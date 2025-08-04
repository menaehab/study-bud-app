<?php

use Livewire\Volt\Volt;
use App\Livewire\HomePage;
use App\Livewire\RoomPage;
use App\Events\RefreshRooms;
use App\Livewire\RoomCreate;
use App\Livewire\TopicsPage;
use App\Livewire\ProfilePage;
use App\Livewire\SettingsPage;
use Illuminate\Support\Facades\Route;

# Home
Route::get('/', HomePage::class)->name('home');

# Must be Authenticated
Route::middleware(['auth', 'verified'])->group(function () {
    # Create Room
    Route::get('/create-room', RoomCreate::class)->name('room.create');
    # Room
    Route::get('/rooms/{slug}', RoomPage::class)->name('room');
    # Topics
    Route::get('/topics', TopicsPage::class)->name('topics');
    # Profile
    Route::get('/profile/{slug}', ProfilePage::class)->name('profile');
    # Settings
    Route::get('/settings', SettingsPage::class)->name('settings');
});

# Auth
require __DIR__ . '/auth.php';
