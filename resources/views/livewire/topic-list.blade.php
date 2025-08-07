<!-- Topics Start -->
<div class="topics">
    <div class="topics__header">
        <h2>Browse Topics</h2>
    </div>
    <ul class="topics__list">
        <li>
            <a href="#" class="{{ $activeTopicId == null ? 'active' : '' }}" wire:click.prevent="topicFilter()">All
                <span>{{ $allRoomsCount }}</span>
            </a>
        </li>
        @foreach ($latestTopics as $topic)
            <li>
                <a href="#" class="{{ $activeTopicId == $topic->id ? 'active' : '' }}"
                    wire:click.prevent="topicFilter({{ $topic->id }})">
                    {{ $topic->name }}
                    <span>{{ $topic->rooms->count() }}</span>
                </a>
            </li>
        @endforeach
    </ul>
    <a class="btn btn--link" href="{{ route('topics') }}" wire:navigate>
        More
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
            <title>chevron-down</title>
            <path d="M16 21l-13-13h-3l16 16 16-16h-3l-13 13z"></path>
        </svg>
    </a>
</div>
<!-- Topics End -->
