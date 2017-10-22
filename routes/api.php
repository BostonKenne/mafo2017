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
Route::get('test',function (){
  return response([1,2,3,4],200);
});

Route::get('/user', function (Request $request) {
	// dd($request->user()); 
    return $request->user();
})->middleware('auth:api');

Route::get('/testusers', 'UsersController@index');
Route::post('/echantillon/result', 'EchantillonsController@result');
Route::get('/parametre_analyse/{id}', 'ParametresController@chercher_parametre');

Route::post('/analyse', 'AnalyseController@ajouter');
Route::post('/analyse/params', 'AnalysesController@analyse');
Route::get('users', 'UsersController@getUsers');

Route::get('echantillons/{id}', 'EchantillonsController@getEchantillonsPuit');
// Route::post('/echantillon/create', 'EchantillonsController@create');
Route::resource('site', 'SitesController');
Route::resource('sites', 'SitesController@all');
Route::resource('puit', 'PuitsController');
Route::resource('parametre', 'ParametresController');
Route::resource('echantillon', 'EchantillonsController');
Route::resource('laboratoire', 'LaboratoiresController');
Route::resource('type_analyse', 'AnalysesController');
Route::resource('type_analyse/parametre', 'ParametresController');  