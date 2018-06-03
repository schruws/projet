<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 06-01-17
 * Time: 19:47
 */
namespace controlleur;

require_once dirname(__DIR__) ."/model/personne/personne_T.php";
require_once dirname(__DIR__)."/model/personne/personne.php";
require_once dirname(__DIR__)."/model/disponibiliter/disponibiliter.php";
require_once dirname(__DIR__)."/model/proposer/proposer.php";
require_once dirname(__DIR__)."/model/etablir/etablir.php";
require_once dirname(__DIR__)."/model/disponibiliter/disponibiliter_T.php";
require_once dirname(__DIR__) ."/model/lieu/lieu.php";
require_once dirname(__DIR__) ."/model/residentiel/residentiel.php";
require_once dirname(__DIR__)."/controlleur/mail.php";
require_once dirname(__DIR__)."/controlleur/message.php";
require_once dirname(__DIR__)."/model/restaurant/restaurant.php";
require_once dirname(__DIR__) . "/model/fonction/fonction.php";
require_once dirname(__DIR__) . "/model/attribuer/attribuer.php";
require_once dirname(__DIR__) . "/model/etablir/etablir.php";
require_once dirname(__DIR__) . "/model/contrat/contr.php";
require_once dirname(__DIR__) . "/model/nationalite/nationalite.php";
require_once dirname(__DIR__) . "/model/competence/competence.php";
require_once dirname(__DIR__) . "/model/dispose/dispose.php";
require_once dirname(__DIR__) ."/model/conger/conger.php";

use model\disponibiliter;
use model\personne;
use model\proposer;
use model\lieu;
use model\residentiel;
use model\contr;
use model\attribuer;
use model\fonction;
use model\etablir;
use model\nationalite;
use model\competence;
use model\dispose;

if(!isset($_SESSION)){
    session_start();
}

if(isset($_POST['action']))
{
    $action = $_POST['action'];
    switch ($action)
    {
        case "creer":
            $controlleur = new personnel();
            $controlleur->creerPersonnel();
            break;
        case "modifier":
            $controlleur = new personnel();
            $controlleur->modifierPersonnel();
            break;
        case "suprimer":
            $controlleur = new personnel();
            $controlleur->suprimerPersonnel();
            break;
        case "consulter":
            $controlleur = new personnel();
            $controlleur->consulterPersonnel();
            break;
        case "restaurant":
            $controlleur = new personnel();
            $controlleur->affichePersonnelDuRestaurant();
            break;
        case "modification":
            $controlleur = new personnel();
            $controlleur->modificationPersonne();
            break;
        case "afficher":
            $controlleur = new personnel();
            $controlleur->afficheNouveauContract();
            break;
        case "effacer":
            $controlleur = new personnel();
            $controlleur->effacerPerssonel();
            break;
        case "retablir":
            $controlleur = new personnel();
            $controlleur->retablirPersonne();
            break;
        case "retabli":
            $controlleur = new personnel();
            $controlleur->retabliPersonne();
            break;
    }
}
class personnel
{
    private $personne;
    private $personneConnecte;
    private $disponibiliterPersonne;
    private $lienDisponibiliterPersonne;
    private $premis = "";
    private $lieu;
    private $residentiel;
    private $message;
    private $contr;
    private $fonction;
    private $attribue;
    private $etabli;
    private $nationalite;
    private $competence;
    private $dispose;




