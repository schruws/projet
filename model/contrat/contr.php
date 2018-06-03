<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 22-01-17
 * Time: 14:16
 */
namespace model;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/contrat/contrat_sql.php";
require_once dirname(__DIR__) ."/contrat/contrat_T.php";

class contr implements dao, contrat_interface
{
    private $contrat;
    private $contratlSql;

    public function __construct()
    {
        $this->contratlSql = new contrat_sql();
        $this->contrat = new contrat_T();
    }


    public function creer($object)
    {

        $this->contrat->table($object);
        $this->contrat->setIdcontrat( $this->contratlSql->creer($this->contrat));
        return $this->contrat;
    }

    public function rechercherNom($Nom)
    {
        return  $this->contratlSql->rechercherNom($Nom);
    }
    public function rechercherId($id)
    {
        return  $this->contratlSql->rechercherId($id);
    }

    public function modifier($object)
    {
        $this->contrat->table($object);
        $this->contratlSql->modifier($this->contrat);
    }

    public function suprimerNom($id)
    {
        $this->contratlSql->suprimerNom($id);
    }

    public function suprimerId($id)
    {
        $this->contratlSql->suprimerId($id);
    }

    public function afficherAll()
    {

        $this->contrat = $this->contratlSql->afficherAll();
        return $this->contrat;
    }

    public function contractPersonne($idPersonne)
    {
        return $this->contratlSql->contractPersonne($idPersonne);
    }

    public function tousLesContratPersonne($idPersonne)
    {
        return $this->contratlSql->tousLesContratPersonne($idPersonne);
    }
}