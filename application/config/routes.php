<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'home'; // Halaman landing page pertama kali diakses
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Routes
$route['auth/login'] = 'auth/login'; // Arahkan ke controller login
$route['auth/authenticate'] = 'auth/authenticate'; // Arahkan ke authenticate
$route['auth/logout'] = 'auth/logout'; // Arahkan ke logout

$route['welcome'] = 'welcome'; // Arahkan ke dashboard setelah login
$route['home'] = 'welcome/home';