<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|

*/
Route::apiResources([
    'addresses' => 'API\AddressController',
    'categories' => 'API\CategoryController',
    'clients' => 'API\ClientController',
    'orders' => 'API\OrderController',
    'products' => 'API\ProductController',
    'roles' => 'API\RoleController',
    'status' => 'API\StatusController',
    'users' => 'API\UserController',
    'warehouses' => 'API\WarehouseController'
]);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'API\UserController@Login');
Route::middleware('auth:api')->post('/logout', 'API\UserController@Logout');
