<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 28-03-17
 * Time: 11:51
 */

namespace model;


interface detenir_interface
{
    public function rechercheIDRestaurant($objet);
    public function suprimeIdRestaurant($id);
}