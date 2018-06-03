<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 11-04-17
 * Time: 15:13
 */

namespace controlleur;

require_once dirname(__DIR__) . "/model/horaire_annuel_vacance/horaire_annuel_vac.php";
require_once dirname(__DIR__) . "/model/horaire_resto_effectif/horaire_resto_effect.php";
require_once dirname(__DIR__) ."/model/restaurant/restaurant.php";
require_once dirname(__DIR__)."/controlleur/message.php";
require_once dirname(__DIR__) ."/model/competence/competence.php";
require_once dirname(__DIR__) . "/model/personne/personne.php";
require_once dirname(__DIR__) . "/model/conger/conger.php";
require_once dirname(__DIR__)."/model/personne/personne.php";
require_once dirname(__DIR__)."/controlleur/PDF.php";
require_once dirname(__DIR__)."/controlleur/mail.php";


use model\horaire_annuel_vac;
use model\horaire_resto_effect;
use model\competence;
use model\conger;
use model\personne;
use ZipArchive;


if(!isset($_SESSION)){
    session_start();
}
if(isset($_POST['action'])) {

    $action = $_POST['action'];
    switch ($action) {
        case "creerVacance":
            $controlleur = new horaire();
            $controlleur->creerHoraireVacance();
            break;
        case "creerHoraireManuel":
            $controlleur = new horaire();
            $controlleur->creerHoraireManuel();
            break;
        case "modifierVacance":
            $controlleur = new horaire();
            $controlleur->modifierHoraireVacance();
            break;
        case "suprimerVacance":
            $controlleur = new horaire();
            $controlleur->suprimerHoraireVacance();
            break;
        case "effacerVacance":
            $controlleur = new horaire();
            $controlleur->effacerHoraireVacance();
            break;
        case "consulterVacance":
            $controlleur = new horaire();
            $controlleur->consulterhoraireVacance();
            break;
        case  "modificationVacance" :
            $controlleur = new horaire();
            $controlleur->modificationhoraireVacance();
            break;
        case "creerEffectif":
            $controlleur = new horaire();
            $controlleur->creerHoraireEffectif();
            break;
        case "modifierEffectif":
            $controlleur = new horaire();
            $controlleur->modifierHoraireEffectif();
            break;
        case  "modificationEffectif" :
            $controlleur = new horaire();
            $controlleur->modificationhoraireEffectif();
            break;
        case "suprimerEffectif":
            $controlleur = new horaire();
            $controlleur->suprimerHoraireEffectif();
            break;
        case "effacerEffectif":
            $controlleur = new horaire();
            $controlleur->effacerHoraireEffectif();
            break;

        case  "restaurant" :
            $controlleur = new horaire();
            $controlleur->restauranthoraire();
            break;

        case  "creationHoraireAutomatique" :
            $controlleur = new horaire();
            $controlleur->creationHoraireAutomatique();
            break;
        case  "CreationHoraireManuel" :
            $controlleur = new horaire();
            $controlleur->creerHoraireManuel();
            break;
        case "modifierHoraire":
            $controlleur = new horaire();
            $controlleur->modifierHoraire();
            break;
        case  "modificationHoraire" :
            $controlleur = new horaire();
            $controlleur->modificationhoraire();
            break;
        case "suprimerHoraire":
            $controlleur = new horaire();
            $controlleur->suprimerHoraire();
            break;
        case "effacerHoraire":
            $controlleur = new horaire();
            $controlleur->effacerHoraire();
            break;
        case "envoyerHoraire":
            $controlleur = new horaire();
            $controlleur->envoyerHorairePersonnel();
            break;

    }
}
class horaire
{
    private $horaireVacanceRestaurant;
    private $horaireEffectifRestaurant;
    private $horaireCongerPersonnel;
    private $resto;
    private $message;
    private $jour;
    private $competence;
    private $phrase = "";
    private $personne;
    private $quelleJour;
    private $email;
    private $temoin;


