<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 25-12-16
 * Time: 18:38
 */

namespace model;

use \PDO;


class db
{
    private $db_name;
    private $db_user;
    private $db_pass;
    private $db_host;
    private static $pdo;
    private $resultat;

     var $nom = "schruwsmytdjzazz";
     var $user = "schruwsmytdjzazz";
     var $ass =    "Finaletudie1";
     var $db =  "schruwsmytdjzazz.mysql.db";

     /**
      * conexion a la base de donnée
     **/
/*$db_name="schruwsmytdjzazz", $db_user = 'schruwsmytdjzazz', $db_pass = 'Finaletudie1', $db_host = 'schruwsmytdjzazz.mysql.db'*/

    public function __construct($db_name="v12", $db_user = 'root', $db_pass = '', $db_host = 'localhost'){
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
    }

    /**
     * méthode: singleton
     * définition : génère un lien sur la base de donnée si pdo est null.
     * @return PDO
     */
    private  function getPDO(){
        if (is_null(self::$pdo)){

            $pdo = new PDO("mysql:host=".$this->db_host.";dbname=".$this->db_name.";charset=utf8",$this->db_user,$this->db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$pdo = $pdo;
        }
        return self::$pdo;
    }

    public function connexion() {

        return $this->getPDO();
    }
    public function deconnexion() {

        self::$pdo = null;
    }
    public function getquery($donne)
    {
        $connexion = $this->getPDO();
        $this->resultat =  $connexion->query($donne);
        return $this->resultat;

    }
    public function exec($donne)
    {
        return $this->getPDO()->exec($donne) ? true : false;
    }
    /**
     * @param mixed $sqlPrepare
     */
    public function setSqlPrepare($sqlPrepare)
    {
        return $this->getPDO()->prepare($sqlPrepare);
    }
    public function dernier()
    {
        return $this->getPDO()->lastInsertId();
    }

}
