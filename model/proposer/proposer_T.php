<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 23-01-17
 * Time: 14:11
 */
namespace model;

class proposer_T
{
    private $idPersonne;
    private $idDisponibilitees;



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
    public function getIdDisponibilitees()
    {
        return $this->idDisponibilitees;
    }

    /**
     * @param mixed $idDisponibilitees
     */
    public function setIdDisponibilitees($idDisponibilitees)
    {
        $this->idDisponibilitees = $idDisponibilitees;
    }


}