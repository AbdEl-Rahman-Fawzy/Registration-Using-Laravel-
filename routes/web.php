<?php
use App\Http\Controllers\BirthdayController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'store']);

Route::get('/index.html', function () {
    return view('front.index');
});
Route::get('/', function () {
    return view('front.welcome');
});
Route ::get('/CelebritiesBornToday',[BirthdayController::class,'showForm']);
Route::post('/CelebritiesBornToday',[BirthdayController::class,'GetCelebrities']);