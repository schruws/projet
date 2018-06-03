<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 22-01-17
 * Time: 14:23
 */
namespace model;
class fonction_T
{
    private $idFonction;

    private $type;

    function table($Tableau)
    {
        foreach ($Tableau as $Key => $Value) {
            $methode = 'set' . ucfirst($Key); //CHANGE LA PREMIERE LETTRE EN MAJUSCULE
            if (method_exists($this, $methode)) {
                $this->$methode($Value); //EXECUTE LA METHODE 'Set$Key($Value)'
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}