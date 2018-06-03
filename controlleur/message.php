<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 25-12-16
 * Time: 21:03
 */

namespace controlleur;


class message
{
    static $instance;

    static function getInstance(){
        if(!self::$instance){
            self::$instance = new message();
        }
        return self::$instance;
    }

    public function __construct(){
        if(!isset($_SESSION))
        {
            session_start();
        }
    }

    public function setFlash($key, $message){
        $_SESSION['flash'][$key] = $message;
    }

    public function hasFlashes(){
        return isset($_SESSION['flash']);
    }

    public function getFlashes(){
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }

    public function write($key, $value){
        $_SESSION[$key] = $value;
    }

    public function read($key){
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function delete($key){
        unset($_SESSION[$key]);
    }
}