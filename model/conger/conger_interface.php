<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 22-01-17
 * Time: 14:18
 */
namespace model;

interface conger_interface
{
    public function tousLesCongerPersonne($idPersonne);
    public function personneEstCOnger($idPersonne);
}