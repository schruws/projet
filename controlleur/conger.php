<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 13-04-17
 * Time: 19:43
 */

namespace controlleur;

require_once dirname(__DIR__) . "/model/personne/personne.php";
require_once dirname(__DIR__) . "/model/conger/conger.php";
require_once dirname(__DIR__) . "/model/demander/demander.php";
require_once dirname(__DIR__)."/controlleur/message.php";
require_once dirname(__DIR__)."/controlleur/erreur.php";


use model\demander;

if(!isset($_SESSION)){
    session_start();
}
if(isset($_POST['action'])) {

    $action = $_POST['action'];
    switch ($action) {
        case "creer":
            $controlleur = new Conger();
            $controlleur->creerConger();
            break;
        case "modifier":
            $controlleur = new Conger();
            $controlleur->modifierConger();
            break;
        case "suprimer":
            $controlleur = new Conger();
            $controlleur->suprimerConger();
            break;
        case "effacer":
            $controlleur = new Conger();
            $controlleur->effacerConger();
            break;
        case "afficher":
            $controlleur = new Conger();
            $controlleur->afficherConger();
            break;
        case "consulter":
            $controlleur = new Conger();
            $controlleur->consulterConger();
            break;
        case  "modification" :
            $controlleur = new Conger();
            $controlleur->modificationConger();
            break;


    }
}

class conger
{
    private $horaireCongerPersonnel;
    private $message;
    private $demander;
    private $erreur;

    public function __construct()
    {
        $this->horaireCongerPersonnel = new \model\conger();
        $this->message = message::getInstance();
        $this->demander =new demander();
        $this->erreur = erreur::getInstance();

    }
    public function creerConger()
    {
        try {
            $_POST["dateDebut"] = $_POST["anneeDebut"] . "-" . $_POST['moisDebut'] . "-" . $_POST['jourDebut'];
            $_POST["dateFin"] = $_POST["anneeFin"] . "-" . $_POST['moisFin'] . "-" . $_POST['jourFin'];
            $valeur = $this->horaireCongerPersonnel->creer($_POST);
            $table = array(
                'idConger' => $valeur->getIdConger(),
                'idPersonne' => $_SESSION["consulter"]->getIdPersonne(),
            );
            $this->demander->creer($table);
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "controlleur/conger/creerConger");
        }
        finally {
            header('Location:../index.php?page=menu.menu');
        }
    }
    public function modifierConger()
    {
        try {
            $this->rechercheConger();
            $_SESSION['action'] = "conger.modification";
            $_SESSION['modifier'] = true;
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/horaire_resto_effect_sql/modfierConger");
        }
        header('Location:../index.php?page=conger.afficherLeConger');
    }
    public function modificationConger()
    {
        try {
            $_POST["dateDebut"] = $_POST["anneeDebut"] . "-" . $_POST['moisDebut'] . "-" . $_POST['jourDebut'];
            $_POST["dateFin"] = $_POST["anneeFin"] . "-" . $_POST['moisFin'] . "-" . $_POST['jourFin'];
            $_POST['idConger'] = $_SESSION['consulterConger']->getIdConger();
            $this->horaireCongerPersonnel->modifier($_POST);
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/horaire_resto_effect_sql/modificationConger");
        }
        finally
        {

        }
        header('Location:../index.php?page=menu.menu');
    }
    public function suprimerConger()
    {
        try {
            $this->rechercheConger();
            $_SESSION['action'] = "conger.effacer";
            $this->message->setFlash('danger', 'Vous allez supprimer le congé de cette personne');
            $_SESSION['modifier'] = false;
            $_SESSION['effacer'] = true;
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/horaire_resto_effect_sql/suprimerConger");
        }
        header('Location:../index.php?page=conger.afficherLeConger');
    }
    public function effacerConger()
    {
        try {
            $table = array(
                'idConger' => $_SESSION['consulterConger']->getIdConger(),
                'idPersonne' => $_SESSION["consulter"]->getIdPersonne(),
            );
            $this->demander->suprimerId($table);
            $this->horaireCongerPersonnel->suprimerId($_SESSION['consulterConger']->getIdConger());
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/horaire_resto_effect_sql/effacerConger");
        }
        header('Location:../index.php?page=menu.menu');
    }
    public function afficherConger()
    {
        try {
            if (isset($_POST["idPersonnel"])) {
                foreach ($_SESSION['personnel'] as $value) {
                    if ($value->getIdPersonne() === $_POST["idPersonnel"]) {
                        $_SESSION['congerPersonne'] = $this->horaireCongerPersonnel->tousLesCongerPersonne($value->getIdPersonne());
                        $_SESSION["consulter"] = $value;
                    }
                }
                header('Location:../index.php?page=conger.menu');
            }
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/horaire_resto_effect_sql/afficherConger");
        }
    }
    public function menu()
    {
        return "vue/template/conger/menu.php";
    }
    public function ajouterConger()
    {

        $this->message->setFlash('warning', 'vous allez créer un nouveau congé');
        return "vue/template/conger/ajouter.php";
    }
    public function consulterConger()
    {
        try {
            $this->rechercheConger();
            $_SESSION['action'] = "";
            $_SESSION['modifier'] = false;
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/horaire_resto_effect_sql/consulterConger");
        }
        header('Location:../index.php?page=conger.afficherLeConger');
    }
    private function rechercheConger()
    {
        try {
            foreach ($_SESSION["congerPersonne"] as $value) {
                if ($value->getIdConger() === $_POST["idConger"]) {
                    $_SESSION['consulterConger'] = $value;
                }
            }
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/horaire_resto_effect_sql/rechercheConger");
        }
    }
    public function afficherLeConger()
    {
        try {
            if (isset($_SESSION['modifier']) && ($_SESSION['modifier'] === true)) {
                $_SESSION['disabled'] = 'false';
            } else {
                $_SESSION['disabled'] = 'disabled';
            }
            $_POST['debut'] = explode("-", $_SESSION["consulterConger"]->getDateDebut());
            $_POST['fin'] = explode("-", $_SESSION["consulterConger"]->getDateFin());
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/horaire_resto_effect_sql/afficherLeConger");
        }
        return "vue/template/conger/modifier.php";
    }
}