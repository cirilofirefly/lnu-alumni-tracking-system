<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\v1\Admin\ {
    AlumniAccountController,
    AuthController as AdminAuthController,
    BatchController as AdminBatchController,
    CategoryController as AdminCategoryController,
    EventController as AdminEventController,
    DashboardController as AdminDashboardContainer,
    RecordController as AdminRecordController
};
use App\Http\Controllers\v1\BatchController;

use App\Http\Controllers\v1\Student\ {
    IDRequestController as StudentIDRequestController,
    AuthController as StudentAuthController,
    EventController as StudentEventController,
};
use App\Models\Student;

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
        Route::apiResource('events', AdminEventController::class);
        Route::get('event/{slug}', [AdminEventController::class, 'show']);
        Route::apiResource('batches', AdminBatchController::class)->only(['index', 'store', 'destroy']);
        Route::get('categories', [AdminCategoryController::class, 'index']);
        Route::get('total-alumni-by-batch', [AdminDashboardContainer::class, 'totalAlumni']);
        Route::get('total-batch', [AdminDashboardContainer::class, 'totalBatch']);
        Route::get('total-alumni-records', [AdminDashboardContainer::class, 'totalAlumniRecords']);
        Route::get('records', [AdminRecordController::class, 'index']);
        Route::get('record/{id}', [AdminRecordController::class, 'show']);
    });

    Route::group(['prefix' => 'student'], function () {
        Route::get('event/{slug}', [StudentEventController::class, 'show']);
        Route::get('events', [StudentEventController::class, 'index']);
        Route::get('latest-event', [StudentEventController::class, 'latestEvent']);
        Route::get('id-student-account/{id}', [StudentIDRequestController::class, 'show']);
        Route::put('update-student-account', [StudentIDRequestController::class, 'updateAccount']);
        Route::post('upload-image', [StudentIDRequestController::class, 'uploadImage']);
        Route::get('get-comments', [StudentEventController::class, 'getComments']);
        Route::post('post-comment', [StudentEventController::class, 'postComment']);

    });

});


Route::get('batches', [BatchController::class, 'index']);