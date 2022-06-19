<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('admin')->group(function(){

    
    Route::get('/dashboard', 'PagesController@dashboard')->name('admin.dashboard');



    //From MainPage Controller
    Route::get('/main', 'MainPagesController@index')->name('admin.main');
    Route::put('/main', 'MainPagesController@update')->name('admin.main.update');


    //From ServicePage Controller
    Route::get('/services/create', 'ServicePagesController@create')->name('admin.services.create');
    Route::get('/services/list', 'ServicePagesController@index')->name('admin.services.list');
    Route::post('/services/create', 'ServicePagesController@store')->name('admin.services.store');
    Route::get('/services/edit/{id}', 'ServicePagesController@edit')->name('admin.services.edit');
    Route::post('/services/update/{id}', 'ServicePagesController@update')->name('admin.services.update');
    Route::delete('/services/destroy/{id}', 'ServicePagesController@destroy')->name('admin.services.destroy');

    //rom PortfolioPage Controller

    Route::get('/portfolios/create', 'PortfolioController@create')->name('admin.portfolios.create');
    Route::get('/portfolios/list', 'PortfolioController@index')->name('admin.portfolios.list');
    Route::put('/portfolios/create', 'PortfolioController@store')->name('admin.portfolios.store');
    Route::get('/portfolios/edit/{id}', 'PortfolioController@edit')->name('admin.portfolios.edit');
    Route::post('/portfolios/update/{id}', 'PortfolioController@update')->name('admin.portfolios.update');
    Route::delete('/portfolios/destroy/{id}', 'PortfolioController@destroy')->name('admin.portfolios.destroy');

    //rom AboutPage Controller
    Route::get('/abouts/create', 'AboutController@create')->name('admin.abouts.create');
    Route::get('/abouts/list', 'AboutController@index')->name('admin.abouts.list');
    Route::put('/abouts/create', 'AboutController@store')->name('admin.abouts.store');
    Route::get('/abouts/edit/{id}', 'AboutController@edit')->name('admin.abouts.edit');
    Route::post('/abouts/update/{id}', 'AboutController@update')->name('admin.abouts.update');
    Route::delete('/abouts/destroy/{id}', 'AboutController@destroy')->name('admin.abouts.destroy');
});

Route::get('/', 'PagesController@index')->name('home');

    

Route::post('/contact', 'ContactFormController@store')->name('contact.store');


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
