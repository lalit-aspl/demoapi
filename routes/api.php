<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MeetingController;

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

Route::post('meeting', [MeetingController::class, 'store']);
Route::get('userList', [MeetingController::class, 'userList']);
Route::post('sendInvitation', [MeetingController::class, 'sendInvitation']);
Route::post('meetingstatus', [MeetingController::class, 'meetingstatus']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
