<?php

/**
 * Created by PhpStorm.
 * User: michael
 * Date: 18-01-17
 * Time: 16:14
 */

namespace model;

use controlleur\erreur;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/restaurant/restaurant_T.php";
require_once dirname(__DIR__)."/restaurant/restaurant_interface.php";
require_once dirname(__DIR__)."/../controlleur/erreur.php";

class restaurant_sql implements dao, restaurant_interface
{
    private $erreur;

    public function __construct()
    {
        $this->erreur = erreur::getInstance();
    }

    public function creer($object)
    {
        try {
            $sql = 'INSERT INTO Restaurant (nomRestau, telephone, fax, email, site, adresseFacebook,
                numeroTVA, compteBancaire, numRegistCommerce, parking, terasse, nombreCouvert,
                 dinersClub, menuEnfant, paimentVisa, paiementMasterCard, paiementBancontact, paiementAmericanExpress,
                paiementSodexo, wiFi,  dateEncodage, idLieu)
                VALUES (:nomRestau, :telephone, :fax, :email, :site, :adresseFacebook, :numeroTVA, :compteBancaire, :numRegistCommerce,
                 :parking, :terasse, :nombreCouvert, :dinersClub, :menuEnfant, :paiementVisa, :paiementMasterCard, :paiementBancontact, :paiementAmericanExpress, :paiementSodexo, :wiFi,  :dateEncodage, :idLieu)';
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':nomRestau', $object->getNomRestau());
            $prepare->bindValue(':telephone', $object->getTelephone());
            $prepare->bindValue(':fax', $object->getFax());
            $prepare->bindValue(':email', $object->getEmail());
            $prepare->bindValue(':site', $object->getSite());
            $prepare->bindValue(':adresseFacebook', $object->getAdresseFacebook());
            $prepare->bindValue(':numeroTVA', $object->getNumeroTVA());
            $prepare->bindValue(':compteBancaire', $object->getCompteBancaire());
            $prepare->bindValue(':numRegistCommerce', $object->getNumRegistCommerce());
            $prepare->bindValue(':parking', $object->getParking());
            $prepare->bindValue(':terasse', $object->getTerasse());
            $prepare->bindValue(':nombreCouvert', $object->getNombreCouvert());
            $prepare->bindValue(':dinersClub', $object->getDinersClub());
            $prepare->bindValue(':menuEnfant', $object->getMenuEnfant());
            $prepare->bindValue(':paiementVisa', $object->getPaimentVisa());
            $prepare->bindValue(':paiementMasterCard', $object->getPaiementMasterCard());
            $prepare->bindValue(':paiementBancontact', $object->getPaiementBancontact());
            $prepare->bindValue(':paiementAmericanExpress', $object->getPaiementAmericanExpress());
            $prepare->bindValue(':paiementSodexo', $object->getPaiementSodexo());
            $prepare->bindValue(':wiFi', $object->getWiFi());
            $prepare->bindValue(':dateEncodage', $object->getdateEncodage());
            $prepare->bindValue(':idLieu', $object->getIdLieu());
            $prepare->execute();
            return $db->dernier();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/restaurant_sql/creer");
        }
    }

    public function rechercherNom($Nom)
    {
        $restaurant = new restaurant_T();
        try {
            $sql = "SELECT * FROM Restaurant WHERE (nomRestau = :nom)";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':nom', $nom);
            $prepare->execute();
            while ($row = $prepare->fetch()) {

                $restaurant->table($row);

            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/restaurant_sql/rechercherNom");
        }
        return $restaurant;
    }

    public function rechercherId($id)
    {
        $restaurant = new restaurant_T();
        try {
            $sql = "SELECT * FROM `Restaurant` WHERE `idRestaurant`= :idRestaurant";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':idRestaurant', $id);
            $prepare->execute();
            while ($row = $prepare->fetch()) {

                $restaurant->table($row);

            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/restaurant_sql/rechercheId");
        }
        return $restaurant;
    }



    public function modifier($object)
    {
        try {
            $sql = 'UPDATE Restaurant SET nomRestau = :nomRestau,
        telephone = :telephone, fax = :fax, email = :email,
        site = :site, adresseFacebook = :adresseFacebook,
         numeroTVA = :numeroTVA, compteBancaire = :compteBancaire,
        numRegistCommerce = :numRegistCommerce, 
         parking = :parking, terasse = :terasse, nombreCouvert = :nombreCouvert,
         dinersClub = :dinersClub, menuEnfant = :menuEnfant, paimentVisa = :paimentVisa,
          paiementMasterCard = :paiementMasterCard,paiementBancontact = :paiementBancontact,
            paiementAmericanExpress = :paiementAmericanExpress, paiementSodexo = :paiementSodexo,
          wiFi = :wiFi, dateEncodage = :dateEncodage,
           dateDerniereModif = :dateDerniereModif, dateSupr = :dateSupr, idLieu = :idLieu, `idHoraireVacance` =:idHoraireVacance
     WHERE idRestaurant = :id';
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':nomRestau', $object->getNomRestau());
            $prepare->bindValue(':telephone', $object->getTelephone());
            $prepare->bindValue(':fax', $object->getFax());
            $prepare->bindValue(':email', $object->getEmail());
            $prepare->bindValue(':site', $object->getSite());
            $prepare->bindValue(':adresseFacebook', $object->getAdresseFacebook());
            $prepare->bindValue(':numeroTVA', $object->getNumeroTVA());
            $prepare->bindValue(':compteBancaire', $object->getCompteBancaire());
            $prepare->bindValue(':numRegistCommerce', $object->getNumRegistCommerce());
            $prepare->bindValue(':parking', $object->getParking());
            $prepare->bindValue(':terasse', $object->getTerasse());
            $prepare->bindValue(':nombreCouvert', $object->getNombreCouvert());
            $prepare->bindValue(':dinersClub', $object->getDinersClub());
            $prepare->bindValue(':menuEnfant', $object->getMenuEnfant());
            $prepare->bindValue(':paimentVisa', $object->getPaimentVisa());
            $prepare->bindValue(':paiementMasterCard', $object->getPaiementMasterCard());
            $prepare->bindValue(':paiementBancontact', $object->getPaiementBancontact());
            $prepare->bindValue(':paiementAmericanExpress', $object->getPaiementAmericanExpress());
            $prepare->bindValue(':paiementSodexo', $object->getPaiementSodexo());
            $prepare->bindValue(':wiFi', $object->getWiFi());
            $prepare->bindValue(':dateEncodage', $object->getDateEncodage());
            $prepare->bindValue(':dateDerniereModif', $object->getDateDerniereModif());
            $prepare->bindValue(':dateSupr', $object->getDateSupr());
            $prepare->bindValue(':idLieu', $object->getIdLieu());
            $prepare->bindValue(':id', $object->getIdRestaurant());
            $prepare->bindValue(':idHoraireVacance', $object->getIdHoraireVacance());
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/restaurant_sql/modifier");
        }
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
        $tableau = array();
        try {
            $sql = 'SELECT * FROM Restaurant';
            $db = new db();

            foreach ($db->getquery($sql) as $row) {
                $retaurant = new retaurant_T();
                $retaurant->table($row);
                $tableau[] = $retaurant;
            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/restaurant_sql/afficherAll");
        }
        return $tableau;
    }
}