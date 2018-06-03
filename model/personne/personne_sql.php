<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 25-12-16
 * Time: 18:51
 */
namespace model;


use controlleur\erreur;

require_once dirname(__DIR__)."/dao.php";
require_once dirname(__DIR__)."/db.php";
require_once dirname(__DIR__)."/personne/personne_interface.php";
require_once dirname(__DIR__) . "/personne/personne_T.php";
require_once dirname(__DIR__)."/../controlleur/erreur.php";


class personne_sql implements dao, personne_interface
{
    private $erreur;

    public function __construct()
    {
        $this->erreur = erreur::getInstance();
    }

    public function creer($object)
    {
        try {
            $sql = 'INSERT INTO Personne (nomPers, prenom, dateNaissance, gsm, telephone, sexe, permisDeConduire, permisDeTravail, etatCivil, email, compteBancaire, password, rappelPassword, responsable, dateEncodage, idLieu, idDisponibilitees, idNationalite)
        VALUES (:nom, :prenom, :dateNaissance, :gsm, :telephone, :sexe,  :permisConduire, :permisTravail, :etatCivil, :email, :compteBancaire, :password, :rappel_password, :responsable, :dateEncodage, :idLieu, :idDisponibilitees, :idNationalite)';
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':nom', $object->getNomPers());
            $prepare->bindValue(':prenom', $object->getPrenom());
            $prepare->bindValue(':dateNaissance', $object->getdateNaissance());
            $prepare->bindValue(':gsm', $object->getGsm());
            $prepare->bindValue(':telephone', $object->getTelephone());
            $prepare->bindValue(':sexe', $object->getSexe());
            $prepare->bindValue(':permisConduire', $object->getPermisDeConduire());
            $prepare->bindValue(':permisTravail', $object->getPermisDeTravail());
            $prepare->bindValue(':etatCivil', $object->getEtatCivil());
            $prepare->bindValue(':email', $object->getEmail());
            $prepare->bindValue(':compteBancaire', $object->getCompteBancaire());
            $prepare->bindValue(':password', $object->getPassword());
            $prepare->bindValue(':rappel_password', $object->getRappelPassword());
            $prepare->bindValue(':responsable', $object->getResponsable());
            $prepare->bindValue(':dateEncodage', $object->getDateEncodage());
            $prepare->bindValue(':idLieu', $object->getIdLieu());
            $prepare->bindValue(':idDisponibilitees', $object->getIdDisponibilitees());
            $prepare->bindValue(':idNationalite', $object->getIdNationalite());

            $prepare->execute();
            return $db->dernier();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/personne_sql/creer");
        }
    }



    public function rechercherNom($Nom)
    {
        $Personne = new Personne_T();
        try {
            $sql = "SELECT * FROM Personne WHERE (Nom_personne = :nom)";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':nom', $nom);
            $prepare->execute();
            while ($row = $prepare->fetch()) {

                $Personne->table($row);

            }
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/personne_sql/rechercherNom");
        }
        return $Personne;
    }
    public function rechercherId($id)
    {
        $Personne = new Personne_T();
        try {
            $sql = "SELECT * FROM Personne WHERE (idPersonne = :id)";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':id', $id);
            $prepare->execute();
            while ($row = $prepare->fetch()) {
                $Personne->table($row);
            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/personne_sql/rechercherId");
        }
        return $Personne;
    }

    public function modifier($object)
    {
        try {
            $sql = "UPDATE `Personne` SET `nomPers`= :nom,`prenom`= :prenom,`dateNaissance`= :dateNaissance,`gsm`= :gsm,`telephone`= :telephone,`sexe`= :sexe,
      `permisDeConduire`= :permisDeConduire,`permisDeTravail`= :permisDeTravail,`etatCivil`= :etatCivil,`email`= :email,`compteBancaire`= :compteBancaire,`password`= :password, `responsable`= :responsable,
      `dateEncodage`= :dateEncodage,`dateDerniereModif`= :dateDerniereModif,`dateSupr`= :dateSupr,`idDisponibilitees`= :idDisponibilitees,`idLieu`= :idLieu, `idNationalite`= :idNationalite,`rappelPassword` =  :rappel_password WHERE `idPersonne` = :id";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindValue(':nom', $object->getNomPers());
            $prepare->bindValue(':prenom', $object->getPrenom());
            $prepare->bindValue(':dateNaissance', $object->getdateNaissance());
            $prepare->bindValue(':gsm', $object->getGsm());
            $prepare->bindValue(':telephone', $object->getTelephone());
            $prepare->bindValue(':sexe', $object->getSexe());
            $prepare->bindValue(':permisDeConduire', $object->getPermisDeConduire());
            $prepare->bindValue(':permisDeTravail', $object->getPermisDeTravail());
            $prepare->bindValue(':etatCivil', $object->getEtatCivil());
            $prepare->bindValue(':email', $object->getEmail());
            $prepare->bindValue(':compteBancaire', $object->getCompteBancaire());
            $prepare->bindValue(':password', $object->getPassword());
            $prepare->bindValue(':responsable', $object->getResponsable());
            $prepare->bindValue(':dateEncodage', $object->getDateEncodage());
            $prepare->bindValue(':dateDerniereModif', $object->getDateDerniereModif());
            $prepare->bindValue('dateSupr', $object->getDateSupr());
            $prepare->bindValue(':idLieu', $object->getIdLieu());
            $prepare->bindValue(':idDisponibilitees', $object->getIdDisponibilitees());
            $prepare->bindValue(':id', $object->getIdPersonne());
            $prepare->bindValue(':idNationalite', $object->getIdNationalite());
            $prepare->bindValue(':rappel_password', $object->getRappelPassword());
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/personne_sql/modifier");
        }
        return $object;
    }

    public function suprimerNom($nom)
    {
        try {
            $sql = "DELETE FROM Personne WHERE nom = :nom";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':nom', $nom);
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/personne_sql/suprimerNom");
        }
    }

    public function suprimerId($id)
    {
        try {
            $sql = "DELETE FROM Personne WHERE id = :id";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':id', $id);
            $prepare->execute();
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/personne_sql/suprimeId");
        }
    }

    public function afficherAll()
    {
        $tableau = array();
        try {
            $sql = 'SELECT * FROM Personne';
            $db = new db();
            foreach ($db->getquery($sql) as $row) {
                $Personne = new Personne_T();
                $Personne->table($row);
                $tableau[] = $Personne;
            }
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/personne_sql/afficheAll");
        }
        return $tableau;
    }
    public function afficherResponsabe()
    {
        $tableau = array();
        try {
            $sql = 'SELECT * FROM `Personne` WHERE `responsable` = 1';
            $db = new db();
            foreach ($db->getquery($sql) as $row) {
                $Personne = new Personne_T();
                $Personne->table($row);
                $tableau[] = $Personne;
            }
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/personne_sql/afficherResponsable");
        }
        return $tableau;
    }

    public function login($nom, $password)
    {
        $Personne = new Personne_T();
        try {
            if (strlen($password) < 25) {
                $longeurPassword = strlen($password);
                $longeur = ($longeurPassword * 4)*($longeurPassword/3);
                $texte1 = $longeur;
                $texte2 = $longeur + $longeurPassword;
                $passwordProvisoire = sha1($texte1.$password.$texte2);
                $password = md5($passwordProvisoire);
            }
            $sql = "SELECT * FROM Personne WHERE (nomPers = :nom OR email  = :nom) AND (password = :password OR rappelPassword = :password)";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':nom', $nom);
            $prepare->bindParam(':password', $password);
            $prepare->execute();
            while ($row = $prepare->fetch()) {


                $Personne->table($row);

            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/personne_sql/Login");
        }
        return $Personne;
    }


    public function RechercheEmail($email, $valeur)
    {
        $Personne = new Personne_T();
        try {

            $sql = "SELECT * FROM `Personne` WHERE (`email` = :email)  AND (`responsable` = :valeur) ";
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':email', $email);
            $prepare->bindParam(':valeur', $valeur);
            $prepare->execute();
            while ($row = $prepare->fetch()) {


                $Personne->table($row);

            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/personne_sql/RechercherMail");
        }
        return $Personne;
    }

    public function PersonnelDuRestaurant($idRestaurant)
    {
        $tableau = array();
        try {
            $sql = 'SELECT * FROM `Personne` inner join etabli on Personne.idPersonne = etabli.idPersonne inner join Contrat on etabli.idContrat = Contrat.idContrat
        where etabli.idRestaurant = :idResto AND Contrat.dateFinContrat is not null ';
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':idResto', $idRestaurant);
            $prepare->execute();
            while ($row = $prepare->fetch()) {
                $Personne = new Personne_T();
                $Personne->table($row);
                $tableau[] = $Personne;
            }

        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/personne_sql/PersonnelDuRestaurant");
        }
        return $tableau;
    }

    public function contratPersonnes($idPersonne, $idrestaurant)
    {
        $tableau = array();
        try {
            $sql = 'SELECT  `remunerationBrut`, `dateDebutContrat`, `dateFinContrat`, `Typecontrat` , etabli.note, etabli.avis, Fonction.type
        from Fonction INNER JOIN attribue on  Fonction.idFonction = attribue.idFonction INNER join Contrat on  attribue.idContrat = Contrat.idContrat
         INNER join etabli on  etabli.idContrat = Contrat.idContrat where etabli.idPersonne = :idPersonne and etabli.idRestaurant = :idRestaurant order by Contrat.dateFinContrat desc ';
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':idPersonne', $idPersonne);
            $prepare->bindParam(':idRestaurant', $idrestaurant);
            $prepare->execute();
            while ($row = $prepare->fetch()) {
                $tableau[] = $row;
            }
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/personne_sql/contratPersonne");
        }
        return $tableau;
    }

    Public function nombrePersonnelDuRestaurant($idRestaurant)
    {
        $nombre = 0;
        try {
            $sql = 'SELECT COUNT(nomPers) as nombre FROM `Personne` inner join etabli on Personne.idPersonne = etabli.idPersonne inner join Contrat on etabli.idContrat = Contrat.idContrat
        where etabli.idRestaurant = :idResto and Personne.dateSupr is null and Contrat.dateFinContrat is not null ';
            $db = new db();
            $prepare = $db->setSqlPrepare($sql);
            $prepare->bindParam(':idResto', $idRestaurant);
            $prepare->execute();
            while ($row = $prepare->fetch()) {
                $nombre = $row['nombre'];
            }
        }
        catch (\Exception $e)
        {
            $this->erreur->ecriture($e,$_SESSION['user']->getNomPers()."".$_SESSION['user']->getPrenom()."", "model/personne_sql/nombrePersonnelDuRestaurant");
        }
        return $nombre;
    }

}