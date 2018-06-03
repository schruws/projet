<?php

/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 06-02-17
 * Time: 22:18
 */
namespace model;

class possede_T
{
    private $idPersonne;

    private $idRestaurant;

    function table($Tableau)
    {
        foreach ($Tableau as $Key => $Value)
        {
            $methode='set'.ucfirst($Key); //CHANGE LA PREMIERE LETTRE EN MAJUSCULE
            if (method_exists($this,$methode))
            {
                $this->$methode($Value); //EXECUTE LA METHODE 'Set$Key($Value)'
            }
        }
    }
    /**
     * @return mixed
     */
    public function getIdPersonne()
    {
        return $this->idPersonne;
    }

    /**
     * @param mixed $idPersonne
     */
    public function setIdPersonne($idPersonne)
    {
        $this->idPersonne = $idPersonne;
    }

    /**
     * @return mixed
     */
    public function getIdRestaurant()
    {
        return $this->idRestaurant;
    }

    /**
     * @param mixed $idRestaurant
     */
    public function setIdRestaurant($idRestaurant)
    {
        $this->idRestaurant = $idRestaurant;
    }
}