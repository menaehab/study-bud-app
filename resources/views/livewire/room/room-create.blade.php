<main class="create-room layout">
    <div class="container">
        <div class="layout__box">
            <div class="layout__boxHeader">
                <div class="layout__boxTitle">
                    <a href="{{ route('home') }}" wire:navigate>
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                            viewBox="0 0 32 32">
                            <title>arrow-left</title>
                            <path
                                d="M13.723 2.286l-13.723 13.714 13.719 13.714 1.616-1.611-10.96-10.96h27.625v-2.286h-27.625l10.965-10.965-1.616-1.607z">
                            </path>
                        </svg>
                    </a>
                    <h3>Create Study Room</h3>
                </div>
            </div>
            <div class="layout__body">
                <form class="form" wire:submit.prevent="createRoom">
                    <div class="form__group">
                        <label for="room_name">Room Name</label>
                        <input wire:model.live..debounce.200ms="name" id="room_name" name="room_name" type="text"
                            placeholder="E.g. Mastering Python + Django" />
                        @error('name')
                            <p class="form__error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form__group">
                        <label for="room_topic">Topic</label>
                        <input wire:model.live.debounce.200ms="topic" type="text" name="topic" id="room_topic"
                            list="topic-list" />
                        <datalist id="topic-list">
                            <select id="room_topic">
                                <option value="">Select your topic</option>
                                @foreach ($topics as $topic)
                                    <option value="{{ $topic->name }}">{{ $topic->name }}</option>
                                @endforeach
                            </select>
                        </datalist>
                        @error('topic')
                            <p class="form__error">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="form__group">
                        <label for="room_about">About</label>
                        <textarea wire:model.live..debounce.200ms="description" name="room_about" id="room_about"
                            placeholder="Write about your study group..."></textarea>
                        @error('description')
                            <p class="form__error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form__action">
                        <a class="btn btn--dark" href="{{ route('home') }}" wire:navigate>Cancel</a>
                        <button class="btn btn--main" type="submit" wire:loading.attr="disabled">Create Room</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
