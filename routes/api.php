<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

Route::group(['prefix' => 'unit'], function(){
    Route::get('', function(){
        $index = DB::table('units')->get();
        return response()->json($index, 200);
    });
    Route::post('add', 'ProductController@CreateUnit');
    Route::post('remove', 'ProductController@DeleteUnit');

});
