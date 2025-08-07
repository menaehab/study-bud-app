            <!-- Activities Start -->
            <div class="activities">
                <div class="activities__header">
                    <h2>Recent Activities</h2>
                </div>
                @foreach ($messages as $message)
                    <div class="activities__box">
                        <div class="activities__boxHeader roomListRoom__header">
                            <a href="{{ route('profile', $message->user->slug) }}" class="roomListRoom__author">
                                <div class="avatar avatar--small">
                                    @if ($message->user->avatar)
                                        <img src="{{ asset('storage/avatars/' . $message->user->avatar) }}" />
                                    @else
                                        <img src="{{ asset('assets/avatar.svg') }}" />
                                    @endif
                                </div>
                                <p>
                                    {{ $message->user->name }}
                                    <span>{{ $message->created_at->diffForHumans() }}</span>
                                </p>
                            </a>
                            <div class="roomListRoom__actions">
                                <a href="#">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                        viewBox="0 0 32 32">
                                        <title>remove</title>
                                        <path
                                            d="M27.314 6.019l-1.333-1.333-9.98 9.981-9.981-9.981-1.333 1.333 9.981 9.981-9.981 9.98 1.333 1.333 9.981-9.98 9.98 9.98 1.333-1.333-9.98-9.98 9.98-9.981z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="activities__boxContent">
                            <p>{{ $message->message }}</p>
                            <div class="activities__boxRoomContent">
                                {{ $message->room->name }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Activities End -->
