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

//________[ALL routes]__________

 Route::get('/', function () { return view('welcome'); });

 Auth::routes(['verify' => true]);

//________[END ALL routes]__________



//Route::get('register', 'Auth\LoginController@showLoginForm')->name('register'); redirigir registro a login
//Route::get('/home', 'HomeController@index')->middleware('verified');


//________[Asesor routes]__________

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/inicio', 'cursoController@inicio')->name('inicio');

Route::post('/storea','AnuncioController@storea')->name('storea');

Route::delete('/destroya/{id}','AnuncioController@destroya')->name('destroya');

Route::put('/updatea/{id}','AnuncioController@updatea')->name('updatea');


//________[END Asesor routes]__________


//________[Perfil routes]__________

Route::get('/perfil', 'FrontController@perfil')->name('perfil');

Route::delete('/destroyp/{id}','AsesorController@destroyp')->name('destroyp');

Route::put('/updatePerfil','frontController@updatePerfil')->name('updatePerfil');

Route::post('/updateimage','frontController@updateimage')->name('updateimage');

//________[END Perfil routes]__________


//________[Curses routes]__________
Route::get('/inicioc','FrontController@index')->name('inicioc');

Route::get('/scursoc/{id}', 'cursoController@showCurso')->name('scursoc');

Route::post('/storeac','cursoController@storea')->name('storeac');

Route::put('/updateac/{id}','cursoController@updatea')->name('updateac');

Route::post('/updateCover/{id}','cursoController@updateCover')->name('updatecover');

Route::delete('/destroyac/{id}','cursoController@destroya')->name('destroyac');

Route::post('/matricular','cursoController@matricular')->name('matricular');

//________[END Asesor routes]__________


//________[Test routes]__________


Route::post('/test', function () { return 'Hello World Post'; }); 
 Route::Get('/test', function () { return 'Hello World Get'; }); 
 

//________[END Test routes]__________



Route::group(['middleware' => ['role:Asesor']], function () {      
});

Route::group(['middleware' => ['role:Estudiante']], function () {   
});


Route::group(['middleware' => ['role:Coordinador']], function () {   

});

Route::resource('asesors', 'AsesorController');

Route::resource('cursos', 'cursoController');

Route::resource('anuncios', 'AnuncioController');

Route::resource('estudiantes', 'EstudianteController');

Route::resource('matriculados', 'MatriculadoController');