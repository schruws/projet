<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 28-03-17
 * Time: 11:33
 */

namespace model;


use controlleur\erreur;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/nationalite/nationalite_interface.php";
require_once dirname(__DIR__) . "/nationalite/nationalite_T.php";
require_once dirname(__DIR__)."/../controlleur/erreur.php";


class nationalite_sql implements dao, nationalite_interface
{
    private $erreur;

    public function __construct()
    {
        $this->erreur = erreur::getInstance();
    }

    public function creer($object)
    {
        try {
            $sql = 'INSERT INTO `Nationalite`( `nationalite`) VALUES (:nationalite)';
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':nationalite', $object->getNationalite());
            $prepare->execute();
            return $db->dernier();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/nationalite_sql/creer");
        }
    }

    public function rechercherNom($Nom)
    {
        $nationalite = new nationalite_T();
        try {


            $sql = "SELECT * FROM Nationalite WHERE (nationalite = :nom)";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':nom', $Nom);
            $prepare->execute();

            while ($row = $prepare->fetch()) {
                $nationalite->table($row);
            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/nationalite_sql/rechercherNom");
        }
        return $nationalite;
    }

    public function rechercherId($id)
    {
        $nationalite = new nationalite_T();
        try {
            $sql = "SELECT * FROM Nationalite WHERE (idNationalite = :id)";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':id', $id);
            $prepare->execute();

            while ($row = $prepare->fetch()) {
                $nationalite->table($row);
            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/nationalite_sql/rechercherId");
        }
        return $nationalite;
    }

    public function modifier($object)
    {
        try {
            $sql = 'UPDATE `Nationalite` SET `nationalite`= :nationalite WHERE idNationalite = :id';
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':id', $object->getIdNationalite());
            $prepare->bindValue(':nationalite', $object->getNationalite());
            $prepare->execute();

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/nationalite_sql/modifier");
        }
        return $object;
    }

    public function suprimerId($id)
    {
        try {
            $sql = "DELETE FROM Nationalite WHERE idNationalite = :id";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':id', $id);
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/nationalite_sql/suprimerId");
        }
    }

    public function suprimerNom($nom)
    {
        try
        {
        $sql = "DELETE FROM Nationalite WHERE nationalite = :nom";
        $db = new db();
        $prepare = $db->setSqlPrepare($sql);
        $prepare->bindParam(':nom', $nom);
        $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/nationalite_sql/suprimerNom");
        }

    }

    public function afficherAll()
    {
        $tableau = array();
        try {
            $sql = 'SELECT * FROM Nationalite';
            $db = new db();
            foreach ($db->getquery($sql) as $row) {
                $nationalite = new nationalite_T();
                $nationalite->table($row);
                $tableau[] = $nationalite;
            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/nationalite_sql/aficherAll");
        }
        return $tableau;
    }
}