    public function __construct()
    {

        $this->horaireEffectifRestaurant = new horaire_resto_effect();
        $this->horaireVacanceRestaurant = new horaire_annuel_vac();
        $this->resto = new \model\restaurant();
        $this->message = message::getInstance();
        $this->jour = array("lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche");
        $this->competence = new competence();
        $this->horaireCongerPersonnel = new conger();
        $this->personne = new personne();
        $this->quelleJour =  date("N") -1;
        $this->email = new mail();


    }
    public function menu()
    {
        if(isset($_SESSION['utilisateur']))
        {
            $_POST['jour'] = $this->jour;
            $_POST['competence'] = $this->competence->afficherAll();
            $_SESSION['disabled'] = 'disabled';
            $_SESSION['user'] = $this->personne->modifier($_SESSION['user']);
            $this->horaire_effectif();
            if($_SESSION['chemin'] != null) {
                $this->message->setFlash('success', 'Bonjour, Vous êtes maintenant connecté en tant qu employé<br>Voici l horaire pour la semaine pour le restaurant ' . $_SESSION['restaurant']->getNomRestau() . '');
            }
            else
            {
                $this->message->setFlash('danger', 'Bonjour, Vous êtes maintenant connecté en tant qu employé<br>Aucun horaire n a été créé pour cette semaine. ' . $_SESSION['restaurant']->getNomRestau() . '');
            }
            return "vue/template/horaire/menu.php";
        }
        else
            {
            if ($_SESSION['congerRestaurant']->getIdHoraireVacance() !== null) {
                $_POST['affiche'] = true;
                if ($_SESSION['congerRestaurant']->getOuvertFerme() == 1) {
                    $_POST["ouvertFerme"] = "oui";
                } else {
                    $_POST["ouvertFerme"] = "non";
                }
            } else {
                $_POST['affiche'] = false;
            }
            $_POST['jour'] = $this->jour;
            $_POST['competence'] = $this->competence->afficherAll();
            $_SESSION['disabled'] = 'disabled';
            $this->horaire_effectif();
            return "vue/template/horaire/menu.php";
        }
    }
    public function creerHoraireVacance()
    {
        if($_POST["ouvertFerme"] === "oui")
        {
            $_POST["ouvertFerme"] = 1;
        }
        else
        {
            $_POST["ouvertFerme"] = 0;
        }
        $_POST["debut"] = $_POST["annéeDebut"]."-".$_POST['moisDebut']."-".$_POST['jourDebut'];
        $_POST["fin"] = $_POST["annéeFin"]."-".$_POST['moisFin']."-".$_POST['jourFin'];
        $_SESSION['congerRestaurant'] = $this->horaireVacanceRestaurant->creer($_POST);
        $_SESSION['consulter']->setIdHoraireVacance($_SESSION['congerRestaurant']->getIdHoraireVacance());
        $this->resto->modifier( $_SESSION['consulter']);
        header('Location: ../index.php?page=menu.menu');
    }
    public function creerHoraireEffectif()
    {
        $competence = $this->competence->afficherAll();
        $valeur = count($competence);
        foreach($this->jour as $jour)
        {
            for($indice = 0 ; $indice < $valeur ; $indice++) {
                $table = array(

                    "jour" => $jour . ".midi",
                    "besoin" => $_POST[$jour . "Midi"][$indice],
                    "idCompetence" => $competence[$indice]->getIdCompetence(),
                    'idRestaurant' => $_SESSION["consulter"]->getIdRestaurant(),
                );
                $this->horaireEffectifRestaurant->creer($table);
                $table = array(

                    "jour" => $jour . ".soir",
                    "besoin" => $_POST[$jour . "Soir"][$indice],
                    "idCompetence" => $competence[$indice]->getIdCompetence(),
                    'idRestaurant' => $_SESSION["consulter"]->getIdRestaurant(),
                );
                $this->horaireEffectifRestaurant->creer($table);
            }
        }
        header('Location: ../index.php?page=menu.menu');
    }
    public function modifierHoraireVacance()
    {
        $_SESSION['action'] = "horaire.modificationVacance";
        $_SESSION['modifier'] = true;
        header('Location:../index.php?page=horaire.afficherHoraireVacance');
    }
    public function modifierHoraireEffectif()
    {
        $_SESSION['action'] = "horaire.modificationEffectif";
        $_SESSION['modifier'] = true;
        header('Location:../index.php?page=horaire.afficherHoraireEffectif');
    }
    public function modificationHoraireVacance()
    {
        if($_POST["ouvertFerme"] === "oui")
        {
            $_POST["ouvertFerme"] = 1;
        }
        else
        {
            $_POST["ouvertFerme"] = 0;
        }
        $_POST["debut"] = $_POST["annéeDebut"]."-".$_POST['moisDebut']."-".$_POST['jourDebut'];
        $_POST["fin"] = $_POST["annéeFin"]."-".$_POST['moisFin']."-".$_POST['jourFin'];
        $_POST['idHoraireVacance'] =  $_SESSION['congerRestaurant']->getIdHoraireVacance();
        $this->horaireVacanceRestaurant->modifier($_POST);
        header('Location: ../index.php?page=menu.menu');
    }
    public function modificationHoraireEffectif()
    {

        $competence = $this->competence->afficherAll();
        $valeur = count($competence);
        $temoin = 0;
        foreach($this->jour as $jour)
        {
            for($indice = 0 ; $indice < $valeur ; $indice++) {

                $table = array(
                    "idHoraireEffectif" => $_SESSION['idHoraireEffectif'][$temoin],
                    "jour" => $jour . ".midi",
                    "besoin" => $_POST[$jour . "Midi"][$indice],
                    "idCompetence" => $competence[$indice]->getIdCompetence(),
                    'idRestaurant' =>  $_SESSION["consulter"]->getIdRestaurant(),
                );
                $this->horaireEffectifRestaurant->modifier($table);
                $temoin++;
                $table = array(

                    "idHoraireEffectif" => $_SESSION['idHoraireEffectif'][$temoin],
                    "jour" => $jour . ".soir",
                    "besoin" => $_POST[$jour . "Soir"][$indice],
                    "idCompetence" => $competence[$indice]->getIdCompetence(),
                    'idRestaurant' =>  $_SESSION["consulter"]->getIdRestaurant(),
                );
                $this->horaireEffectifRestaurant->modifier($table);
                $temoin++;
            }
        }
        header('Location: ../index.php?page=menu.menu');
    }
    public function suprimerHoraireVacance()
    {
        $_SESSION['action'] = "horaire.effacerVacance";
        $this->message->setFlash('danger', 'Vous allez supprimer cet horaire de vacances');
        $_SESSION['modifier'] = false;
        $_SESSION['effacer'] = true;
        header('Location:../index.php?page=horaire.afficherHoraireVacance');
    }
    public function suprimerHoraireEffectif()
    {
        $_SESSION['action'] = "horaire.effacerEffectif";
        $this->message->setFlash('danger', 'Vous allez supprimer cet horaire d effectif');
        $_SESSION['modifier'] = false;
        $_SESSION['effacer'] = true;
        header('Location:../index.php?page=horaire.afficherHoraireEffectif');
    }
    public function effacerHoraireVacance()
    {
        $_SESSION['consulter']->setIdHoraireVacance(null);
        $this->resto->modifier( $_SESSION['consulter']);
        $this->horaireVacanceRestaurant->suprimerId($_SESSION['congerRestaurant']->getIdHoraireVacance());
        unset( $_SESSION['congerRestaurant']);
        header('Location: ../index.php?page=menu.menu');
    }
    public function effacerHoraireEffectif()
    {
        $this->horaireEffectifRestaurant->suprimerId($_SESSION["consulter"]->getIdRestaurant());
        header('Location: ../index.php?page=menu.menu');
    }
    public function consulterHoraireVacance()
    {

        $_SESSION['action'] = "";
        $_SESSION['modifier'] = false;
        header('Location:../index.php?page=horaire.afficherHoraireVacance');
    }
    public function restaurantHoraire()
    {
        if(isset($_POST['idRestaurant']))
        {
            $dateJour = date("Y/m/j");
            $tableau = array();
            for ($valeur = $this->quelleJour ; $valeur >= 0 ; $valeur--) {
                $date = strtotime(date("Y/m/j", strtotime($dateJour)) . "-" . $valeur . " days");
                $value = date("Y-m-j", $date);
                $tableau[] = $value;
            }

            for ($valeur =  6- $this->quelleJour; $valeur > 0 ; $valeur--) {
                $date = strtotime(date("Y-m-j", strtotime($dateJour)) . "+" . $valeur . " days");
                $value = date("Y-m-j", $date);
                $tableau[] = $value;
            }

            foreach ($_SESSION["restaurant"] as $value)
            {
                if($value->getIdRestaurant() === $_POST["idRestaurant"]) {
                    $_SESSION["consulter"] = $value;
                    $_SESSION['congerRestaurant'] = $this->horaireVacanceRestaurant->rechercherId($value->getIdHoraireVacance());
                    $_SESSION['horaireRestaurant'] = $this->horaireEffectifRestaurant->rechercheIdRestaurant($value->getIdRestaurant());
                }
            }
            unset( $_SESSION['horaire']);
            unset( $_SESSION['chemin']);
            foreach (glob("../horaire/" . $_SESSION['consulter']->getNomRestau()."/*") as $value)
            {
                $date = explode("/", $value);
               $dateFinal =  strftime('%d-%m-%y', strtotime($date[3]));
            //    foreach ($tableau as $donnee)
             //   {
                //    $donnees = strftime('%d-%m-%y', strtotime($donnee));
                //   if($donnees === $dateFinal) {
                  //     $jour = date('w', strtotime($donnees) -1 );
                 //      $journee = $this->jour[$jour];
                 //      if (file_exists($value . "/" . $journee . ".pdf")) {
                           $_SESSION['horaire'][] = $dateFinal;
                           foreach (glob($value . "/*.pdf") as $valeur) {
                               $chemin = substr($valeur, 3);
                               if (isset($chemin)) {
                                   $_SESSION['chemin'][] = $chemin;
                               }
                           }
                     //  }
                  // }
             //   }
            }
            header('Location: ../index.php?page=horaire.menu');
        }
    }


