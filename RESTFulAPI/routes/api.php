<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/






/**
 * Products
 */
Route::resource('planetas','Product\ProductController',['only' => ['index','show']]);


/**
 * User
 */
Route::resource('users','User\UserController',['except' => ['edit']]);

/**
 * Registro
 */
Route::resource('registro','Registro\RegistroController',['except' => ['edit']]);

/**
 * Registrop
 */
Route::resource('registroPessoas','Registro\RelatorioPessoasController',['only' => ['index','show']]);

Route::resource('PlanetasAcessados','Registro\PlantetasAcessadosController',['only' => ['index','show']]);


if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
    }