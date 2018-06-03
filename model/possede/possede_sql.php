<?php

/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 06-02-17
 * Time: 22:18
 */
namespace model;

use controlleur\erreur;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/possede/possede_T.php";
require_once dirname(__DIR__)."/possede/possede_interface.php";
require_once dirname(__DIR__)."/../controlleur/erreur.php";

class possede_sql implements dao, possede_interface
{
    private $erreur;

    public function __construct()
    {
        $this->erreur = erreur::getInstance();
    }

    public function creer($object)
    {
        try {
            $sql = 'INSERT INTO `possede`(`idPersonne`, `idRestaurant`) VALUES (:idPersonne,:idRestaurant)';
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':idPersonne', $object->getIdPersonne());
            $prepare->bindValue(':idRestaurant', $object->getIdRestaurant());
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/possede_sql/creer");
        }
    }

    public function rechercherNom($Nom)
    {
        // TODO: Implement rechercherNom() method.
    }

    public function rechercherId($id)
    {
        $tableau = array();
        try {
            $sql = "SELECT * FROM `possede` WHERE `idPersonne`= :idPersonne";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':idPersonne', $id);
            $prepare->execute();

            while ($row = $prepare->fetch()) {
                $possede = new possede_T();
                $possede->table($row);
                $tableau[] = $possede;
            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/possede_sql/rechercheId");
        }
        return $tableau;
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