    public function ajouterVacance()
    {
        $_POST['jour'] = array("la journée", "le lundi matin", "le lundi soir", "le mardi matin", "le mardi soir", "le mercredi matin", "le mecredi soir", "le jeudi matin", "le jeudi soir", "le vendredi matin"
        , "le vendredi soir", "le samedi matin", "le samedi soir", "le dimanche matin", "le dimanche soir");
        return "vue/template/horaire/ajouterVacance.php";
    }
    public function ajouterEffectif()
    {
        $_POST['jour'] = $this->jour;
        $_POST['competence'] = $this->competence->afficherAll();
        return "vue/template/horaire/ajouterEffectif.php";
    }

    public function afficherHoraireVacance()
    {
        if(isset($_SESSION['modifier']) && ($_SESSION['modifier'] === true))
        {
            $_SESSION['disabled'] = 'false';
        }
        else
        {
            $_SESSION['disabled'] = 'disabled';
        }
        $_POST['jour'] = array("la journée", "le lundi matin", "le lundi soir", "le mardi matin", "le mardi soir", "le mercredi matin", "le mecredi soir", "le jeudi matin, le jeudi soir", "le vendredi matin"
        , "le vendredi soir", "le samedi matin", "le samedi soir", "le dimanche matin", "le dimanche soir");
        $_POST['debut'] = explode("-",  $_SESSION["congerRestaurant"]->getDebut() );
        $_POST['fin'] = explode("-",  $_SESSION["congerRestaurant"]->getFin() );
        return "vue/template/horaire/modifierVacance.php";
    }
    public function afficherHoraireEffectif()
    {
        if(isset($_SESSION['modifier']) && ($_SESSION['modifier'] === true))
        {
            $_SESSION['disabled'] = 'false';
        }
        else
        {
            $_SESSION['disabled'] = 'disabled';
        }
        $_POST['jour'] = $this->jour;
        $_POST['competence'] = $this->competence->afficherAll();
        $this->horaire_effectif();
        return "vue/template/horaire/modifierEffectif.php";
    }

