<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 23-01-17
 * Time: 13:12
 */
namespace model;

interface horaire_resto_effect_interface
{
    public function rechercheIdRestaurant($id);
    public function nombrePersonneDisponiblePost($idRestaurant, $jour, $competence);
    public function recupereLesPersonneDisponible($idRestaurant, $jour, $competence);
    public function besoinRestaurant($idRestaurant, $jour, $competence);


}