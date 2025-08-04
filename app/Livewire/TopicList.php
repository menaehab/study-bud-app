<?php

namespace App\Livewire;

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
        if ($this->activeTopicId != $id) {
            $this->activeTopicId = $id;
            $this->dispatch('topicFiltered', id: $id);
        }
    }

    public function render()
    {
        $latestTopics = Topic::take(5)->get();
        $allTopicsCount = Topic::count();
        return view('livewire.topic-list', compact('latestTopics', 'allTopicsCount'));
    }
}
