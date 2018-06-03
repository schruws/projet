<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 28-03-17
 * Time: 11:51
 */

namespace model;

use controlleur\erreur;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/detenir/detenir_interface.php";
require_once dirname(__DIR__) . "/detenir/detenir_T.php";
require_once dirname(__DIR__)."/../controlleur/erreur.php";

class detenir_sql implements dao, detenir_interface
{
    private $erreur;

    public function __construct()
    {
        $this->erreur = erreur::getInstance();
    }

    public function creer($object)
    {
        try {
            $sql = 'INSERT INTO `detenir`(`idRestaurant`, `idCuisinne`) VALUES (:idRestaurant,:idCuisine)';
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':idCuisine', $object->getIdCuisinne());
            $prepare->bindValue(':idRestaurant', $object->getIdRestaurant());
            $prepare->execute();
            return $db->dernier();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/detenir_sql/creer");
        }
    }

    public function rechercherNom($Nom)
    {
        // TODO: Implement rechercherNom() method.
    }

    public function rechercherId($objet)
    {
        try {
            $sql = "SELECT * FROM `detenir` WHERE `idRestaurant`= :idRestaurant and  `idCuisinne = :idCuisinne";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':idRestaurant', $objet->getIdRestaurant());
            $prepare->bindValue(':idCuisine', $objet->getIdCuisine());
            $prepare->execute();
            $detenir = new detenir_T();
            while ($row = $prepare->fetch()) {
                $detenir->table($row);
            }
            return $detenir;
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/detenir_sql/creer");
        }
    }

    public function rechercheIDRestaurant($id)
    {
        try {
            $sql = 'SELECT * FROM `detenir` WHERE `idRestaurant` = :idRestaurant';
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':idRestaurant', $id);
            $prepare->execute();
            $tableau = array();
            while ($row = $prepare->fetch()) {
                $detenir = new detenir_T();
                $detenir->table($row);
                $tableau[] = $detenir;
            }
            return $tableau;
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/detenir_sql/creer");
        }

    }

    public function modifier($objet)
    {
        try {
            $sql = 'UPDATE `detenir` SET `idRestaurant`= :idRestaurant,`idCuisinne`= :idCuisine  WHERE idRestaurant = ::idRestaurant  AND idCuisinne = :idCuisine';
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':idRestaurant', $objet->getIdRestaurant());
            $prepare->bindValue(':idCuisine', $objet->getIdCuisine());
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/detenir_sql/creer");
        }
    }

    public function suprimerId($objet)
    {
        try {
            $sql = "DELETE FROM detenir WHERE idRestaurant = ::idRestaurant  AND idCuisinne = :idCuisine";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':idRestaurant', $objet->getIdRestaurant());
            $prepare->bindValue(':idCuisine', $objet->getIdCuisine());
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/detenir_sql/creer");
        }
    }

    public function suprimerNom($nom)
    {
        // TODO: Implement suprimerNom() method.
    }

    public function afficherAll()
    {
        try {
            $sql = 'SELECT * FROM detenir';
            $db = new db();
            $tableau = array();
            foreach ($db->getquery($sql) as $row) {

                $detenir = new detenir_T();
                $detenir->table($row);
                $tableau[] = $detenir;
            }
            return $tableau;
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/detenir_sql/creer");
        }
    }

    public function suprimeIdRestaurant($id)
    {
        try {


            $sql = "DELETE FROM detenir WHERE idRestaurant = :idRestaurant ";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':idRestaurant', $id);
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/detenir_sql/creer");
        }
    }
}