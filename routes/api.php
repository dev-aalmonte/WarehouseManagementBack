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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('cors')->group(function () {
    Route::apiResources([
        'addresses' => 'API\AddressController',
        'categories' => 'API\CategoryController',
        'clients' => 'API\ClientController',
        'orders' => 'API\OrderController',
        'orderdetail' => 'API\OrderDetailController',
        'orderuser' => 'API\OrderUserController',
        'products' => 'API\ProductController',
        'roles' => 'API\RoleController',
        'status' => 'API\StatusController',
        'users' => 'API\UserController',
        'warehouses' => 'API\WarehouseController',
        'stock' => 'API\StockController',
        'location' => 'API\LocationController'
    ]);

    Route::post('/login', 'API\UserController@Login');
    Route::post('/logout', 'API\UserController@Logout');

    Route::get('/warehouses_location', 'API\WarehouseController@getLocations');
    Route::post('/warehouses/location', 'API\WarehouseController@storeLocation');

    Route::get('/stock/location/{stock}', 'API\StockController@getLocations');

    Route::get('/location/section/{warehouse}', 'API\LocationController@getSections');
    Route::get('/location/aisle/{section}', 'API\LocationController@getAisles');
    Route::get('/location/column/{aisle}', 'API\LocationController@getColumns');
    Route::get('/location/row/{column}', 'API\LocationController@getRows');
    Route::get('/location/item/{row}', 'API\LocationController@getItems');
    Route::post('/location/item', 'API\LocationController@storeItemToLocation');

    Route::get('/user/token/{token}', 'API\UserController@showByToken');

    Route::post('/orderdetails/update', 'API\OrderDetailController@updateStatus');

    // Upload Files
    Route::post('/upload/product/{product}', 'API\ProductController@uploadImage');

});

