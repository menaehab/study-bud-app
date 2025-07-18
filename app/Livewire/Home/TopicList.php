<?php

namespace App\Livewire\Home;

use App\Models\Topic;
use Livewire\Component;

class TopicList extends Component
{
    public $listeners = [
        "echo:rooms,.refresh-rooms" => '$refresh',
    ];

    public function render()
    {
        $latestTopics = Topic::take(5)->get();
        $allTopicsCount = Topic::count();
        return view('livewire.home.topic-list', compact('latestTopics', 'allTopicsCount'));
    }
}
