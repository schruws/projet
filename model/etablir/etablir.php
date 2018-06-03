<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 23-01-17
 * Time: 13:14
 */
namespace model;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/etablir/etablir_sql.php";
require_once dirname(__DIR__) ."/etablir/etablir_T.php";

class etablir implements dao, etablir_interface
{

    private $etablir;
    private $etablirSql;
    public function __construct()
    {
        $this->etablir = new etablir_T();
        $this->etablirSql = new etablir_sql();
    }
    public function creer($object)
    {
        $this->etablir->table($object);
        $this->etablirSql->creer($this->etablir);
    }

    public function rechercherNom($Nom)
    {
        // TODO: Implement rechercherNom() method.
    }

    public function rechercherId($id)
    {
        return $this->etablirSql->rechercherId($id);
    }

    public function rechercheIdContrat($id)
    {
      return $this->etablirSql->rechercheIdContrat($id);
    }

    public function modifier($object)
    {
        $this->etablir->table($object);
        $this->etablirSql->modifier($this->etablir);
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


    public function rechercheID($idRestaurant, $idPersonne, $idContrat)
    {
        // TODO: Implement rechercheID() method.
    }

    public function rechercheIDRestaurant($idPersonne)
    {
        return $this->etablirSql->rechercheIDRestaurant($idPersonne);
    }

    public function rechercheAvisPersonne($idPersonne)
    {
        return $this->etablirSql->rechercheAvisPersonne($idPersonne);
    }


}