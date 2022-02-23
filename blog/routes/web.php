<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SocialController;
// use App\Http\Controllers\Auth\;
// use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


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
    return view('home');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');
Route::get('/posts/welcome', [PostController::class, 'welcome'])->name('posts.welcome')->middleware('auth');

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::POST('/posts/store', [PostController::class, 'store'])->name('posts.store')->middleware('auth');

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show')->middleware('auth');

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');
Route::PUT('/posts/{post}', [PostController::class, 'update'])->name('posts.update')->middleware('auth');

Route::DELETE('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// GITHUB
Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('github.login');

Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->stateless()->user();
    $user = User::where('github_id', $githubUser->id)->first();

    if ($user) {
        $user->update([
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
    } else {
        $user = User::create([
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'github_id' => $githubUser->id,
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
    }

    Auth::login($user);

    return redirect('/posts/welcome');
});


//GOOGLE
Route::get('/auth/googleredirect', function () {
    return Socialite::driver('google')->redirect();
})->name('google.login');

Route::get('/auth/googlecallback', function () {
    $googleUser = Socialite::driver('google')->stateless()->user();
    $user = User::where('google_id', $googleUser->id)->first();

    if ($user) {
        $user->update([
            'google_token' => $googleUser->token,
        ]);
    } else {
        $user = User::create([
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'google_id' => $googleUser->id,
            'google_token' => $googleUser->token,
        ]);
    }

    Auth::login($user);

    return redirect('/posts/welcome');
});
