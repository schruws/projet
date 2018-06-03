<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 28-03-17
 * Time: 11:52
 */

namespace model;


class detenir_T
{
    private $idRestaurant;

    private $idCuisinne;

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

    /**
     * @return mixed
     */
    public function getIdCuisinne()
    {
        return $this->idCuisinne;
    }

    /**
     * @param mixed $idCuisinne
     */
    public function setIdCuisinne($idCuisinne)
    {
        $this->idCuisinne = $idCuisinne;
    }


}