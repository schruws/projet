<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 01-03-17
 * Time: 09:40
 */

namespace model;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/fonction/fonction_sql.php";
require_once dirname(__DIR__) ."/fonction/fonction_T.php";


class fonction implements dao, fonction_interface
{
    private $fonctionlSql;
    private $fonction;



    /**
     * fonction constructor.
     */
    public function __construct()
    {
        $this->fonctionlSql = new fonction_sql();
        $this->fonction = new fonction_T();
    }


    public function creer($object)
    {
        $this->fonction->table($object);
        $this->fonction->setIdfonction($this->fonctionlSql->creer($this->fonction));
        return $this->fonction;
    }

    public function rechercherNom($Nom)
    {
        return  $this->fonctionlSql->rechercherNom($Nom);
    }

    public function rechercherId($id)
    {
        return  $this->fonctionlSql->rechercherId($id);
    }

    public function modifier($object)
    {
        $this->fonction->table($object);
        return $this->fonctionlSql->modifier($this->fonction);
    }

    public function suprimerId($id)
    {
        $this->fonctionlSql->suprimerId($id);
    }

    public function suprimerNom($nom)
    {
        $this->fonctionlSql->suprimerNom($nom);
    }

    public function afficherAll()
    {
        return $this->fonctionlSql->afficherAll();
    }
}