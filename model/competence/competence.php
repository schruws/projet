<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 23-01-17
 * Time: 12:56
 */

namespace model;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/competence/competence_sql.php";
require_once dirname(__DIR__) ."/competence/competence_T.php";

class competence implements dao, competence_interface
{
    private $competenceSql;
    private $compet;

    public function __construct()
    {
        $this->competenceSql = new competence_sql();
        $this->compet = new competence_T();
    }


    public function creer($object)
    {
        $this->compet->table($object);
        $this->compet->setIdcompetence( $this->competenceSql->creer($this->compet));
        return $this->compet;
    }

    public function rechercherNom($Nom)
    {
        return  $this->competenceSql->rechercherNom($Nom);
    }
    public function rechercherId($id)
    {
        return  $this->competenceSql->rechercherId($id);
    }

    public function modifier($object)
    {
        $this->compet->table($object);
        $this->competenceSql->modifier($this->compet);
    }

    public function suprimerNom($id)
    {
        $this->competenceSql->suprimerNom($id);
    }

    public function suprimerId($id)
    {
        $this->competenceSql->suprimerId($id);
    }

    public function afficherAll()
    {

        $this->compet = $this->competenceSql->afficherAll();
        return $this->compet;
    }

}