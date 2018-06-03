<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 23-01-17
 * Time: 13:20
 */
namespace model;


use controlleur\erreur;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/attribuer/attribuer_interface.php";
require_once dirname(__DIR__) . "/attribuer/attribuer_T.php";
require_once dirname(__DIR__)."/../controlleur/erreur.php";

class attribuer_sql implements dao, attribuer_interface
{
    private $erreur;

    public function __construct()
    {
        $this->erreur = erreur::getInstance();
    }


    public function creer($object)
    {
        try
        {
            $sql=" INSERT INTO `attribue`(`idFonction`, `idContrat`) VALUES (:idFonction,:idContrat)";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':idFonction', $object->getIdFonction());
            $prepare->bindValue(':idContrat', $object->getIdContrat());
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/attribuer_sql/creer");
        }
    }

    public function rechercherId($object)
    {
        $attribuer = new attribuer_T();
        try {
            $sql = "SELECT * FROM attribue WHERE idFonction = :idFonction  AND id = :id ";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindColumn(':idFonction', $object->getIdFonction());
            $prepare->bindColumn(':id', $object->getId());
            $prepare->execute();
            while ($row = $prepare->fetch()) {

                $attribuer->table($row);
            }
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/attribuer_sql/rechercheId");
        }
        return $attribuer;
    }

    public function modifier($object)
    {
        try {
            $sql = "UPDATE attribue SET  WHERE id_fonction = :id_fonction  AND id = :id ";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':id_fonction', $object->getIdFonction());
            $prepare->bindParam(':id_fonction', $object->getId());
            $prepare->execute();

            return $object;
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/attribuer_sql/modifier");
        }
    }

    public function suprimerId($id)
    {
        try {
            // Delete from 'attribuer' where
            $sql = "DELETE  FROM atribue WHERE (id = :id)";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':id', $id);
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/attribuer_sql/suprimerID");
        }
    }

    public function afficherAll()
    {
        try
        {
            $sql = 'SELECT * FROM `attribue`';
            $db = new db();
            $tableau = array();
            foreach ($db->query($sql) as $row) {
                $attribuer = new attribuer_T();
                $attribuer->table($row);
                $tableau = $attribuer;
            }
            return $tableau;
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/attribuer_sql/afficherAll");
        }
    }
    //pas de sens a l'implemente
    public function rechercherNom($Nom)
    {
        // TODO: Implement rechercherNom() method.
    }
    //pas de sens a l'implemente
    public function suprimerNom($id)
    {
        // TODO: Implement suprimerNom() method.
    }

    public function rechercheIdContrat($idContrat)
    {
        try {
            $sql = "SELECT * FROM attribue WHERE  idContrat = :id ";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':id', $idContrat);
            $prepare->execute();
            $attribuer = new attribuer_T();
            while ($row = $prepare->fetch()) {
                $attribuer->table($row);
            }
            return $attribuer;
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/attribuer_sql/rechercheIdContrat");
        }
    }

}