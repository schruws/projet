<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 27-12-16
 * Time: 18:52
 */
namespace model;


class personne_T
{
    private $idPersonne = null;

    private $nomPers = null;

    private $prenom= null;

    private $dateNaissance = null;

    private $gsm = null;

    private $telephone = null;

    private $sexe = null;

    private $permisDeConduire = null;

    private $permisDeTravail = null;

    private $etatCivil = null;

    private $email = null;

    private $compteBancaire = null;

    private $password;

    private $rappelPassword;

    private $responsable = 0;

    private $dateEncodage;

    private $dateDerniereModif;

    private $dateSupr;

    private $idLieu;

    private $idDisponibilitees;

    private $idNationalite;

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
    public function getNomPers()
    {
        return $this->nomPers;
    }

    /**
     * @param mixed $nomPers
     */
    public function setNomPers($nomPers)
    {
        $this->nomPers = $nomPers;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @param mixed $dateNaissance
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
    }

    /**
     * @return mixed
     */
    public function getGsm()
    {
        return $this->gsm;
    }

    /**
     * @param mixed $gsm
     */
    public function setGsm($gsm)
    {
        $this->gsm = $gsm;
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
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param mixed $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    /**
     * @return mixed
     */
    public function getPermisDeConduire()
    {
        return $this->permisDeConduire;
    }

    /**
     * @param mixed $permisDeConduire
     */
    public function setPermisDeConduire($permisDeConduire)
    {
        $this->permisDeConduire = $permisDeConduire;
    }

    /**
     * @return mixed
     */
    public function getPermisDeTravail()
    {
        return $this->permisDeTravail;
    }

    /**
     * @param mixed $permisDeTravail
     */
    public function setPermisDeTravail($permisDeTravail)
    {
        $this->permisDeTravail = $permisDeTravail;
    }

    /**
     * @return mixed
     */
    public function getEtatCivil()
    {
        return $this->etatCivil;
    }

    /**
     * @param mixed $etatCivil
     */
    public function setEtatCivil($etatCivil)
    {
        $this->etatCivil = $etatCivil;
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
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getRappelPassword()
    {
        return $this->rappelPassword;
    }

    /**
     * @param mixed $rappelPassword
     */
    public function setRappelPassword($rappelPassword)
    {
        $this->rappelPassword = $rappelPassword;
    }

    /**
     * @return mixed
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * @param mixed $responsable
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;
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
    public function getIdNationalite()
    {
        return $this->idNationalite;
    }

    /**
     * @param mixed $idNationalite
     */
    public function setIdNationalite($idNationalite)
    {
        $this->idNationalite = $idNationalite;
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


}