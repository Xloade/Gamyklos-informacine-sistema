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

Route::get('/', function () {
    return view('root');
})->name('root.index');

Route::prefix('admin')->group(function () {
    Route::get('','AdminController@index')->name('admin.index');
    Route::get('create','AdminController@create')->name('admin.create');
    Route::post('store','AdminController@store')->name('admin.store');
    Route::get('{user}','AdminController@edit')->name('admin.edit');
    Route::get('{user}','AdminController@edit')->name('admin.edit');
    Route::patch('{user}/update','AdminController@update')->name('admin.update');
    Route::delete('{user}/destroy','AdminController@destroy')->name('admin.destroy');
});
Route::prefix('user')->group(function () {
    Route::get('/user','UserController@editprofile')->name('user.editprofile');
});



Route::prefix('gamyklos')->group(function () {
    Route::get('', 'GamyklaController@index')->name('gamyklos.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
