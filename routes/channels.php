<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return true;
});

Broadcast::channel('room.{roomId}', function ($user, $roomId) {
    if (!$user) {
        return false;
    }


    return [
        'id' => $user->id,
        'name' => $user->name,
    ];
});
