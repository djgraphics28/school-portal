<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


Route::middleware('auth')->prefix('student')->group(function () {
    Volt::route('schedules', 'student.schedules.index')
    ->name('student.schedules');

    Volt::route('subjects', 'student.subjects.index')
        ->name('student.subjects');

    Volt::route('grades', 'student.grades.index')
        ->name('student.grades');

});
