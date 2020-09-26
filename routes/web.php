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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/courses', 'CourseController@index')->name('courses.index');
Route::get('/courses/add', 'CourseController@create')->name('courses.form');
Route::post('/courses/add', 'CourseController@store')->name('courses.add');

Route::middleware('web')
    ->prefix(config('formbuilder.url_path', '/form-builder'))
    ->name('formbuilder::')
    ->group(function () {
        Route::redirect('/', url(config('formbuilder.url_path', '/form-builder') . '/forms'));

        /**
         * Public form url
         */
        Route::get('/form/{identifier}', 'RenderFormController@render')->name('form.render');
        Route::post('/form/{identifier}', 'RenderFormController@submit')->name('form.submit');
        Route::get('/form/{identifier}/feedback', 'RenderFormController@feedback')->name('form.feedback');

        /**
         * My submission routes
         */
        Route::resource('/my-submissions', 'MySubmissionController');

        /**
         * Form submission management routes
         */
        Route::name('forms.')
            ->prefix('/forms/{fid}')
            ->group(function () {
                Route::resource('/submissions', 'SubmissionController');
            });

        /**
         * Form management routes
         */
        Route::resource('/forms', 'FormController');
    });
