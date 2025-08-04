<?php

namespace App\Livewire;

use App\Models\Topic;
use Livewire\Component;
use Livewire\Attributes\On;

class TopicsPage extends Component
{
    public $search = '';
    public $topics;
    public $allTopicsCount;
    
    protected $queryString = ['search'];
    
    public function mount()
    {
        $this->loadTopics();
        $this->allTopicsCount = Topic::count();
    }
    
    public function updatedSearch()
    {
        $this->loadTopics();
    }
    
    public function filterByTopic($topicId)
    {
        $this->redirect(
            route('home', ['topicId' => $topicId]), 
            navigate: true
        );
    }
    
    protected function loadTopics()
    {
        $query = Topic::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
            
        $this->topics = $query->latest()->take(5)->get();
    }

    public function render()
    {
        return view('livewire.topics-page');
    }
}