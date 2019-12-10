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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/libros/filtro', 'LibroController@filtroLibros');
Route::get('/libros/lista', 'LibroController@listaLibros');
Route::post('/libros', 'LibroController@postLibros');
Route::middleware('auth:api')->put('/libros', 'LibroController@putLibros');
Route::middleware('auth:api')->delete('/libros', 'LibroController@deleteLibros');



Route::middleware('auth:api')->post('/usuarios', 'UsuarioController@postUsuarios');
Route::middleware('auth:api')->get('/usuarios', 'UsuarioController@listaUsuarios');
Route::middleware('auth:api')->put('/usuarios', 'UsuarioController@putUsuarios');
Route::middleware('auth:api')->delete('/usuarios', 'UsuarioController@deleteUsuarios');

Route::middleware('auth:api')->post('/prestamos', 'PrestarController@prestarLibro');
Route::put('/prestamos', 'PrestarController@devolverLibro');
