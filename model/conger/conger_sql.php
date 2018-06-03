<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 22-01-17
 * Time: 14:18
 */
namespace model;
use controlleur\erreur;


require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/conger/conger_interface.php";
require_once dirname(__DIR__) . "/conger/conger_T.php";
require_once dirname(__DIR__)."/../controlleur/erreur.php";

class conger_sql implements dao, conger_interface
{
    private $erreur;

    public function __construct()
    {
        $this->erreur = erreur::getInstance();
    }

    public function creer($object)
    {
        try{
        $sql = 'INSERT INTO `Conger`( `dateDebut`, `dateFin`) VALUES ( :debut,:fin)';
        $db = new db();
        $prepare = $db->setSqlPrepare($sql);
        $prepare->bindValue(':debut', $object->getDateDebut());
        $prepare->bindValue(':fin', $object->getDateFin());

        $prepare->execute();
        return $db->dernier();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/conger_sql/creer");
        }

    }



    public function rechercherNom($Nom)
    {

    }
    public function rechercherId($id)
    {
        $conger = new conger_T();
        try {
            $sql = "SELECT * FROM Conger WHERE (idConger = :id)";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':id', $id);
            $prepare->execute();
            while ($row = $prepare->fetch()) {
                $conger->table($row);
            }
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/comger_sql/rechercherId");
        }
        return $conger;
    }

    public function modifier($object)
    {
        try {
            $sql = "UPDATE `Conger` SET `dateDebut`= :debut,`dateFin`= :fin WHERE idConger= :id";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':debut', $object->getDateDebut());
            $prepare->bindValue(':fin', $object->getDateFin());
            $prepare->bindValue(':id', $object->getIdConger());
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/conger_sql/modifier");
        }
        return $object;
    }

    public function suprimerNom($nom)
    {

    }

    public function tousLesCongerPersonne($idPersonne)
    {
        $conger = new conger_T();
        try {
            $sql = 'SELECT * FROM `Conger` inner join demande on Conger.idConger = demande.idConger WHERE demande.idPersonne = :idPersonne';
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':idPersonne', $idPersonne);
            $prepare->execute();
            while ($row = $prepare->fetch()) {

                $conger = new conger_T();
                $conger->table($row);
                $tableau[] = $conger;
            }
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/conger_sql/tousLesCongerPersonne");
        }
        return $tableau;
    }

    public function suprimerId($id)
    {
        try {
            $sql = "DELETE FROM Conger WHERE idConger = :id";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':id', $id);
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/conger_sql/suprimeId");
        }
    }

    public function afficherAll()
    {
        $tableau = array();
        try {
            $sql = 'SELECT * FROM Conger';
            $db = new db();
            foreach ($db->getquery($sql) as $row) {
                $conger = new conger_T();
                $conger->table($row);
                $tableau[] = $conger;
            }
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/conger_sql/afficheAll");
        }
        return $tableau;
    }

    public function personneEstCOnger($idPersonne)
    {
        $conger = new conger_T();
        try {
            $sql = "SELECT * from Conger inner join demande on demande.idConger = Conger.idConger INNER join Personne on Personne.idPersonne = demande.idPersonne
            where Conger.dateDebut <= CURRENT_DATE() and Conger.dateFin >= CURRENT_DATE() and Personne.idPersonne = :id ";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':id', $idPersonne);
            $prepare->execute();

            while ($row = $prepare->fetch()) {
                $conger->table($row);
            }
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/conger_sql/personneEstConger");
        }
        return $conger;
    }
}