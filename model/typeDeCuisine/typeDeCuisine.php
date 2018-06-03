<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 28-03-17
 * Time: 11:41
 */

namespace model;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/typeDeCuisine/typeDeCuisine_sql.php";
require_once dirname(__DIR__) ."/typeDeCuisine/typeDeCuisine_T.php";


class typeDeCuisine implements dao, typeDeCuisine_interface
{

    private $CuisinelSql;
    private $Cuisine;



    /**
     * Cuisine constructor.
     */
    public function __construct()
    {
        $this->CuisinelSql = new typeDeCuisine_sql();
        $this->Cuisine = new typeDeCuisine_T();
    }


    public function creer($object)
    {
        $this->Cuisine->table($object);
        $this->Cuisine->setIdCuisinne( $this->CuisinelSql->creer($this->Cuisine));
        return $this->Cuisine;
    }
    public function rechercherNom($Nom)
    {
        return  $this->CuisinelSql->rechercherNom($Nom);
    }
    public function rechercherId($id)
    {
        return  $this->CuisinelSql->rechercherId($id);
    }

    public function modifier($object)
    {
        $this->Cuisine->table($object);
        $this->Cuisine->setIdCuisine($this->CuisinelSql->modifier($this->Cuisine));
        return $this->Cuisine;
    }

    public function suprimerNom($id)
    {
        $this->CuisinelSql->suprimerNom($id);
    }

    public function suprimerId($id)
    {
        $this->CuisinelSql->suprimerId($id);
    }

    public function afficherAll()
    {

        $this->Cuisine = $this->CuisinelSql->afficherAll();
        return $this->Cuisine;
    }
}