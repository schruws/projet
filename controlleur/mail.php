<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 15-01-17
 * Time: 18:17
 */

namespace controlleur;


class mail
{
    private static $header;


    public function emailReset($email, $nom ,$password)
    {

        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email)) // On filtre les serveurs qui présentent des bogues.
        {
            $passage_ligne = "\r\n";
        } else {
            $passage_ligne = "\n";
        }

        $message_txt = "Bonjour ".$nom.",\n\n afin de réinitialiser votre mot de passe, merci de vous diriger sur ce lien. \\n
        http://schruws-michael.be/index.php\n\n
        Mot de passe provisoire =\".$password.\"\";" ;
        $message_html = "<html><header></header><body>Bonjour ".$nom.",<br><br> afin de réinitialiser votre mot de passe, merci de vous diriger sur ce lien.<br>
        <a href='http://schruws-michael.be/index.php'>ici</a>
      <br><br>Mot de passe provisoire : ".$password."</body></html>";



        // Création de la boundary.
        $boundary = "-----=" . md5(rand());
        $boundary_alt = "-----=" . md5(rand());

// Définition du sujet.
        $sujet = "Reinitiatilisation de votre mot de passe";

// Création du header de l'e-mail.
        $header = "From: \"application\"<michael@schruws-michael.be>" . $passage_ligne;
        $header .= "Reply-to: \"Test\" <$email>" . $passage_ligne;
        $header .= "MIME-Version: 1.0" . $passage_ligne;
        $header .= "Content-Type: multipart/mixed;" . $passage_ligne . " boundary=\"$boundary\"" . $passage_ligne;

// Création du message.
        $message = $passage_ligne . "--" . $boundary . $passage_ligne;
        $message .= "Content-Type: multipart/alternative;" . $passage_ligne . " boundary=\"$boundary_alt\"" . $passage_ligne;
        $message .= $passage_ligne . "--" . $boundary_alt . $passage_ligne;

// Ajout du message au format texte.
        $message .= "Content-Type: text/plain; charset=\"UTF-8\"" . $passage_ligne;
        $message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
        $message .= $passage_ligne . $message_txt . $passage_ligne;
        $message .= $passage_ligne . "--" . $boundary_alt . $passage_ligne;


// Ajout du message au format HTML.
        $message .= "Content-Type: text/html; charset=\"UTF-8\"" . $passage_ligne;
        $message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
        $message .= $passage_ligne . $message_html . $passage_ligne;

// On ferme la boundary alternative.
        $message .= $passage_ligne . "--" . $boundary_alt . "--" . $passage_ligne;
        $message .= $passage_ligne . "--" . $boundary . $passage_ligne;

        // Envoi de l'e-mail.
        return  mail($email, $sujet, $message, $header);

    }
    private  function entete(){
        if (is_null(self::$header)){

            self::$header ='From: michael@schruws-michael.be'."\n";
            self::$header .='Reply-To: michael@schruws-michael.be'."\n";
            self::$header .='Content-Type: text/plain; charset="iso-8859-1"'."\n";
            self::$header .='Content-Transfer-Encoding: 8bit \n';
        }
        return self::$header;
    }
    private function envoie($email, $sujet, $texte)
    {
        return mail($email, $sujet,$texte, $this->entete());
    }

    public function nouveauGerant($email, $nom ,$password)
    {
        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email)) // On filtre les serveurs qui présentent des bogues.
        {
            $passage_ligne = "\r\n";
        } else {
            $passage_ligne = "\n";
        }

        $message_txt = "Bonjour ".$nom.",\n\n merci d'avoir choisi notre application. \\n
    Afin d'accéder à votre compte, veuillez aller sur le site ci-joint: \n\n http://schruws-michael.be/index.php\n\n
        Mot de passe provisoire =\".$password.\"\";" ;
        $message_html = "<html><header></header><body>Bonjour ".$nom.",<br><br>merci d'avoir choisi notre application.<br>
     Afin d'accéder à votre compte, veuillez aller sur le site ci-joint.<br> <a href='http://schruws-michael.be/index.php'>ici</a>
      <br><br>Mot de passe provisoire : ".$password."</body></html>";



        // Création de la boundary.
        $boundary = "-----=" . md5(rand());
        $boundary_alt = "-----=" . md5(rand());

