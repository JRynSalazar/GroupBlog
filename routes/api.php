<?php

use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\Api\ApiCommentController;
use App\Http\Controllers\Api\ApiCommentReplyController;
use App\Http\Controllers\Api\ApiLikeController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [ApiUserController::class, 'store']);
Route::post('/login', [ApiUserController::class, 'login']);
Route::get('/users', [ApiUserController::class, 'index']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users/{id}', [ApiUserController::class, 'show']);
    Route::put('/users/{id}', [ApiUserController::class, 'update']);
    Route::delete('/users/{id}', [ApiUserController::class, 'destroy']);
    Route::post('/logout', [ApiUserController::class, 'logout']);

    Route::apiResource('comments', ApiCommentController::class);
    Route::put('comments/{id}', [ApiCommentController::class, 'update']);

    Route::post('/like', [ApiLikeController::class, 'toggleLike']);
    Route::get('/like/{postId}', [ApiLikeController::class, 'getLikes']);
    // Route::get('/comments/{postId}/likes', [ApiCommentController::class, 'getLikes']);

    Route::post('/comments/reply', [ApiCommentReplyController::class, 'storeReply']);
    Route::put('/comments/reply/{id}', [ApiCommentReplyController::class, 'updateReply']);
    Route::delete('/comments/reply/{id}', [ApiCommentReplyController::class, 'deleteReply']);
    Route::get('/comments/{postId}/replies', [ApiCommentReplyController::class, 'getRepliesByPost']);
});
