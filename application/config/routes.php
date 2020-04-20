<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|	https://codeigniter.com/user_guide/general/routing.html
*/

$route['api/calendario'] = 'Api_Calendario/fullCalendario';

$route['api/login'] = 'Api_Authentication/login';
$route['api/logout'] = 'Api_Authentication/logout';

$route['api/user/(:num)'] = 'Api_User/user/$1';




$route['default_controller'] = 'landing';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

