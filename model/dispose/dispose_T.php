<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 27-02-17
 * Time: 17:47
 */

namespace model;


class dispose_T
{
    private $idCompetence;

    private $idPersonne;

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


}