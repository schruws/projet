<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 23-01-17
 * Time: 13:20
 */
namespace model;

class attribuer_T
{
    private $idFonction;

    private $idContrat;

    function table($Tableau)
    {
        foreach ($Tableau as $Key => $Value) {
            $methode = 'set' . ucfirst($Key); //change la premiere lettre en maj
            if (method_exists($this, $methode)) {
                $this->$methode($Value); //execute la methode 'Set$Key($Value)'
            }
        }
    }

    /**
     * @return mixed
     */
    public function getIdFonction()
    {
        return $this->idFonction;
    }

    /**
     * @param mixed $idFonction
     */
    public function setIdFonction($idFonction)
    {
        $this->idFonction = $idFonction;
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

}