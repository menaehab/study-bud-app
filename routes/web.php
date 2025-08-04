<?php

use Livewire\Volt\Volt;
use App\Livewire\HomePage;
use App\Events\RefreshRooms;
use App\Livewire\RoomCreate;
use App\Livewire\TopicsPage;
use App\Livewire\ProfilePage;
use App\Livewire\SettingsPage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/create-room', RoomCreate::class)->name('room.create');
    Route::get('/settings', SettingsPage::class)->name('settings');
    Route::get('/profile/{slug}', ProfilePage::class)->name('profile');
    Route::get('/topics', TopicsPage::class)->name('topics');
});


require __DIR__ . '/auth.php';
