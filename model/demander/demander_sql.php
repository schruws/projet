<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 23-01-17
 * Time: 13:02
 */

namespace model;
use controlleur\erreur;


require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/demander/demander_interface.php";
require_once dirname(__DIR__) . "/demander/demander_T.php";
require_once dirname(__DIR__)."/../controlleur/erreur.php";

class demander_sql implements dao, demander_interface
{
    private $erreur;

    public function __construct()
    {
        $this->erreur = erreur::getInstance();
    }
    public function creer($object)
    {
        try {
            $sql = 'INSERT INTO `demande`(`idPersonne`, `idConger`) VALUES (:idPersonne, :idConger)';
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':idPersonne', $object->getIdPersonne());
            $prepare->bindValue(':idConger', $object->getIdConger());

            $prepare->execute();
            return $db->dernier();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/demander_sql/creer");
        }
    }



    public function rechercherNom($Nom)
    {

    }
    public function rechercherId($object)
    {
        $demander = new demander_T();
        try {
            $sql = "SELECT * FROM `demande` WHERE `idPersonne` = :idPersonne and `idConger` = :IdConger";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':idPersonne', $object->getIdPersonne());
            $prepare->bindValue(':idConger', $object->getIdConger());
            $prepare->execute();

            while ($row = $prepare->fetch()) {

                $demander->table($row);
            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/demander_sql/rechercherId");
        }
        return $demander;
    }

    public function modifier($object)
    {
        try {
            $sql = "UPDATE `demande` SET `idPersonne`=[value-1],`idConger`=[value-2] WHERE `idPersonne` = :idPersonne and `idConger` = :IdConger";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':idPersonne', $object->getIdPersonne());
            $prepare->bindValue(':idConger', $object->getIdConger());
            $prepare->execute();


        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/demander_sql/modifier");
        }
        return $object;
    }

    public function suprimerNom($nom)
    {

    }

    public function suprimerId($object)
    {
        try {
            $sql = "DELETE FROM demande WHERE `idPersonne` = :idPersonne and `idConger` = :idConger";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':idPersonne', $object->getIdPersonne());
            $prepare->bindValue(':idConger', $object->getIdConger());
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/demander_sql/suprimerId");
        }
    }

    public function afficherAll()
    {
        $tableau = array();
        try {
            $sql = 'SELECT * FROM demande';
            $db = new db();
            foreach ($db->getquery($sql) as $row) {
                $demander = new demander_T();
                $demander->table($row);
                $tableau[] = $demander;
            }
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/demander_sql/afficherAll");
        }
        return $tableau;
    }
}