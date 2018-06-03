<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 23-01-17
 * Time: 13:15
 */

namespace model;

class etablir_T
{
    private $note;

    private $avis;

    private $idContrat;

    private $idRestaurant;

    private $idPersonne;

    function table($Tableau)
    {
        foreach ($Tableau as $Key => $Value)
        {
            $methode='set'.ucfirst($Key);
            if (method_exists($this,$methode))
            {
                $this->$methode($Value);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return mixed
     */
    public function getAvis()
    {
        return $this->avis;
    }

    /**
     * @param mixed $avis
     */
    public function setAvis($avis)
    {
        $this->avis = $avis;
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
    public function getIdContrat()
    {
        return $this->idContrat;
    }

    /**
     * @param mixed $idContrat
     */
    public function setIdContrat($idContrat)
    {
        $this->idContrat = $idContrat;
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