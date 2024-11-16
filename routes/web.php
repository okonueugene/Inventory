<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::group(
    ['namespace' => 'App\Http\Controllers'],
    function () {
        Route::get('/', 'Auth\LoginController@index')->name('home');
        Route::post('/login', 'Auth\AuthenticationController@loginUser')->name('loginUser');
        Route::get('/register', 'Auth\AuthenticationController@register')->name('register');
        Route::post('/registerUser', 'Auth\AuthenticationController@registerUser')->name('registerUser');
        Route::get('/forgot-password', 'Auth\AuthenticationController@forgotPassword')->name('forgot-password');
        Route::post('/forgot-password-email', 'Auth\AuthenticationController@sendResetLinkEmail')->name('forgot-password-email');
        Route::get('/reset-password/{token}', 'Auth\AuthenticationController@resetPassword')->name('reset-password-form');
        Route::post('/reset-password', 'Auth\AuthenticationController@reset')->name('reset-password');
        Route::get('/logout', 'Auth\AuthenticationController@logout')->name('logout');
        Route::group(['middleware' => ['auth', 'read.notification']], function () {

            //Admin routes
            Route::group([
                'prefix' => 'admin',
                'middleware' => 'admin',
            ], function () {

                Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');

                Route::resource('/categories', 'Admin\CategoryController');
                Route::resource('/employees', 'Admin\EmployeesController');
                Route::resource('/assets', 'Admin\AssetController');
                Route::resource('/audits', 'Admin\AuditsController');
                Route::resource('/users', 'Admin\UserController');

                //Dashboard assets
                Route::get('/get-latest-assets', 'Admin\DashboardController@getLatestAssets')->name('get-latest-assets');

                //export and import
                Route::get('/export-employees', 'Admin\EmployeesController@export')->name('export-employees');
                Route::post('/import-employees', 'Admin\EmployeesController@import')->name('import-employees');

            }
            );

        });
    }
);
