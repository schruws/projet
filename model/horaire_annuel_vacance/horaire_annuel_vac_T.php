<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 23-01-17
 * Time: 13:08
 */
namespace model;
class horaire_annuel_vac_T
{

    private $idHoraireVacance;

    private $debut;

    private $fin;

    private $moment;

    private $ouvertFerme;

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
    public function getIdHoraireVacance()
    {
        return $this->idHoraireVacance;
    }

    /**
     * @param mixed $idHoraireVacance
     */
    public function setIdHoraireVacance($idHoraireVacance)
    {
        $this->idHoraireVacance = $idHoraireVacance;
    }

    /**
     * @return mixed
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * @param mixed $debut
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;
    }

    /**
     * @return mixed
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * @param mixed $fin
     */
    public function setFin($fin)
    {
        $this->fin = $fin;
    }

    /**
     * @return mixed
     */
    public function getMoment()
    {
        return $this->moment;
    }

    /**
     * @param mixed $moment
     */
    public function setMoment($moment)
    {
        $this->moment = $moment;
    }

    /**
     * @return mixed
     */
    public function getOuvertFerme()
    {
        return $this->ouvertFerme;
    }

    /**
     * @param mixed $ouvertFerme
     */
    public function setOuvertFerme($ouvertFerme)
    {
        $this->ouvertFerme = $ouvertFerme;
    }

}