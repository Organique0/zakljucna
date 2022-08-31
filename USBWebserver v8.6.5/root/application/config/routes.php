<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['odjava'] = 'prijave/odjava';
$route['uspelaPrijava'] = 'prijave/uspelaPrijava';
$route['admin'] = 'admin/izpisiVseUporabnike';
$route['sestavljalci'] = 'sestavljalci/prikazi';
$route['prijava'] = 'prijave/prijavniObrazec';
$route['registracija'] = 'Registracije/registracijskiObrazec';
$route['pregledUporabnika'] = 'admin/pregledUporabnika';
$route['naloge'] = 'naloge/naloga';
$route['(:any)'] = 'pages/view/$1';
$route['default_controller'] = 'pages/view';
$route['404_override'] = 'errors/page_missing';
$route['translate_uri_dashes'] = FALSE;
