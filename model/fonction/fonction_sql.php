<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 22-01-17
 * Time: 14:23
 */
namespace model;


use controlleur\erreur;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__) . "/fonction/fonction_T.php";
require_once dirname(__DIR__)."/fonction/fonction_interface.php";
require_once dirname(__DIR__)."/../controlleur/erreur.php";


class fonction_sql implements dao, fonction_interface
{
    private $erreur;

    public function __construct()
    {
        $this->erreur = erreur::getInstance();
    }

    public function creer($object)
    {
        try {
            $sql = "INSERT INTO `Fonction`( `type`) VALUES (:typ)";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':typ', $object->getType());
            $prepare->execute();
            return $db->dernier();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/fonction_sql/creer");
        }
    }

    public function rechercherNom($Nom)
    {
        $fonction = new fonction_T();
        try {
            $sql = "SELECT * FROM `Fonction` WHERE `fonction` = :nom";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':nom', $Nom);
            $prepare->execute();
            while ($row = $prepare->fetch()) {
                $fonction->table($row);
            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/fonction_sql/rechercherNom");
        }
        return $fonction;
    }
    public function rechercherId($id)
    {
        $fonction = new fonction_T();
        try {
            $sql = "SELECT * FROM `Fonction` WHERE `idFonction` = :id";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':id', $id);
            $prepare->execute();
            while ($row = $prepare->fetch()) {
                $fonction->table($row);
            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/fonction_sql/rechercherId");
        }
        return $fonction;
    }

    public function modifier($object)
    {
        try {
            $sql = "UPDATE `Fonction` SET `type`= :nom WHERE `idFonction` = :id ";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':nom', $object->getType());
            $prepare->bindValue(':id', $object->getIdFonction());
            $prepare->execute();


        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/fonction_sql/modifier");
        }
        return $object;
    }

    public function suprimerId($id)
    {
        try {
            $sql = "DELETE FROM `Fonction` WHERE `idFonction`= :id";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':id', $id);
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/fonction_sql/suprimerId");
        }
    }
    public function suprimerNom($nom)
    {
        try {
            $sql = "DELETE FROM `Fonction` WHERE `type`= :nom";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':nom', $nom);
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/fonction_sql/suprimerNom");
        }
    }

    public function afficherAll()
    {
        $tableau = array();
        try {
            $sql = 'SELECT * FROM `Fonction`';
            $db = new db();

            foreach ($db->getquery($sql) as $row) {
                $fonction = new fonction_T();
                $fonction->table($row);
                $tableau[] = $fonction;
            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/fonction_sql/afficherAll");
        }
        return $tableau;
    }




}