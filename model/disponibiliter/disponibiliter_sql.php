<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 22-01-17
 * Time: 14:20
 */
namespace model;

use controlleur\erreur;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/disponibiliter/disponibiliter_T.php";
require_once dirname(__DIR__)."/../controlleur/erreur.php";

class disponibiliter_sql implements dao
{
    private $erreur;

    public function __construct()
    {
        $this->erreur = erreur::getInstance();
    }
    public function creer($object)
    {
        try {
            $sql = "INSERT INTO Disponibilitees (lundiMidi, lundiSoir, mardiMidi, mardiSoir, mercrediMidi, mercrediSoir, jeudiMidi, jeudiSoir, vendrediMidi, vendrediSoir, samediMidi, samediSoir, dimancheMidi, dimancheSoir)
        VALUES (:lundiMidi,:lundiSoir,:mardiMidi,:mardiSoir,:mercrediMidi,:mercrediSoir,:jeudiMidi,:jeudiSoir,:vendrediMidi,:vendrediSoir,:samediMidi,:samediSoir,:dimancheMidi,:dimancheSoir)";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':lundiMidi', $object->getLundiMidi());
            $prepare->bindValue(':lundiSoir', $object->getLundiSoir());
            $prepare->bindValue(':mardiMidi', $object->getMardiMidi());
            $prepare->bindValue(':mardiSoir', $object->getMardiSoir());
            $prepare->bindValue(':mercrediMidi', $object->getMercrediMidi());
            $prepare->bindValue(':mercrediSoir', $object->getMercrediSoir());
            $prepare->bindValue(':jeudiMidi', $object->getJeudiMidi());
            $prepare->bindValue(':jeudiSoir', $object->getJeudiSoir());
            $prepare->bindValue(':vendrediMidi', $object->getVendrediMidi());
            $prepare->bindValue(':vendrediSoir', $object->getVendrediSoir());
            $prepare->bindValue(':samediMidi', $object->getSamediMidi());
            $prepare->bindValue(':samediSoir', $object->getSamediSoir());
            $prepare->bindValue(':dimancheMidi', $object->getDimancheMidi());
            $prepare->bindValue(':dimancheSoir', $object->getDimancheSoir());
            $prepare->execute();
            return $db->dernier();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/disponibiliter_sql/creer");
        }
    }

    public function rechercherNom($Nom)
    {
        // TODO: Implement rechercherNom() method.
    }

    public function rechercherId($id)
    {
        try {
            $sql = "SELECT * FROM `Disponibilitees` WHERE `idDisponibilitees`= :idDisponibilitees";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':idDisponibilitees', $id);
            $prepare->execute();
            $disponibiliter = new disponibiliter_T();
            while ($row = $prepare->fetch()) {
                $disponibiliter->table($row);
            }
            return $disponibiliter;
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/disponibiliter_sql/creer");
        }
    }

    public function modifier($object)
    {
        try {
            $sql = 'UPDATE `Disponibilitees` SET `lundiMidi`= :lundiMidi,`lundiSoir`= :lundiSoir,
        `mardiMidi`= :mardiMidi,`mardiSoir`= :mardiSoir,
        `mercrediMidi`= :mercrediMidi,`mercrediSoir`= :mercrediSoir,
        `jeudiMidi`= :jeudiMidi,`jeudiSoir`= :jeudiSoir,
        `vendrediMidi`= :vendrediMidi,`vendrediSoir`= :vendrediSoir,
        `samediMidi`= :samediMidi,`samediSoir`= :samediSoir,
        `dimancheMidi`= :dimancheMidi,`dimancheSoir`= :dimancheSoir WHERE `idDisponibilitees` = :id';
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':lundiMidi', $object->getLundiMidi());
            $prepare->bindValue(':lundiSoir', $object->getLundiSoir());
            $prepare->bindValue(':mardiMidi', $object->getMardiMidi());
            $prepare->bindValue(':mardiSoir', $object->getMardiSoir());
            $prepare->bindValue(':mercrediMidi', $object->getMercrediMidi());
            $prepare->bindValue(':mercrediSoir', $object->getMercrediSoir());
            $prepare->bindValue(':jeudiMidi', $object->getJeudiMidi());
            $prepare->bindValue(':jeudiSoir', $object->getJeudiSoir());
            $prepare->bindValue(':vendrediMidi', $object->getVendrediMidi());
            $prepare->bindValue(':vendrediSoir', $object->getVendrediSoir());
            $prepare->bindValue(':samediMidi', $object->getSamediMidi());
            $prepare->bindValue(':samediSoir', $object->getSamediSoir());
            $prepare->bindValue(':dimancheMidi', $object->getDimancheMidi());
            $prepare->bindValue(':dimancheSoir', $object->getDimancheSoir());
            $prepare->bindValue(':id', $object->getIdDisponibilitees());
            $prepare->execute();
            return $db->dernier();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/disponibiliter_sql/creer");
        }
    }

    public function suprimerId($id)
    {
        // TODO: Implement suprimerId() method.
    }

    public function suprimerNom($id)
    {
        // TODO: Implement suprimerNom() method.
    }

    public function afficherAll()
    {
        // TODO: Implement afficherAll() method.
    }
}