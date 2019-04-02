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

DB::listen(function($query){
  //var_dump($query->sql);
});

Route::group([
    'prefix' => 'admin',
    'middleware' => 'auth',
    'namespace' => 'Admin', //=>DAÑA LOS ESTILOS
], function(){
    //Route::get('all/{id}', 'AnunciosController@all')->name('anuncios.all');
    Route::get('registrar_empresa','EmpresasController@create')->name('registrar_empresa');
    Route::post('registrar_empresa','EmpresasController@store')->name('registrar_empresa');
    Route::post('editar_empresa/{id}','EmpresasController@update')->name('editar_empresa');
    Route::get('consultar_empresas','EmpresasController@index')->name('consultar_empresas');
    Route::get('consultar_usuarios','UsuariosController@index')->name('consultar_usuarios');
    Route::post('editar_usuario/{id}','UsuariosController@update')->name('editar_usuario');
    Route::get('register', 'UsuariosController@create')->name('register');
    Route::post('register', 'UsuariosController@store');
    Route::post('subir_procesos', 'ProcesosController@subir_archivos_procesos')->name('subir_procesos');
    Route::get('registrar_procesos','ProcesosController@create')->name('registrar_procesos');
    Route::get('consultar_procesos','ProcesosController@index')->name('consultar_procesos');
    Route::post('editar_proceso/{id}','ProcesosController@update')->name('editar_proceso');
    Route::get('ver_perfil','UsuariosController@ver_perfil')->name('ver_perfil');
    Route::post('registrar_observacion/{id_proceso}','ProcesosController@registrar_observacion')->name('registrar_observacion');
    Route::post('cambiar_fecha_cierre/{id_proceso}','ProcesosController@cambiar_fecha_cierre')->name('cambiar_fecha_cierre');
    Route::post('cambiar_estados/{id_proceso}','ProcesosController@cambiar_estados')->name('cambiar_estados');
    

});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');


Route::group([
    //'prefix' => 'admin',
    'middleware' => 'auth',

], function(){

	Route::get('/home', 'HomeController@index')->name('home');    

	 	
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');

        // Registration Routes...
        

        // Password Reset Routes...
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset');
});



Route::get('/', function () {
    return view('auth.login');
});




//

Route::get('/clearcache', function(){
      Artisan::call('cache:clear');
      Artisan::call('config:clear');
      Artisan::call('route:clear');
      Artisan::call('view:clear');
      // Artisan::call('event:generate ');
      // Artisan::call('key:generate');
      return '<h1>se ha borrado el cache</h1>';
  });
Route::get('prueba',function(){
  return view('index');
});