<?php

/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 26-02-17
 * Time: 20:34
 */
namespace model;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/lieu/lieu_sql.php";
require_once dirname(__DIR__) ."/lieu/lieu_T.php";

class lieu implements dao, lieu_interface
{
    private $lieu;
    private $lieuSql;

    public function __construct()
    {
        $this->lieu = new lieu_T();
        $this->lieuSql = new lieu_sql();
    }
    public function creer($object)
    {
        $this->lieu->table($object);
        $this->lieu->setIdlieu( $this->lieuSql->creer($this->lieu));
        return $this->lieu;
    }

    public function rechercherNom($Nom)
    {
        // TODO: Implement rechercherNom() method.
    }

    public function rechercherId($id)
    {
        return  $this->lieuSql->rechercherId($id);
    }

    public function modifier($object)
    {
        $this->lieu->table($object);
        $this->lieuSql->modifier($this->lieu);
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