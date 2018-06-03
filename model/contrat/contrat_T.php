<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 22-01-17
 * Time: 14:17
 */

namespace model;

class contrat_T
{
    private $idContrat;

    private $remunerationBrut = 0;

    private $dateDebutContrat;

    private $dateFinContrat;

    private $typecontrat;

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
    public function getRemunerationBrut()
    {
        return $this->remunerationBrut;
    }

    /**
     * @param mixed $remunerationBrut
     */
    public function setRemunerationBrut($remunerationBrut)
    {
        if($remunerationBrut !== "") {
            $this->remunerationBrut = $remunerationBrut;
        }
    }

    /**
     * @return mixed
     */
    public function getDateDebutContrat()
    {
        return $this->dateDebutContrat;
    }

    /**
     * @param mixed $dateDebutContrat
     */
    public function setDateDebutContrat($dateDebutContrat)
    {
        $this->dateDebutContrat = $dateDebutContrat;
    }

    /**
     * @return mixed
     */
    public function getDateFinContrat()
    {
        return $this->dateFinContrat;
    }

    /**
     * @param mixed $dateFinContrat
     */
    public function setDateFinContrat($dateFinContrat)
    {
        $this->dateFinContrat = $dateFinContrat;
    }

    /**
     * @return mixed
     */
    public function getTypecontrat()
    {
        return $this->typecontrat;
    }

    /**
     * @param mixed $typecontrat
     */
    public function setTypecontrat($typecontrat)
    {
        $this->typecontrat = $typecontrat;
    }
}