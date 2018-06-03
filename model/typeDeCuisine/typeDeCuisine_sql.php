<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 28-03-17
 * Time: 11:41
 */

namespace model;


use controlleur\erreur;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/typeDeCuisine/typeDeCuisine_interface.php";
require_once dirname(__DIR__) . "/typeDeCuisine/typeDeCuisine_T.php";
require_once dirname(__DIR__)."/../controlleur/erreur.php";

class typeDeCuisine_sql implements dao, typeDeCuisine_interface
{
    private $erreur;

    public function __construct()
    {
        $this->erreur = erreur::getInstance();
    }
    public function creer($object)
    {
        try {
            $sql = 'INSERT INTO `typeDeCuisinne`( `typeDeCuisinne`) VALUES (:typeDeCuisinne)';
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':typeDeCuisinne', $object->getTypeDeCuisinne());
            $prepare->execute();
            return $db->dernier();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/typeDeCuisine_sql/creer");
        }
    }

    public function rechercherNom($Nom)
    {
        $typeDeCuisine = new typeDeCuisine_T();
        try {
            $sql = "SELECT * FROM typeDeCuisinne WHERE (typeDeCuisinne = :nom)";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':nom', $Nom);
            $prepare->execute();

            while ($row = $prepare->fetch()) {
                $typeDeCuisine->table($row);
            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/typeDeCuisine_sql/rechercherNom");
        }
        return $typeDeCuisine;
    }

    public function rechercherId($id)
    {
        $typeDeCuisine = new typeDeCuisine_T();
        try {
            $sql = "SELECT * FROM typeDeCuisinne WHERE (idCuisinne = :id)";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':id', $id);
            $prepare->execute();

            while ($row = $prepare->fetch()) {
                $typeDeCuisine->table($row);
            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/typeDeCuisine_sql/rechercherId");
        }
        return $typeDeCuisine;
    }

    public function modifier($object)
    {
        try {
            $sql = 'UPDATE `typeDeCuisinne` SET `typeDeCuisine`= :typeDeCuisinne WHERE idCuisine = :id';
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':id', $object->getIdNtionalite());
            $prepare->bindValue(':typeDeCuisine', $object->getNtionalite());
            $prepare->execute();
            return $db->dernier();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/typeDeCuisine_sql/modifier");
        }
    }

    public function suprimerId($id)
    {
        try {
            $sql = "DELETE FROM typeDeCuisinne WHERE idTypeDeCuisinne = :id";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':id', $id);
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/typeDeCuisine_sql/suprimerId");
        }
    }

    public function suprimerNom($nom)
    {
        try {
            $sql = "DELETE FROM typeDeCuisinne WHERE typeDeCuisinne = :nom";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':nom', $nom);
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/typeDeCuisine_sql/suprimerNom");
        }
    }

    public function afficherAll()
    {
        $tableau = array();
        try {
            $sql = 'SELECT * FROM typeDeCuisinne';
            $db = new db();

            foreach ($db->getquery($sql) as $row) {
                $typeDeCuisine = new typeDeCuisine_T();
                $typeDeCuisine->table($row);
                $tableau[] = $typeDeCuisine;
            }
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/typeDeCuisine_sql/afficherAll");
        }
        return $tableau;
    }
}