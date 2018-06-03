<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 31-12-16
 * Time: 14:04
 */

namespace controlleur;


class reCaptcha
{
    private $cleSecret;
    private $cleSite;


    function __construct($cle_site= "6LcjPxAUAAAAANq5q75A9L_zSSoUWdLOnyUeKmBA", $api_secret = "6LcjPxAUAAAAAHP1VS577qYEQarYaAhI-E7SQfl-")
    {
        $this->cleSecret = $api_secret;
        $this->cleSite = $cle_site;
    }

    /**
     * Permet de générer le code HTML de notre captcha
     * @return string
     */
    public function html()
    {
        return '<div class="g-recaptcha" data-sitekey="' . $this->cleSite . '"></div>';
    }

    /**
     * Permet de vérifier la réponse donné par recaptcha
     * @param string $code
     * @param null $ip
     * @return bool
     */
    public function isValid($code, $ip = null)
    {
        var_dump($code);
        if (empty($code)) {
            return false;
        }
        $params = [
            'secret'    => $this->cleSecret,
            'response'  => $code
        ];
        if( $ip ){
            $params['remoteip'] = $ip;
        }
        $url = "https://www.google.com/recaptcha/api/siteverify?" . http_build_query($params);
        if (function_exists('curl_version')) {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($curl);
        } else {
            $response = file_get_contents($url);
        }

        if (empty($response) || is_null($response)) {
            return false;
        }

        $json = json_decode($response);
        return $json->success;
    }
}