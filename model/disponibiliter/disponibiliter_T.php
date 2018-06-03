<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 22-01-17
 * Time: 14:20
 */
namespace model;

class disponibiliter_T
{
    private $idDisponibilitees;

    private $lundiMidi;

    private $lundiSoir;

    private $mardiMidi;

    private $mardiSoir;

    private $mercrediMidi;

    private $mercrediSoir;

    private $jeudiMidi;

    private $jeudiSoir;

    private $vendrediMidi;

    private $vendrediSoir;

    private $samediMidi;

    private $samediSoir;

    private $dimancheMidi;

    private $dimancheSoir;

    function table($Tableau)
    {
        foreach ($Tableau as $Key => $Value)
        {
            $methode='set'.ucfirst($Key); //CHANGE LA PREMIERE LETTRE EN MAJUSCULE
            if (method_exists($this,$methode))
            {
                if($Value == "on")
                {
                    $Value = 1;
                }
                $this->$methode($Value); //EXECUTE LA METHODE 'Set$Key($Value)'
            }
        }
    }

    /**
     * @return mixed
     */
    public function getIdDisponibilitees()
    {
        return $this->idDisponibilitees;
    }

    /**
     * @param mixed $idDisponibilitees
     */
    public function setIdDisponibilitees($idDisponibilitees)
    {
        $this->idDisponibilitees = $idDisponibilitees;
    }

    /**
     * @return mixed
     */
    public function getLundiMidi()
    {
        return $this->lundiMidi;
    }

    /**
     * @param mixed $lundiMidi
     */
    public function setLundiMidi($lundiMidi)
    {
        $this->lundiMidi = $lundiMidi;
    }

    /**
     * @return mixed
     */
    public function getLundiSoir()
    {
        return $this->lundiSoir;
    }

    /**
     * @param mixed $lundiSoir
     */
    public function setLundiSoir($lundiSoir)
    {
        $this->lundiSoir = $lundiSoir;
    }

    /**
     * @return mixed
     */
    public function getMardiMidi()
    {
        return $this->mardiMidi;
    }

    /**
     * @param mixed $mardiMidi
     */
    public function setMardiMidi($mardiMidi)
    {
        $this->mardiMidi = $mardiMidi;
    }

    /**
     * @return mixed
     */
    public function getMardiSoir()
    {
        return $this->mardiSoir;
    }

    /**
     * @param mixed $mardiSoir
     */
    public function setMardiSoir($mardiSoir)
    {
        $this->mardiSoir = $mardiSoir;
    }

    /**
     * @return mixed
     */
    public function getMercrediMidi()
    {
        return $this->mercrediMidi;
    }

    /**
     * @param mixed $mercrediMidi
     */
    public function setMercrediMidi($mercrediMidi)
    {
        $this->mercrediMidi = $mercrediMidi;
    }

    /**
     * @return mixed
     */
    public function getMercrediSoir()
    {
        return $this->mercrediSoir;
    }

    /**
     * @param mixed $mercrediSoir
     */
    public function setMercrediSoir($mercrediSoir)
    {
        $this->mercrediSoir = $mercrediSoir;
    }

    /**
     * @return mixed
     */
    public function getJeudiMidi()
    {
        return $this->jeudiMidi;
    }

    /**
     * @param mixed $jeudiMidi
     */
    public function setJeudiMidi($jeudiMidi)
    {
        $this->jeudiMidi = $jeudiMidi;
    }

    /**
     * @return mixed
     */
    public function getJeudiSoir()
    {
        return $this->jeudiSoir;
    }

    /**
     * @param mixed $jeudiSoir
     */
    public function setJeudiSoir($jeudiSoir)
    {
        $this->jeudiSoir = $jeudiSoir;
    }

    /**
     * @return mixed
     */
    public function getVendrediMidi()
    {
        return $this->vendrediMidi;
    }

    /**
     * @param mixed $vendrediMidi
     */
    public function setVendrediMidi($vendrediMidi)
    {
        $this->vendrediMidi = $vendrediMidi;
    }

    /**
     * @return mixed
     */
    public function getVendrediSoir()
    {
        return $this->vendrediSoir;
    }

    /**
     * @param mixed $vendrediSoir
     */
    public function setVendrediSoir($vendrediSoir)
    {
        $this->vendrediSoir = $vendrediSoir;
    }

    /**
     * @return mixed
     */
    public function getSamediMidi()
    {
        return $this->samediMidi;
    }

    /**
     * @param mixed $samediMidi
     */
    public function setSamediMidi($samediMidi)
    {
        $this->samediMidi = $samediMidi;
    }

    /**
     * @return mixed
     */
    public function getSamediSoir()
    {
        return $this->samediSoir;
    }

    /**
     * @param mixed $samediSoir
     */
    public function setSamediSoir($samediSoir)
    {
        $this->samediSoir = $samediSoir;
    }

    /**
     * @return mixed
     */
    public function getDimancheMidi()
    {
        return $this->dimancheMidi;
    }

    /**
     * @param mixed $dimancheMidi
     */
    public function setDimancheMidi($dimancheMidi)
    {
        $this->dimancheMidi = $dimancheMidi;
    }

    /**
     * @return mixed
     */
    public function getDimancheSoir()
    {
        return $this->dimancheSoir;
    }

    /**
     * @param mixed $dimancheSoir
     */
    public function setDimancheSoir($dimancheSoir)
    {
        $this->dimancheSoir = $dimancheSoir;
    }


}