<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ProfilePage extends Component
{
    public $user;
    public $id;
    public function mount($id)
    {
        $this->id = $id;
        $this->user = User::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.profile-page');
    }
}
