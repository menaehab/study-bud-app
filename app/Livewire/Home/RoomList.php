<?php

namespace App\Livewire\Home;

use App\Models\Room;
use Livewire\Component;

class RoomList extends Component
{
    public $rooms = [];

    public $listeners = [
        "echo:rooms,.refresh-rooms" => 'refreshRooms',
    ];

    public function mount()
    {
        $this->refreshRooms();
    }

    public function refreshRooms()
    {
        $this->rooms = Room::latest()->get();
    }

    public function render()
    {
        return view('livewire.home.room-list');
    }
}
