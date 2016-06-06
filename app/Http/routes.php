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



Route::get('/', 'SearchController@index');
Route::get('home', 'HomeController@index');
Route::get('/phone', 'PhoneController@index');


Route::bind('elector', function($id){
    return App\Elector::where('id', $id)->first();
});

Route::get('/visual', function() {
    return View::make('data-visualisation');
});

Route::get ('/geo','GeoController@store');
Route::get ('/geo/api','GeoController@toGeojson');

Route::get('/surveys', function() {
    return View::make('index');
});

Route::get('/survey/{id}', function() {
    return View::make('index');
});

Route::get('/survey/{id}/survey-record', function() {
    return View::make('index');
});

Route::group(['prefix' => 'api'], function() {
    Route::resource('surveys','SurveyController');
    Route::resource('questions','QuestionController');
    Route::resource('answers','AnswerController');
    Route::get('survey/{id}/questions', 'QuestionController@index');
});


Route::bind('address', function($id){
    return App\Address::where('id', $id)->first();
});

Route::get ('db','DBManageController@update');
Route::resource ('elector.relation','RelationController');
Route::get('findgap', 'AddressController@findGap');

App::bind('App\Inroll\Repositories\ElectorRepositoryInterface','App\Inroll\Repositories\ElectorRepository');
App::bind('App\Inroll\Repositories\AddressRepositoryInterface','App\Inroll\Repositories\AddressRepository');

Route::get('/export', ['uses' => 'SearchController@export', 'as' => 'export']);


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
        ],
        'only'=>['index','show']
    ]);

Route::controller('address', 'AddressController');
$router->resource('phone', 'PhoneController',

    ['names'=>[
        'index' => 'phone_path',
        'show'  => 'phone_path',
        'edit'  => 'phone_path',
        'update'  => 'phone_path',
        'query' => 'phone_path'
    ],
        'only'=>['index','show','edit','update','query']
    ]);



Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');


//Event::listen('illuminate.query', function($query)
//{
//    var_dump($query);
//});