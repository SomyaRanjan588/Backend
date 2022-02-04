<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurdApiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\commentsController;
use App\Http\Controllers\tagController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Blogproject Curd Routes
 */

Route::get("data",[CurdApiController::class,"getData"]); 
Route::delete("delete/{id}",[CurdApiController::class,'getDelete']); 
// Route::get("/product/{id}",[ CurdApiController::class,'eachData']);

/**
 * Blogproject Login,Logout and register Routes
 */
Route::post("/register",[UserController::class,"registration"]);
Route::post("/login",[UserController::class,"login"]);
Route::middleware('auth:api')->post("/logout",[ UserController::class,'logout']);
Route::middleware('auth:api')->post("/save",[ CurdApiController::class,'saveData']);
Route::middleware('auth:api')->get("/show",[ CurdApiController::class,'showData']);
Route::middleware('auth:api')->get("/edit/{id}",[ CurdApiController::class,'editData']);
Route::middleware('auth:api')->post("/update/{id}",[ CurdApiController::class,'getUpdate']);
Route::middleware('auth:api')->get("/productdetails/{id}",[ CurdApiController::class,'eachData']);

// Route::group(["middleware"=>["protectedPage"]],function(){

// });

//Comments api 
Route::middleware('auth:api')->post("/comments",[ commentsController::class,'saveComment']);
Route::middleware('auth:api')->get("/showcomments",[ commentsController::class,'showComment']);


Route::middleware('auth:api')->post("/savetag",[ tagController::class,'saveTag']);
