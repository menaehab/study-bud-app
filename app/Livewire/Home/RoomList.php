<?php

namespace App\Livewire\Home;

use App\Models\Room;
use Livewire\Component;
use Livewire\WithPagination;

class RoomList extends Component
{
    use WithPagination;

    public $topicId = null;

    public $listeners = [
        "echo:rooms,.refresh-rooms" => '$refresh',
        'topicFiltered' => 'filterRooms',
    ];

    public function filterRooms($data)
    {
        $id = $data['id'] ?? null;

        $this->topicId = $id;

        $this->resetPage();
    }

    public function render()
    {
        $query = Room::query();

        if (!is_null($this->topicId)) {
            $query->where('topic_id', $this->topicId);
        }

        return view('livewire.home.room-list', [
            'rooms' => $query->latest()->paginate(5),
            'roomsCount' => $this->topicId ? $query->count() : Room::count(),
        ]);
    }
}
