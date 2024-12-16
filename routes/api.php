<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\Book\ExchangeController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\User\PermissionController;
use App\Http\Controllers\User\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

//user route
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/logout', action: [AuthController::class, 'logout']);
    Route::get('/users', action: [AuthController::class, 'users']);

    //permission routes
    Route::get('/permission/list', action: [PermissionController::class, 'list']);
    Route::post('/permission/create', action: [PermissionController::class, 'create']);
    Route::get('/permission/{id}/edit', action: [PermissionController::class, 'edit']);
    Route::post('/permission/{id}/update', action: [PermissionController::class, 'update']);
    Route::delete('/permission/{id}/delete', action: [PermissionController::class, 'destroy']);
    //role routes
    Route::get('/role/list', action: [RoleController::class, 'list']);
    Route::post('/role/create', action: [RoleController::class, 'create']);
    Route::get('/role/{id}/edit', action: [RoleController::class, 'edit']);
    Route::post('/role/{id}/update', action: [RoleController::class, 'update']);
    Route::delete('/role/{id}/delete', action: [RoleController::class, 'destroy']);
    //role assign user
    Route::post('/role/{id}/assign', action: [RoleController::class, 'assign']);
    //Customer route 
    Route::get('customer/list', [CustomerController::class, 'list']);

});

//customer route
Route::post('/customer/signup', [CustomerController::class, 'signup']);
Route::post('/customer/login', [CustomerController::class, 'login']);
Route::group(['middleware' => 'auth:customer-api'], function () {
    Route::get('/customer/logout', action: [CustomerController::class, 'logout']);
    Route::get('/customer/customer', action: [CustomerController::class, 'customer']);

    //book route
    Route::get('/customer/book/list', action: [BookController::class, 'list']);
    Route::post('/customer/book/create', action: [BookController::class, 'create']);
    Route::get('/customer/book/{id}/edit', action: [BookController::class, 'edit']);
    Route::post('/customer/book/{id}/update', action: [BookController::class, 'update']);
    Route::delete('/customer/book/{id}/delete', action: [BookController::class, 'destroy']);
    //book route
    Route::get('/customer/exchange/list', action: [ExchangeController::class, 'list']);
    Route::post('/customer/exchange/create', action: [ExchangeController::class, 'create']);
    Route::get('/customer/exchange/{id}/edit', action: [ExchangeController::class, 'edit']);
    Route::post('/customer/exchange/{id}/update', action: [ExchangeController::class, 'update']);
    Route::delete('/customer/exchange/{id}/delete', action: [ExchangeController::class, 'destroy']);
});

