<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 23-01-17
 * Time: 13:44
 */

namespace model;


use controlleur\erreur;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__) . "/proposer/proposer_T.php";
require_once dirname(__DIR__)."/../controlleur/erreur.php";

class proposer_sql implements dao
{
    private $erreur;

    public function __construct()
    {
        $this->erreur = erreur::getInstance();
    }

    public function creer($object)
    {
        try {
            $sql = "INSERT INTO `propose`(`idPersonne`, `idDisponibilitees`) VALUES (:idPersonne,:idDisponibiliter)";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':idPersonne', $object->getIdPersonne());
            $prepare->bindValue(':idDisponibiliter', $object->getIdDisponibiliter());
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/proposer_sql/creer");
        }
    }

    /**
     * n'a pas de sens
     * @param $Nom
     * @return bool
     */
    public function rechercherNom($Nom)
    {
        return false;
    }

    public function rechercherId($id)
    {
        try {
            $sql = "SELECT * FROM `propose` WHERE `idPersonne`= :idPersonne";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':idPersonne', $id);
            $prepare->execute();
            while ($row = $prepare->fetch()) {
                $proposer = new proposer_T();
                $proposer->table($row);
            }
            return $proposer;
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/proposer_sql/rechercherId");
        }
    }

    public function modifier($object)
    {
        // TODO: Implement modifier() method.
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