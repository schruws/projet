<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 27-02-17
 * Time: 17:55
 */

namespace model;


require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/residentiel/residentiel_sql.php";
require_once dirname(__DIR__) ."/residentiel/residentiel_T.php";



class residentiel implements dao, residentiel_interface
{
    private $residentiel;
    private $residentielSql;
    /**
     * residentiel constructor.
     */
    public function __construct()
    {
        $this->residentiel = new residentiel_T();
        $this->residentielSql = new residentiel_sql();
    }

    public function creer($object)
    {
        $this->residentiel->table($object);
        $this->residentielSql->creer( $this->residentiel);
    }

    public function rechercherNom($Nom)
    {
        // TODO: Implement rechercherNom() method.
    }

    public function rechercherId($id)
    {
        return  $this->residentielSql->rechercherId($id);
    }

    public function modifier($object)
    {
        // TODO: Implement modifier() method.
    }

    public function suprimerId($id)
    {
        // TODO: Implement suprimerId() method.
    }

    public function suprimerNom($nom)
    {
        // TODO: Implement suprimerNom() method.
    }

    public function afficherAll()
    {
        // TODO: Implement afficherAll() method.
    }
}