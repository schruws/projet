<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 23-12-16
 * Time: 23:08
 */

require_once dirname(__DIR__)."/projet/controlleur/menu.php";
require_once dirname(__DIR__)."/projet/controlleur/reCaptcha.php";
require_once dirname(__DIR__)."/projet/controlleur/personnel.php";
require_once dirname(__DIR__)."/projet/controlleur/restaurant.php";
require_once dirname(__DIR__)."/projet/controlleur/contrat.php";
require_once dirname(__DIR__)."/projet/controlleur/horaire.php";
require_once dirname(__DIR__)."/projet/controlleur/conger.php";

use controlleur\menu;
use controlleur\message;
use controlleur\restaurant;
use controlleur\reCaptcha;

setlocale(LC_TIME, 'fr_FR', 'FRA');
date_default_timezone_set("Europe/paris");
mb_internal_encoding("UTF-8");
if(!isset($_SESSION))
{
    session_start();
}
if(!isset($_SESSION['activationCaptcha']))
{
    $_SESSION['activationCaptcha']= 0;
    $_SESSION['Captcha'] = new reCaptcha();

}



ob_start(); /* donnée mise en tampon */
if(isset($_GET['page']))
{
    $page = explode('.', $_GET['page']);
    $controlleur = "\\controlleur\\".$page[0];
    $test = explode(';', $page[1]);
    $action = $test[0];
    $controlleur = new $controlleur();
    $vue = $controlleur->$action();
    if(! is_null($vue))
    {
        require $vue;
    }
}
else {
    $controlleur = new menu();
    $vue = $controlleur->index();
    require $vue;
}
$content = ob_get_clean(); /* insere le contenue du tampin dans la variable content */
require "vue/defaut.php";
ini_set('display_errors',0);
