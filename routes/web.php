<?php

use Livewire\Volt\Volt;
use App\Events\RefreshRooms;
use App\Livewire\ProfilePage;
use App\Livewire\SettingsPage;
use App\Livewire\Home\HomePage;
use App\Livewire\Room\RoomCreate;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');


Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/create-room', RoomCreate::class)->name('room.create');
    Route::get('/settings', SettingsPage::class)->name('settings');
    Route::get('/profile/{slug}', ProfilePage::class)->name('profile');
});
require __DIR__ . '/auth.php';



// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::middleware(['auth'])->group(function () {
//     Route::redirect('settings', 'settings/profile');

//     Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
//     Volt::route('settings/password', 'settings.password')->name('settings.password');
//     Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
// });