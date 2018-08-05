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

    $roles = \App\Role::with('perms')->get();

    foreach ($roles as $role) {
        echo "<b>$role->name<br></b>";

        foreach ($role->perms as $perm) {
            echo "#$perm->id $perm->name<br>";
        }
    }
    return;
    return view('welcome');
});

Auth::routes();
Route::post('graphql/login', 'AuthenticateController@authenticate');
Route::get('/home', 'HomeController@index');
