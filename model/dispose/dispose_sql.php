<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 27-02-17
 * Time: 17:47
 */

namespace model;
use controlleur\erreur;


require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/dispose/dispose_interface.php";
require_once dirname(__DIR__) . "/dispose/dispose_T.php";
require_once dirname(__DIR__)."/../controlleur/erreur.php";


class dispose_sql implements dao, dispose_interface
{
    private $erreur;

    public function __construct()
    {
        $this->erreur = erreur::getInstance();
    }
    public function creer($object)
    {
        try {
            $sql = " INSERT INTO `Dispose`(`idCompetence`, `idPersonne`) VALUES (:idCompetence,:idPersonne)";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':idCompetence', $object->getIdCompetence());
            $prepare->bindValue(':idPersonne', $object->getIdPersonne());
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/dispose_sql/creer");
        }
    }

    public function rechercherId($object)
    {
        $competence = new competence_T();
        try {
            $sql = "SELECT * FROM Dispose WHERE idCompetence = :idCompetence  AND idPersonne = :idPersonne ";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindColumn(':idCompetence', $object->getIdCompetence());
            $prepare->bindColumn(':idPersonne', $object->getPersonne());
            $prepare->execute();
            while ($row = $prepare->fetch()) {
                $competence->table($row);
            }
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/dispose_sql/rechercherId");
        }
        return $competence;
    }

    public function modifier($object)
    {
        try {
            $sql = "UPDATE `dispose` SET `idCompetence`= :idCompetence,`idPersonne`= :idPersonne WHERE idCompetence = :idCompetence  AND idPersonne = :idPersonne";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':idCompetence', $object->getIdCompetence());
            $prepare->bindParam(':idPersonne', $object->getIdPersonne());
            $prepare->execute();


        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/dispose_sql/modifier");
        }
        return $object;
    }

    public function suprimerId($object)
    {
        try {
            // Delete from 'attribuer' where
            $sql = "DELETE  FROM Dispose WHERE idCompetence = :idCompetence  AND idPersonne = :idPersonne";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':idCompetence', $object->getIdCompetence());
            $prepare->bindValue(':idPersonne', $object->getIdPersonne());
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/dispose_sql/suprimerId");
        }
    }

    public function afficherAll()
    {
        $tableau = array();
        try
        {
            $sql = 'SELECT * FROM `Dispose`';
            $db = new db();
            foreach ($db->query($sql) as $row) {
                $attribuer = new attribuer_T();
                $attribuer->table($row);
                $tableau = $attribuer;
            }
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/dispose_sql/afficherAll");
        }
        return $tableau;

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

    public function rechercheIdPersonne($id)
    {
        $competence = new competence_T();
        try {
            $sql = "SELECT * FROM Dispose WHERE  idPersonne = :idPersonne ";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':idPersonne', $id);
            $prepare->execute();
            while ($row = $prepare->fetch()) {
                $competence->table($row);
            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/dispose_sql/rechercherIdPersonne");
        }
        return $competence;
    }
}