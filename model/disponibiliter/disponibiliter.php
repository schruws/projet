<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 29-01-17
 * Time: 23:00
 */
namespace model;


require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/disponibiliter/disponibiliter_sql.php";
require_once dirname(__DIR__) ."/disponibiliter/disponibiliter_T.php";



class disponibiliter implements dao
{
    private $disponibiliterSql;
    private $disponibiliterT;

    /**
     * disponibiliter constructor.
     *
     */
    public function __construct()
    {
        $this->disponibiliterSql = new disponibiliter_sql();
        $this->disponibiliterT = new disponibiliter_T();
    }

    public function creer($object)
    {
        $this->disponibiliterT->table($object);
        $this->disponibiliterT->setIdDisponibilitees($this->disponibiliterSql->creer($this->disponibiliterT));
        return $this->disponibiliterT;
    }

    public function rechercherNom($Nom)
    {
        // TODO: Implement rechercherNom() method.
    }

    public function rechercherId($id)
    {
        return $this->disponibiliterSql->rechercherId($id);
    }

    public function modifier($object)
    {
        $this->disponibiliterT->table($object);
        $this->disponibiliterT->setIdDisponibilitees($this->disponibiliterSql->modifier($this->disponibiliterT));
        return $this->disponibiliterT;
    }

    public function suprimerId($id)
    {
        // TODO: Implement suprimerId() method.
    }

    public function suprimerNom($id)
    {
        // TODO: Implement suprimerNom() method.
    }

    public function afficherAll()
    {
        // TODO: Implement afficherAll() method.
    }
}