    public function creationHoraireManuel()
    {
        $this->recuperePersonnelDisponible();
        $this->restaurantConger();
        $_POST['jour'] = $this->jour;
        $_POST['quelleJour'] = $this->quelleJour;
        $_POST['competence'] = $this->competence->afficherAll();
        return "vue/template/horaire/creationHoraireManuel.php";
    }


    private function horaire_effectif()
    {
        $_POST['midi'] = array();
        $_POST['soir'] = array();
        $_SESSION['idHoraireEffectif'] = array();

        $competence = $this->competence->afficherAll();
        $indice = 0; // permet de faire la difference entre le service du midi et du soir
        $temoinJour = 0;
        $temoinCompetence = 0;
        $premiereFois = false; // pour avoir qu'une seule fois "vous n'avez pas le personnel pour telle jour."
        $_POST['afficherCreationHoraire'] = true;

        if(empty($_SESSION['horaireRestaurant'])) // si pas horaire effectif
        {
            $_POST["ajouter"] = true; // affiche le boutton creation horaire
        }
        else // si horaire effectif
        {
            foreach ($_SESSION['horaireRestaurant'] as $valeur) { // recupere les donnée dans bdd les données sont bar midi, soir. cuisine midi, soir. etc...

                if($temoinCompetence == count($competence)) // remet les temoin competence et premiere fois a 0  et augmente d'un jour
                {
                    $temoinCompetence = 0;
                    $temoinJour++;
                    $premiereFois = false;
                }
                if($temoinJour == count($this->jour))
                {
                    $temoinJour = 0;
                }
                if ($indice == 0)
                {
                    $_POST['midi'][] = $valeur->getBesoin(); // recupere la valeur pour le midi
                    $journee = $this->jour[$temoinJour]."midi"; // premet de faire la recherche sur la requete sql. bdd lundiMidi, mardiMidi, etc...
                    $_SESSION['idHoraireEffectif'][] = $valeur->getIdHoraireEffectif(); // recupère id pour les modification et la suppression
                    $nombrePersonneDisponible = $this->horaireEffectifRestaurant->nombrePersonneDisponiblePost($_SESSION["consulter"]->getIdRestaurant(),$journee,$competence[$temoinCompetence]->getNomComp());
                    if($nombrePersonneDisponible < $valeur->getBesoin())
                    {
                        $_POST['afficherCreationHoraire'] = false;
                        if($premiereFois == false)
                        {
                            $this->phrase =  $this->phrase .'vous n avez pas le personnel nécessaire pour le '.$this->jour[$temoinJour].'';
                            $premiereFois = true;
                        }
                       $this->phrase = $this->phrase .  '<li> midi.  Nombre d employés : '.$nombrePersonneDisponible.' besoin : '.$valeur->getBesoin()." pour le poste : ".$competence[$temoinCompetence]->getNomComp()."</li><br>";
                    }
                    $indice++;
                }
                else
                {
                    $this->temoin = false;
                    $_POST['soir'][] = $valeur->getBesoin();
                    $_SESSION['idHoraireEffectif'][] = $valeur->getIdHoraireEffectif();
                    $journee = $this->jour[$temoinJour]."soir";
                    $nombrePersonneDisponible = $this->horaireEffectifRestaurant->nombrePersonneDisponiblePost($_SESSION["consulter"]->getIdRestaurant(),$journee,$competence[$temoinCompetence]->getNomComp());
                    if($nombrePersonneDisponible < $valeur->getBesoin())
                    {
                        $_POST['afficherCreationHoraire'] = false;
                        if($premiereFois == false)
                        {
                            $this->phrase =  $this->phrase .'vous n avez pas le personnel nécessaire pour le '.$this->jour[$temoinJour].'';
                            $premiereFois = true;
                            $this->temoin = true;
                        }
                        $this->phrase = $this->phrase .   '<li> soir.  Nombre d employés : '.$nombrePersonneDisponible.' besoin : '.$valeur->getBesoin()." pour le poste : ".$competence[$temoinCompetence]->getNomComp()." </li><br>";
                    }
                    if($this->phrase !== "") {
                        $this->message->setFlash('danger', $this->phrase);
                    }
                    else if($this->temoin == false)
                    {
                      //  $this->message->setFlash('success', "Vous avez l’effectif nécessaire pour créer les horaires ");
                    }
                    $indice = 0;
                    $temoinCompetence++;

                }
            }
        }
    }
    public function creerHoraireManuel()
    {
        $this->creationHoraire();
        header('Location: ../index.php?page=menu.menu');
    }

