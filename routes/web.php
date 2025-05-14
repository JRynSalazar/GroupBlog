<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DiscriminationTypeController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;
use App\Http\Middleware\EnsureUserIsAuthenticated;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PostCommentReplyController;
use App\Http\Controllers\AdminController;
use App\Models\User;


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Route::get('/child/profile', [AuthController::class, 'userDashboard'])->name('child.profile');
// Route::post('/updateProfile', [AuthController::class, 'updateProfileImage'])->name('updateProfileImage');



Route::middleware(['auth'])->group(function () {
    Route::get('/child/profile', [UserController::class, 'userDashboard'])->name('user.dashboard');
    Route::post('/profile/updateProfile', [UserController::class, 'updateProfileImage'])->name('user.updateProfileImage');
    Route::put('/profile/update', [UserController::class, 'update'])->name('profile.update');

    Route::post('/post-comment/{post_id}/reply', [PostCommentReplyController::class, 'store'])
    // ->middleware('auth') 
    ->name('post-comment.reply');

    Route::post('/post-comment/{post_id}/like', [LikeController::class, 'toggleLike'])
    // ->middleware('auth')
    ->name('post-comment.like');
    
    // Route::get('/add-article', function () {
    //     return view('admin.addarticle');
    // })->name('admin.addarticle');
    

});

Route::resource('media', MediaController::class);
// Route::get('/news', function () {
//     return view('blog.news');
// })->name('blog.news');

Route::get('/question', function () {
    return view('blog.questions');
})->name('blog.questions');


Route::get('/media/{id?}', [MediaController::class, 'show'])->name('media.show');


Route::get('/', function () {
    return view('user.udashboard');
})->name('user.udashboard');

// Route::get('/{name}', function ($name) {
//     return view('user.udashboard', compact('name'));
// })->where('name', '[A-Za-z]+');







Route::get('/admin/dashboard/{name?}', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard')
    ->middleware('auth'); // Ensures only authenticated users can access




Route::prefix('blog')->group(function () {
    Route::get('/article', [MediaController::class, 'index'])->name('blog.article');
    Route::get('/news', [NewsController::class, 'index'])->name('blog.news');
    // Route::get('/news', [NewsController::class, 'showNews'])->name('blog.news');
    Route::get('/forum', [PostCommentController::class, 'index'])->name('blog.forum');
    Route::get('/allpost', [PostCommentController::class, 'allPosts'])->name('blog.allpost');
});

Route::resource('discrimination-type', DiscriminationTypeController::class);
Route::resource('post-comment', PostCommentController::class);

Route::group(['prefix' => 'child','as' => 'child.'], function () {
    Route::get('/aboutus', [ChildController::class, 'aboutUs'])->name('aboutus');
    Route::get('/profile', [ChildController::class, 'profile'])->name('profile');
});

