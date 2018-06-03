<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 23-01-17
 * Time: 12:56
 */
namespace model;
use controlleur\erreur;


require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__) . "/competence/competence_T.php";
require_once dirname(__DIR__)."/competence/competence_interface.php";
require_once dirname(__DIR__)."/../controlleur/erreur.php";

class competence_sql implements dao, competence_interface
{
    private $erreur;

    public function __construct()
    {
        $this->erreur = erreur::getInstance();
    }

    public function creer($object)
    {
        try {
            $sql = "INSERT INTO `Competence`( `nom`) VALUES (:nom)";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':nom', $object->getNom());
            $prepare->execute();
            return $db->dernier();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/competence_sql/creer");
        }
    }

    public function rechercherNom($Nom)
    {
        $comptence = new competence_T();
        try {
            $sql = "SELECT * FROM `Competence` WHERE `nomComp` = :nom";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':nom', $Nom);
            $prepare->execute();

            while ($row = $prepare->fetch()) {
                $comptence->table($row);
            }
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/competence_sql/rechercheNom");
        }
        return $comptence ;
    }
    public function rechercherId($id)
    {
        $comptence = new competence_T();
        try {
            $sql = "SELECT * FROM `Competence` WHERE `idCompetence` = :id";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':id', $id);
            $prepare->execute();
            while ($row = $prepare->fetch()) {
                $comptence->table($row);
            }
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/competence_sql/rechercheId");
        }
        return $comptence ;
    }

    public function modifier($object)
    {
        try {
            $sql = "UPDATE `Competence` SET `nomComp`= :nom WHERE `idCompetence` = :id ";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':nom', $object->getNomComp());
            $prepare->bindParam(':id', $object->getIdCompetence());
            $prepare->execute();


        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/competence_sql/modifier");
        }
        return $object;
    }

    public function suprimerId($id)
    {
        try {
            $sql = "DELETE FROM `Competence` WHERE `id` = :id";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':id', $id);
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/competence_sql/suprimerId");
        }
    }



    public function suprimerNom($nom)
    {
        try {
            $sql = "DELETE FROM `Competence` WHERE `nom` = :nom";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':nom', $nom);
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/compectence_sql/suprimerNom");
        }
    }

    public function afficherAll()
    {
        $tableau = array();
        try {
            $sql = 'SELECT * FROM `Competence`';
            $db = new db();

            foreach ($db->getquery($sql) as $row) {

                $comptence = new competence_T();
                $comptence->table($row);
                $tableau[] = $comptence;
            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/competence_sql/afficherAll");
        }
        return $tableau;
    }


}