<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 22-01-17
 * Time: 14:17
 */
namespace model;
interface contrat_interface
{
    public function contractPersonne($idPersonne);
    public function tousLesContratPersonne($idPersonne);
}