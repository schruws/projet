<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 28-03-17
 * Time: 11:33
 */

namespace model;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/nationalite/nationalite_sql.php";
require_once dirname(__DIR__) ."/nationalite/nationalite_T.php";


class nationalite implements dao, nationalite_interface
{
    private $nationalitelSql;
    private $nationalite;



    /**
     * nationalite constructor.
     */
    public function __construct()
    {
        $this->nationalitelSql = new nationalite_sql();
        $this->nationalite = new nationalite_T();
    }


    public function creer($object)
    {
        $this->nationalite->table($object);
        $this->nationalite->setIdnationalite( $this->nationalitelSql->creer($this->nationalite));
        return $this->nationalite;
    }
    public function rechercherNom($Nom)
    {
        return  $this->nationalitelSql->rechercherNom($Nom);
    }
    public function rechercherId($id)
    {
        return  $this->nationalitelSql->rechercherId($id);
    }

    public function modifier($object)
    {
        $this->nationalite->table($object);
        $this->nationalite->setIdnationalite($this->nationalitelSql->modifier($this->nationalite));
        return $this->nationalite;
    }

    public function suprimerNom($id)
    {
        $this->nationalitelSql->suprimerNom($id);
    }

    public function suprimerId($id)
    {
        $this->nationalitelSql->suprimerId($id);
    }

    public function afficherAll()
    {

        $this->nationalite = $this->nationalitelSql->afficherAll();
        return $this->nationalite;
    }
}