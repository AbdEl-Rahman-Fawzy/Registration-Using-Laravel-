<?php
use App\Http\Controllers\BirthdayController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;


Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'store']);

Route::get('/index', function () {
    return view('front.index');
});
Route::get('/', function () {
    return view('front.welcome');
});
Route::get('/AR', function () {
    return view('front.indexAR');
});
Route ::get('/CelebritiesBornToday',[BirthdayController::class,'showForm']);
Route::post('/CelebritiesBornToday',[BirthdayController::class,'GetCelebrities']);

Route :: get('/send-email/{email}',[MailController::class,'sendEmail']);
Route::get('/test-email-config', function () {
    return [
        'from_address' => config('mail.from.address'),
        'from_name' => config('mail.from.name'),
    ];
});
