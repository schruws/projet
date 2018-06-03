<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 22-01-17
 * Time: 14:18
 */
namespace model;

class conger_T
{
    private $idConger;

    private $dateDebut;

    private $dateFin;

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
    public function getIdConger()
    {
        return $this->idConger;
    }

    /**
     * @param mixed $idConger
     */
    public function setIdConger($idConger)
    {
        $this->idConger = $idConger;
    }
    /**
     * @return mixed
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param mixed $dateDebut
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return mixed
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param mixed $dateFin
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }


}