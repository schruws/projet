<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 23-01-17
 * Time: 13:14
 */

namespace model;
interface etablir_interface
{

    public function rechercheIDRestaurant($idPersonne);
    public function rechercheAvisPersonne($idPersonne);
    public function rechercheIdContrat($id);

}