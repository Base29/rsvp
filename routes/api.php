<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

use App\Http\Controllers\InvitationController;

Route::get('invitations', [InvitationController::class, 'index']);

Route::post('update', [InvitationController::class, 'update']);

Route::post('invitation', [InvitationController::class, 'show']);