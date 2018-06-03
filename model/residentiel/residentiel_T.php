<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 27-02-17
 * Time: 17:56
 */

namespace model;


class residentiel_T
{
    private $idPersonne;

    private $idLieu;

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
    public function getIdLieu()
    {
        return $this->idLieu;
    }

    /**
     * @param mixed $idLieu
     */
    public function setIdLieu($idLieu)
    {
        $this->idLieu = $idLieu;
    }
}