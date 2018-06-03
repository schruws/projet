<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 25-12-16
 * Time: 18:39
 */

namespace model;


interface dao
{


     public function creer ($object);
     public function rechercherNom ($Nom);
    public function rechercherId ($id);
     public function modifier ($object);
     public function suprimerId ($id);
    public function suprimerNom ($nom);
     public function afficherAll ();


}