    public function modifierHoraire()
    {
        $this->recuperePersonnelDisponible();
        $this->recuperePersonnelTxt();
        $_SESSION['modifier'] = true;
        $_SESSION['action'] = "horaire.modificationHoraire";
        $_POST['jour'] = $this->jour;
        $_POST['quelleJour'] = $this->quelleJour;
        $_POST['competence'] = $this->competence->afficherAll();
        $this->message->setFlash('warning', 'Vous allez modifer les horaires');
        return "vue/template/horaire/modifierHoraire.php";

    }
    public function modificationHoraire()
    {
        $this->effacerFichier();
        $this->creationHoraire();
        header('Location: ../index.php?page=menu.menu');

    }
    public function  suprimerHoraire()
    {
        $this->recuperePersonnelDisponible();
        $this->recuperePersonnelTxt();
        $_SESSION['action'] = "horaire.effacerHoraire";
        $_SESSION['modifier'] = false;
        $_SESSION['effacer'] = true;
        $_POST['jour'] = $this->jour;
        $_POST['quelleJour'] = $this->quelleJour;
        $_POST['competence'] = $this->competence->afficherAll();
        $this->message->setFlash('danger', 'Vous allez supprimer les horaires de la semaine');
        return "vue/template/horaire/modifierHoraire.php";
    }
    public function effacerHoraire()
    {
        $this->effacerFichier();
        header('Location: ../index.php?page=menu.menu');
    }

