<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 27-02-17
 * Time: 17:55
 */

namespace model;

use controlleur\erreur;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/residentiel/residentiel_interface.php";
require_once dirname(__DIR__) . "/residentiel/residentiel_T.php";
require_once dirname(__DIR__)."/../controlleur/erreur.php";


class residentiel_sql implements dao, residentiel_interface
{
    private $erreur;

    public function __construct()
    {
        $this->erreur = erreur::getInstance();
    }

    public function creer($object)
    {
        try {

            $sql = "INSERT INTO `residentiel`(`idPersonne`, `idLieu`) VALUES (:idPersonne,:idLieu)";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':idPersonne', $object->getIdPersonne());
            $prepare->bindValue(':idLieu', $object->getIdLieu());
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/residentiel_sql/creer");
        }
    }

    public function rechercherNom($Nom)
    {
        return false;
    }

    public function rechercherId($id)
    {
        $residentiel = new residentiel_T();
        try {
            $sql = "SELECT * FROM residentiel WHERE (idPersonne = :id)";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':id', $id);
            $prepare->execute();
            while ($row = $prepare->fetch()) {
                $residentiel->table($row);
            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/residentiel_sql/creer");
        }
        return $residentiel;
    }

    public function modifier($object)
    {
        // TODO: Implement modifier() method.
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