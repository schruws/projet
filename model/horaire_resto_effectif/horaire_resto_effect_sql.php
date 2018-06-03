<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 23-01-17
 * Time: 13:12
 */
namespace model;
use controlleur\erreur;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/horaire_resto_effectif/horaire_resto_effect_interface.php";
require_once dirname(__DIR__) ."/horaire_resto_effectif/horaire_resto_effect_T.php";
require_once dirname(__DIR__)."/../controlleur/erreur.php";

class horaire_resto_effect_sql implements dao, horaire_resto_effect_interface
{
    private $erreur;

    public function __construct()
    {
        $this->erreur = erreur::getInstance();
    }
    public function creer($object)
    {
        /*try {*/
            $sql = 'INSERT INTO `horaire_resto_effectif`(`jour`, `besoin`, `idRestaurant`, `idCompetence`) VALUES (:jour,:besoin,:idRestaurant,:idCompetence)';
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':jour', $object->getJour());
            $prepare->bindValue(':besoin', $object->getBesoin());
            $prepare->bindValue(':idRestaurant', $object->getIdRestaurant());
            $prepare->bindValue(':idCompetence', $object->getIdCompetence());
            $prepare->execute();
            return $db->dernier();
       /* }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/horaire_resto_effect_sql/creer");
        }*/
    }



    public function rechercherNom($Nom)
    {
        $horaire = new horaire_resto_effect_T();
        try {
            $sql = "SELECT * FROM `horaire_resto_effectif` WHERE `jour` = :Nom";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':nom', $nom);
            $prepare->execute();

            while ($row = $prepare->fetch()) {

                $horaire->table($row);

            }
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/horaire_resto_effect_sql/rechercherNom");
        }
        return $horaire;
    }
    public function rechercherId($id)
    {
       // na
    }

    public function modifier($object) // a retravaille
    {
        try {
            $sql = "UPDATE `horaire_resto_effectif` SET `jour`= :jour,`besoin`= :besoin,`idRestaurant`= :idRestaurant,`idCompetence`= :idCompetence
        WHERE `idHoraireEffectif` = :id ";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':jour', $object->getJour());
            $prepare->bindValue(':besoin', $object->getBesoin());
            $prepare->bindValue(':idRestaurant', $object->getIdRestaurant());
            $prepare->bindValue(':idCompetence', $object->getIdCompetence());
            $prepare->bindValue(':id', $object->getIdHoraireEffectif());
            $prepare->execute();


        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/horaire_resto_effect_sql/modifier");
        }
        return $object;
    }

    public function suprimerNom($nom)
    {
        try {
            $sql = "DELETE  FROM `horaire_resto_effectif` WHERE `jour` = :Nom";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':nom', $nom);
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/horaire_resto_effect_sql/suprimerNom");
        }
    }

    public function suprimerId($id)
    {
        try {
            $sql = "DELETE  FROM `horaire_resto_effectif` WHERE `idRestaurant` = :id";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':id', $id);
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/horaire_resto_effect_sql/suprimerNom");
        }
    }

    public function afficherAll()
    {
        $tableau = array();
        try {

            $sql = 'SELECT * FROM `horaire_resto_effectif`';
            $db = new db();

            foreach ($db->getquery($sql) as $row) {
                $horaire = new horaire_resto_effect_T();
                $horaire->table($row);
                $tableau[] = $horaire;
            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/horaire_resto_effect_sql/afficherAll");
        }
        return $tableau;
    }

    public function rechercheIdRestaurant($id)
    {
        $tableau = array();

        try {
            $sql = "SELECT * FROM `horaire_resto_effectif` WHERE `idRestaurant` = :id";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':id', $id);
            $prepare->execute();

            while ($row = $prepare->fetch()) {
                $horaire = new horaire_resto_effect_T();
                $horaire->table($row);
                $tableau[] = $horaire;
            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/horaire_resto_effect_sql/rechercheIdRestaurant");
        }
        return $tableau;
    }
    public function nombrePersonneDisponiblePost($idRestaurant, $jour, $competence)
    {
        $nombre = 0;
        try {
            //SELECT COUNT(nomPers) as nombre FROM `Personne` inner join etabli on Personne.idPersonne = etabli.idPersonne inner join Contrat on etabli.idContrat = Contrat.idContrat inner join Disponibilitees on Disponibilitees.idDisponibilitees = Personne.idDisponibilitees inner join Dispose on Dispose.idPersonne = Personne.idPersonne INNER join Competence on Competence.idCompetence = Dispose.idCompetence
            // where etabli.idRestaurant = 1 and Personne.dateSupr is null and Contrat.dateFinContrat is not null and Competence.nomComp = "bar" AND Disponibilitees.lundiMidi = 1
            $sql = 'SELECT COUNT(nomPers) as nombre FROM `Personne` inner join etabli on Personne.idPersonne = etabli.idPersonne
            inner join Contrat on etabli.idContrat = Contrat.idContrat inner join Disponibilitees on Disponibilitees.idDisponibilitees = Personne.idDisponibilitees
            inner join Dispose on Dispose.idPersonne = Personne.idPersonne INNER join Competence on Competence.idCompetence = Dispose.idCompetence
            where etabli.idRestaurant = :idRestaurant and Personne.dateSupr is null and Contrat.dateFinContrat is not null and Competence.nomComp = :competence AND Disponibilitees.'.$jour.' =  1 ';
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':idRestaurant', $idRestaurant);
            $prepare->bindParam(':competence', $competence);
            $prepare->execute();
            while ($row = $prepare->fetch()) {
                $nombre = $row['nombre'];
            }
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/personne_sql/nombrePersonnelDuRestaurant");
        }
        return $nombre;
    }

    public function recupereLesPersonneDisponible($idRestaurant, $jour, $competence)
    {

        $tableau = array();
        try {
            $sql = 'SELECT * FROM `Personne` inner join etabli on Personne.idPersonne = etabli.idPersonne
            inner join Contrat on etabli.idContrat = Contrat.idContrat inner join Disponibilitees on Disponibilitees.idDisponibilitees = Personne.idDisponibilitees
            inner join Dispose on Dispose.idPersonne = Personne.idPersonne INNER join Competence on Competence.idCompetence = Dispose.idCompetence
            where etabli.idRestaurant = :idRestaurant and Personne.dateSupr is null and Contrat.dateFinContrat is not null and Competence.nomComp = :competence AND Disponibilitees.'.$jour.' =   1 ';
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':idRestaurant', $idRestaurant);
            $prepare->bindParam(':competence', $competence);
            $prepare->execute();
            while ($row = $prepare->fetch()) {
                $tableau[] = $row;
            }
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/personne_sql/nombrePersonnelDuRestaurant");
        }
        return $tableau;
    }


    public function besoinRestaurant($idRestaurant, $jour, $competence)
    {
        $nombre = 0;
        try
        {
            $sql = "SELECT `besoin` FROM `horaire_resto_effectif` WHERE `idRestaurant` = :idRestaurant and `idCompetence` = :competence and `jour` = :jour";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':idRestaurant', $idRestaurant);
            $prepare->bindParam(':competence', $competence);
            $prepare->bindParam(':jour', $jour);
            $prepare->execute();
            while ($row = $prepare->fetch()) {
                $nombre = $row['besoin'];
            }
        }
        catch (\Exception $e)
        {
        $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/personne_sql/nombrePersonnelDuRestaurant");
        }
        return $nombre;
    }
}