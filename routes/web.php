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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware('auth')->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');

    /*
     * Classtypes Routes
     */
    Route::resource('classtypes', 'ClasstypeController');

    /*
     * StudentClasses Routes
     */
    Route::resource('student_classes', 'StudentClassController');

    /*
     * Ajax Routes
     */
    Route::get('ajax_samples', 'AjaxSampleController@index')->name('ajax_samples.index');

});
