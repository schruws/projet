<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 18-01-17
 * Time: 16:14
 */

namespace model;

class restaurant_T
{
    private $idRestaurant;

    private $nomRestau;

    private $rue;

    private $numero;

    private $localite;

    private $codePostal;

    private $telephone;

    private $fax;

    private $email;

    private $site;

    private $adresseFacebook;

    private $numeroTVA;

    private $compteBancaire;

    private $numRegistCommerce;

    private $typeDeCuisine;

    private $parking = 0;

    private $terasse = 0;

    private $nombreCouvert = 0;

    private $dinersClub = 0;

    private $menuEnfant = 0;

    private $paimentVisa = 0;

    private $paiementMasterCard = 0;

    private $paiementBancontact = 0;

    private $paiementAmericanExpress = 0;

    private $paiementSodexo = 0;

    private $wiFi = 0;

    private $dateDeFondation;

    private $dateEncodage;

    private $dateDerniereModif;

    private $dateSupr;

    private $idLieu;

    private $idHoraireVacance;

    function table($Tableau)
    {
        foreach ($Tableau as $Key => $Value)
        {
            $methode='set'.ucfirst($Key); //CHANGE LA PREMIERE LETTRE EN MAJUSCULE
            if (method_exists($this,$methode))
            {
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
    public function getNomRestau()
    {
        return $this->nomRestau;
    }

    /**
     * @param mixed $nomRestau
     */
    public function setNomRestau($nomRestau)
    {
        $this->nomRestau = $nomRestau;
    }

    /**
     * @return mixed
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * @param mixed $rue
     */
    public function setRue($rue)
    {
        $this->rue = $rue;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return mixed
     */
    public function getLocalite()
    {
        return $this->localite;
    }

    /**
     * @param mixed $localite
     */
    public function setLocalite($localite)
    {
        $this->localite = $localite;
    }

    /**
     * @return mixed
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * @param mixed $codePostal
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @param mixed $fax
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param mixed $site
     */
    public function setSite($site)
    {
        $this->site = $site;
    }

    /**
     * @return mixed
     */
    public function getAdresseFacebook()
    {
        return $this->adresseFacebook;
    }

    /**
     * @param mixed $adresseFacebook
     */
    public function setAdresseFacebook($adresseFacebook)
    {
        $this->adresseFacebook = $adresseFacebook;
    }

    /**
     * @return mixed
     */
    public function getNumeroTVA()
    {
        return $this->numeroTVA;
    }

    /**
     * @param mixed $numeroTVA
     */
    public function setNumeroTVA($numeroTVA)
    {
        $this->numeroTVA = $numeroTVA;
    }

    /**
     * @return mixed
     */
    public function getCompteBancaire()
    {
        return $this->compteBancaire;
    }

    /**
     * @param mixed $compteBancaire
     */
    public function setCompteBancaire($compteBancaire)
    {
        $this->compteBancaire = $compteBancaire;
    }

    /**
     * @return mixed
     */
    public function getNumRegistCommerce()
    {
        return $this->numRegistCommerce;
    }

    /**
     * @param mixed $numRegistCommerce
     */
    public function setNumRegistCommerce($numRegistCommerce)
    {
        $this->numRegistCommerce = $numRegistCommerce;
    }

    /**
     * @return mixed
     */
    public function getTypeDeCuisine()
    {
        return $this->typeDeCuisine;
    }

    /**
     * @param mixed $typeDeCuisine
     */
    public function setTypeDeCuisine($typeDeCuisine)
    {
        $this->typeDeCuisine = $typeDeCuisine;
    }

    /**
     * @return mixed
     */
    public function getParking()
    {
        return $this->parking;
    }

    /**
     * @param mixed $parking
     */
    public function setParking($parking)
    {
        $this->parking = $parking;
    }

    /**
     * @return mixed
     */
    public function getTerasse()
    {
        return $this->terasse;
    }

    /**
     * @param mixed $terasse
     */
    public function setTerasse($terasse)
    {
        $this->terasse = $terasse;
    }

    /**
     * @return mixed
     */
    public function getNombreCouvert()
    {
        return $this->nombreCouvert;
    }

    /**
     * @param mixed $nombreCouvert
     */
    public function setNombreCouvert($nombreCouvert)
    {
        $this->nombreCouvert = $nombreCouvert;
    }

    /**
     * @return mixed
     */
    public function getDinersClub()
    {
        return $this->dinersClub;
    }

    /**
     * @param mixed $dinersClub
     */
    public function setDinersClub($dinersClub)
    {
        if($dinersClub === "on")
        {
            $dinersClub = 1;
        }
        $this->dinersClub = $dinersClub;
    }

    /**
     * @return mixed
     */
    public function getMenuEnfant()
    {
        return $this->menuEnfant;
    }

    /**
     * @param mixed $menuEnfant
     */
    public function setMenuEnfant($menuEnfant)
    {
        if($menuEnfant === "on")
        {
            $menuEnfant = 1;
        }
        $this->menuEnfant = $menuEnfant;
    }

    /**
     * @return mixed
     */
    public function getPaimentVisa()
    {
        return $this->paimentVisa;
    }

    /**
     * @param mixed $paimentVisa
     */
    public function setPaimentVisa($paimentVisa)
    {
        if($paimentVisa === "on")
        {
            $paimentVisa = 1;
        }
        $this->paimentVisa = $paimentVisa;
    }

    /**
     * @return mixed
     */
    public function getPaiementMasterCard()
    {
        return $this->paiementMasterCard;
    }

    /**
     * @param mixed $paiementMasterCard
     */
    public function setPaiementMasterCard($paiementMasterCard)
    {
        if($paiementMasterCard === "on")
        {
            $paiementMasterCard = 1;
        }
        $this->paiementMasterCard = $paiementMasterCard;
    }

    /**
     * @return mixed
     */
    public function getPaiementBancontact()
    {
        return $this->paiementBancontact;
    }

    /**
     * @param mixed $paiementBancontact
     */
    public function setPaiementBancontact($paiementBancontact)
    {
        if($paiementBancontact === "on")
        {
            $paiementBancontact = 1;
        }
        $this->paiementBancontact = $paiementBancontact;
    }

    /**
     * @return mixed
     */
    public function getPaiementAmericanExpress()
    {
        return $this->paiementAmericanExpress;
    }

    /**
     * @param mixed $paiementAmericanExpress
     */
    public function setPaiementAmericanExpress($paiementAmericanExpress)
    {
        if($paiementAmericanExpress === "on")
        {
            $paiementAmericanExpress = 1;
        }
        $this->paiementAmericanExpress = $paiementAmericanExpress;
    }

    /**
     * @return mixed
     */
    public function getPaiementSodexo()
    {
        return $this->paiementSodexo;
    }

    /**
     * @param mixed $paiementSodexo
     */
    public function setPaiementSodexo($paiementSodexo)
    {
        if($paiementSodexo === "on")
        {
            $paiementSodexo = 1;
        }
        $this->paiementSodexo = $paiementSodexo;
    }

    /**
     * @return mixed
     */
    public function getWiFi()
    {
        return $this->wiFi;
    }

    /**
     * @param mixed $wiFi
     */
    public function setWiFi($wiFi)
    {
        if($wiFi === "on")
        {
            $wiFi = 1;
        }
        $this->wiFi = $wiFi;
    }

    /**
     * @return mixed
     */
    public function getDateDeFondation()
    {
        return $this->dateDeFondation;
    }

    /**
     * @param mixed $dateDeFondation
     */
    public function setDateDeFondation($dateDeFondation)
    {
        $this->dateDeFondation = $dateDeFondation;
    }

    /**
     * @return mixed
     */
    public function getDateEncodage()
    {
        return $this->dateEncodage;
    }

    /**
     * @param mixed $dateEncodage
     */
    public function setDateEncodage($dateEncodage)
    {
        $this->dateEncodage = $dateEncodage;
    }

    /**
     * @return mixed
     */
    public function getDateDerniereModif()
    {
        return $this->dateDerniereModif;
    }

    /**
     * @param mixed $dateDerniereModif
     */
    public function setDateDerniereModif($dateDerniereModif)
    {
        $this->dateDerniereModif = $dateDerniereModif;
    }

    /**
     * @return mixed
     */
    public function getDateSupr()
    {
        return $this->dateSupr;
    }

    /**
     * @param mixed $dateSupr
     */
    public function setDateSupr($dateSupr)
    {
        $this->dateSupr = $dateSupr;
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

}