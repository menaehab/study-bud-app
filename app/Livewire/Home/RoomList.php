<?php

namespace App\Livewire\Home;

use App\Models\Room;
use Livewire\Component;
use Livewire\WithPagination;

class RoomList extends Component
{
    use WithPagination;

    public $listeners = [
        "echo:rooms,.refresh-rooms" => '$refresh',
    ];

    public function render()
    {
        return view('livewire.home.room-list', [
            'rooms' => Room::latest()->paginate(5),
        ]);
    }
}