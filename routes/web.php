<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    Route::get('/', 'Auth\LoginController@abrirLogin')->name('login');
    Route::post('/authenticate', 'Auth\LoginController@authenticate')->name('authenticate');
    

 Route::group(['middleware' => ['auth']], function () {
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
 
    Route::get('/inicio', function () {
        return view('template.inicio');
    })->name('inicio');
    Route::group(['middleware' => ['Administrador']], function () {
                    
        Route::get('/cargo/cargo', 'CargoController@index')->name('cargo');
        Route::get('/cargo/listacargo','CargoController@listaCargos');
        Route::post('/cargo/guardarcargo','CargoController@store');
        Route::put('/cargo/actualizarcargo','CargoController@update');
        Route::post('/cargo/eliminarCargo','CargoController@destroy');
        Route::get('/cargo/listaVerificarNombre','CargoController@listaVerificarNombre');
        Route::get('/cargo/exportarExcel','CargoController@exportarExcel')->name('exportarcargo');
        
        Route::get('/gmaps', ['as ' => 'gmaps', 'uses' => 'GmapsController@index']);
        
        Route::get('/servicio/index', 'ServicioController@index')->name('servicio');
        Route::get('/servicio/listarServicios', 'ServicioController@listarServicios');
        Route::post('/servicio/guardarservicios', 'ServicioController@store')->name('guardarServicio');
        Route::get('/servicio/create', 'ServicioController@Create')->name('crearcargo');
        Route::get('/servicio/edit/{id}', 'ServicioController@edit')->name('editarServicio');
        Route::post('/servicio/actualizarServicio/', 'ServicioController@update')->name('actualizarServicio');
        Route::get('/servicio/eliminar/{id}', 'ServicioController@edit')->name('eliminar');
        Route::post('/servicio/eliminar','ServicioController@destroy')->name('eliminarServicio');
        
        Route::get('/comunidad/index', 'ComunidadController@index')->name('indexComunidad');
        Route::get('/comunidad/listaComunidades','ComunidadController@listaComunidades');
        Route::post('/comunidad/guardarcomunidad','ComunidadController@store');
        Route::put('/comunidad/actualizarcomunidad','ComunidadController@update');
        Route::get('/comunidad/listaVerificarNombre','ComunidadController@listaVerificarNombre');
        Route::put('/comunidad/desactivar','ComunidadController@desactivar');
        Route::put('/comunidad/activar','ComunidadController@activar');
        
        Route::get('/cliente/index', 'ClienteController@index')->name('indexCliente');
        Route::get('/cliente/listaClientes','ClienteController@listaClientes');
        Route::post('/cliente/guardarClientes','ClienteController@store');
        Route::put('/cliente/actualizarClientes','ClienteController@update');
        Route::get('/cliente/create', 'clienteController@create')->name('crearcliente');
        Route::get('/cliente/listaVerificarCedula','ClienteController@listaVerificarCedula');
        Route::put('/cliente/desactivar','ClienteController@desactivar');
        Route::put('/cliente/activar','ClienteController@activar');
        Route::get('/cliente/listarComunidad','ClienteController@listarComunidad');
        Route::post('/cliente/eliminarCliente','ClienteController@destroy');
        
        Route::get('/roles/index', 'RolesController@index')->name('indexRoles');
        Route::get('/roles/listarRoles','RolesController@listaRoles');
        Route::post('/roles/guardarRoles','RolesController@store');
        Route::put('/roles/actualizarRoles','RolesController@update');
        Route::get('/roles/listaVerificarNombre','RolesController@listaVerificarNombre');
        Route::put('/roles/desactivar','RolesController@desactivar');
        Route::put('/roles/activar','RolesController@activar');
        
        
        Route::get('/user/vistaUsuarios', 'UserController@vistaUsuarios')->name('vistaUsuarios');
        Route::get('/user/listaUsuario', 'UserController@listaUsuario')->name('listaUsuario');
        Route::get('/user/createUsuario', 'UserController@createUsuario')->name('crearUsuario');
        Route::post('/user/guardarUsuario','UserController@store');
        Route::put('/user/actualizar','UserController@update');
        Route::get('/user/cargarRoles', 'UserController@cargarRoles');
        Route::get('/user/cargarUsuarios', 'UserController@cargarUsuarios');
        Route::get('/user/cargarEmailUsuarios', 'UserController@cargarEmailUsuarios');
        Route::put('/user/desactivar','UserController@desactivar');
        Route::put('/user/activar','UserController@activar');
        
 
    });
    Route::group(['middleware' => ['Recolector']], function () {
                    
        Route::get('/cargo/cargo', 'CargoController@index')->name('cargo');
        Route::get('/cargo/listacargo','CargoController@listaCargos');
        Route::post('/cargo/guardarcargo','CargoController@store');
        Route::put('/cargo/actualizarcargo','CargoController@update');
        Route::post('/cargo/eliminarCargo','CargoController@destroy');
        Route::get('/cargo/listaVerificarNombre','CargoController@listaVerificarNombre');
        Route::get('/cargo/exportarExcel','CargoController@exportarExcel')->name('exportarcargo');
        
        Route::get('/gmaps', ['as ' => 'gmaps', 'uses' => 'GmapsController@index']);
        
        Route::get('/servicio/index', 'ServicioController@index')->name('servicio');
        Route::get('/servicio/listarServicios', 'ServicioController@listarServicios');
        Route::post('/servicio/guardarservicios', 'ServicioController@store')->name('guardarServicio');
        Route::get('/servicio/create', 'ServicioController@Create')->name('crearcargo');
        Route::get('/servicio/edit/{id}', 'ServicioController@edit')->name('editarServicio');
        Route::post('/servicio/actualizarServicio/', 'ServicioController@update')->name('actualizarServicio');
        Route::get('/servicio/eliminar/{id}', 'ServicioController@edit')->name('eliminar');
        Route::post('/servicio/eliminar','ServicioController@destroy')->name('eliminarServicio');
        
        
        
        
        Route::get('/user/vistaUsuarios', 'UserController@vistaUsuarios')->name('vistaUsuarios');
        Route::get('/user/listaUsuario', 'UserController@listaUsuario')->name('listaUsuario');
        Route::get('/user/createUsuario', 'UserController@createUsuario')->name('crearUsuario');
        Route::post('/user/guardarUsuario','UserController@store');
        Route::put('/user/actualizar','UserController@update');
        Route::get('/user/cargarRoles', 'UserController@cargarRoles');
        Route::get('/user/cargarUsuarios', 'UserController@cargarUsuarios');
        Route::get('/user/cargarEmailUsuarios', 'UserController@cargarEmailUsuarios');
        Route::put('/user/desactivar','UserController@desactivar');
        Route::put('/user/activar','UserController@activar');
        
 
    });
});





