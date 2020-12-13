<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('root');
})->name('root.index');

Route::prefix('admin')->group(function () {
    Route::get('','AdminController@index')->name('admin.index');
    Route::get('change_category','AdminController@change_category')->name('admin.change_category');
    Route::get('search','AdminController@search')->name('admin.search');
    Route::patch('{user}','AdminController@change_password')->name('admin.change_password');

    Route::get('create','AdminController@create')->name('admin.create');
    Route::post('store','AdminController@store')->name('admin.store');
    Route::get('{user}','AdminController@edit')->name('admin.edit');
    Route::patch('{user}/update','AdminController@update')->name('admin.update');
    Route::delete('{user}/destroy','AdminController@destroy')->name('admin.destroy');
});
Route::prefix('user')->group(function () {
    Route::get('','UserController@editprofile')->name('user.editprofile');
    Route::patch('change_password','UserController@change_password')->name('user.change_password');
});

Route::prefix('gamyklos')->group(function () {
    Route::get('', 'GamyklaController@index')->name('gamyklos.index');
    Route::get('edit/{id}', 'GamyklaController@edit')->name('gamyklos.edit');
    Route::post('edit/{id}', 'GamyklaController@update')->name('gamyklos.update');
    Route::delete('delete','GamyklaController@delete')->name('gamyklos.delete');
    Route::get('create', 'GamyklaController@create')->name('gamyklos.create');
    Route::post('create', 'GamyklaController@store')->name('gamyklos.store');
});

Route::prefix('tvarkarasciai')->group(function () {
    Route::get('', 'TvarkarastisController@index')->name('tvarkarasciai.index');
    Route::get('edit/{id}', 'TvarkarastisController@edit')->name('tvarkarasciai.edit');
    Route::post('edit/{id}', 'TvarkarastisController@update')->name('tvarkarasciai.update');
    Route::delete('delete','TvarkarastisController@delete')->name('tvarkarasciai.delete');
    Route::get('create', 'TvarkarastisController@create')->name('tvarkarasciai.create');
    Route::post('create', 'TvarkarastisController@store')->name('tvarkarasciai.store');
    Route::get('show', 'TvarkarastisController@show')->name('tvarkarasciai.show');
});

Route::prefix('sandelis')->group(function () {
    Route::get('', 'SandelisController@index')->name('sandelis.index');
    Route::get('edit/{id}', 'SandelisController@edit')->name('sandelis.edit');
    Route::post('edit/{id}', 'SandelisController@update')->name('sandelis.update');
    Route::delete('delete','SandelisController@delete')->name('sandelis.delete');
    Route::get('create', 'SandelisController@create')->name('sandelis.create');
    Route::post('create', 'SandelisController@store')->name('sandelis.store');
});

Route::prefix('prekes_sandelyje')->group(function () {
    Route::get('{id}', 'PrekesSandelyjeController@index')->name('prekes_sandelyje.index');
    Route::get('create', 'PrekesSandelyjeController@create')->name('prekes_sandelyje.create');
    Route::get('edit/{id}', 'PrekesSandelyjeController@edit')->name('prekes_sandelyje.edit');
    Route::delete('delete','PrekesSandelyjeController@delete')->name('prekes_sandelyje.delete');
    Route::post('create', 'PrekesSandelyjeController@store')->name('prekes_sandelyje.store');
});

Route::prefix('sandelio_uzimtumas')->group(function () {
    Route::get('show', 'SandelioUzimtumasController@show')->name('sandelio_uzimtumas.show');
});

Route::prefix('populiariausios_prekes')->group(function () {
    Route::get('show', 'PopuliariausiosPrekesController@show')->name('populiariausios_prekes.show');
});

Route::prefix('tvarkarascio_statistika')->group(function () {
    Route::get('show', 'TvarkarascioStatistikaController@show')->name('tvarkarascio_statistika.show');
});

Route::prefix('eparduotuve')->group(function () {
    Route::get('', 'EParduotuveController@index')->name('eparduotuve.index');
    Route::get('cart', 'EParduotuveController@cart')->name('eparduotuve.cart');
    Route::get('item/{id}', 'EParduotuveController@show')->name('eparduotuve.show');
    Route::get('complete', 'EParduotuveController@complete')->name('eparduotuve.complete');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
