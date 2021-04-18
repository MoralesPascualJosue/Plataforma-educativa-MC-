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
Route::get('/test', function () { return view('hometestvue'); });

//________[ALL routes]__________
 Route::get('/', function () { return view('welcome'); });
 Auth::routes(['verify' => true]);
//________[END ALL routes]__________


//________[Auth routes]__________
Route::get('/home', 'AppController@index')->name('home');
Route::get('/notificaciones', 'cursoController@notificaciones')->name('notificaciones');
Route::get('change-password', 'ChangePasswordController@index');
Route::post('change-password', 'ChangePasswordController@store')->name('change.password');
//________[END Auth routes]__________


//________[Anuncio routes]__________
Route::post('/storea','AnuncioController@storea')->name('storea');
Route::put('/updatea/{id}','AnuncioController@updatea')->name('updatea');
Route::delete('/destroya/{id}','AnuncioController@destroya')->name('destroya');
//________[END Anuncio routes]__________


//________[Perfil routes]__________
Route::get('/perfil', 'FrontController@perfil')->name('perfil');
Route::post('/updatePerfil','FrontController@updatePerfil')->name('updatePerfil');
Route::get('/leernotificaciones', 'FrontController@leernotificaciones')->name('leernotificaciones');
Route::post('/leernotificacion', 'FrontController@leernotificacion')->name('leernotificacion');
//________[END Perfil routes]__________


//________[Curses routes]__________
Route::get('/inicio', 'cursoController@inicio')->name('inicio');
Route::get('/scursoc/{id}', 'cursoController@showCurso')->name('scursoc');
Route::post('/storeac','cursoController@storea')->name('storeac');
Route::post('/updateac/{id}','cursoController@updatea')->name('updateac');
Route::delete('/destroyac/{id}','cursoController@destroya')->name('destroyac');
Route::post('/matricular','cursoController@matricular')->name('matricular');
Route::post('/desmatricular/{curso}','cursoController@desmatricular')->name('desmatricular');
Route::get('/actividadescurso/{id}','cursoController@trabajos')->name('actividadescurso');
Route::get('/calificaciones/{id}', 'cursoController@calificaciones');
Route::get('/generarlista/{curso}', 'cursoController@reporteListac');
Route::get('/generarexcel/{curso}', 'cursoController@reporteListae');
//________[END curses routes]__________


//________[Activities routes]__________
Route::post('/storeaa/{id}','ActivitieController@storea')->name('storeaa');
Route::get('/sactivitiec/{id}', 'ActivitieController@showActivitie')->name('sactivitiec');
Route::delete('/destroyaa/{id}','ActivitieController@destroya')->name('destroyaa');
Route::post('/updateaa/{id}','ActivitieController@updatea')->name('updateaa');
//________[END activities routes]__________


//________[Tasks routes]__________
Route::put('/updateat/{id}','TaskController@updatea')->name('updateat');
Route::get('/trabajos/{id}','TaskController@trabajos')->name('trabajos');
//________[END tasks routes]__________


//________[works routes]__________
Route::post('/storeaw/{id}','WorkController@storea')->name('storeaw');
Route::get('/showworks/{act}/{est}','WorkController@showworks')->name('works');
//________[END works routes]__________


//________[Qualifications routes]__________
Route::post('/updateaw/{id}','QualificationController@updatea')->name('updateaw');
//________[END qualifications routes]__________


//________[Forum routes]__________
Route::get('/foro/{curso}','ForumController@foro')->name('foro');
Route::post('/foro/{curso}/creartema/','ForumController@store')->name('creartema');
Route::post('/foro/comentar/{id}/','ForumController@comentar')->name('comentar');
Route::get('/foro/{curso}/{disc}/','ForumController@show')->name('showtema');
Route::post('/foro/update/{id}/','ForumController@updated')->name('updatead');
Route::post('/foro/modificarco/{id}/','ForumController@updateco')->name('modificarco');
Route::delete('/foro/{curso}/eliminarco/{id}/','ForumController@deleteco')->name('eliminarco');
Route::delete('/foro/{curso}/eliminardis/{id}/','ForumController@deletedis')->name('eliminardis');
//________[END forum routes]__________


//________[Chat routes]__________
Route::get('/mensajes/{id}','ChatController@mensajes')->name('mensajes');
Route::post('/sendmensaje/{id}','ChatController@send')->name('sendmensaje');
Route::get('/chatC/{id}/{c}','ChatController@chatC')->name('chatC');
Route::delete('/mensajes/destroyms/{id}','ChatController@destroyc')->name('destroyms');
//________[END Chat routes]__________


//________[Resources routes]__________
Route::post('/uploadfilei',"UploadController@uploadFileimage");
Route::post('/uploadfilev',"UploadController@uploadFilevideo");
Route::post('/uploadfiled',"UploadController@uploadFiledoc");
Route::post('/uploadfile',"UploadController@uploadFile");
Route::post('/uploadfilee',"UploadController@uploadFilee");
//________[END redources routes]__________


//________[Informacion routes]__________
Route::get('/informacion/{cur}','informacionController@informacion')->name("informacion");
Route::get('/informacionActividades/{cur}','informacionController@informacionActividades')->name("informacionActividades");
Route::get('/informacionCursop/{cur}','informacionController@informacionCursop')->name("informacionCursop");
//________[END Informacion routes]__________


//________[Test routes]__________
Route::post('test/create/{id}','TestController@storeTest');
Route::get('test/show/{id}','TestController@showTest');
Route::post('test/question/{id}','TestController@storeQuestion');
Route::post('test/questiond/{id}','TestController@deleteQuestion');
Route::post('test/result/{id}','TestController@resultTest');
Route::post('/updateat/{id}','TestController@updateTest')->name('updateat');
Route::delete('/destroyat/{id}','TestController@destroyTest')->name('destroyat');
Route::get('test/trabajos/{id}','TestController@trabajos')->name('trabajost');
Route::get('test/showwork/{act}/{est}','TestController@showworks')->name('workst');
Route::post('test/puntajes/{act}/{est}','TestController@puntajes')->name('puntajes');
//________[END Test routes]__________

Route::post('remove/{id}','UploadController@remove');

Route::get('/{catchall?}', 'AppController@index');