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

Route::group(['middleware' => ['web']], function () {

    Route::get('/', 'AngularController@serveApp');

    Route::get('/unsupported-browser', 'AngularController@unsupported');

    Route::get('/home', 'AngularController@home');

});


/**
 * to be remove
 */
Route::resource('milestones', 'MilestoneController');
Route::resource('projects', 'ProjectController');
Route::get('milestone/detailed/{milestone_id}', 'MilestoneController@showDetailed');
Route::get('profile', 'UserController@profile');
Route::get('isAdmin', 'UserController@isAdmin');
Route::resource('users', 'UserController');

Route::get('projects-beta', 'ProjectController@beta');

$api->version('v1', function($api) {
    //public API routes
    $api->group(['middleware' => ['api']], function ($api) {

        // Authentication Routes...
        $api->post('auth/login', 'Auth\AuthController@login');
        $api->post('auth/register', 'Auth\AuthController@register');

        // Password Reset Routes...
        $api->post('auth/password/email', 'Auth\PasswordResetController@sendResetLinkEmail');
        $api->get('auth/password/verify', 'Auth\PasswordResetController@verify');
        $api->post('auth/password/reset', 'Auth\PasswordResetController@reset');


    });
});

//protected API routes with JWT (must be logged in)
$api->group(['middleware' => ['api', 'api.auth']], function ($api) {
    
    // resourceful routes for projects
    $api->resource('projects', 'ProjectController');

    $api->get('milestone/detailed/{milestone_id}', 'MilestoneController@showDetailed');
    // resourceful routes for milestone
    $api->resource('milestones', 'MilestoneController');

    // resourceful routes for user
    $api->get('profile', 'UserController@profile');
    $api->get('isAdmin', 'UserController@isAdmin');
    $api->resource('users', 'UserController');

    // resourceful routes for MilestoneUser
    $api->resource('milestone-user', 'MilestoneUserController');

    $api->post('upload', 'UploadController@usersDisplayImage');

});
