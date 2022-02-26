<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\v1\Admin\ {
    AlumniAccountController,
    AuthController as AdminAuthController,
    CategoryController as AdminCategoryController,
    EventController as AdminEventController
};

use App\Http\Controllers\v1\Student\ {
    AuthController as StudentAuthController
};


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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::group(['prefix' => 'admin'], function (){
        Route::post('login', [AdminAuthController::class, 'login']);
        Route::post('logout', [AdminAuthController::class, 'logout']);
        Route::post('me', [AdminAuthController::class, 'me']);
    });

    Route::group(['prefix' => 'student'], function (){
        Route::post('signup', [StudentAuthController::class, 'signup']);
        Route::post('login', [StudentAuthController::class, 'login']);
        Route::post('logout', [StudentAuthController::class, 'logout']);
        Route::post('me', [StudentAuthController::class, 'me']);
    });

});



Route::group(['middleware' => 'api'], function (){

    Route::group(['prefix' => 'admin'], function () {
        Route::put('approve-alumni/{id}', [AlumniAccountController::class, 'approveAccount']);
        Route::put('disapprove-alumni/{id}', [AlumniAccountController::class, 'disapproveAccount']);
        Route::get('alumnae', [AlumniAccountController::class, 'index']);
        Route::apiResource('events', AdminEventController::class)->except('show');
        Route::get('categories', [AdminCategoryController::class, 'index']);
    });

    
});