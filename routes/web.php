<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    $res['success'] = true;
    $res['result'] = 'Hello Api Perpusmu...l';
    return response($res);
});

//Ganarate Aplikasi
$router->get('/key', function(){
    return str_random(32);
});

$router->post('/input','InputController@input');
$router->post('/register','AuthController@register');
$router->post('/login','AuthController@login');
$router->get('/user/{id}', ['middleware' => 'auth' ,'uses' => 'AuthController@getUser']);

$router->get('/users/{id}','AuthController@getUser');


$router->get('user', ['uses' => 'AuthController@indexuser']);

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {

  $router->get('rak',  ['uses' => 'RakController@showAllJurnal']);
  $router->get('rak/{id}', ['uses' => 'RakController@showOneJurnal']);

  $router->post('/rak', ['uses' => 'RakController@create']);

  $router->post('post', ['uses' => 'PostController@create']);
  
  $router->get('rakjurnal', ['uses' => 'RakController@indexjurnal']);
  $router->get('rakbuku', ['uses' => 'RakController@indexbuku']);

  //status
  $router->get('rakdipinjam', ['uses' => 'RakController@indexdipinjam']);
  $router->get('raktersedia', ['uses' => 'RakController@indextersedia']);

  $router->delete('rakkoleksibuku/{id}', ['uses' => 'KoleksiBController@delete']);
  $router->delete('rakkoleksijurnal/{id}', ['uses' => 'KoleksiController@delete']);
  
  $router->delete('rakadmin/{id}', ['uses' => 'RakController@delete']);

  $router->put('rak/{id}', ['uses' => 'RakController@update']);
  $router->put('pinjam/{id}', ['uses' => 'PinjamController@update']);

  $router->post('pinjam', ['uses' => 'PinjamController@create']);
  $router->get('listpinjam/{id}', ['uses' => 'PinjamController@get']);
  $router->get('listsemuapinjam', ['uses' => 'PinjamController@getsemuapinjam']);

  $router->post('pengembalian', ['uses' => 'KembalianController@create']);
  $router->get('listpengembalian/{id}', ['uses' => 'KembalianController@get']);
  $router->get('listsemuapengembalian', ['uses' => 'KembalianController@getsemuapengembalian']);
  $router->delete('deletepengembalian/{id}', ['uses' => 'KembalianController@delete']);
  

  $router->post('koleksi', ['uses' => 'KoleksiController@create']);
  $router->get('listkoleksi/{id}', ['uses' => 'KoleksiController@get']);

  $router->post('koleksibuku', ['uses' => 'KoleksiBController@create']);
  $router->get('listkoleksibuku/{id}', ['uses' => 'KoleksiBController@get']);

  $router->get('search/{keyword}',  ['uses' => 'SearchController@searchjurnal']);
  $router->get('searchbuku/{keyword}',  ['uses' => 'SearchbukuController@searchbuku']);

});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('pinjam',  ['uses' => 'PinjamController@showAllJurnal']);
    $router->post('pinjam/{id}', ['uses' => 'PinjamController@peminjaman']);
    $router->get('pinjam', ['uses' => 'PinjamController@index']);
    $router->delete('pinjam/{id}', ['uses' => 'PinjamController@delete']);
    $router->put('pinjam/{id}', ['uses' => 'PinjamController@update']);
  });
