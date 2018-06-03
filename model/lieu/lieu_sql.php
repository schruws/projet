<?php

/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 26-02-17
 * Time: 20:34
 */
namespace model;


use controlleur\erreur;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/lieu/lieu_interface.php";
require_once dirname(__DIR__) . "/lieu/lieu_T.php";
require_once dirname(__DIR__)."/../controlleur/erreur.php";

class lieu_sql implements dao, lieu_interface
{
    private $erreur;

    public function __construct()
    {
        $this->erreur = erreur::getInstance();
    }

    public function creer($object)
    {
        try {
            $sql = 'INSERT INTO `lieu`(`rue`, `numero`, `localite`, `codePostal`)
                VALUES (:lieu,:numero,:localite,:codePostal)';
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':lieu', $object->getRue());
            $prepare->bindValue(':numero', $object->getNumero());
            $prepare->bindValue(':localite', $object->getLocalite());
            $prepare->bindValue(':codePostal', $object->getCodePostal());
            $prepare->execute();
            return $db->dernier();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/lieu_sql/creer");
        }
    }

    public function rechercherNom($Nom)
    {
        // TODO: Implement modifier() method.
    }

    public function rechercherId($id)
    {
        $lieu = new lieu_T();
        try {
            $sql = "SELECT * FROM `lieu` WHERE `idLieu`= :id";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':id', $id);
            $prepare->execute();

            while ($row = $prepare->fetch()) {
                $lieu->table($row);
            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/lieu_sql/rechercheId");
        }
        return $lieu;
    }

    public function modifier($object)
    {
        try {
            $sql = " UPDATE lieu SET rue = :lieu, numero = :numero, localite = :localite, codePostal = :codePostal WHERE idLieu = :id";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':lieu', $object->getRue());
            $prepare->bindValue(':numero', $object->getNumero());
            $prepare->bindValue(':localite', $object->getLocalite());
            $prepare->bindValue(':codePostal', $object->getCodePostal());
            $prepare->bindValue(':id', $object->getIdLieu());
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/lieu_sql/modifier");
        }
    }

    public function suprimerId($id)
    {
        // TODO: Implement suprimerId() method.
    }

    public function suprimerNom($nom)
    {
        // TODO: Implement suprimerNom() method.
    }

    public function afficherAll()
    {
        // TODO: Implement afficherAll() method.
    }
}