<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\v1\Admin\{
    AlumniAccountController,
    AlumniIdRequestController,
    AuthController as AdminAuthController,
    FeedbackController as AdminFeedbackController,
    BatchController as AdminBatchController,
    CategoryController as AdminCategoryController,
    EventController as AdminEventController,
    DashboardController as AdminDashboardContainer,
    RecordController as AdminRecordController,
    AdminNotificationController
};
use App\Http\Controllers\v1\BatchController;
use App\Http\Controllers\v1\DownloadController;

use App\Http\Controllers\v1\Student\{
    IDRequestController as StudentIDRequestController,
    AuthController as StudentAuthController,
    EventController as StudentEventController,
    FeedbackController as StudentFeedbackController,
    CompanyController,
    ElegibilityController,
    Employee\ElegibilityController as EmployeeElegibilityController,
    Employee\SeminarController as EmployeeSeminarController,
    SeminarController,
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
    Route::group(['prefix' => 'admin'], function () {
        Route::post('login', [AdminAuthController::class, 'login']);
        Route::post('logout', [AdminAuthController::class, 'logout']);
        Route::put('change-password', [AdminAuthController::class, 'changePassword']);
        Route::put('update-account', [AdminAuthController::class, 'updateAccount']);
        Route::post('me', [AdminAuthController::class, 'me']);
    });
    Route::group(['prefix' => 'student'], function () {
        Route::post('signup', [StudentAuthController::class, 'signup']);
        Route::post('login', [StudentAuthController::class, 'login']);
        Route::post('logout', [StudentAuthController::class, 'logout']);
        Route::post('me', [StudentAuthController::class, 'me']);
        Route::put('change-password', [StudentAuthController::class, 'changePassword']);
    });
});

Route::group(['middleware' => 'api'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::put('approve-alumni/{id}', [AlumniAccountController::class, 'approveAccount']);
        Route::put('disapprove-alumni/{id}', [AlumniAccountController::class, 'disapproveAccount']);
        Route::get('alumnae', [AlumniAccountController::class, 'index']);
        Route::apiResource('events', AdminEventController::class);
        Route::get('event/{slug}', [AdminEventController::class, 'show']);
        Route::apiResource('batches', AdminBatchController::class)->only(['index', 'store', 'destroy']);
        Route::get('get-students-by-batch', [AdminBatchController::class, 'getStudents']);
        Route::get('categories', [AdminCategoryController::class, 'index']);
        Route::get('total-alumni-by-batch', [AdminDashboardContainer::class, 'totalAlumni']);
        Route::get('total-batch', [AdminDashboardContainer::class, 'totalBatch']);
        Route::get('total-batch', [AdminDashboardContainer::class, 'totalBatch']);
        Route::get('total-alumni-records', [AdminDashboardContainer::class, 'totalAlumniRecords']);
        Route::get('total-alumni-application', [AdminDashboardContainer::class, 'totalAlumniApplication']);
        Route::get('records', [AdminRecordController::class, 'index']);
        Route::get('record/{id}', [AdminRecordController::class, 'show']);
        Route::get('get-feedbacks', [AdminFeedbackController::class, 'index']);
        Route::get('send-feedback/{id}', [AdminFeedbackController::class, 'store']);
        Route::get('get-notification', [AdminNotificationController::class, 'index']);
        Route::put('update-notification', [AdminNotificationController::class, 'update']);
        Route::post('notification', [AdminNotificationController::class, 'store']);
        Route::get('get-count-notif', [AdminNotificationController::class, 'countNotification']);
        Route::get('get-student-id-requests/{type}', [AlumniIdRequestController::class, 'getStudentIDRequests']);
        Route::get('get-student-id-request/{id}', [AlumniIdRequestController::class, 'getStudentIDRequest']);
        Route::post('approve-student-id-request/{id}', [AlumniIdRequestController::class, 'approveStudentIDRequest']);
        Route::post('disapprove-student-id-request/{id}', [AlumniIdRequestController::class, 'disapproveStudentIDRequest']);
        Route::post('send-message/{id}', [AdminFeedbackController::class, 'sendMessage']);
        Route::get('get-feedback/{id}', [AdminFeedbackController::class, 'getFeedback']);
        Route::post('send-message/{id}', [AdminFeedbackController::class, 'sendMessage']);
        Route::get('/download', [DownloadController::class, 'download']);
    });
    Route::group(['prefix' => 'student'], function () {
        Route::get('event/{slug}', [StudentEventController::class, 'show']);
        Route::get('events', [StudentEventController::class, 'index']);
        Route::get('latest-event', [StudentEventController::class, 'latestEvent']);
        Route::get('id-student-account/{id}', [StudentIDRequestController::class, 'show']);
        Route::get('request-logs/{id}', [StudentIDRequestController::class, 'requestLogs']);
        Route::put('update-student-account', [StudentIDRequestController::class, 'updateAccount']);
        Route::post('upload-image', [StudentIDRequestController::class, 'uploadImage']);
        Route::post('upload-signature', [StudentIDRequestController::class, 'uploadSignature']);
        Route::post('send-id-request', [StudentIDRequestController::class, 'sendIdRequest']);
        Route::get('get-comments', [StudentEventController::class, 'getComments']);
        Route::post('post-comment', [StudentEventController::class, 'postComment']);
        Route::delete('delete-comment/{event_id}', [StudentEventController::class, 'deleteComment']);
        Route::get('get-feedbacks', [StudentFeedbackController::class, 'getFeedbacks']);
        Route::post('send-feedback', [StudentFeedbackController::class, 'sendFeedback']);
        Route::get('get-feedback/{id}', [StudentFeedbackController::class, 'getFeedback']);
        Route::post('send-message/{id}', [StudentFeedbackController::class, 'sendMessage']);

        Route::post('companies', [CompanyController::class, 'store']);
        Route::get('companies', [CompanyController::class, 'index']);
        Route::post('elegibilities', [ElegibilityController::class, 'store']);
        Route::get('elegibilities', [ElegibilityController::class, 'index']);
        Route::post('seminars', [SeminarController::class, 'store']);
        Route::get('seminars', [SeminarController::class, 'index']);
    });
});


Route::get('batches', [BatchController::class, 'index']);

Route::get('latest-event', [StudentEventController::class, 'latestEventLanding']);
