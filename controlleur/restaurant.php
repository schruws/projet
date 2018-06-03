<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 11-02-17
 * Time: 15:40
 */

namespace controlleur;

use model\horaire_resto_effect;
use model\lieu;

require_once dirname(__DIR__) ."/model/restaurant/restaurant.php";
require_once dirname(__DIR__) ."/model/lieu/lieu.php";
require_once dirname(__DIR__) ."/model/possede/possede.php";
require_once dirname(__DIR__) ."/model/personne/personne.php";
require_once dirname(__DIR__) ."/model/lieu/lieu_T.php";
require_once dirname(__DIR__)."/controlleur/message.php";
require_once dirname(__DIR__) ."/model/typeDeCuisine/typeDeCuisine.php";
require_once dirname(__DIR__) ."/model/detenir/detenir.php";
require_once dirname(__DIR__) ."/model/competence/competence.php";
require_once dirname(__DIR__) ."/model/horaire_resto_effectif/horaire_resto_effect.php";

use model\possede;
use model\typeDeCuisine;
use model\detenir;
use model\competence;

if(!isset($_SESSION)){
    session_start();
}

if(isset($_POST['action']))
{
    $action = $_POST['action'];
    switch ($action)
    {
        case "creer":
            $controlleur = new restaurant();
            $controlleur->creerRestaurant();
            break;
        case "modifier":
            $controlleur = new restaurant();
            $controlleur->modifierRestaurant();
            break;
        case "suprimer":
            $controlleur = new restaurant();
            $controlleur->suprimerRestaurant();
            break;
        case "consulter":
            $controlleur = new restaurant();
            $controlleur->consulterRestaurant();
            break;
        case "modification":
            $controlleur = new restaurant();
            $controlleur->modificationRestaurant();
            break;
        case "effacer":
            $controlleur = new restaurant();
            $controlleur->effacerRestaurant();
            break;
        case "retablir":
            $controlleur = new restaurant();
            $controlleur->retablirRestaurant();
            break;
        case "retabli":
            $controlleur = new restaurant();
            $controlleur->retabliRestaurant();
            break;
    }
}

class restaurant
{
    private $restaurant;
    private $lieu;
    private $possede;
    private $message;
    private $typeCuisine;
    private $detenir;
    private $jour;
    private $competence;
    private $horaireEffectif;

    public function __construct()
    {
        $this->restaurant = new \model\restaurant();
        $this->lieu = new lieu();
        $this->possede = new possede();
        $this->message = message::getInstance();
        $this->typeCuisine = new typeDeCuisine();
        $this->detenir = new detenir();
        $this->jour = array("lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche");
        $this->competence = new competence();
        $this->horaireEffectif = new horaire_resto_effect();
    }

