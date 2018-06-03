<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 29-12-16
 * Time: 10:47
 */
namespace model;


interface personne_interface
{
    public function login ($nom, $password);
    public function RechercheEmail($email, $valeur);
    public function PersonnelDuRestaurant($idRestaurant);
    Public function nombrePersonnelDuRestaurant($idRestaurant);
    public function afficherResponsabe();
    public function contratPersonnes($idPersonne, $idRestaurant);
}
