<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 23-01-17
 * Time: 13:11
 */
namespace model;
require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/horaire_resto_effectif/horaire_resto_effect_sql.php";
require_once dirname(__DIR__) ."/horaire_resto_effectif/horaire_resto_effect_T.php";

class horaire_resto_effect implements dao, horaire_resto_effect_interface
{
    private $horaireEffectif;
    private $horaireEffectifSql;

    public function __construct()
    {
        $this->horaireEffectifSql = new horaire_resto_effect_sql();
        $this->horaireEffectif = new horaire_resto_effect_T();
    }


    public function creer($object)
    {

        $this->horaireEffectif->table($object);
        $this->horaireEffectifSql->creer($this->horaireEffectif);
        return $this->horaireEffectif;
    }

    public function rechercherNom($Nom)
    {
        return  $this->horaireEffectifSql->rechercherNom($Nom);
    }
    public function rechercherId($id)
    {
        return  $this->horaireEffectifSql->rechercherId($id);
    }

    public function modifier($object)
    {
        $this->horaireEffectif->table($object);
        $this->horaireEffectifSql->modifier($this->horaireEffectif);
    }

    public function suprimerNom($id)
    {
        $this->horaireEffectifSql->suprimerNom($id);
    }

    public function suprimerId($id)
    {
        $this->horaireEffectifSql->suprimerId($id);
    }

    public function afficherAll()
    {

        $this->horaireEffectif = $this->horaireEffectifSql->afficherAll();
        return $this->horaireEffectif;
    }

    public function rechercheIdRestaurant($id)
    {

        return  $this->horaireEffectifSql->rechercheIdRestaurant($id);
    }
    public function nombrePersonneDisponiblePost($idRestaurant ,$jour , $competence)
    {
        return $this->horaireEffectifSql->nombrePersonneDisponiblePost($idRestaurant, $jour, $competence);
    }

    public function recupereLesPersonneDisponible($idRestaurant, $jour, $competence)
    {
        return $this->horaireEffectifSql->recupereLesPersonneDisponible($idRestaurant, $jour, $competence);
    }


    public function besoinRestaurant($idRestaurant, $jour, $competence)
    {
        return $this->horaireEffectifSql->besoinRestaurant($idRestaurant, $jour, $competence);
    }
}