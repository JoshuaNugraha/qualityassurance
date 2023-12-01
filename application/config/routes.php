<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['auth'] = 'Auth';
$route['login'] = 'Auth/login';
$route['dashboard'] = 'Dashboard';
$route['logout'] = 'Auth/logout';



// CS
$route['komplain'] = 'Cs/master_komplain';
$route['laporan-komplain'] = 'Cs/laporan_komplain';


// programmer
$route['komplain-list'] = 'Programmer/master_komplain';


// QA
$route['komplain-qa'] = 'Qa/master_qa';