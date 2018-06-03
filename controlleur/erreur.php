<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 14-04-17
 * Time: 20:05
 */

namespace controlleur;


class erreur
{
    private  $chemin;
    static $instance;

    static function getInstance(){
        if(!self::$instance){
            self::$instance = new erreur();
        }
        return self::$instance;
    }

    private function ouverture()
    {
        $this->chemin = fopen(dirname(__DIR__)."/erreur/erreur.txt", "a+");
    }
    private function fermeture()
    {
        fclose( $this->chemin);
    }

    public function ecriture($message, $utilisateur, $ou)
    {
        $this->ouverture();
        # Ajout de la date et de l'heure au début de la ligne
        $message = date('d/m/Y H:i:s').' erreur : '.$message.' utilisateur : '.$utilisateur.' ou : '.$ou;

        # Ajout du retour chariot de fin de ligne si il n'y en a pas
        if( !preg_match('#\n$#',$message) ){
            $message .= "\n";
        }
        fputs($this->chemin, $message);

        $this->fermeture();
    }



}