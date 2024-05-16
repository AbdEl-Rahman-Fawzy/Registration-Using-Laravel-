<?php

use App\Http\Controllers\BirthdayController;
use Illuminate\Support\Facades\Route;
Route ::get('/CelebritiesBornToday',[BirthdayController::class,'showForm']);