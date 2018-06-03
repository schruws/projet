<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 23-01-17
 * Time: 13:15
 */

namespace model;
use controlleur\erreur;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/etablir/etablir_interface.php";
require_once dirname(__DIR__) . "/etablir/etablir_T.php";
require_once dirname(__DIR__)."/../controlleur/erreur.php";


class etablir_sql implements dao, etablir_interface
{
    private $erreur;

    public function __construct()
    {
        $this->erreur = erreur::getInstance();
    }

    public function creer($object)
    {
        try {
            $sql = " INSERT INTO `etabli`(`idContrat`, `idRestaurant`, `idPersonne`) VALUES (:idContrat,:idRestaurant,:idPersonne)";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':idPersonne', $object->getIdPersonne());
            $prepare->bindValue(':idContrat', $object->getIdContrat());
            $prepare->bindValue(':idRestaurant', $object->getIdRestaurant());
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/etablir_sql/creer");
        }
    }

    public function rechercherNom($Nom)
    {
        // TODO: Implement rechercherNom() method.
    }

    public function rechercherId($id)
    {
        // TODO: Implement rechercheID() method.
    }

    public function rechercheID($idRestaurant, $idPersonne, $idContrat)
    {
        $tableau = array();
        try {
            $sql = "SELECT * FROM `etabli` WHERE `idRestaurant`= :idRestaurant  and idContrat = :idContrat AND idPersonne = :idPersonne";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':idRestaurant', $idRestaurant);
            $prepare->bindValue(':idPersonne', $idPersonne);
            $prepare->bindValue(':idContrat', $idContrat);
            $prepare->execute();
            while ($row = $prepare->fetch()) {
                $etablir = new etablir_T();
                $etablir->table($row);
                $tableau[] = $etablir;
            }
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/etablir_sql/rechercherID");
        }
        return $tableau;
    }
    public function rechercheIDRestaurant($idPersonne)
    {
        $etablir = new etablir_T();
        try {
            $sql = "SELECT * FROM `etabli` inner join Contrat on etabli.idContrat = Contrat.idContrat INNER join Personne on etabli.idPersonne = Personne.idPersonne where Personne.idPersonne = :idPersonne and Contrat.dateFinContrat is not null ";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':idPersonne', $idPersonne);
            $prepare->execute();
            while ($row = $prepare->fetch()) {

                $etablir->table($row);

            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/etablir_sql/rechercheIdRestaurant");
        }
       return $etablir;
    }

    public function modifier($object)
    {
        try {
            $sql = "UPDATE `etabli` SET `note`= :notes,`avis`= :avis WHERE `idContrat` = :id";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':avis', $object->getAvis());
            $prepare->bindValue(':notes', $object->getNote());
            $prepare->bindValue(':id', $object->getIdContrat());
            $prepare->execute();

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/etablir_sql/modifier");
        }
        return $object;
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

    public function rechercheAvisPersonne($idPersonne)
    {
        $tableau = array();
        try {
            $sql = "SELECT * FROM `etabli` WHERE `idPersonne`= :idPersonne";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':idPersonne', $idPersonne);
            $prepare->execute();
            while ($row = $prepare->fetch()) {
                $etablir = new etablir_T();
                $etablir->table($row);
                $tableau[] = $etablir;
            }
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/etablir_sql/rechercheAvisPersonne");
        }
        return $tableau;
    }


    public function rechercheIdContrat($id)
    {
        $etablir = new etablir_T();
        try {
            $sql = "SELECT * FROM `etabli` WHERE `idContrat`= :idContrat";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':idContrat', $id);
            $prepare->execute();
            while ($row = $prepare->fetch()) {
                $etablir->table($row);
            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/etablir_sql/rechercheIdContrat");
        }
        return $etablir;
    }
}