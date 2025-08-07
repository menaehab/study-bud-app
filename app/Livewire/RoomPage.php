<?php

namespace App\Livewire;

use App\Models\Room;
use App\Models\Message;
use Livewire\Component;
use App\Events\MessageRefreshed;

class RoomPage extends Component
{
    public $room;
    public $messages;
    public $message;
    public $users;
    public $onlineUsers;
    public $usersCount;
    protected function getListeners()
    {
        return [
            "echo-presence:room.{$this->room->id},.refresh-messages" => 'loadMessages',
        ];
    }

    public function mount($slug)
    {
        $this->room = Room::where('slug', $slug)->with('messages.user')->first();
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->messages = $this->room->messages->all();
        $this->users = $this->room->messages->pluck('user')->unique()->all();
        $this->usersCount = count($this->users);
    }

    public function sendMessage()
    {
        $this->validate([
            'message' => 'required|string|max:255',
        ]);

        Message::create([
            'message' => $this->message,
            'room_id' => $this->room->id,
            'user_id' => auth()->id(),
        ]);

        event(new MessageRefreshed($this->room->id));

        $this->message = '';
        $this->loadMessages();
    }

    public function deleteMessage($id)
    {
        $message = Message::find($id);
        if ($message->user_id != auth()->id()) {
            return;
        }

        $message->delete();

        event(new MessageRefreshed($this->room->id));

        $this->loadMessages();
    }

    public function deleteRoom($id)
    {
        $room = Room::find($id);
        if ($room->user_id != auth()->id()) {
            return;
        }

        $room->delete();
        $this->redirect(route('home'), navigate: true);
    }

    public function render()
    {
        return view('livewire.room-page');
    }
}
