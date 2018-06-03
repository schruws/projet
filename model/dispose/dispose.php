<?php

/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 27-02-17
 * Time: 17:46
 */
namespace model;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/dispose/dispose_sql.php";
require_once dirname(__DIR__) ."/dispose/dispose_T.php";

class dispose implements dao, dispose_interface
{

    private $disposeSql;
    private $dispose;


    public function __construct()
    {
        $this->disposeSql = new dispose_sql();
        $this->dispose = new dispose_T();
    }


    public function creer($object)
    {
        $this->dispose->table($object);
        $this->disposeSql->creer($this->dispose);

    }

    public function rechercherNom($Nom)
    {
        return  $this->disposeSql->rechercherNom($Nom);
    }
    public function rechercherId($id)
    {
        return  $this->disposeSql->rechercherId($id);
    }

    public function modifier($object)
    {
        $this->dispose->table($object);
        $this->disposeSql->modifier( $this->dispose);
    }

    public function suprimerNom($nom)
    {
        $this->disposeSql->suprimerNom($nom);
    }

    public function suprimerId($object)
    {
        $this->dispose->table($object);
        $this->disposeSql->suprimerId( $this->dispose);
    }

    public function afficherAll()
    {

        $this->dispose = $this->disposeSql->afficherAll();
        return $this->dispose;
    }

    public function rechercheIdPersonne($id)
    {
       return $this->disposeSql->rechercheIdPersonne($id);
    }
}