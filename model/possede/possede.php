<?php

/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 06-02-17
 * Time: 22:17
 */

namespace model;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/possede/possede_T.php";
require_once dirname(__DIR__) ."/possede/possede_sql.php";

class possede implements dao, possede_interface
{
    private $possedeSql;
    private $possede;

    /**
     * possede constructor.
     * @param $posseSql
     */
    public function __construct()
    {
        $this->possedeSql = new possede_sql();
        $this->possede = new possede_T();
    }

    public function creer($object)
    {
        $this->possede->table($object);
        $this->possedeSql->creer( $this->possede);
    }

    public function rechercherNom($Nom)
    {
        // TODO: Implement rechercherNom() method.
    }

    public function rechercherId($id)
    {
        return $this->possedeSql->rechercherId($id);
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