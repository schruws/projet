<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 23-01-17
 * Time: 13:01
 */
namespace model;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/demander/demander_sql.php";
require_once dirname(__DIR__) ."/demander/demander_T.php";

class demander implements dao, demander_interface
{
    private $demander;
    private $demanderSql;

    public function __construct()
    {
        $this->demanderSql = new demander_sql();
        $this->demander = new demander_T();
    }


    public function creer($object)
    {
        $this->demander->table($object);
        return  $this->demanderSql->creer($this->demander);
    }

    public function rechercherNom($Nom)
    {
        return  $this->demanderSql->rechercherNom($Nom);
    }
    public function rechercherId($id)
    {
        return  $this->demanderSql->rechercherId($id);
    }

    public function modifier($object)
    {
        $this->demanderSql->modifier($object);
    }

    public function suprimerNom($id)
    {
        $this->demanderSql->suprimerNom($id);
    }

    public function suprimerId($object)
    {
        $this->demander->table($object);
        $this->demanderSql->suprimerId( $this->demander);
    }

    public function afficherAll()
    {

        $this->demander = $this->demanderSql->afficherAll();
        return $this->demander;
    }

}