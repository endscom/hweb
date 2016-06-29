<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------

*/
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


/*----Rutas de administrador********
***********************************/
$route['inicio']= "horasextras/inicio";
$route['bio']= "bio/biometrico";
$route['archivo']= "bio/archivo";
$route['horasextras']="horasextras/index";
$route['ingresar']="horasextras/llenarHE";
$route['verReporte']="horasextras/verdetalle";
$route['updateReporte']="horasextras/updateReporte";
$route['llenarHE']="horasextras/generarHE";
$route['getEmpleados']="horasextras/get_subcat";
$route['getCargos']="horasextras/get_subcargos";
$route['guardar']="horasextras/guardarHE";
$route['vercomparativa']="comparativa/cargarcomparativa";
$route['verusuarios']="users/index";
$route['nuevousuario']="users/nuevo";
$route['saveusuario']="users/save";
$route['deleteusuario']="users/delete";
$route['empleados']="empleados/index";
$route['saveempleados']="empleados/save";


/*----Rutas del elaborador********
***********************************/
$route['vertodos']="horasextras/vertodos";
$route['editar/(:any)']="horasextras/editarreporte/$1";
$route['update']="horasextras/updateHE";
$route['borrar']="horasextras/eliminar";


/*----Rutas del que revisa********
***********************************/
$route['autorizar']="horasextras/autorizar";
$route['verautorizados']="horasextras/verautorizados";
$route['check']="horasextras/checkreporte";
$route['visualizar/(:any)']="horasextras/verReporte/$1";
$route['visualizarAutorizados/(:any)']="horasextras/verReporteAutorizado/$1";

$route['reporXgerencia']="comparativa/cargarcomparativaXID";
$route['comparar/(:any)']="comparativa/cargarcomparativaXID/$1";
$route['consolidado/(:any)']="comparativa/vercomparativa/$1";


/*----Rutas para login y deslogin ********
***********************************/
$route['entrar'] = "login/logueo";
$route['salir'] = "login/salir";
$route['updatePass'] = "users/updatePass";

/*------Rutas de REPORTES--------------*/
$route['consolidadopdf'] = "reportes/consolidadopdf";
$route['ingresohepdf'] = "reportes/ingresohepdf";
$route['edicionhepdf'] = "reportes/edicionhepdf";
$route['reportegerentepdf'] = "reportes/reportegerentepdf";
$route['consolidadoexcel'] = "reportes/consolidadoexcel";
