<?php

namespace App\Livewire;

use App\Models\Room;
use App\Models\Message;
use Livewire\Component;

class RoomPage extends Component
{
    public $room;
    public $messages;
    public $message;
    public $users;
    public function mount($slug)
    {
        $this->room = Room::where('slug', $slug)->with('messages.user')->first();
        $this->messages = $this->room->messages->all();
        // Get all users in the room + user owner of the room
        $this->users = $this->room->messages->pluck('user')->merge(collect([$this->room->user]))->unique()->all();
    }
    public function rules(): array
    {
        return [
            'message' => 'required|string|max:255',
        ];
    }

    public function sendMessage()
    {
        $this->validate($this->rules());

        Message::create([
            'message' => $this->message,
            'room_id' => $this->room->id,
            'user_id' => auth()->id(),
        ]);

        $this->message = '';
    }

    public function render()
    {
        return view('livewire.room-page');
    }
}