// Définition du sujet.
        $sujet = "Validation Mail";

// Création du header de l'e-mail.
        $header = "From: \"application\"<michael@schruws-michael.be>" . $passage_ligne;
        $header .= "Reply-to: \"Test\" <$email>" . $passage_ligne;
        $header .= "MIME-Version: 1.0" . $passage_ligne;
        $header .= "Content-Type: multipart/mixed;" . $passage_ligne . " boundary=\"$boundary\"" . $passage_ligne;

// Création du message.
        $message = $passage_ligne . "--" . $boundary . $passage_ligne;
        $message .= "Content-Type: multipart/alternative;" . $passage_ligne . " boundary=\"$boundary_alt\"" . $passage_ligne;
        $message .= $passage_ligne . "--" . $boundary_alt . $passage_ligne;

// Ajout du message au format texte.
        $message .= "Content-Type: text/plain; charset=\"UTF-8\"" . $passage_ligne;
        $message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
        $message .= $passage_ligne . $message_txt . $passage_ligne;
        $message .= $passage_ligne . "--" . $boundary_alt . $passage_ligne;


// Ajout du message au format HTML.
        $message .= "Content-Type: text/html; charset=\"UTF-8\"" . $passage_ligne;
        $message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
        $message .= $passage_ligne . $message_html . $passage_ligne;

// On ferme la boundary alternative.
        $message .= $passage_ligne . "--" . $boundary_alt . "--" . $passage_ligne;
        $message .= $passage_ligne . "--" . $boundary . $passage_ligne;

        // Envoi de l'e-mail.
       return  mail($email, $sujet, $message, $header);
    }
    public function envoyerhoraire($email, $nom ,$password)
    {
        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email)) // On filtre les serveurs qui présentent des bogues.
        {
            $passage_ligne = "\r\n";
        } else {
            $passage_ligne = "\n";
        }

        $message_txt = "Bonjour ".$nom.",\n\n voici les nouveaux horaires de la semaine \\n
    Afin d'accéder aux horaires.  veuillez aller sur le site ci-joint: \n\n http://schruws-michael.be/index.php\n\n
        Mot de passe  =\".$password.\"\";" ;
        $message_html = "<html><header></header><body>Bonjour ".$nom.",<br><br>voici les nouveaux horaires de la semaine.<br>
     Afin d'accéder aux horaires.  veuillez aller sur le site ci-joint :<br> <a href='http://schruws-michael.be/index.php'>ici</a>
      <br><br>Mot de passe  : ".$password."</body></html>";



        // Création de la boundary.
        $boundary = "-----=" . md5(rand());
        $boundary_alt = "-----=" . md5(rand());

// Définition du sujet.
        $sujet = "Les horaires de la semaine";

// Création du header de l'e-mail.
        $header = "From: \"application\"<michael@schruws-michael.be>" . $passage_ligne;
        $header .= "Reply-to: \"Test\" <$email>" . $passage_ligne;
        $header .= "MIME-Version: 1.0" . $passage_ligne;
        $header .= "Content-Type: multipart/mixed;" . $passage_ligne . " boundary=\"$boundary\"" . $passage_ligne;

// Création du message.
        $message = $passage_ligne . "--" . $boundary . $passage_ligne;
        $message .= "Content-Type: multipart/alternative;" . $passage_ligne . " boundary=\"$boundary_alt\"" . $passage_ligne;
        $message .= $passage_ligne . "--" . $boundary_alt . $passage_ligne;

// Ajout du message au format texte.
        $message .= "Content-Type: text/plain; charset=\"UTF-8\"" . $passage_ligne;
        $message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
        $message .= $passage_ligne . $message_txt . $passage_ligne;
        $message .= $passage_ligne . "--" . $boundary_alt . $passage_ligne;


// Ajout du message au format HTML.
        $message .= "Content-Type: text/html; charset=\"UTF-8\"" . $passage_ligne;
        $message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
        $message .= $passage_ligne . $message_html . $passage_ligne;

// On ferme la boundary alternative.
        $message .= $passage_ligne . "--" . $boundary_alt . "--" . $passage_ligne;
        $message .= $passage_ligne . "--" . $boundary . $passage_ligne;

        // Envoi de l'e-mail.
        return  mail($email, $sujet, $message, $header);
    }

}
