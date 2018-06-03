<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 23-01-17
 * Time: 13:07
 */
namespace model;
require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/horaire_annuel_vacance/horaire_annuel_vac_sql.php";
require_once dirname(__DIR__) ."/horaire_annuel_vacance/horaire_annuel_vac_T.php";

class horaire_annuel_vac implements dao, horaire_annuel_vac_interf
{
    private $horaireVacance;
    private $horaireVacanceSql;

    public function __construct()
    {
        $this->horaireVacanceSql = new horaire_annuel_vac_sql();
        $this->horaireVacance = new horaire_annuel_vac_T();
    }


    public function creer($object)
    {

        $this->horaireVacance->table($object);
        $this->horaireVacance->setIdHoraireVacance( $this->horaireVacanceSql->creer($this->horaireVacance));
        return $this->horaireVacance;
    }

    public function rechercherNom($Nom)
    {
        return  $this->horaireVacanceSql->rechercherNom($Nom);
    }
    public function rechercherId($id)
    {
        return  $this->horaireVacanceSql->rechercherId($id);
    }

    public function modifier($object)
    {
        $this->horaireVacance->table($object);
        $this->horaireVacanceSql->modifier($this->horaireVacance);
    }

    public function suprimerNom($id)
    {
        $this->horaireVacanceSql->suprimerNom($id);
    }

    public function suprimerId($id)
    {
        $this->horaireVacanceSql->suprimerId($id);
    }

    public function afficherAll()
    {

        $this->horaireVacance = $this->horaireVacanceSql->afficherAll();
        return $this->horaireVacance;
    }

    public function restaurantConger($id)
    {
        return $this->horaireVacanceSql->restaurantConger($id);
    }
}