    /**
     *
     */
    public function creerRestaurant()
    {

        if($_POST['parking'] === "")
        {
            $_POST['parking'] = 0;
        }
        if($_POST['terasse'] === "")
        {
            $_POST['terasse'] = 0;
        }
        if($_POST['nombreCouvert'] === "")
        {
            $_POST['nombreCouvert'] = 0;
        }
        // creation du lieu du retaurant
        $lieuCreer = $this->lieu->creer($_POST);
        $_POST['idLieu'] = $lieuCreer->getIdLieu();
        $_POST['dateEncodage'] = date("Y/m/j");
        // creation du restaurant
        $resto = $this->restaurant->creer($_POST);
        // lie le restaurant avec l'utilisateur
        $table = array(

            'idPersonne' => $_SESSION['user']->getIdPersonne(),
            'idRestaurant' =>  $resto->getIdRestaurant(),
        );
        $this->possede->creer($table);
        //
        // explode les différents type de cuisinne si utilisateur en a mis plusieur et les mets dans la bdd
        if(isset($_POST['typeDeCuisine'])) {
            $tableau = explode(",", $_POST['typeDeCuisine']);
            foreach ($tableau as $value) {
                if( $value[0] === " ")
                {
                    $value = trim($value);
                }
                // verifie qu'une des type de cuisinnes est déjà dans la bdd
                $cuisine = $this->typeCuisine->rechercherNom($value);
                if ($cuisine->getIdCuisinne() === null) { // si null la creer
                    $table = array("typeDeCuisinne" => $value);
                    $cuisine = $this->typeCuisine->creer($table);
                }
                $table = array( // lie le type de cuisinne avec le restaurant

                    'idCuisinne' => $cuisine->getIdCuisinne(),
                    'idRestaurant' =>  $resto->getIdRestaurant(),
                );
                $this->detenir->creer($table);
            }
        }
        //
        // creer le nombre effectif pour chaque journer
        $competence = $this->competence->afficherAll();
        $valeur = count($competence);
        // les données sont envoyé via array exemple LundiMidi[2,2,2,2]
        foreach($this->jour as $jour) {
            for ($indice = 0; $indice < $valeur; $indice++) {
                $table = array(

                    "jour" => $jour . ".midi",
                    "besoin" => $_POST[$jour . "Midi"][$indice],
                    "idCompetence" => $competence[$indice]->getIdCompetence(),
                    'idRestaurant' => $resto->getIdRestaurant(),
                );
                $this->horaireEffectif->creer($table);
                $table = array(

                    "jour" => $jour . ".soir",
                    "besoin" => $_POST[$jour . "Soir"][$indice],
                    "idCompetence" => $competence[$indice]->getIdCompetence(),
                    'idRestaurant' => $resto->getIdRestaurant(),
                );
                $this->horaireEffectif->creer($table);
            }
        }
        $_SESSION['restaurant'][] = $resto;
        $_SESSION[$resto->getIdRestaurant().'lieu'] = $this->lieu->rechercherId($resto->getIdLieu());
        header('Location: ../index.php?page=menu.menu');
    }
    public function modifierRestaurant()
    {
        if(isset($_POST["idRestaurant"])) {
            $this->rechercheRestaurant();
            $this->message->setFlash('warning', 'Vous allez modifier les données du restaurant');
            $_SESSION['action'] = "restaurant.modification";
            $_SESSION['modifier'] = true;
            header('Location:../index.php?page=restaurant.afficheLeRestaurant');
        }
    }
    public function suprimerRestaurant()
    {
        if(isset($_POST["idRestaurant"])) {
            $this->rechercheRestaurant();
            $this->message->setFlash('danger', 'Vous allez supprimer ce restaurant');
            $_SESSION['modifier'] = false;
            $_SESSION['effacer'] = true;
            $_SESSION['action'] = "restaurant.effacer";
            header('Location:../index.php?page=restaurant.afficheLeRestaurant');
        }
    }
    public function consulterRestaurant()
    {
        if(isset($_POST["idRestaurant"])) {
            $this->rechercheRestaurant();
            $_SESSION['modifier'] = false;
            $_SESSION['action'] = "#";
            header('Location:../index.php?page=restaurant.afficheLeRestaurant');
        }
    }
    public function afficheLeRestaurant(){

        if(isset($_SESSION['modifier']) && ($_SESSION['modifier'] === true))
        {
            $_SESSION['disabled'] = 'false';
        }
        else
        {
            $_SESSION['disabled'] = 'disabled';
        }
        $_POST['typeCuisinne'] = $this->typeCuisine->afficherAll();
        return "vue/template/restaurant/modifier.php";
    }
    public function modificationRestaurant()
    {
        $_POST["idLieu"] = $_SESSION["lieu"]->getIdLieu();
        $_POST["idRestaurant"] = $_SESSION["consulter"]->getIdRestaurant();
         $this->lieu->modifier($_POST);
        $_POST['dateDerniereModif'] = date("Y/m/j");
         $modification = $this->restaurant->modifier($_POST);
         $compteur = 0;
        foreach ($_SESSION["restaurant"] as $value)
        {
            if($value->getIdRestaurant() === $modification->getIdRestaurant())
            {
                $_SESSION["restaurant"][$compteur] = $modification;
                $_SESSION[$modification->getIdRestaurant().'lieu'] = $this->lieu->rechercherId($modification->getIdLieu());
            }
            $compteur++;
        }
        if(isset($_POST['typeDeCuisine'])) {
            $this->detenir->suprimeIdRestaurant($modification->getIdRestaurant());
            $tableau = explode(",", $_POST['typeDeCuisine']);
            foreach ($tableau as $value) {
                if( $value[0] === " ")
                {
                    $value = trim($value);
                }
                $cuisine = $this->typeCuisine->rechercherNom($value);
                if ($cuisine->getIdCuisinne() === null) {
                    $table = array("typeDeCuisinne" => $value);
                    $cuisine = $this->typeCuisine->creer($table);
                }
                $table = array(

                    'idCuisinne' => $cuisine->getIdCuisinne(),
                    'idRestaurant' =>  $modification->getIdRestaurant(),
                );
                $this->detenir->creer($table);
            }
        }
        header('Location:../index.php?page=menu.menu');
    }
    public function effacerRestaurant()
    {

        $compteur = 0;
        foreach ($_SESSION["restaurant"] as $value)
        {
            if($value->getIdRestaurant() === $_SESSION["consulter"]->getIdRestaurant())
            {
                $value->setDateSupr(date("Y/m/j"));
                $_SESSION["restaurant"][$compteur] = $value;
                $this->restaurant->modifier($value);
                $_SESSION[$value->getIdRestaurant().'lieu'] = $this->lieu->rechercherId($value->getIdLieu());
            }
            $compteur++;
        }
        header('Location:../index.php?page=menu.menu');
    }
    public function ajouterRestaurant()
    {
        $_POST['jour'] = $this->jour;
        $_POST['competence'] = $this->competence->afficherAll();
        $_POST['typeCuisinne'] = $this->typeCuisine->afficherAll();
        return "vue/template/restaurant/ajouter.php";
    }
    private function rechercheRestaurant()
    {
        foreach ($_SESSION["restaurant"] as $value)
        {
            if($value->getIdRestaurant() === $_POST["idRestaurant"])
            {
                $_SESSION["consulter"] = $value;
                $_SESSION["lieu"]= $this->lieu->rechercherId($_SESSION["consulter"]->getIdLieu());
                $tableau =  $this->detenir->rechercheIDRestaurant($_SESSION["consulter"]->getIdRestaurant());
                $table = array();
                foreach ($tableau as $donnee)
                {
                    $cuisinne = $this->typeCuisine->rechercherId($donnee->getIdCuisinne());
                    $table[] = $cuisinne->getTypeDeCuisinne();
                }
                $_SESSION['typeDeCuisine'] = join(", ", $table);
            }
        }
    }
    public function retablirRestaurant()
    {
        if(isset($_POST["idRestaurant"])) {
            $this->rechercheRestaurant();
            $this->message->setFlash('warning', 'Vous allez rétablir ce restaurant');
            $_SESSION['modifier'] = false;
            $_SESSION['retablir'] = true;
            $_SESSION['action'] = "restaurant.retabli";
            header('Location:../index.php?page=restaurant.afficheLeRestaurant');
        }
    }
    public function retabliRestaurant()
    {
        $compteur = 0;
        foreach ($_SESSION["restaurant"] as $value)
        {
            if($value->getIdRestaurant() === $_SESSION["consulter"]->getIdRestaurant())
            {
                $value->setDateSupr(null);
                $value->setDateDerniereModif(date("Y/m/j"));
                $_SESSION["restaurant"][$compteur] = $value;
                $this->restaurant->modifier($value);
                $_SESSION[$value->getIdRestaurant().'lieu'] = $this->lieu->rechercherId($value->getIdLieu());
            }
            $compteur++;
        }
        header('Location:../index.php?page=menu.menu');
    }
}