<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 28-03-17
 * Time: 11:50
 */

namespace model;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/detenir/detenir_sql.php";
require_once dirname(__DIR__) ."/detenir/detenir_T.php";

class detenir implements dao, detenir_interface
{
    private $detenirSql;
    private $detenir;

    /**
     * detenir constructor.
     * @param $detenirlSql
     * @param $detenir
     */
    public function __construct()
    {
        $this->detenirSql = new detenir_sql();
        $this->detenir = new detenir_T();
    }


    public function creer($object)
    {
        $this->detenir->table($object);
        $this->detenirSql->creer($this->detenir);
    }

    public function rechercherNom($Nom)
    {
        return  $this->detenirSql->rechercherNom($Nom);
    }
    public function rechercherId($id)
    {
        return  $this->detenirSql->rechercherId($id);
    }

    public function modifier($object)
    {
        $this->detenirSql->modifier($object);
    }

    public function suprimerNom($nom)
    {
        $this->detenirSql->suprimerNom($nom);
    }

    public function suprimerId($id)
    {
        $this->detenirSql->suprimerId($id);
    }

    public function rechercheIDRestaurant($id)
    {
        return $this->detenirSql->rechercheIDRestaurant($id);
    }

    public function afficherAll()
    {

        $this->detenir = $this->detenirSql->afficherAll();
        return $this->detenir;
    }

    public function suprimeIdRestaurant($id)
    {
        $this->detenirSql->suprimeIdRestaurant($id);
    }
}