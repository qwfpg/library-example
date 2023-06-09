<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImportBooksController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'welcome')->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
    Route::post('comments', [CommentController::class, 'store'])->name('comments.store');
});


Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth', 'employee']
], function () {
    Route::get('/', function () {
        return redirect()->route('books.index');
    });
    Route::resource('books', BookController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
    Route::post('import-books', [ImportBooksController::class, 'import'])->name('import-books');
});

Route::get('', [PageController::class, 'getHomePage'])->name('home');
Route::get('/books/{slug}', [PageController::class, 'getBookShowPage'])->name('site-books.show');
Route::get('/categories', [PageController::class, 'getCategoryIndexPage'])->name('site-categories.index');
Route::get('/books/categories/{slug}', [PageController::class, 'getBooksIndexPageByCategorySlug'])->name('category-books.index');