    /**
     * personnel constructor.
     */
    public function __construct()
    {
        $this->personne = new personne();
        $this->disponibiliterPersonne = new disponibiliter();
        $this->lienDisponibiliterPersonne = new proposer();
        $this->personneConnecte = $_SESSION['user'];
        $this->lieu = new lieu();
        $this->residentiel = new residentiel();
        $this->message = message::getInstance();
        $this->email = new mail();
        $this->contr = new contr();
        $this->fonction = new fonction();
        $this->attribue = new attribuer();
        $this->etabli =new etablir();
        $this->nationalite = new nationalite();
        $this->competence = new competence();
        $this->dispose = new dispose();
        $this->dateIntedermine = "2035-12-31";
    }
    public function creerPersonnel()
    {
        if(isset($_POST["responsable"]) && ($_POST["responsable"] === "on"))
        {
            $_POST["responsable"] = 1;
        }
        else
        {
            $_POST["responsable"] = 0;
        }
        if(isset($_POST['permis']))
        {
            foreach ($_POST['permis'] as $value)
            {
                $this->premis .= $value. ",";
            }
        }
        if(($_POST["année"] !== "") && ( $_POST['mois'] !== "") && ($_POST['jour'] !== ""))
        {
            $_POST["dateNaissance"] = $_POST["année"] . "-" . $_POST['mois'] . "-" . $_POST['jour'];
        }
        if($_SESSION['user']->getNomPers() !== "admin") {
            $_POST["dateDebutContrat"] = $_POST["anneeDebut"] . "-" . $_POST['moisDebut'] . "-" . $_POST['jourDebut'];
            if(isset($_POST["typeContrat"])  && ($_POST["typeContrat"] !== "CDI") && ($_POST["anneeFin"] !== "") && ( $_POST['moisFin'] !== "") && ($_POST['jourFin'] !== "") ) {
                $_POST["dateFinContrat"] = $_POST["anneeFin"] . "-" . $_POST['moisFin'] . "-" . $_POST['jourFin'];
            }
            elseif($_POST["typeContrat"] === "CDI") // date intedermine
            {
                $_POST["dateFinContrat"] = $this->dateIntedermine;
            }
        }
        else /*la création de compte utilisateur avec admin  est d'office responsable*/
        {
            $_POST["responsable"] = 1;
        }
        $lieuCreer = $this->lieu->creer($_POST);
        if(isset($_POST['nationalite'])) {
            $nouvelleNationalite = $this->nationalite->rechercherNom($_POST['nationalite']);
            if($nouvelleNationalite->getIdNationalite() === null)
            {
                $nouvelleNationalite = $this->nationalite->creer($_POST);
            }
            $_POST['idNationalite'] =  $nouvelleNationalite->getIdNationalite();
        }
        $_POST['idLieu'] = $lieuCreer->getIdLieu();
        $_POST['permisDeConduire'] = $this->premis;
        $_POST['dateEncodage'] = date("Y/m/j");
        $disponibiliterPersonne = $this->disponibiliterPersonne->creer($_POST);
        $_POST['idDisponibilitees'] = $disponibiliterPersonne->getIdDisponibilitees();
        $personne = $this->personne->creer($_POST);

        // creation de la residentiel //

        if(isset($_POST["Residentiel"]))
        {
            $tableau = array("rue", "numero", "codePostal", "localite");
            $tableauEnvoie = array();
            $i = 0;
            foreach ($_POST["Residentiel"] as $value)
            {
                $tableauEnvoie[$tableau[$i]] = $value;
                $i++;
                if($i === 4)
                {
                    $lieuCreer = $this->lieu->creer($tableauEnvoie);
                    $table = array(
                        'idLieu' => $lieuCreer->getIdLieu(),
                        'idPersonne' => $personne->getIdPersonne() ,
                    );
                    $this->residentiel->creer($table);
                    unset($table);
                    unset($tableauEnvoie);
                    $i = 0;
                }
            }
        }
        // fin de la residentiel //
        if($_SESSION['user']->getNomPers() === "admin")
        {
            $envoye = $this->email->nouveauGerant($_POST['email'], $personne->getNomPers(),$personne->getRappelPassword());

            if($envoye) {

                $this->message->setFlash('success', 'un mail a été envoyé aux nouveau gérant <br> il est possible qu il soit dans les courriers indésirable');
                header('Location: ../index.php?page=personnel.afficherResponsable');
            }
            else
            {

                $this->message->setFlash('danger', 'erreur dans l envoie du mail');
                header('Location: ../index.php?page=personnel.afficherResponsable');
            }
        }
        else
        {
            // creation du contrat
            $fonct =  $this->fonction->creer($_POST);
            $contr = $this->contr->creer($_POST);
            $table = array(
                'idFonction' => $fonct->getIdFonction(),
                'idContrat' => $contr->getIdContrat() ,
            );
            $this->attribue->creer($table);
            $table = array(
                'idContrat' => $contr->getIdContrat() ,
                'idPersonne' => $personne->getIdPersonne() ,
                'idRestaurant' =>  $_SESSION['restaurantContrat']->getIdRestaurant(),
            );
            $this->etabli->creer($table);
            $idCompetence = $this->competence->rechercherNom($_POST['nomComp']);
            if($idCompetence->getIdCompetence() === null)
            {
                $idCompetence = $this->competence->creer($_POST['nomComp']);
            }
            $table = array(
                'idCompetence' => $idCompetence->getIdCompetence() ,
                'idPersonne' => $personne->getIdPersonne() ,
            );
            $this->dispose->creer($table);
            $this->message->setFlash('success', 'la personne a bien été crée');
            header('Location:../index.php?page=menu.menu');
        }

    }
    /**
     *
     */
    public function suprimerPersonnel()
    {
        if(isset($_POST["idPersonnel"])) {
            $this->recherchePersonne();
            $this->message->setFlash('danger', 'Vous allez supprimer cette personne du restaurant');
            $_SESSION['modifier'] = false;
            $_SESSION['effacer'] = true;
            $_SESSION['action'] = "personnel.effacer";
            header('Location:../index.php?page=personnel.afficheLaPersonne');
        }
    }
    public function effacerPerssonel()
    {
        $compteur = 0;
        foreach ($_SESSION["personnel"] as $value)
        {
            if($value->getIdPersonne() === $_SESSION["consulter"]->getIdPersonne())
            {
                $value->setDateSupr(date("Y/m/j"));
                $_SESSION["Personnel"][$compteur] = $value;
                $this->personne->modifier($value);
            }
            $compteur++;
        }
        if($_SESSION['user']->getNomPers() === "admin")
        {
            header('Location: ../index.php?page=personnel.afficherResponsable');
        }
        else
        {
            header('Location:../index.php?page=menu.menu');
        }


    }
    /**
     *
     */
    public function modifierPersonnel()
    {
        if(isset($_POST["idPersonnel"]))
        {
            $this->recherchePersonne();
            $this->message->setFlash('warning', 'vous allez modifier les données de l employé '.$_SESSION['consulter']->getNomPers()." ".$_SESSION['consulter']->getPrenom()."");
            $_SESSION['action'] = "personnel.modification";
            $_SESSION['modifier'] = true;
            header('Location:../index.php?page=personnel.afficheLaPersonne');
        }
    }
    public function modificationPersonne()
    {
        if(isset($_POST['permis']))
        {
            foreach ($_POST['permis'] as $value)
            {
                $this->premis .= $value. ",";
            }
        }
        if(isset($_POST["responsable"]) && ($_POST["responsable"] === "on"))
        {
            $_POST["responsable"] = 1;
            $_POST['password'] = $_SESSION["consulter"]->getPassword();
        }
        else
        {
            $_POST["responsable"] = 0;
        }
        $_POST["dateNaissance"] = $_POST["année"]."-".$_POST['mois']."-".$_POST['jour'];
        $_POST['permisDeConduire'] = $this->premis;
        $_POST["idLieu"] = $_SESSION["lieuDomicile"]->getIdLieu();
        $_POST["idDisponibilitees"] = $_SESSION["consulter"]->getIdDisponibilitees();
        $_POST['idPersonne'] = $_SESSION["consulter"]->getIdPersonne();
        $this->lieu->modifier($_POST);
        $_POST['dateDerniereModif'] = date("Y/m/j");
        if(isset($_POST['nationalite'])) {
            $nouvelleNationalite = $this->nationalite->rechercherNom($_POST['nationalite']);
            if($nouvelleNationalite->getIdNationalite() === null)
            {
                $nouvelleNationalite = $this->nationalite->creer($_POST);
            }
            $_POST['idNationalite'] =  $nouvelleNationalite->getIdNationalite();
        }
        $modification = $this->personne->modifier($_POST);
        $this->disponibiliterPersonne->modifier($_POST);


        if (isset($_POST["Residentiel"])) {
            $tableau = array("rue", "numero", "codePostal", "localite", "idLieu");
            $tableauEnvoie = array();
            $i = 0;
            foreach ($_POST["Residentiel"] as $value) {
                $tableauEnvoie[$tableau[$i]] = $value;
                $i++;
                if ($i === 4) {
                    $tableauEnvoie["idLieu"] = $_SESSION["lieuResidentiel"]->getIdLieu();
                    $this->lieu->modifier($tableauEnvoie);
                    unset($table);
                    unset($tableauEnvoie);
                    $i = 0;
                }
            }
        }

        $compteur = 0;
        foreach ($_SESSION["personnel"] as $value)
        {
            if($value->getIdPersonne() === $modification->getIdPersonne())
            {
                $_SESSION["personnel"][$compteur] = $modification;
            }
            $compteur++;
        }
        if($_SESSION['user']->getNomPers() === "admin")
        {
            header('Location:../index.php?page=personnel.afficherResponsable');
        }
        else
        {
            header('Location:../index.php?page=menu.menu');
        }
    }
    /**
     *
     */
    public function consulterPersonnel()
    {
        if(isset($_POST["idPersonnel"]))
        {
            $this->recherchePersonne();
            $_SESSION['action'] = "#";
            $_SESSION['modifier'] = false;
            header('Location:../index.php?page=personnel.afficheLaPersonne');
        }
    }
    public function affichePersonnelDuRestaurant()
    {
        if(isset($_POST["idRestaurant"]))
        {
            $_SESSION['personnel'] = $this->personne->PersonnelDuRestaurant($_POST["idRestaurant"]);
            //$_SESSION['personnelDuRestaurant'] = true;
            foreach ($_SESSION['restaurant'] as $value) {
                if ($_POST["idRestaurant"] === $value->getIdRestaurant()) {
                    $_SESSION['restaurantContrat'] = $value;
                }
            }
            header('Location:../index.php?page=personnel.menu');
        }
    }
    public function affichePersonnelDeTousRestaurant()
    {
        foreach ($_SESSION['restaurant'] as $value)
        {
            $_SESSION[$value->getNomRestau()." ".$value->getIdRestaurant()] = $this->personne->PersonnelDuRestaurant($value->getIdRestaurant());
        }

        $_SESSION['personnel'] = $this->personne->afficherAll();
        // $_SESSION['personnelDuRestaurant'] = false;
        $_SESSION['afficheTous']= true;
        return "vue/template/personnel/menu.php";
    }
    public function afficherResponsable()
    {
        $_SESSION['personnel'] = $this->personne->afficherResponsabe();
        return "vue/template/personnel/menu.php";
    }
    public function afficheLaPersonne()
    {
        if(isset($_SESSION['modifier']) && ($_SESSION['modifier'] === true))
        {
            $_SESSION['disabled'] = 'false';
        }
        else
        {
            $_SESSION['disabled'] = 'disabled';
        }
        $_POST['nationalite'] = $this->nationalite->rechercherId($_SESSION['consulter']->getIdNationalite());
        $_SESSION['nationalite'] = $this->nationalite->afficherAll();
        $_POST['naissance'] = explode("-",  $_SESSION["consulter"]->getDateNaissance() );
        $tableau = explode(",", $_SESSION["consulter"]->getPermisDeConduire());
        foreach ($tableau as $value)
        {
            $_POST[$value] = true;
        }
        return "vue/template/personnel/modifier.php";
    }
    public function modifier(){


    }
    public function afficheNouveauContract()
    {
        if(isset($_POST['idRestaurant']))
        {
            foreach ($_SESSION['restaurant'] as $value)
            {
                if($_POST['idRestaurant'] === $value->getIdRestaurant())
                {

                    $_SESSION['restaurantContrat'] = $value;
                    header('Location: ../index.php?page=personnel.ajouterPersonnel');
                    $this->message->setFlash('success', 'vous allez créer un contrat pour le restaurant '.$value->getNomRestau());
                }
            }
        }
    }
    public function ajouterPersonnel()
    {
        $_POST['competence'] = $this->competence->afficherAll();
        $_SESSION['nationalite'] = $this->nationalite->afficherAll();
        return "vue/template/personnel/ajouter.php";
    }
    public function menu(){

        if(isset($_SESSION['personnel']))
        {
            foreach ($_SESSION['personnel'] as $value)
            {
                $_POST[$value->getIdPersonne()] = $this->personne->contratPersonnes($value->getIdPersonne(), $_SESSION['restaurantContrat']->getIdRestaurant());
            }
        }

        return "vue/template/personnel/menu.php";
    }
    private function recherchePersonne()
    {
        foreach ($_SESSION['personnel'] as $value)
        {
            if($value->getIdPersonne() === $_POST["idPersonnel"])
            {
                $_SESSION["consulter"] = $value;
                $_SESSION["lieuDomicile"]= $this->lieu->rechercherId($_SESSION["consulter"]->getIdLieu());
                $lienResidentiel = $this->residentiel->rechercherId($_SESSION["consulter"]->getIdPersonne());
                $_SESSION["lieuResidentiel"]= $this->lieu->rechercherId($lienResidentiel->getIdLieu());
                $_SESSION['disponibiliter'] = $this->disponibiliterPersonne->rechercherId($_SESSION["consulter"]->getIdDisponibilitees());
            }
        }
    }
    public function retablirPersonne()
    {
        if(isset($_POST["idPersonnel"])) {
            $this->recherchePersonne();
            $this->message->setFlash('warning', 'Vous allez restaurer cette personne');
            $_SESSION['modifier'] = false;
            $_SESSION['retablir'] = true;
            $_SESSION['action'] = "personnel.retabli";
            header('Location:../index.php?page=personnel.afficheLaPersonne');
        }
    }
    public function retabliPersonne()
    {
        $compteur = 0;
        foreach ($_SESSION["personnel"] as $value)
        {
            if($value->getIdPersonne() === $_SESSION["consulter"]->getIdPersonne())
            {
                $value->setDateSupr(null);
                $value->setDateDerniereModif(date("Y/m/j"));
                $_SESSION["Personne"][$compteur] = $value;
                $this->personne->modifier($value);
            }
            $compteur++;
        }
        if($_SESSION['user']->getNomPers() === "admin")
        {
            header('Location:../index.php?page=personnel.afficherResponsable');
        }
        else
        {
            header('Location:../index.php?page=menu.menu');
        }
    }
}