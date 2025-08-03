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

    protected $queryString = [
        'topicId' => ['except' => ''],
    ];

    public function filterRooms($id = null)
    {
        if ($this->topicId != $id) {
            $this->topicId = $id;
            $this->resetPage();
        }
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
