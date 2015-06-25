<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'SearchController@index');
Route::get('home', 'HomeController@index');


Route::bind('elector', function($id){
    return App\Elector::where('id', $id)->first();
});

Route::bind('address', function($id){
    return App\Address::where('id', $id)->first();
});


Route::resource ('elector.relation','RelationController');
Route::get('query', 'AddressController@query');

App::bind('App\Inroll\Repositories\ElectorRepositoryInterface','App\Inroll\Repositories\ElectorRepository');
App::bind('App\Inroll\Repositories\AddressRepositoryInterface','App\Inroll\Repositories\AddressRepository');

Route::get('Request::url()/export', ['uses' => 'SearchController@export', 'as' => 'export']);

$router->resource('elector', 'ElectorController',
    ['names'=>[
        'index' => 'elector_path',
        'show'  => 'elector_path',
        'edit'  => 'elector_path',
        'update'  => 'elector_path' ],
        'only'=>['index','show','edit','update']

    ]);

$router->resource('address', 'AddressController',

    ['names'=>[
        'index' => 'address_path',
        'show'  => 'address_path',
        'edit'  => 'address_path',
        'update'  => 'address_path',
        'feedback' => 'address_path',
        'query' => 'address_path'],
        'only'=>['index','show','edit','update','feedback','query']

    ]);


//Route::controllers([
//    'auth' => 'Auth\AuthController',
//    'password' => 'Auth\PasswordController',
//]);

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

/*
 * Display SQL Queries
 */
//Event::listen('illuminate.query', function($sql)
//{
//    var_dump($sql);
//});

