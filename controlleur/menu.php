<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 25-12-16
 * Time: 20:38
 */
namespace controlleur;

require_once dirname(__DIR__)."/model/personne/personne.php";
require_once dirname(__DIR__)."/controlleur/message.php";
require_once dirname(__DIR__)."/controlleur/reCaptcha.php";
require_once dirname(__DIR__)."/model/disponibiliter/disponibiliter_T.php";
require_once dirname(__DIR__)."/model/possede/possede.php";
require_once dirname(__DIR__)."/model/restaurant/restaurant.php";
require_once dirname(__DIR__) ."/model/lieu/lieu.php";
require_once dirname(__DIR__) ."/model/horaire_annuel_vacance/horaire_annuel_vac.php";
require_once dirname(__DIR__) ."/model/conger/conger.php";
require_once dirname(__DIR__) . "/model/horaire_resto_effectif/horaire_resto_effect.php";
require_once dirname(__DIR__) ."/controlleur/contrat.php";
require_once dirname(__DIR__)."/controlleur/mail.php";
require_once dirname(__DIR__)."/model/etablir/etablir.php";

use DateTime;
use model\personne;
use controlleur\mail;
use model\possede;
use model\restaurant;
use model\restaurant_T;
use model\lieu;
use model\etablir;

if(!isset($_SESSION)){
    session_start();
}
if(isset($_POST['action']) && $_SESSION['activationCaptcha'] < 3)
{
    $action = $_POST['action'];
    switch ($action)
    {
        case "login":
            $controlleur = new menu();
            $controlleur->login();
            break;
        case "inscrire":
            $controlleur = new menu();
            $controlleur->inscrire();
            break;
        case "reset":
            $controlleur = new menu();
            $controlleur->reseter();
            break;
        case "renitialisation":
            $controlleur = new menu();
            $controlleur->renitialPassword();
            break;
    }
}
elseif (isset($_POST['action']))
{
    if($_SESSION['Captcha']->isValid($_POST['g-recaptcha-response']))
    {
        $action = $_POST['action'];
        switch ($action)
        {
            case "login":
                $controlleur = new menu();
                $controlleur->login();
                break;
            case "inscrire":
                $controlleur = new menu();
                $controlleur->inscrire();
                break;
            case "reset":
                $controlleur = new menu();
                $controlleur->reseter();
                break;
            case "renitialisation":
                $controlleur = new menu();
                $controlleur->renitialPassword();
                break;
        }
    }
    else{
        $message = message::getInstance();
        $message->setFlash('danger', 'Le captcha ne semble pas valide' );
        header('Location: ../index.php');
    }
}


