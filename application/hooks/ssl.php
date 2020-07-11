<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

header("Cache-Control: no-cache, must-revalidate");
header('Content-Type: text/html; charset=utf-8');
header("X-Clacks-Overhead: GNU Terry Pratchett");
header("Content-Language: en");
header("X-XSS-Protection: 1; mode=block");
header("X-Frame-Options: SAMEORIGIN");
header("X-Content-Type-Options: nosniff");
header("Referrer-Policy: no-referrer-when-downgrade");
header("Feature-Policy: sync-xhr *");
header("Content-Security-Policy: img-src: script-src");

function redirect_ssl() {

    // $CI =& get_instance();

    // if(strpos ( $_SERVER['SERVER_NAME'] , 'elasticbeanstalk' ) ) {

    //     header('Location: ' . $CI->config->config['base_url']);
    //     exit;
    // }
}