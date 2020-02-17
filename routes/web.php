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

Route::resource('person', 'PersonController');
Route::get('template/generate', 'TemplateController@getGenerate')->name('template.generate');
Route::post('template/{id}/updatename', 'TemplateController@updateName')->name('template.updatename');
Route::resource('template', 'TemplateController');
Route::resource('templatepart', 'TemplatePartController');
