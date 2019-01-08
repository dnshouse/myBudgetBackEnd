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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    $user = \Illuminate\Support\Facades\Auth::user();
//    return response()->json($user, 200);
//});
//
//Route::get('categories', 'CategoryController@index');
//Route::get('categories/{category}', 'CategoryController@show');
//Route::post('categories','CategoryController@store');
//Route::put('categories/{category}','CategoryController@update');
//Route::delete('categories/{category}', 'CategoryController@destroy');

Route::middleware('auth:api')->group(function () {
    Route::apiResources([
        'categories' => 'CategoryController',
        'budgets' => 'BudgetController',
        'accounts' => 'AccountController',
        'transactions' => 'TransactionController',
    ]);
});