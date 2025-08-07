<?php

namespace App\Livewire;

use App\Models\Message;
use Livewire\Component;

class RecentActivity extends Component
{
    public $messages;
    protected $listeners = [
        'echo:recent-activity,.recent-activity-refreshed' => 'refreshActivity',
    ];

    public function mount()
    {
        $this->refreshActivity();
    }

    public function refreshActivity()
    {
        $this->messages = Message::latest()->take(3)->get();
    }

    public function render()
    {
        return view('livewire.recent-activity');
    }
}
