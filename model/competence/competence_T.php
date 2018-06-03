<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 23-01-17
 * Time: 12:56
 */
namespace model;
class competence_T
{
    private $idCompetence;

    private $nomComp;

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
    public function getNomComp()
    {
        return $this->nomComp;
    }

    /**
     * @param mixed $nomComp
     */
    public function setNomComp($nomComp)
    {
        $this->nomComp = $nomComp;
    }



}