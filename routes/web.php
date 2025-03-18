<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth','check.active', 'verified'])
    ->name('dashboard');

Route::middleware(['auth','check.active'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Volt::route('users', 'users.index')->name('users');
    Volt::route('roles', 'roles.index')->name('roles');
    Volt::route('school-year-and-semester', 'schoolyearandsemester.index')->name('schoolyearandsemester');
});

Route::group(['prefix' => 'student','middleware' => ['auth', 'check.active', 'verified']], function() {
    Volt::route('/home', 'student.dashboard')->name('student.dashboard');
});

require __DIR__.'/auth.php';
