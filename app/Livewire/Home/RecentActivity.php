<?php

namespace App\Livewire\Home;

use Livewire\Component;

class RecentActivity extends Component
{
    protected $listeners = [
        'echo:rooms,.refresh-rooms' => '$refresh',
    ];
    
    public function render()
    {
        return view('livewire.home.recent-activity');
    }
}
