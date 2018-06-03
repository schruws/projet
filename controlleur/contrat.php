<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 10-03-17
 * Time: 20:19
 */


namespace controlleur;
require_once dirname(__DIR__) . "/model/personne/personne.php";
require_once dirname(__DIR__) . "/model/restaurant/restaurant_T.php";
require_once dirname(__DIR__) . "/model/fonction/fonction.php";
require_once dirname(__DIR__) . "/model/attribuer/attribuer.php";
require_once dirname(__DIR__) . "/model/etablir/etablir.php";
require_once dirname(__DIR__) . "/model/contrat/contr.php";
require_once dirname(__DIR__)."/controlleur/message.php";
require_once dirname(__DIR__) . "/model/competence/competence.php";
require_once dirname(__DIR__) . "/model/dispose/dispose.php";


use model\contr;
use model\attribuer;
use model\fonction;
use model\etablir;
use model\personne;
use model\competence;
use model\dispose;


if(!isset($_SESSION)){
    session_start();
}
if(isset($_POST['action'])) {

    $action = $_POST['action'];
    switch ($action) {
        case "creer":
            $controlleur = new contrat();
            $controlleur->creerContrat();
            break;
        case "modifier":
            $controlleur = new contrat();
            $controlleur->modifierContrat();
            break;
        case "suprimer":
            $controlleur = new contrat();
            $controlleur->suprimerContrat();
            break;
        case "effacer":
            $controlleur = new contrat();
            $controlleur->effacerContrat();
            break;
        case "afficher":
            $controlleur = new contrat();
            $controlleur->afficherContrat();
            break;
        case "consulter":
            $controlleur = new contrat();
            $controlleur->consulterContrat();
            break;
        case "retablir":
            $controlleur = new contrat();
            $controlleur->retablirContrat();
            break;
        case "retabli":
            $controlleur = new contrat();
            $controlleur->retabliContrat();
            break;
        case "lier":
            $controlleur = new contrat();
            $controlleur->lier();
            break;
        case  "modification" :
            $controlleur = new contrat();
            $controlleur->modificationContrat();
            break;
        case "lierRestaurant":
            $controlleur = new contrat();
            $controlleur->lierRestaurant();
            break;


    }
}
class contrat
{
    private $contr;
    private $fonction;
    private $attribue;
    private $etabli;
    private $personne;
    private $message;
    private $competence;
    private $dispose;

    public function __construct()
    {
        $this->contr = new contr();
        $this->fonction = new fonction();
        $this->attribue = new attribuer();
        $this->etabli =new etablir();
        $this->personne = new personne();
        $this->message = message::getInstance();
        $this->competence = new competence();
        $this->dispose = new dispose();
        $this->dateIntedermine = "2035-12-31";
    }

