<?php

namespace App\Livewire;

use App\Models\Room;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ProfilePage extends Component
{
    use WithPagination;
    
    public $user;
    public $slug;
    public $topicId = null;
    
    protected $queryString = [
        'topicId' => ['except' => ''],
    ];
    
    protected $listeners = [
        'topicFiltered' => 'filterRooms',
    ];

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->user = User::where('slug', $slug)->firstOrFail();
        
        // Initialize topicId from request if present
        if (request()->has('topicId')) {
            $this->topicId = request('topicId');
        }
    }

    public function filterRooms($data)
    {
        $this->topicId = $data['id'] ?? null;
        $this->resetPage();
    }
    
    public function updatingTopicId()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $query = Room::query();

        $query->where('user_id', $this->user->id);

        if (!is_null($this->topicId)) {
            $query->where('topic_id', $this->topicId);
        }

        return view('livewire.profile-page', [
            'rooms' => $query->latest()->paginate(5),
            'activeTopicId' => $this->topicId,
        ]);
    }
}
