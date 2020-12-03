<?php

use Illuminate\Support\Facades\Route;

// need to be pulled in manually
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TweetsController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\TweetLikesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// so the public or guest cannot accessed with out login

Route::middleware('auth')->group(function() {

    // explore page, we make invokeable controller
    // invokeable contoller is a controller that only has single action
    Route::get('/explore', ExploreController::class);

    Route::get('/tweets', [TweetsController::class, 'index'])->name('home');
    Route::post('/tweets', [TweetsController::class, 'store']);

    // end point for likes and dislike
    Route::post('/tweets/{tweet}/like', [TweetLikesController::class, 'store']);
    Route::delete('/tweets/{tweet}/like', [TweetLikesController::class, 'destroy']);

    // :name is specify which attribute we're looking
    Route::post('/profiles/{user:username}/follow', [FollowsController::class, 'store']);
    Route::get('profiles/{user:username}/edit', [ProfilesController::class, 'edit'])->middleware('can:edit,user'); // ('can:edit, name') user is the wildcard
    // if you are using this authentication on this route, then there is no need to be authenticate on the controller

    Route::patch('/profiles/{user:username}', [ProfilesController::class, 'update'])->middleware('can:edit,user');

});




Route::get('/profiles/{user:username}', [ProfilesController::class, 'show'])->name('profile');

Auth::routes();