    public function creerContrat()
    {

        $fonct =  $this->fonction->creer($_POST);

        $_POST["dateDebutContrat"] = $_POST["anneeDebut"]."-".$_POST['moisDebut']."-".$_POST['jourDebut'];
        if(isset($_POST["typeContrat"])  && ($_POST["typeContrat"] !== "CDI") ) {
            $_POST["dateFinContrat"] = $_POST["anneeFin"] . "-" . $_POST['moisFin'] . "-" . $_POST['jourFin'];
        }
        else // date intedermine
        {
            $_POST["dateFinContrat"] = $this->dateIntedermine;
        }
        $contr = $this->contr->creer($_POST);
        $table = array(
            'idFonction' => $fonct->getIdFonction(),
            'idContrat' => $contr->getIdContrat() ,
        );
        $this->attribue->creer($table);
        $table = array(
            'idContrat' => $contr->getIdContrat() ,
            'idPersonne' => $_SESSION['consulter']->getIdPersonne() ,
            'idRestaurant' => $_SESSION['restaurantContrat']->getIdRestaurant(),
        );
        $ancienContract = $this->contr->contractPersonne($_SESSION['consulter']->getIdPersonne());
        $this->etabli->creer($table);
        /*
         * mets le contrat actif a null
         * */
        $ancienContract->setDateFinContrat(null);
        $this->contr->modifier($ancienContract);
        header('Location: ../index.php?page=menu.menu');
    }
    public function modifierContrat()
    {

        $this->rechercheContrat();
        $_SESSION['action'] = "contrat.modification";
        $_SESSION['modifier'] = true;
        header('Location:../index.php?page=contrat.afficherLeContrat');
    }
    public function modificationContrat()
    {
        $_POST["idContrat"] = $_SESSION['contratConsulter']->getIdContrat();
        /* modification de la note et de l'avis */
        $this->etabli->modifier($_POST);
        /* modification du contrat */
        $_POST["dateDebutContrat"] = $_POST["anneeDebut"]."-".$_POST['moisDebut']."-".$_POST['jourDebut'];
        $_POST["dateFinContrat"] = $_POST["anneeFin"]."-".$_POST['moisFin']."-".$_POST['jourFin'];
        $this->contr->modifier($_POST);
        /*modification de la fonction*/
        $_POST["idFonction"] = $_SESSION["fonction"]->getIdFonction();
        $this->fonction->modifier($_POST);
        /*modification de dispose*/
        $_POST['idPersonne'] = $_SESSION['consulter']->getIdPersonne();
        /* supression du lien de dispose*/
        $table = array(
            'idCompetence' => $_SESSION['competence']->getIdCompetence() ,
            'idPersonne' => $_SESSION['consulter']->getIdPersonne() ,
        );
        $this->dispose->suprimerId($table);
        /* creation du nouveaux lien dispose*/
        $idCompetence = $this->competence->rechercherNom($_POST['nomComp']);
        if($idCompetence->getIdCompetence() === null)
        {
            $idCompetence = $this->competence->creer($_POST['nomComp']);
        }
        $table = array(
            'idCompetence' => $idCompetence->getIdCompetence() ,
            'idPersonne' => $_SESSION['consulter']->getIdPersonne() ,
        );
        $this->dispose->creer($table);
        header('Location: ../index.php?page=menu.menu');

    }
    public function suprimerContrat()
    {
        $this->rechercheContrat();
        $_SESSION['action'] = "contrat.effacer";
        $this->message->setFlash('danger', 'Vous allez supprimer cette personne et son contrat');
        $_SESSION['modifier'] = false;
        $_SESSION['effacer'] = true;
        header('Location:../index.php?page=contrat.afficherLeContrat');
    }
    public function effacerContrat()
    {
        $_SESSION["contratConsulter"]->setDateFinContrat(date("Y/m/j"));
        $this->contr->modifier( $_SESSION["contratConsulter"]);
        $_SESSION["consulter"]->setdateSupr(date("Y/m/j"));
        $this->personne->modifier($_SESSION["consulter"]);
        header('Location: ../index.php?page=menu.menu');
    }
    public function retablirContrat()
    {
        $this->rechercheContrat();
        $this->message->setFlash('warning', 'Vous allez rétablir le contrat et cette personne. Veuillez modifier la date de fin');
        $_SESSION['modifier'] = true;
        $_SESSION['retablir'] = true;
        $_SESSION['action'] = "contrat.retabli";
        header('Location:../index.php?page=contrat.afficherLeContrat');
    }
    public function retabliContrat()
    {
        $_POST["dateFinContrat"] = $_POST["anneeFin"]."-".$_POST['moisFin']."-".$_POST['jourFin'];
        $_SESSION["contratConsulter"]->setDateFinContrat( $_POST["dateFinContrat"]);
        $this->contr->modifier( $_SESSION["contratConsulter"]);
        $_SESSION["consulter"]->setdateSupr(null);
        $this->personne->modifier($_SESSION["consulter"]);
        header('Location: ../index.php?page=menu.menu');
    }
    public function afficherContrat()
    {
        if(isset($_POST["idPersonnel"]))
        {
            foreach ($_SESSION['personnel'] as $value)
            {
                if($value->getIdPersonne() === $_POST["idPersonnel"]) {
                    $_SESSION["consulter"] = $value;
                }
            }
            $_SESSION['contrat'] = $this->contr->tousLesContratPersonne($_POST["idPersonnel"]);
            $_SESSION['tableauFonction'] =array();
            $indice = 0;
            foreach ( $_SESSION['contrat'] as $value) {

                $attribue = $this->attribue->rechercheIdContrat($value->getIdContrat());
                $_SESSION['tableauFonction'][$value->getIdcontrat()] = $this->fonction->rechercherId($attribue->getIdFonction());
                $indice++;
            }

        }
        header('Location: ../index.php?page=contrat.menu');
    }
    public function lier()
    {
        if(isset($_POST['idContrat']))
        {
            foreach ($_SESSION['contrat'] as $donnee)
            {
                if($_POST['idContrat'] === $donnee->getIdCOntrat())
                {
                    $_SESSION['contratLier'] = $donnee;
                }
            }
            header('Location: ../index.php?page=contrat.lierAutreRestaurant');
        }
    }
    public function lierRestaurant()
    {
        $attribue = $this->attribue->rechercheIdContrat($_SESSION['contratLier']->getIdContrat());
      $nouveauContrat = $_SESSION['contratLier'];
      $nouveauContrat->setDateDebutContrat(date("Y/m/j"));
      $contr = $this->contr->creer($nouveauContrat);
      $table = array(
            'idContrat' => $contr->getIdContrat() ,
            'idPersonne' => $_SESSION['consulter']->getIdPersonne() ,
            'idRestaurant' => $_POST['idRestaurant'],
        );
      $this->etabli->creer($table);
        $table = array(
            'idContrat' => $contr->getIdContrat() ,
            'idFOnction' => $attribue->getIdFonction() ,
        );
     $this->attribue->creer($table);
     $_SESSION['contratLier']->setDateFinContrat(null);
     $this->contr->modifier($_SESSION['contratLier']);
     header('Location: ../index.php?page=menu.menu');

    }
    public function menu()
    {
        return "vue/template/contrat/menu.php";
    }
    public function ajouterContrat()
    {
        $_POST['competence'] = $this->competence->afficherAll();
        $this->message->setFlash('warning', 'vous allez créer un nouveau contrat');
        return "vue/template/contrat/ajouter.php";
    }
    public function lierAutreRestaurant()
    {
        $this->message->setFlash('warning', 'vous allez lier la personne à un autre restaurant');
        return "vue/template/contrat/lier.php";
    }
    public function consulterContrat()
    {
        $this->rechercheContrat();
        $_SESSION['action'] = "";
        $_SESSION['modifier'] = false;
        header('Location:../index.php?page=contrat.afficherLeContrat');
    }
    private function rechercheContrat()
    {
        $_SESSION['contratNotes'] = $this->etabli->rechercheIdContrat($_POST["idContrat"]);
        $_SESSION["contratConsulter"] = $this->contr->rechercherId($_POST["idContrat"]);
        $tableau = $this->attribue->rechercheIdContrat($_SESSION['contratConsulter']->getIdContrat());
        $_SESSION["fonction"] = $this->fonction->rechercherId($tableau->getIdFonction());
        $lien = $this->dispose->rechercheIdPersonne($_SESSION['consulter']->getIdPersonne());
        $_SESSION['competence'] = $this->competence->rechercherId($lien->getIdCompetence());

    }
    public function afficherLeContrat()
    {
        if(isset($_SESSION['modifier']) && ($_SESSION['modifier'] === true))
        {
            $_SESSION['disabled'] = 'false';
        }
        else
        {
            $_SESSION['disabled'] = 'disabled';
        }
        $_POST['competence'] = $this->competence->afficherAll();
        $_POST['debut'] = explode("-",  $_SESSION["contratConsulter"]->getDateDebutContrat() );
        if( $_SESSION["contratConsulter"]->getDateFinContrat())
        {
            $_POST['fin'] = explode("-",  $_SESSION["contratConsulter"]->getDateFinContrat() );
        }
        return "vue/template/contrat/modifier.php";
    }
    /*
    public function fff ()
    {
        // voir si deja contrat si oui alle dans modification
        if($_SESSION['personnelDuRestaurant'])
        {
            $_SESSION['personnelDuRestaurant'] = false;
            header('Location: ../index.php?page=contrat.ajouterContrat');
        }
        elseif (isset($_POST['idRestaurant']))
        {
            foreach ($_SESSION['restaurant'] as $value)
            {
                if($_POST['idRestaurant'] === $value->getIdRestaurant()) {
                    $_SESSION["contratRestaurant"] = $value;
                }
            }
            header('Location: ../index.php?page=contrat.ajouterContrat');
        }
        elseif (isset($_SESSION["contratRestaurant"]) && isset($_SESSION["contratPersonne"]))
        {
            $fonct =  $this->fonction->creer($_POST);
            $contr = $this->contr->creer($_POST);
            $table = array(
                'idFonction' => $fonct->getIdFonction(),
                'idContrat' => $contr->getIdContrat() ,
            );
            $this->attribue->creer($table);
            $table = array(
                'idContrat' => $contr->getIdContrat() ,
                'idPersonne' => $_SESSION["contratPersonne"]->getIdPersonne() ,
                'idRestaurant' => $_SESSION["contratRestaurant"]->getIdRestaurant(),
            );
            $this->etabli->creer($table);
            $_SESSION["contratPersonne"] = null;
            $_SESSION["contratRestaurant"] = null;
            $_SESSION['personnelDuRestaurant'] = null;
            $_SESSION['lierContrat'] = null;
            header('Location: ../index.php?page=menu.menu');
        }
        else
        {
            $_SESSION['lierContrat'] = true;
            foreach ($_SESSION['personnel'] as $value)
            {
                if($_POST['idPersonnel'] === $value->getIdPersonne())
                {
                    $_SESSION["contratPersonne"] = $value;
                }
            }
            header('Location: ../index.php?page=menu.menu');
        }
    }
*/
}