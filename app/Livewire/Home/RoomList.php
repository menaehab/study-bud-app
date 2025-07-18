<?php

namespace App\Livewire\Home;

use App\Models\Room;
use Livewire\Component;

class RoomList extends Component
{
    public function render()
    {
        $rooms = Room::all();
        return view('livewire.home.room-list',compact('rooms'));
    }
}