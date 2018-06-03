<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 28-03-17
 * Time: 11:41
 */

namespace model;


class typeDeCuisine_T
{
    private $idCuisinne;

    private $typeDeCuisinne;

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

    /**
     * @return mixed
     */
    public function getTypeDeCuisinne()
    {
        return $this->typeDeCuisinne;
    }

    /**
     * @param mixed $typeDeCuisinne
     */
    public function setTypeDeCuisinne($typeDeCuisinne)
    {
        $this->typeDeCuisinne = $typeDeCuisinne;
    }

}