<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\HasApiTokens;


Route::get('/', function () {
    return view('pages.login');
});
Route::get('/register', function () {
    return view('pages.register');
});
Route::get('/post', function () {
    return view('pages.post');
})->name('post');
Route::get('/profile', function () {
    return view('pages.profile');
});
Route::get('/home', function () {
    return view('pages.home');
});
Route::post('/upload-photo', [PostController::class, 'store'])->name('upload.photo');





Route::post('/signin', [UserController::class,'authenticateUser'] );
Route::get('/users',[UserController::class,'getAllUsers']);
Route::post('/create-user',[UserController::class,'create']);
Route::post('/update-user/{id}',[UserController::class,'update']);
Route::delete('/delete-user/{id}',[UserController::class,'delete']);
Route::get('/show-user/{id}',[UserController::class,'show']);
Route::get('/categories',[CategoryController::class,'getAllCategories']);
Route::post('/create-categories',[CategoryController::class,'create']);
Route::post('/update-categories/{id}',[CategoryController::class,'update']);
Route::delete('/delete-categories/{id}',[CategoryController::class,'delete']);
Route::get('/show-categories/{id}',[CategoryController::class,'show']);
Route::get('/posts',[PostController::class,'getAllPosts']);
Route::post('/create-post',[PostController::class,'create']);
Route::post('/update-post/{id}',[PostController::class,'update']);
Route::delete('/delete-post/{id}',[PostController::class,'delete']);
Route::get('/show-post/{id}',[PostController::class,'show']);
Route::get('/comments',[CommentController::class,'getAllComments']);
Route::post('/create-comment',[CommentController::class,'create']);
Route::post('/update-commment/{id}',[CommentController::class,'update']);
Route::delete('/delete-comment/{id}',[CommentController::class,'delete']);
Route::get('/show-comment/{id}',[CommentController::class,'show']);
Route::get('/reactions',[ReactionController::class,'getAllReactions']);
Route::post('/create-rection',[ReactionController::class,'create']);
Route::post('/update-reaction/{id}',[ReactionController::class,'update']);
Route::delete('/delete-reaction/{id}',[ReactionController::class,'delete']);
Route::get('/show-reaction/{id}',[ReactionController::class,'show']);
Route::get('/shares',[ShareController::class,'getAllShares']);
Route::post('/create-share',[ShareController::class,'create']);
Route::post('/update-share/{id}',[ShareController::class,'update']);
Route::delete('/delete-share/{id}',[ShareController::class,'delete']);
Route::get('/show-share/{id}',[ShareController::class,'share']);
Route::post('/users/{userId}/shares/{shareId}', [ShareController::class, 'attachShareToUser']);
Route::get('/users/{userId}/shares', [ShareController::class, 'getUserShares']);