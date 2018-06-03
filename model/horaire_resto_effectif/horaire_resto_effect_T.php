<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 23-01-17
 * Time: 13:12
 */

namespace  model;

class horaire_resto_effect_T
{
    private $idHoraireEffectif;

    private $jour;

    private $besoin;

    private $idRestaurant;

    private $idCompetence;


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
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * @param mixed $jour
     */
    public function setJour($jour)
    {
        $this->jour = $jour;
    }

    /**
     * @return mixed
     */
    public function getBesoin()
    {
        return $this->besoin;
    }

    /**
     * @param mixed $besoin
     */
    public function setBesoin($besoin)
    {
        $this->besoin = $besoin;
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
    public function getIdCompetence()
    {
        return $this->idCompetence;
    }

    /**
     * @param mixed $idCompetence
     */
    public function setIdCompetence($idCompetence)
    {
        $this->idCompetence = $idCompetence;
    }

    /**
     * @return mixed
     */
    public function getIdHoraireEffectif()
    {
        return $this->idHoraireEffectif;
    }

    /**
     * @param mixed $idHoraireEffectif
     */
    public function setIdHoraireEffectif($idHoraireEffectif)
    {
        $this->idHoraireEffectif = $idHoraireEffectif;
    }


}