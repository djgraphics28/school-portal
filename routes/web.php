<?php

use Livewire\Volt\Volt;
use App\Livewire\TwoFactorVerify;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return redirect()->route('login');
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth','check.active', 'verified','2fa'])
    ->name('dashboard');

Route::middleware(['auth','check.active','2fa'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
    Volt::route('settings/2fa-config', 'settings.two-factor-authentication')->name('settings.2fa-config');

    Volt::route('users', 'users.index')->name('users');
    Volt::route('roles', 'roles.index')->name('roles');
    Volt::route('school-year-and-semester', 'schoolyearandsemester.index')->name('schoolyearandsemester');
});

Route::group(['prefix' => 'student','middleware' => ['auth', 'check.active', 'verified','2fa']], function() {
    Volt::route('/home', 'student.dashboard')->name('student.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Volt::route('2fa/verify', 'auth.two-factor-verify')->name('2fa.verify');
});

require __DIR__.'/auth.php';
