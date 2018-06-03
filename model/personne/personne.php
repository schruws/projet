<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 09-01-17
 * Time: 21:44
 */
namespace model;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/personne/personne_sql.php";
require_once dirname(__DIR__) ."/personne/personne_T.php";




class personne implements dao, personne_interface
{
    private $personnelSql;
    private $personne;



    /**
     * personne constructor.
     */
    public function __construct()
    {
        $this->personnelSql = new personne_sql();
        $this->personne = new personne_T();
    }


    public function creer($object)
    {
        $object["rappelPassword"] = $this->password();
        $this->personne->table($object);
        $this->personne->setIdPersonne( $this->personnelSql->creer($this->personne));
        return $this->personne;
    }

    public function PersonnelDuRestaurant($idRestaurant)
    {
        return $this->personnelSql->PersonnelDuRestaurant($idRestaurant);
    }

    public function contratPersonnes($idPersonne, $idRestaurant)
    {
        return $this->personnelSql->contratPersonnes($idPersonne, $idRestaurant);
    }

    public function rechercherNom($Nom)
    {
      return  $this->personnelSql->rechercherNom($Nom);
    }
    public function rechercherId($id)
    {
        return  $this->personnelSql->rechercherId($id);
    }

    public function modifier($object)
    {

        $this->personne->table($object);
        $this->personne->setRappelPassword($this->password());
        $this->personne->setIdPersonne($this->personnelSql->modifier($this->personne));
        return $this->personne;
    }

    public function suprimerNom($id)
    {
        $this->personnelSql->suprimerNom($id);
    }

    public function suprimerId($id)
    {
        $this->personnelSql->suprimerId($id);
    }

    public function afficherAll()
    {

        $this->personne = $this->personnelSql->afficherAll();
        return $this->personne;
    }

    public function afficherResponsabe()
    {
        $this->personne = $this->personnelSql->afficherResponsabe();
        return $this->personne;
    }

    public function login($nom, $password)
    {
        $this->personne =  $this->personnelSql->login($nom, $password);
        return $this->personne;
    }

    public function RechercheEmail($email, $valeur)
    {
        $this->personne =  $this->personnelSql->RechercheEmail($email, $valeur);
        return $this->personne;
    }
    private function password(){ // générateur rappel_password
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, 30)), 0, 30);
    }

    Public function nombrePersonnelDuRestaurant($idRestaurant)
    {
        return $this->personnelSql->nombrePersonnelDuRestaurant($idRestaurant);
    }
    public function reset($objet)
    {
        $object["rappelPassword"] = $this->password();
        $this->personne->table($object);
        $this->modifier($object);
    }

}