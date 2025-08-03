<?php

namespace App\Livewire\Home;

use App\Models\Topic;
use Livewire\Component;

class TopicList extends Component
{
    public $activeTopicId = null;
    
    protected $listeners = [
        'echo:rooms,.refresh-rooms' => '$refresh',
    ];
    
    public function mount($activeTopicId = null)
    {
        $this->activeTopicId = $activeTopicId;
    }
    
    public function updatedActiveTopicId($value)
    {
        $this->emit('topicFiltered', ['id' => $value]);
    }

    public function topicFilter($id = null)
    {
        $this->activeTopicId = $id;
        $this->dispatch('topicFiltered', ['id' => $id]);
    }

    public function render()
    {
        $latestTopics = Topic::take(5)->get();
        $allTopicsCount = Topic::count();
        return view('livewire.home.topic-list', compact('latestTopics', 'allTopicsCount'));
    }
}
