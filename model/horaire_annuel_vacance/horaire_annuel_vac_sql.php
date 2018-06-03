<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 23-01-17
 * Time: 13:08
 */
namespace model;
use controlleur\erreur;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/horaire_annuel_vacance/horaire_annuel_vac_interf.php";
require_once dirname(__DIR__) ."/horaire_annuel_vacance/horaire_annuel_vac_T.php";
require_once dirname(__DIR__)."/../controlleur/erreur.php";


class horaire_annuel_vac_sql implements dao, horaire_annuel_vac_interf
{
    private $erreur;

    public function __construct()
    {
        $this->erreur = erreur::getInstance();
    }
    public function creer($object)
    {
        try {
            $sql = 'INSERT INTO `Horaire_annuel_vacance`( `debut`, `fin`, `moment`, `ouvertFerme`) VALUES (:debut,:fin,:moment,:ouvertFerme)';
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':debut', $object->getDebut());
            $prepare->bindValue(':fin', $object->getFin());
            $prepare->bindValue(':moment', $object->getMoment());
            $prepare->bindValue(':ouvertFerme', $object->getOuvertFerme());
            $prepare->execute();
            return $db->dernier();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/horaire_annuel_vac_sql/creer");
        }

    }



    public function rechercherNom($Nom)
    {
        $horaire = new horaire_annuel_vac_T();
        try {
            $sql = "SELECT * FROM `Horaire_annuel_vacance` WHERE (moment = :nom)";
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
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/horaire_annuel_vac_sql/rechercherNom");
        }
        return $horaire;
    }
    public function rechercherId($id)
    {
        $horaire = new horaire_annuel_vac_T();
        try {
            $sql = "SELECT * FROM `Horaire_annuel_vacance` WHERE (`idHoraireVacance` = :id)";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':id', $id);
            $prepare->execute();

            while ($row = $prepare->fetch()) {
                $horaire->table($row);
            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/horaire_annuel_vac_sql/rechercherId");
        }
        return $horaire;
    }

    public function modifier($object)
    {
        try {
            $sql = "UPDATE `Horaire_annuel_vacance` SET `debut`= :debut,`fin`= :fin,`moment`= :moment,`ouvertFerme`= :ouvertFerme WHERE `idHoraireVacance` = :id";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':debut', $object->getDebut());
            $prepare->bindValue(':fin', $object->getFin());
            $prepare->bindValue(':moment', $object->getMoment());
            $prepare->bindValue(':ouvertFerme', $object->getOuvertFerme());
            $prepare->bindValue(':id', $object->getIdHoraireVacance());
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/horaire_annuel_vac_sql/modifier");
        }

        return $object;
    }

    public function suprimerNom($nom)
    {
        try {
            $sql = "DELETE FROM `Horaire_annuel_vacance` WHERE nom = :nom";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':nom', $nom);
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/horaire_annuel_vac_sql/suprimerNom");
        }
    }

    public function suprimerId($id)
    {
        try {
            $sql = "DELETE FROM `Horaire_annuel_vacance` WHERE idHoraireVacance = :id";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':id', $id);
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/horaire_annuel_vac_sql/suprimerId");
        }
    }

    public function afficherAll()
    {
        $tableau = array();
        try {
            $sql = 'SELECT * FROM `Horaire_annuel_vacance`';
            $db = new db();
            foreach ($db->getquery($sql) as $row) {
                $horaire = new horaire_annuel_vac_T();
                $horaire->table($row);
                $tableau[] = $horaire;
            }
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/horaire_annuel_vac_sql/afficherAll");
        }
        return $tableau;
    }


    public function restaurantConger($id)
    {
        $horaire = new horaire_annuel_vac_T();
        try {
            $sql = "SELECT * FROM `horaire_annuel_vacance` WHERE `idHoraireVacance` = :id and `debut` <= CURRENT_DATE() and `fin` >= CURRENT_DATE() ";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':id', $id);
            $prepare->execute();

            while ($row = $prepare->fetch()) {
                $horaire->table($row);
            }
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/horaire_annuel_vac_sql/restaurantConger");
        }
        return $horaire;
    }
}