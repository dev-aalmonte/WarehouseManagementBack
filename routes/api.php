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
    'user' => 'API\UserController',
]);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
