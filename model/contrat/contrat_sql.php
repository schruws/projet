<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 22-01-17
 * Time: 14:17
 */
namespace model;
use controlleur\erreur;


require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/contrat/contrat_interface.php";
require_once dirname(__DIR__) . "/contrat/contrat_T.php";
require_once dirname(__DIR__)."/../controlleur/erreur.php";

class contrat_sql implements dao, contrat_interface
{
    private $erreur;

    public function __construct()
    {
        $this->erreur = erreur::getInstance();
    }

    public function creer($object)
    {
        try {
            $sql = 'INSERT INTO `Contrat`( `remunerationBrut`, `dateDebutContrat`, `dateFinContrat`, `Typecontrat`)
        VALUES (:remunerationBrut,:dateDebut,:dateFin,:typeContrat)';
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':remunerationBrut', $object->getRemunerationBrut());
            $prepare->bindValue(':dateDebut', $object->getDateDebutContrat());
            $prepare->bindValue(':dateFin', $object->getDateFinContrat());
            $prepare->bindValue(':typeContrat', $object->getTypeContrat());
            $prepare->execute();
            return $db->dernier();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/contrat_sql/creer");
        }
    }

    public function rechercherNom($Nom)
    {
        $contrat = new contrat_T();
        try {
            $sql = "SELECT * FROM Contrat WHERE (Nom_contrat = :nom)";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':nom', $nom);
            $prepare->execute();

            while ($row = $prepare->fetch()) {
                $contrat->table($row);
            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/contrat_sql/rechercheNom");
        }
        return $contrat;
    }

    public function rechercherId($id)
    {
        $contrat = new contrat_T();
        try {
            $sql = "SELECT * FROM Contrat WHERE (idContrat = :id)";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':id', $id);
            $prepare->execute();

            while ($row = $prepare->fetch()) {
                $contrat->table($row);
            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/contrat_sql/rechercheId");
        }
        return $contrat;
    }

    public function contractPersonne($idPersonne)
    {
        $contrat = new contrat_T();
        try {
            $sql = 'SELECT * FROM `Contrat` inner join etabli on Contrat.idContrat = etabli.idContrat where etabli.idPersonne = :id and Contrat.dateFinContrat IS NOT NULL ';
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':id', $idPersonne);
            $prepare->execute();
            while ($row = $prepare->fetch()) {
                $contrat->table($row);
            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/contrat_sql/contratPersonne");
        }
        return $contrat;
    }

    public function tousLesContratPersonne($idPersonne)
    {
        $tableau = array();
        try {
            $sql = 'SELECT * FROM `Contrat` inner join etabli on Contrat.idContrat = etabli.idContrat where etabli.idPersonne = :id ';
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':id', $idPersonne);
            $prepare->execute();

            while ($row = $prepare->fetch()) {
                $contrat = new contrat_T();
                $contrat->table($row);
                $tableau[] = $contrat;
            }
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/contrat_sql/tousLesContratPersonne");
        }
        return $tableau;
    }

    public function modifier($object)
    {
        try {
            $sql = "UPDATE `Contrat` SET `remunerationBrut`= :remunerationBrut,`dateDebutContrat`= :dateDebutContrat,`dateFinContrat`= :dateFinCOntrat,`Typecontrat`= :typeContrat WHERE `idContrat` = :id";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':remunerationBrut', $object->getRemunerationBrut());
            $prepare->bindValue(':dateDebutContrat', $object->getDateDebutContrat());
            $prepare->bindValue(':dateFinCOntrat', $object->getDateFinContrat());
            $prepare->bindValue(':typeContrat', $object->getTypeContrat());
            $prepare->bindValue(':id', $object->getIdContrat());
            $prepare->execute();

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/contrat_sql/modifier");
        }
        return $object;
    }

    public function suprimerId($id)
    {
        try
        {
        $sql = "DELETE FROM Contrat WHERE id = :id";
        $db = new db();
        $prepare = $db->setSqlPrepare($sql);
        $prepare->bindParam(':id', $id);
        $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/contrat_sql/suprimerId");
        }

    }

    public function suprimerNom($nom)
    {
        try {
            $sql = "DELETE FROM Contrat WHERE nom = :nom";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':nom', $nom);
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/contrat_sql/suprimerNom");
        }
    }

    public function afficherAll()
    {
        $tableau = array();
        try {
            $sql = 'SELECT * FROM Contrat';
            $db = new db();
            foreach ($db->getquery($sql) as $row) {
                $contrat = new contrat_T();
                $contrat->table($row);
                $tableau[] = $contrat;
            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/contrat_sql/afficheAll");
        }
        return $tableau;
    }
}