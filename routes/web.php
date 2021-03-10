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
    return view('master');
});
Route::get('login', 'UserController@login')->name('login');
Route::post('do-login', 'UserController@doLogin');
Route::post('forgot-pass', "UserController@forgotPass");
Route::get('logout', "UserController@logout");
Route::group(['middleware'=>'auth'], function(){
    Route::get('/','HomeController@index')->name('home');
    Route::group(['prefix'=>'users', 'as'=>'users.'], function(){
        Route::get('getDataAjax', 'UserController@getDataAjax');
        Route::get('multiDelete', 'UserController@multiDelete')->middleware(['createPermission:users.delete_multi', 'can:users.delete_multi']);
        Route::get('/','UserController@index');
        Route::post('store','UserController@store')->middleware(['createPermission:users.create', 'can:users.create']);
        Route::post('update/{id}','UserController@update')->middleware(['createPermission:users.edit','can:users.edit']);
        Route::delete('delete/{id}','UserController@destroy')->middleware(['createPermission:users.delete','can:users.delete']);

        Route::get('change-profile', 'UserController@changeProfile');
        Route::post('do-change-profile', 'UserController@changeProfileHanding');
        Route::get('change-password', 'UserController@changePassword');
        Route::post('do-change-password', 'UserController@changePasswordHanding');
        Route::post('upload-image', 'UserController@uploadImage');
    });

    Route::group(['prefix'=>'department', 'as'=>'department.'], function(){
        Route::get('getDataAjax', 'DepartmentController@getDataAjax');
        Route::delete('multiDelete', 'DepartmentController@multiDelete')->middleware(['createPermission:department.delete_multi','can:department.delete_multi']);
        Route::get('/','DepartmentController@index');
        Route::post('store','DepartmentController@store')->middleware(['createPermission:department.create','can:department.create']);
        Route::put('edit/{id}','DepartmentController@update')->middleware(['createPermission:department.edit','can:department.edit']);
        Route::delete('delete/{id}','DepartmentController@destroy')->middleware(['createPermission:department.delete','can:department.delete']);
    });

    Route::group(['prefix'=>'roles', 'as'=>'roles.'], function(){
        Route::get('getDataAjax', 'RoleController@getDataAjax');
        Route::post('getRoleById/{id}', 'RoleController@getRoleById');
        Route::get('multiDelete', 'RoleController@multiDelete')->middleware(['createPermission:roles.delete_multi','can:roles.delete_multi']);
        Route::get('/','RoleController@index');
        Route::post('store','RoleController@store')->middleware(['createPermission:roles.create','can:roles.create']);
        Route::post('update/{id}','RoleController@update')->middleware(['createPermission:roles.edit','can:roles.edit']);
        Route::delete('delete/{id}','RoleController@destroy')->middleware(['createPermission:roles.delete','can:roles.delete']);
    });

    Route::group(['prefix'=>'districts', 'use'=>'districts.'], function(){
        Route::get('getDataAjax', 'DistrictController@getDataAjax');
        Route::get('multiDelete','DistrictController@multiDelete')->middleware(['createPermission:districts.delete_multi','can:districts.delete_multi']);
        Route::get('', 'DistrictController@index');
        Route::post('store', 'DistrictController@store')->middleware(['createPermission:districts.store','can:districts.store']);;
        Route::post('update/{id}', 'DistrictController@update')->middleware(['createPermission:districts.edit','can:districts.edit']);;
        Route::delete('delete/{id}', 'DistrictController@destroy')->middleware(['createPermission:districts.delete','can:districts.delete']);;
    });
    Route::group(['prefix'=>'wards', 'use'=>'wards.'], function(){
        Route::get('getDataAjax', 'WardController@getDataAjax');
        Route::get('multiDelete','WardController@multiDelete')->middleware(['createPermission:wards.delete_multi','can:wards.delete_multi']);;
        Route::get('', 'WardController@index');
        Route::post('store', 'WardController@store')->middleware(['createPermission:wards.store','can:wards.store']);
        Route::post('update/{id}', 'WardController@update')->middleware(['createPermission:wards.edit','can:wards.edit']);
        Route::delete('delete/{id}', 'WardController@destroy')->middleware(['createPermission:wards.delete','can:wards.delete']);
    });

    Route::group(['prefix'=>'processing-levels', 'use'=>'processing-levels.'], function(){
        Route::get('getDataAjax', 'ProcessingLevelController@getDataAjax');
        Route::get('multiDelete','ProcessingLevelController@multiDelete')->middleware(['createPermission:processing-levels.delete_multi','can:processing-levels.delete_multi']);
        Route::get('', 'ProcessingLevelController@index');
        Route::post('store', 'ProcessingLevelController@store')->middleware(['createPermission:processing-levels.store','can:processing-levels.store']);
        Route::post('update/{id}', 'ProcessingLevelController@update')->middleware(['createPermission:processing-levels.edit','can:processing-levels.edit']);
        Route::delete('delete/{id}', 'ProcessingLevelController@destroy')->middleware(['createPermission:processing-levels.delete','can:processing-levels.delete']);
    });

    Route::group(['prefix'=>'form-violates', 'use'=>'form-violates.'], function(){
        Route::get('getDataAjax', 'FormViolateController@getDataAjax');
        Route::get('multiDelete','FormViolateController@multiDelete')->middleware(['createPermission:form-violates.delete_multi','can:form-violates.delete_multi']);
        Route::get('', 'FormViolateController@index');
        Route::post('store', 'FormViolateController@store')->middleware(['createPermission:form-violates.store','can:form-violates.store']);
        Route::post('update/{id}', 'FormViolateController@update')->middleware(['createPermission:form-violates.edit','can:form-violates.edit']);
        Route::delete('delete/{id}', 'FormViolateController@destroy')->middleware(['createPermission:form-violates.delete','can:form-violates.delete']);
    });

    Route::group(['prefix'=>'error-violates', 'use'=>'error-violates.'], function(){
        Route::get('getDataAjax', 'ErrorViolateController@getDataAjax');
        Route::get('multiDelete','ErrorViolateController@multiDelete')->middleware(['createPermission:error-violates.delete_multi','can:error-violates.delete_multi']);
        Route::get('', 'ErrorViolateController@index');
        Route::post('store', 'ErrorViolateController@store')->middleware(['createPermission:error-violates.store','can:error-violates.store']);
        Route::post('update/{id}', 'ErrorViolateController@update')->middleware(['createPermission:error-violates.edit','can:error-violates.edit']);
        Route::delete('delete/{id}', 'ErrorViolateController@destroy')->middleware(['createPermission:error-violates.delete','can:error-violates.delete']);
    });

    Route::group(['prefix'=>'type-investments', 'use'=>'type-investments.'], function(){
        Route::get('getDataAjax', 'TypeInvestmentController@getDataAjax');
        Route::get('multiDelete','TypeInvestmentController@multiDelete')->middleware(['createPermission:type-investments.delete_multi','can:type-investments.delete_multi']);;
        Route::get('', 'TypeInvestmentController@index');
        Route::post('store', 'TypeInvestmentController@store')->middleware(['createPermission:type-investments.store','can:type-investments.store']);
        Route::post('update/{id}', 'TypeInvestmentController@update')->middleware(['createPermission:type-investments.edit','can:type-investments.edit']);
        Route::delete('delete/{id}', 'TypeInvestmentController@destroy')->middleware(['createPermission:type-investments.delete','can:type-investments.delete']);
    });

    Route::group(['prefix'=>'business', 'use'=>'business.'], function(){
        Route::get('getDataAjax', 'BussinesController@getDataAjax');
        Route::get('multiDelete','BussinesController@multiDelete')->middleware(['createPermission:business.delete_multi']);
        Route::get('', 'BussinesController@index');
        Route::get("create",'BussinesController@create');
        Route::post('store', 'BussinesController@store')->middleware(['createPermission:business.store']);
        Route::get("edit/{id}",'BussinesController@edit');
        Route::post('update/{id}', 'BussinesController@update')->middleware(['createPermission:business.edit']);
        Route::delete('delete/{id}', 'BussinesController@destroy')->middleware(['createPermission:business.delete']);

        Route::post("getDataById",'BussinesController@getDataById');
    });
    Route::group(['prefix'=>'violates', 'use'=>'violates.'], function(){
        Route::get('getDataAjax', 'ViolateController@getDataAjax');
        Route::get('multiDelete','ViolateController@multiDelete');
        Route::get('', 'ViolateController@index');
        Route::get("create",'ViolateController@create');
        Route::post('store', 'ViolateController@store');
        Route::get("edit/{id}",'ViolateController@edit');
        Route::post('update/{id}', 'ViolateController@update');
        Route::delete('delete/{id}', 'ViolateController@destroy');
        Route::post('get-data-by-busines/{id}', 'ViolateController@getDataByBusines');
    });
});