    private function recuperePersonnelTxt()
    {
        $competence = $this->competence->afficherAll();
        $indice = 0;
        $dateJour = date("Y/m/j");
        for ($valeur = $this->quelleJour; $valeur <= count($this->jour) -1 ; $valeur++) {
            $date =strtotime (date("Y/m/j", strtotime($dateJour))."+".$indice." days");
            $dateFinal = date("Y-m-j", $date);
            foreach (glob(dirname(__DIR__)."/horaire/". $_SESSION['consulter']->getNomRestau()."/".$dateFinal."/*.txt") as $value)
            {
                /*Ouverture du fichier en lecture seule*/
                $texte = fopen($value, 'r');
                /*Si on a réussi à ouvrir le fichier*/
                if ($texte)
                {
                    /*Tant que l'on est pas à la fin du fichier*/
                    while (!feof($texte))
                    {
                        /*On lit la ligne courante*/
                        $buffer = fgets($texte);
                        $donnee = explode(";", $buffer);
                        if($donnee[0] !== '')
                        {
                            if($donnee[0] == "midi")
                            {
                                foreach ($competence as $value) {
                                    if($donnee[1] == $value->getNomComp())
                                    {
                                        $_POST[$this->jour[$valeur]."midi"][$value->getNomComp()][] = $donnee[2];
                                    }
                                }
                            }
                            else
                            {
                                foreach ($competence as $value) {
                                    if($donnee[1] == $value->getNomComp())
                                    {
                                        $_POST[$this->jour[$valeur]."soir"][$value->getNomComp()][] = $donnee[2];
                                    }
                                }
                            }
                        }

                    }
                    /*On ferme le fichier*/
                    fclose($texte);
                }
            }
            $indice++;
        }
    }

