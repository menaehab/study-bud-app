<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ProfilePage extends Component
{
    public $user;
    public $slug;
    public function mount($slug)
    {
        $this->slug = $slug;
        $this->user = User::where('slug', $slug)->first();
    }
    public function render()
    {
        return view('livewire.profile-page');
    }
}
