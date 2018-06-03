<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 23-01-17
 * Time: 13:43
 */
namespace model;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/proposer/proposer_T.php";
require_once dirname(__DIR__) ."/proposer/proposer_sql.php";

class proposer implements dao
{
    private $proposer;
    private $proposerSql;
    /**
     * proposer constructor.
     */
    public function __construct()
    {
        $this->proposer = new proposer_T();
        $this->proposerSql = new proposer_sql();
    }

    public function creer($object)
    {
        $this->proposer->table($object);
        $this->proposerSql->creer( $this->proposer);
    }

    public function rechercherNom($Nom)
    {
        // TODO: Implement rechercherNom() method.
    }

    public function rechercherId($id)
    {
        return $this->proposerSql->rechercherId($id);
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