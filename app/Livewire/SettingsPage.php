<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Events\RoomsRefreshed;

class SettingsPage extends Component
{
    use WithFileUploads;

    public $avatar;
    public $name;
    public $email;
    public $about;
    public $newAvatar;

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->about = auth()->user()->about;
        $this->avatar = auth()->user()->avatar;
        $this->newAvatar = null;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'about' => 'nullable|string',
            'newAvatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function updateSettings()
    {
        $this->validate();

        $user = auth()->user();

        if ($this->newAvatar) {

            if ($user->avatar) {
                $oldAvatarPath = 'avatars/' . $user->avatar;
                if (\Storage::disk('public')->exists($oldAvatarPath)) {
                    \Storage::disk('public')->delete($oldAvatarPath);
                }
            }

            $avatarName = time() . '_' . $this->newAvatar->getClientOriginalName();
            $this->newAvatar->storeAs('avatars', $avatarName, 'public');

            $user->update(['avatar' => $avatarName]);

            $this->avatar = $avatarName;

            $this->reset('newAvatar');

        }

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'about' => $this->about,
        ]);

        broadcast(new RoomsRefreshed())->toOthers();

        session()->flash('message', 'Profile updated successfully!');
        $this->redirectIntended(route('home', absolute: false), navigate: true);
    }
    public function render()
    {
        return view('livewire.settings-page');
    }
}