class menu
{
    private $users;
    private $table_personne;
    private $email;
    private $possede;
    private $restaurant;
    private $etablir;
    /**
     * menu constructor.
     */
    public function __construct()
    {
        $this->table_personne = new personne();
        $this->email = new mail();
        $this->possede = new possede();
        $this->message = message::getInstance();
        $this->lieu = new lieu();
        $this->etablir = new etablir();
        $this->restaurant = new restaurant();


    }
    /**
     * renvoie à l'index du menu principal
     */
    public function index()
    {
        return  "vue/template/menu/login.php";
    }
    /**
     * verifie les champs login et password et verifie dans la data base
     */
    public function login()
    {

        if(!empty($_POST) && isset($_POST['nom']) && isset($_POST['password'])) {
            $this->users = $this->table_personne->login($_POST['nom'], $_POST['password']);

            if($this->users){
                if($this->users->getResponsable())
                {
                    if( $this->users->getDateSupr() !== null)
                    {
                        $_SESSION['activationCaptcha'] = 1 + $_SESSION['activationCaptcha'];
                        $this->message->setFlash('danger', 'votre compte a été archiver. Veuillez contacter l administrateur');
                        header('Location: ../index.php');
                    }
                    else if ($this->users->getRappelPassword() == $_POST['password'])
                    {
                        $_SESSION['user'] = $this->users;
                        $this->message->setFlash('success', 'Veuillez ecrire votre mot de passe');
                        header('Location: ../index.php?page=menu.confirmation');
                    }
                    else
                    {
                        $this->message->setFlash('success', 'Bonjour, vous êtes maintenant connecté en temps utilisateur');
                        $_SESSION['user'] = $this->users;
                        $tableauLienRestaurantPossede = $this->possede->rechercherId($this->users->getIdPersonne());
                        $_SESSION['restaurant'] = null;
                        foreach ($tableauLienRestaurantPossede as $value)
                        {
                            $restaurant = $this->restaurant->rechercherId($value->getIdRestaurant());
                            $_SESSION['restaurant'][] = $restaurant;
                            $_SESSION[$restaurant->getIdRestaurant().'lieu'] = $this->lieu->rechercherId($restaurant->getIdLieu());
                        }
                        $this->nombrePersonnel();
                        header('Location: ../index.php?page=menu.menu');
                    }
                }
                elseif ($this->users->getNomPers() === "admin")
                {
                    $this->message->setFlash("success", "Bonjour, vous êtes connecté en temps qu'administrateur");
                    $_SESSION['user'] = $this->users;
                    header('Location: ../index.php?page=personnel.afficherResponsable');

                }
                elseif($this->users->getNomPers() !== null) //pour les les employer et les comptables
                {
                    unset( $_SESSION['horaire']);
                    unset( $_SESSION['chemin']);
                    $_SESSION['user'] = $this->users;
                    $etabli = $this->etablir->rechercheIDRestaurant($this->users->getIdPersonne());
                    $_SESSION['restaurant'] = $this->restaurant->rechercherId($etabli->getIdRestaurant());
                    $dateJour = date("Y/m/j");
                    $date = new DateTime( $dateJour );
                    $jourDate = $date->format("Ymd");
                    foreach (glob("../horaire/" .  $_SESSION['restaurant']->getNomRestau()."/*") as $value)
                    {
                        $date = explode("/", $value);
                        $dateFinal = strftime('%d-%m-%y', strtotime($date[3]));
                        $dateHoraire = new DateTime( $date[3] );
                        $dateHoraire = $dateHoraire->format("Ymd");
                        if( $jourDate <= $dateHoraire )
                        {
                            $_SESSION['horaire'][] = $dateFinal;
                            foreach (glob($value."/*.pdf") as $valeur)
                                $chemin =  substr($valeur,3);
                            $_SESSION['chemin'][] = $chemin;
                        }
                    }
                    $_SESSION['utilisateur'] = true;

                    header('Location:../index.php?page=horaire.menu');

                }
                else
                {
                    $_SESSION['activationCaptcha'] = 1 + $_SESSION['activationCaptcha'];
                    $this->message->setFlash('danger', 'Identifiant ou mot de passe incorrecte');
                    header('Location: ../index.php');
                }

            }
            else
            {
                $_SESSION['activationCaptcha'] = 1 + $_SESSION['activationCaptcha'];
                $this->message->setFlash('danger', 'Identifiant ou mot de passe incorrecte');
                header('Location: ../index.php');
            }
        }
    }
    /*
     * fait la deconnection de user et le retourne sur le menu principal
     */
    public  function deco()
    {
        unset($_SESSION['utilisateur']);
        session_destroy();
        $this->message->setFlash('success', 'Vous êtes maintenant déconnecté');
        header('Location: index.php');
    }
    /*
     * renvoie sur la page reset
     */
    public function reset()
    {
        return "vue/template/menu/reset.php";
    }
    /*
     * renvoie sur la page comfirmation
     */
    public function confirmation()
    {

        return "vue/template/menu/confirmation.php";

    }
    public function menu()
    {
        if(isset($_SESSION['user']) && $_SESSION['user'] != null) {

            $this->nombrePersonnel();
            return "vue/template/menu/menu.php";
        }
        else{
            return $this->index();
        }
    }
    public function reseter()
    {
        if($_SESSION['Captcha']->isValid($_POST['g-recaptcha-response'])) {
            if (!empty($_POST) && isset($_POST['email'])) {
                if ($this->users = $this->table_personne->Rechercheemail($_POST['email'], 1)) {
                    $envoye = $this->email->emailReset($_POST['email'], $this->users->getNomPers(), $this->users->getRappelPassword());

                    if ($envoye) {

                        $this->message->setFlash('success', 'un mail a été envoyé pour reseter votre compte. <br> il est possible que que le courier indésirable');
                        header('Location: ../index.php');
                    } else {

                        $this->message->setFlash('danger', 'erreur dans l envoie du mail');
                        header('Location: ../index.php?page=menu.reset');
                    }
                } else {
                    $this->message->setFlash('danger', 'erreur dans l addresse mail');
                    header('Location: ../index.php?page=menu.reset');
                }
            } else {
                $_SESSION['activationCaptcha'] = 1 + $_SESSION['activationCaptcha'];
                $this->message->setFlash('danger', 'erreur dans le formulaire');
                header('Location: ../index.php?page=menu.reset');
            }
        }
        else {
            $_SESSION['activationCaptcha'] = 1 + $_SESSION['activationCaptcha'];
            $this->message->setFlash('danger', 'erreur dans le formulaire');
            header('Location: ../index.php?page=menu.reset');
        }
    }
    public function renitialPassword()
    {

        if(!empty($_POST)  && isset($_POST['password']) )
        {
            $longeurPassword = strlen($_POST['password']);
            $longeur = ($longeurPassword * 4)*($longeurPassword/3);
            $texte1 = $longeur;
            $texte2 = $longeur + $longeurPassword;
            $passwordProvisoire = sha1($texte1.$_POST['password'].$texte2);
            $password = md5($passwordProvisoire);
            $_SESSION['user']->setPassword($password);
            $this->table_personne->modifier( $_SESSION['user']);
            $tableauLienRestaurantPossede = $this->possede->rechercherId($_SESSION['user']->getIdPersonne());
            $_SESSION['restaurant'] = null;
            foreach ($tableauLienRestaurantPossede as $value)
            {
                $restaurant = $this->restaurant->rechercherId($value->getIdRestaurant());
                $_SESSION['restaurant'][] = $restaurant;
                $_SESSION[$restaurant->getIdRestaurant().'lieu'] = $this->lieu->rechercherId($restaurant->getIdLieu());
            }
            $this->nombrePersonnel();
            header('Location: ../index.php?page=menu.menu');
        }
        else
        {
            $this->message->setFlash('danger', 'soucie dans le formulaire');
            header('Location: ../index.php');
        }
    }

    private function nombrePersonnel()
    {
        if(isset($_SESSION['restaurant'])) {
            foreach ($_SESSION['restaurant'] as $value) {
                $_SESSION[$value->getNomRestau() . " " . $value->getIdRestaurant()] = $this->table_personne->nombrePersonnelDuRestaurant($value->getIdRestaurant());
            }
        }
    }
}