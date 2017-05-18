<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "usuarios_controller";
//rutas usuarios importarUsersExcel
$route['verificaUsuario'] = "usuarios_controller/verificaUsuario";
$route['mostrarusuarios'] = "usuarios_controller/mostrarUsuarios";
$route['actualizarUsuario/(:num)'] = "usuarios_controller/actualizarUsuario/$1";
$route['eliminarUsuario/(:num)'] = "usuarios_controller/eliminarUsuario/$1";
$route['nuevoUsuario'] = "usuarios_controller/nuevoUsuario";
$route['importarUsersExcel'] = "usuarios_controller/importarUsersExcel";

//rutas proveedores importarProveedoresExcel
$route['mostrarproveedores'] = "proveedores_controller/mostrarProveedores";
$route['actualizarProveedor/(:num)'] = "proveedores_controller/actualizarProveedor/$1";
$route['eliminarProveedor/(:num)'] = "proveedores_controller/eliminarProveedor/$1";
$route['nuevoproveedor'] = "proveedores_controller/nuevoProveedor";
$route['importarProveedoresExcel'] = "proveedores_controller/importarProveedoresExcel";
$route['exportarProveedorExcel'] = "proveedores_controller/exportarProveedoresExcel";

//rutas clientes importarClientesExcel
$route['mostrarclientes'] = "clientes_controller/mostrarClientes";
$route['actualizarCliente/(:num)'] = "clientes_controller/actualizarCliente/$1";
$route['eliminarCliente/(:num)'] = "clientes_controller/eliminarCliente/$1";
$route['nuevoCliente'] = "clientes_controller/nuevoCliente";
$route['importarClientesExcel'] = "clientes_controller/importarClientesExcel";
$route['exportarClienteExcel'] = "clientes_controller/exportarClienteExcel";

//rutas categorias direccionadas a configuracion 
$route['mostrarvalores'] = "configuracion_controller/mostrarValores";
$route['actualizarCategoria/(:num)'] = "configuracion_controller/actualizarCategoria/$1";
$route['eliminarCategoria/(:num)'] = "configuracion_controller/eliminarCategoria/$1";
$route['nuevocategoria'] = "configuracion_controller/nuevoCategoria";
$route['importarCategoriasExcel'] = "configuracion_controller/importarCategoriasExcel";
$route['exportarCategoriaExcel'] = "configuracion_controller/exportarCategoriaExcel";
$route['actualizarDatosEmpresa/(:num)'] = "configuracion_controller/actualizarDatosEmpresa/$1";
$route['actualizarSistema/(:num)'] = "configuracion_controller/actualizarSistema/$1";

//rutas sucursales direccionadas a configuracion 
$route['mostrarvalores'] = "configuracion_controller/mostrarValores";
$route['actualizarSucursal/(:num)'] = "configuracion_controller/actualizarSucursal/$1";
$route['eliminarSucursal/(:num)'] = "configuracion_controller/eliminarSucursal/$1";
$route['nuevosucursal'] = "configuracion_controller/nuevoSucursal";
$route['importarSucursalesExcel'] = "configuracion_controller/importarSucursalesExcel";
$route['exportarSucursalExcel'] = "configuracion_controller/exportarSucursalExcel";

//rutas inventarios importarInventariosExcel
$route['mostrarinventarios'] = "inventarios_controller/mostrarInventarios";
$route['actualizarInventario/(:num)'] = "inventarios_controller/actualizarCliente/$1";
$route['eliminarInventario/(:num)(:num)'] = "inventarios_controller/eliminarCliente/$1/$1";
$route['nuevoInventario'] = "inventarios_controller/nuevoInventario";
$route['importarInventariosExcel'] = "inventarios_controller/importarClientesExcel";
$route['exportarInventarioExcel'] = "inventarios_controller/exportarClienteExcel";
//$route['edicionMultipleInventario/(:any)'] = "inventarios_controller/edicionMultipleInventario/$1";


$route['cerrarSesion'] = "usuarios_controller/cerrarSesion";


$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */