<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


Route::middleware('auth')->prefix('faculty')->group(function () {
    Volt::route('schedules', 'faculty.schedules.index')
    ->name('faculty.schedules');

});
