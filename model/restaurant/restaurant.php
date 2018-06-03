<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 18-01-17
 * Time: 16:11
 */
namespace model;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/restaurant/restaurant_T.php";
require_once dirname(__DIR__) ."/restaurant/restaurant_sql.php";

class restaurant implements dao, restaurant_interface
{
    private $restaurant;
    private $restaurantsql;

    public function __construct()
    {
        $this->restaurant = new restaurant_T();
        $this->restaurantsql = new restaurant_sql();
    }
    public function creer($object)
    {
        $this->restaurant->table($object);
        $this->restaurant->setIdrestaurant( $this->restaurantsql->creer($this->restaurant));
        return $this->restaurant;
    }

    public function rechercherNom($Nom)
    {
        return  $this->restaurantsql->rechercherNom($Nom);
    }

    public function rechercherId($id)
    {
        $this->restaurant = $this->restaurantsql->rechercherId($id);
        return $this->restaurant;
    }

    public function modifier($object)
    {
        $this->restaurant->table($object);
        $this->restaurantsql->modifier($this->restaurant);
        return $this->restaurant;
    }

    public function suprimerId($id)
    {
        $this->restaurantsql->suprimerId($id);
    }

    public function suprimerNom($nom)
    {
        $this->restaurantsql->suprimerNom($nom);
    }

    public function afficherAll()
    {
        $this->restaurant = $this->restaurantsql->afficherAll();
        return $this->restaurant;
    }


}