    private function recuperePersonnelDisponible()
    {
        $competence = $this->competence->afficherAll();
        $temoinJour = 0;
        $tableauPersonne = array();
        for ($valeur = $this->quelleJour ; $valeur <= count($this->jour) -1 ; $valeur++) {
            foreach ($competence as $value) {
                $temoinPersonneConger = false;
                $journee = $this->jour[$valeur] . "Midi"; // premet de faire la recherche sur la requete sql. bdd lundiMidi, mardiMidi, etc...
                $tableau = $this->horaireEffectifRestaurant->recupereLesPersonneDisponible($_SESSION["consulter"]->getIdRestaurant(), $journee, $value->getNomComp());
                $jour = $this->jour[$valeur] . ".midi"; // premet de faire la recherche sur la requete sql. bdd lundiMidi, mardiMidi, etc...
                $_POST[$journee]["nombre".$value->getNomComp()] = $this->horaireEffectifRestaurant->besoinRestaurant($_SESSION["consulter"]->getIdRestaurant(), $jour, $value->getIdCompetence());
                foreach ($tableau as $donnee)
                {
                    $conger = $this->horaireCongerPersonnel->personneEstCOnger($donnee['idPersonne']);
                    if($conger->getIdConger()) // a modifie
                    {
                        foreach ($tableauPersonne as $tt)
                        {
                            if($tt == $donnee['idPersonne'])
                            {
                                $temoinPersonneConger = true;
                            }
                        }
                        if(!$temoinPersonneConger) {
                            $debut = strftime('%d-%m-%y', strtotime($conger->getDateDebut()));
                            $fin = strftime('%d-%m-%y', strtotime($conger->getDateFin()));
                            $this->phrase = $this->phrase . 'La personne  ' . $donnee['nomPers'] . ' ' . $donnee['prenom'] . ' est normallement en conger pour le ' . $debut . ' à ' . $fin . "<br>";
                            $tableauPersonne[] = $donnee['idPersonne'];
                            //$tableau[$journee][$value->getNomComp()] = true; pourquoi j'ai mis un true ? fait bug l'application pour les modification
                        }
                    }
                }
                $_POST[$journee][$value->getNomComp()] = $tableau;

                $journee = $this->jour[$valeur] . "Soir";
                $tableau = $this->horaireEffectifRestaurant->recupereLesPersonneDisponible($_SESSION["consulter"]->getIdRestaurant(), $journee, $value->getNomComp());
                $jour = $this->jour[$valeur] . ".soir";
                $_POST[$journee]["nombre".$value->getNomComp()] = $this->horaireEffectifRestaurant->besoinRestaurant($_SESSION["consulter"]->getIdRestaurant(), $jour, $value->getIdCompetence());
                foreach ($tableau as $donnee)
                {
                    $temoinPersonneConger = false;
                    $conger = $this->horaireCongerPersonnel->personneEstCOnger($donnee['idPersonne']);
                    if($conger->getIdConger())
                    {
                        foreach ($tableauPersonne as $tt)
                        {
                            if($tt == $donnee['idPersonne'])
                            {
                                $temoinPersonneConger = true;
                            }
                        }
                        if(!$temoinPersonneConger) {
                            $debut = strftime('%d-%m-%y', strtotime($conger->getDateDebut()));
                            $fin = strftime('%d-%m-%y', strtotime($conger->getDateFin()));
                            $this->phrase = $this->phrase . 'La personne  ' . $donnee['nomPers'] . ' ' . $donnee['prenom'] . ' est normallement en conger pour le ' . $debut . ' à ' . $fin . "<br>";
                            // $tableau[$journee][$value->getNomComp()] = true;
                            $tableauPersonne[] = $donnee['idPersonne'];
                        }
                    }
                }
                $_POST[$journee][$value->getNomComp()] = $tableau;
            }
        }
        if(strlen($this->phrase) !== 0)
        {
            $this->message->setFlash('danger',$this->phrase);
        }

    }
    private function effacerFichier()
    {

        $indice = 0;
        $dateJour = date("Y/m/j");
        for ($valeur = $this->quelleJour; $valeur <= count($this->jour) -1 ; $valeur++) {
            $date = strtotime(date("Y/m/j", strtotime($dateJour)) . "+" . $indice . " days");
            $dateFinal = date("Y-m-j", $date);
            foreach (glob(dirname(__DIR__) ."/horaire/" . $_SESSION['consulter']->getNomRestau() . "/" . $dateFinal . "/*") as $value) {
                chmod($value, 0755);
                unlink($value);
            }
            $indice++;

        }

    }
    private function creationHoraire()
    {
        $indice = 0;
        $dateJour = date("Y/m/j");
        if(!file_exists(dirname(__DIR__)."/horaire/" . $_SESSION['consulter']->getNomRestau())) {
            mkdir(dirname(__DIR__)."/horaire/" . $_SESSION['consulter']->getNomRestau());
        }
        $competence = $this->competence->afficherAll();
        for ($valeur = $this->quelleJour; $valeur <= count($this->jour) -1 ; $valeur++) {
            $date =strtotime (date("Y/m/j", strtotime($dateJour))."+".$indice." days");
            $dateFinal = date("Y-m-j", $date);
            if(!file_exists(dirname(__DIR__)."/horaire/" . $_SESSION['consulter']->getNomRestau() . "/" . $dateFinal . "")) {
                mkdir(dirname(__DIR__)."/horaire/" . $_SESSION['consulter']->getNomRestau() . "/" . $dateFinal . "");
            }
            $texte = fopen(dirname(__DIR__)."/horaire/".$_SESSION['consulter']->getNomRestau()."/".$dateFinal."/".$this->jour[$valeur].".txt", "w+");

            foreach ($competence as $value) {
                if (isset($_POST['midi'][ $this->jour[$valeur]] [$value->getNomComp()])) {
                    foreach ($_POST['midi'][ $this->jour[$valeur]] [$value->getNomComp()] as $donnee) {
                        $personne = $this->personne->rechercherId($donnee);
                        $phrase = "midi;".$value->getNomComp().";".$personne->getNomPers().";".$personne->getPrenom()."\n";
                        fputs($texte, $phrase);
                    }
                }
                if (isset($_POST['Soir'][ $this->jour[$valeur]] [$value->getNomComp()])) {
                    foreach ($_POST['Soir'][ $this->jour[$valeur]] [$value->getNomComp()] as $donnee) {
                        $personne = $this->personne->rechercherId($donnee);
                        $phrase = "soir;".$value->getNomComp().";".$personne->getNomPers().";".$personne->getPrenom()."\n";
                        fputs($texte, $phrase);
                    }
                }
            }
            fclose($texte);
            // creation du pdf
            $this->PDF = new PDF('L','mm','A4');
            $datepdf = strftime('%d-%m-%y', strtotime($dateFinal));
            $header = array( $datepdf , 'Poste', 'Nom', 'Prenom');
            $data = $this->PDF->LoadData(dirname(__DIR__)."/horaire/".$_SESSION['consulter']->getNomRestau()."/".$dateFinal."/".$this->jour[$valeur].".txt");

            $this->PDF->SetFont('Arial','',14);
            $this->PDF->AddPage();
            $this->PDF->FancyTable($header,$data);
            $this->PDF->Output(dirname(__DIR__)."/horaire/".$_SESSION['consulter']->getNomRestau()."/".$dateFinal."/".$this->jour[$valeur].".pdf",'F');
            $indice++;
        }
    }
    public function envoyerHorairePersonnel()
    {
            $tableau = $this->personne->PersonnelDuRestaurant($_SESSION['consulter']->getIdRestaurant());
            foreach ($tableau as $personne)
            {
                $envoye = $this->email->envoyerHoraire($personne->getEmail(), $personne->getNomPers(), $personne->getRappelPassword());
                if(!$envoye) {
                    $_SESSION["erreurEnvoie"] = true;
                    $_SESSION["erreurPersonne"] = $personne->getNomPers();
                    break;
                }

            }
        header('Location: ../index.php?page=menu.menu');
    }
    public function creationHoraireAutomatique()
    {
        $this->recuperePersonnelDisponible();
        $u = 0; // pour pouvoir mettre un select pour la personne sélectionne
        $i = $this->quelleJour * 8; // pour nombre de besoin trier array lundi.midi lundi.soir poste en question
        for ($indice = $this->quelleJour; $indice <= count($this->jour) - 1; $indice++) {
            foreach ($this->competence->afficherAll() as $valeur) {
                if (isset($_POST[$this->jour[$indice] . "Midi"][$valeur->getNomComp()])) {
                    $nombreBesoin = $_SESSION['horaireRestaurant'][$i]->getBesoin();
                    if ($nombreBesoin > 0)
                    {
                        for ($temoin = 0; $temoin < $nombreBesoin; $temoin++)
                        {
                            foreach ($_POST[$this->jour[$indice] . "Midi"][$valeur->getNomComp()] as $personne)
                            {
                                if (!isset($personne['select']))
                                {
                                        $personne["select"] = true;
                                        $_POST[$this->jour[$indice] . "Midi"][$valeur->getNomComp()][$u] = $personne;
                                        $_POST['midi'][$this->jour[$indice]][$valeur->getNomComp()][] = $personne['idPersonne'];
                                        break;
                                }
                                $u++;
                            }
                            $u = 0;
                        }
                    }
                }
                if (isset($_POST[$this->jour[$indice] . "Soir"][$valeur->getNomComp()])) {
                    $nombreBesoin = $_SESSION['horaireRestaurant'][$i+1]->getBesoin();
                    if ($nombreBesoin > 0)
                    {
                        for ($temoin = 0; $temoin < $nombreBesoin; $temoin++)
                        {
                            foreach ($_POST[$this->jour[$indice] . "Soir"][$valeur->getNomComp()] as $personne) {
                                if (!isset($personne['select']))
                                {
                                    $personne["select"] = true;
                                    $_POST[$this->jour[$indice] . "Soir"][$valeur->getNomComp()][$u] = $personne;
                                    $_POST['Soir'][$this->jour[$indice]][$valeur->getNomComp()][] = $personne['idPersonne'];
                                    break;
                                }
                                    $u++;
                            }
                            $u = 0;
                        }
                    }
                }
                $i = $i+2;
            }
        }
         $this->creationHoraire();
        header('Location: ../index.php?page=menu.menu');
    }
    private function restaurantConger()
    {
        if($_SESSION["consulter"]->getIdHoraireVacance()) {
            $valeur = $this->horaireVacanceRestaurant->restaurantConger($_SESSION["consulter"]->getIdHoraireVacance());

            if ($valeur->getDebut()) {
                $debut = strftime('%d-%m-%y', strtotime($valeur->getDebut()));
                $fin = strftime('%d-%m-%y', strtotime($valeur->getFin()));
                $ouvert = ($valeur->getOuvertFerme() == 1)? "ouvert" : "fermé";
                $moment = $valeur->getMoment();
                $this->message->setFlash('warning', 'le restaurant est normallement ' . $ouvert . ' pour ' . $moment . ' du ' . $debut . ' au ' . $fin);
            }
        }
    }
}