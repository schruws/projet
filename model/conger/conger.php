<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 22-01-17
 * Time: 14:18
 */
namespace model;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/conger/conger_sql.php";
require_once dirname(__DIR__) ."/conger/conger_T.php";

class conger implements dao, conger_interface
{
    private $congerSql;
    private $conger;

    public function __construct()
    {
        $this->congerSql = new conger_sql();
        $this->conger = new conger_T();
    }


    public function tousLesCongerPersonne($idPersonne)
    {
        return $this->congerSql->tousLesCongerPersonne($idPersonne);
    }

    public function creer($object)
    {

        $this->conger->table($object);
        $this->conger->setIdconger( $this->congerSql->creer($this->conger));
        return $this->conger;
    }

    public function personneEstCOnger($idPersonne)
    {
        return $this->congerSql->personneEstCOnger($idPersonne);
    }

    public function rechercherNom($Nom)
    {
        return  $this->congerSql->rechercherNom($Nom);
    }
    public function rechercherId($id)
    {
        return  $this->congerSql->rechercherId($id);
    }

    public function modifier($object)
    {
        $this->conger->table($object);
        $this->congerSql->modifier( $this->conger);
    }

    public function suprimerNom($id)
    {
        $this->congerSql->suprimerNom($id);
    }

    public function suprimerId($id)
    {
        $this->congerSql->suprimerId($id);
    }

    public function afficherAll()
    {

        $this->conger = $this->congerSql->afficherAll();
        return $this->conger;
    }

}