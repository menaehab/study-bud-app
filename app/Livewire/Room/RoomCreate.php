<?php

namespace App\Livewire\Room;

use App\Models\Room;
use App\Models\Topic;
use Livewire\Component;
use App\Events\RefreshRooms;

class RoomCreate extends Component
{
    public $name;
    public $topic;
    public $description;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'topic' => 'required|string|max:255',
            'description' => 'required|string',
        ];
    }
    public function createRoom()
    {
        $this->validate();

        $topic = Topic::firstOrCreate([
            'name' => \Str::lower($this->topic),
        ], [
            'name' => \Str::lower($this->topic),
        ]);

        $room = Room::create([
            'name' => $this->name,
            'topic_id' => $topic->id,
            'description' => $this->description,
            'user_id' => auth()->user()->id,
        ]);

        broadcast(new RefreshRooms())->toOthers();

        $this->redirectIntended(route('home', absolute: false), navigate: true);

    }
    public function render()
    {
        $topics = Topic::all();
        return view('livewire.room.room-create',compact('topics'));
    }
}