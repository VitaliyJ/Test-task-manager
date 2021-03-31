<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Helpers\APIResponseHelper;


Route::match(['put', 'patch'], '/tasks/{task}/complete', [TaskController::class, 'markComplete'])
    ->missing(function () {
        return APIResponseHelper::getFailedResponse('Record not found', 404);
    });

Route::apiResource('tasks', TaskController::class)
    ->except([
        'show',
    ])
    ->missing(function () {
        return APIResponseHelper::getFailedResponse('Record not found', 404);
    });

Route::fallback(function () {
    return APIResponseHelper::getFailedResponse('Method not found. Read API documentation.', 404);
});
