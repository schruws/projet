<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 23-01-17
 * Time: 13:19
 */
namespace model;
require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/attribuer/attribuer_sql.php";
require_once dirname(__DIR__) ."/attribuer/attribuer_T.php";

class attribuer implements dao, attribuer_interface
{
    private $attribuerSql;
    private $attribuer;


    public function __construct()
    {
        $this->attribuerSql = new attribuer_sql();
        $this->attribuer = new attribuer_T();
    }


    public function creer($object)
    {
        $this->attribuer->table($object);
        $this->attribuerSql->creer($this->attribuer);

    }

    public function rechercherNom($Nom)
    {
        return  $this->attribuerSql->rechercherNom($Nom);
    }
    public function rechercherId($id)
    {
        return  $this->attribuerSql->rechercherId($id);
    }

    public function modifier($object)
    {
        $this->attribuerSql->modifier($object);
    }

    public function suprimerNom($nom)
    {
        $this->attribuerSql->suprimerNom($nom);
    }

    public function suprimerId($id)
    {
        $this->attribuerSql->suprimerId($id);
    }

    public function afficherAll()
    {

        $this->attribuer = $this->attribuerSql->afficherAll();
        return $this->attribuer;
    }

    public function rechercheIdContrat($idContrat)
    {
        return  $this->attribuerSql->rechercheIdContrat($idContrat);
    }
}