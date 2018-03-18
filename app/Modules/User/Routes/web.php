<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => 'user'], function () {
    Route::get('/home',['as'=>'home','uses'=>'UserController@home'] );
    Route::get('/add',['as'=>'user.add','uses'=>'UserController@home_add'] );
    Route::get('/role',['as'=>'role','uses'=>'RoleController@home'] );
    Route::get('/permission',['as'=>'permission','uses'=>'PermissionController@home'] );

    Route::group(['prefix' => 'api'], function () {
        Route::group(['prefix' => 'permission'], function () {
            Route::get('/getall_byrole/{id}',['as'=>'permission.anydata','uses'=>'PermissionApiController@getall_byrole'] );
            Route::get('/anydata',['as'=>'permission.anydata','uses'=>'PermissionApiController@anydata'] );
            Route::post('/',['as'=>'permission.add','uses'=>'PermissionApiController@store'] );
            Route::delete('/delete/{id}',['as'=>'permission.delete','uses'=>'PermissionApiController@delete'] );
        });
        Route::group(['prefix' => 'role'], function () {
            Route::get('/get',['as'=>'role.get','uses'=>'RoleApiController@get'] );
            Route::get('/get_byid/{id}',['as'=>'role.get','uses'=>'RoleApiController@get_byid'] );
            Route::get('/anydata',['as'=>'role.anydata','uses'=>'RoleApiController@anydata'] );
            Route::post('/',['as'=>'role.add','uses'=>'RoleApiController@store'] );
            Route::put('/{id}',['as'=>'role.add','uses'=>'RoleApiController@update'] );
            Route::delete('/delete/{id}',['as'=>'role.delete','uses'=>'RoleApiController@delete'] );
        });
        Route::group(['prefix' => 'user'], function () {
            Route::get('/anydata',['as'=>'role.anydata','uses'=>'RoleApiController@anydata'] );
            Route::post('/add',['as'=>'role.add','uses'=>'RoleApiController@store'] );
            Route::delete('/delete/{id}',['as'=>'role.delete','uses'=>'RoleApiController@delete'] );
        });
    });
});
