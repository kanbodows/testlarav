<?php
Route::when('*','detectLang');
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('role', 'Role');
Route::model('video', 'Video');

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('user', '[0-9]+');
Route::pattern('role', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');
Route::pattern('video', '[0-9]+');

/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{
    # User Management
    Route::get('users/{user}/show', 'AdminUsersController@getShow');
    Route::get('users/{user}/edit', 'AdminUsersController@getEdit');
    Route::post('users/{user}/edit', 'AdminUsersController@postEdit');
    Route::get('users/{user}/delete', 'AdminUsersController@getDelete');
    Route::post('users/{user}/delete', 'AdminUsersController@postDelete');
    Route::controller('users', 'AdminUsersController');

    # User Role Management
    Route::get('roles/{role}/show', 'AdminRolesController@getShow');
    Route::get('roles/{role}/edit', 'AdminRolesController@getEdit');
    Route::post('roles/{role}/edit', 'AdminRolesController@postEdit');
    Route::get('roles/{role}/delete', 'AdminRolesController@getDelete');
    Route::post('roles/{role}/delete', 'AdminRolesController@postDelete');
    Route::controller('roles', 'AdminRolesController');
    
    # Video Management  
    Route::get('videos/{video}/show', 'AdminVideosController@getShow');
//    Route::get('videos/editlist', 'AdminVideosController@getEditlist');
    Route::get('videos/{video}/edit', 'AdminVideosController@getEdit');
    Route::post('videos/{video}/edit', 'AdminVideosController@postEdit');
    Route::get('videos/{video}/delete', 'AdminVideosController@getDelete');
    Route::post('videos/{video}/delete', 'AdminVideosController@postDelete');
    Route::get('videos/{video}/moderate', 'AdminVideosController@getModerate');
    Route::post('videos/{video}/moderate', 'AdminVideosController@postModerate');
    Route::controller('videos', 'AdminVideosController');
    # Admin Dashboard
    Route::controller('/', 'AdminDashboardController');
});


/** ------------------------------------------
 *  Frontend Routes
 *  ------------------------------------------
 */

// User reset routes
Route::get('user/reset/{token}', 'UserController@getReset');
// User password reset
Route::post('user/reset/{token}', 'UserController@postReset');
//:: User Account Routes ::
Route::post('user/{user}/edit', 'UserController@postEdit');

//:: User Account Routes ::
Route::post('user/login', 'UserController@postLogin');

# User RESTful Routes (Login, Logout, Register, etc)
Route::controller('user', 'UserController');

//:: Application Routes ::

# Filter for detect language
Route::when('contact-us','detectLang');

# Contact Us Static Page
Route::get('contact-us', function()
{
    // Return about us page
    return View::make('site/contact-us');
});


# Index Page - Last route, no matches
Route::get('/', array('before' => 'detectLang','uses' => 'AdminVideosController@getIndexModerated'));
//Route::get('videos/v', 'AdminVideosController@getIndexAll');

Route::get('videos/v', 'AdminVideosController@getIndexModerated');
Route::get('videos/v/create2', 'AdminVideosController@getCreate2');
Route::post('videos/v/create2', 'AdminVideosController@postCreate2');
//Route::get('videos/create', 'AdminVideosController@getEdit');


//Route::get('admin/videos', 'AdminVideosController@getIndex');