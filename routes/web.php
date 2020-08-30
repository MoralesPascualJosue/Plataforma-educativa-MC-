<?php

use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

Route::get('/mail', function () {
    Mail::to('correo@gmail.com')->send(new TestMail());
    return 'Mail send';
});

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
 Route::get('change-password', 'ChangePasswordController@index');
 Route::post('change-password', 'ChangePasswordController@store')->name('change.password');
//________[END ALL routes]__________


//________[Asesor routes]__________
Route::get('/homeblade', 'HomeController@index')->name('homeblade');
Route::get('/home', 'AppController@index')->name('home');


Route::get('/inicio', 'cursoController@inicio')->name('inicio');
Route::get('/notificaciones', 'cursoController@notificaciones')->name('notificaciones');
Route::post('/storea','AnuncioController@storea')->name('storea');
Route::delete('/destroya/{id}','AnuncioController@destroya')->name('destroya');
Route::put('/updatea/{id}','AnuncioController@updatea')->name('updatea');
//________[END Asesor routes]__________


//________[Perfil routes]__________
Route::get('/perfil', 'FrontController@perfil')->name('perfil');
Route::delete('/destroyp/{id}','AsesorController@destroyp')->name('destroyp');
Route::post('/updatePerfil','FrontController@updatePerfil')->name('updatePerfil');
Route::post('/updateimage','FrontController@updateimage')->name('updateimage');
Route::get('/leernotificaciones', 'FrontController@leernotificaciones')->name('leernotificaciones');
//________[END Perfil routes]__________


//________[Curses routes]__________
Route::get('/curso/{id}', 'cursoController@curso')->name('curso');
Route::get('/scursoc/{id}', 'cursoController@showCurso')->name('scursoc');
Route::post('/storeac','cursoController@storea')->name('storeac');
Route::post('/updateac/{id}','cursoController@updatea')->name('updateac');
Route::post('/updateCover/{id}','cursoController@updateCover')->name('updatecover');
Route::delete('/destroyac/{id}','cursoController@destroya')->name('destroyac');
Route::post('/matricular','cursoController@matricular')->name('matricular');
Route::post('/desmatricular/{curso}','cursoController@desmatricular')->name('desmatricular');
Route::get('/actividadescurso/{id}','cursoController@trabajos')->name('actividadescurso');
Route::get('/calificaciones/{id}', 'cursoController@calificaciones');
Route::get('/entregash/{id}','cursoController@historiale')->name('entregash');
Route::get('/entregase/{cur}/{id}','cursoController@historialu')->name('entregase');
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
Route::get('/foro/{curso}/discusion/{id}','ForumController@discusion')->name('discusion');
Route::post('/foro/update/{id}/','ForumController@updated')->name('updatead');
Route::post('/foro/modificarco/{id}/','ForumController@updateco')->name('modificarco');
Route::delete('/foro/{curso}/eliminarco/{id}/','ForumController@deleteco')->name('eliminarco');
Route::delete('/foro/{curso}/eliminardis/{id}/','ForumController@deletedis')->name('eliminardis');
Route::get('/foro/{curso}/comentario/{id}','ForumController@comentario')->name('comentario');
//________[END forum routes]__________


//________[Chat routes]__________
Route::get('/mensajes/{id}','ChatController@mensajes')->name('mensajes');
Route::post('/sendmensaje/{id}','ChatController@send')->name('sendmensaje');
Route::get('/chatC/{id}/{c}','ChatController@chatC')->name('chatC');
Route::delete('/mensajes/destroyms/{id}','ChatController@destroyc')->name('destroyms');
Route::get('/mensajes/updatems/{id}','ChatController@updatems')->name('updatems');
Route::get('/mensajes/enviadosms/{id}','ChatController@enviadosms')->name('enviadosms');
//________[END Chat routes]__________


//________[Resources routes]__________
Route::post('/uploadfilei',"ActivitieController@uploadFileimage");
Route::post('/uploadfilev',"ActivitieController@uploadFilevideo");
Route::post('/uploadfiled',"ActivitieController@uploadFiledoc");
Route::post('/uploadfile',"ActivitieController@uploadFile");
Route::post('/uploadfilee',"ActivitieController@uploadFilee");
//________[END redources routes]__________


//________[Informacion routes]__________
Route::get('/informacion/{cur}','informacionController@informacion')->name("informacion");
Route::get('/informacionActividades/{cur}','informacionController@informacionActividades')->name("informacionActividades");
Route::get('/informacionCursop/{cur}','informacionController@informacionCursop')->name("informacionCursop");
//________[END Informacion routes]__________


//________[Test routes]__________
Route::post('/test', function () { return 'Hello World Post'; }); 
Route::Get('/test', function () { return 'Hello World Get'; }); 
//________[END Test routes]__________


// Route::group(['middleware' => ['role:Asesor']], function () {          
// });
// Route::group(['middleware' => ['role:Coordinador']], function () {   
// });

Route::get('/{catchall?}', 'AppController@index');