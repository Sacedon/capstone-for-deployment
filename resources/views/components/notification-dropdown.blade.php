    <div class="relative" x-data="{ open: false }">
        <button
            type="button"
            class="relative p-2 text-gray-500 rounded-full hover:text-gray-700 focus:outline-none focus:ring focus:ring-purple-500 focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark-eval-1 dark:text-gray-400 dark:hover:text-gray-200"
            aria-label="Notifications"
            x-on:click="open = !open; markNotificationsAsRead()"
        >
            @php
                $unreadCount = auth()->user()->unreadNotifications->count();
            @endphp
            @if ($unreadCount > 0)
                <!-- Add a red badge with the number of notifications -->
                <span class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                    {{ $unreadCount }}
                </span>
            @endif
            <div class="ml-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"></path></svg>
            </div>
        </button>
        <!-- Add your notification dropdown here -->
        <div
            class="absolute right-0 mt-2 w-64 bg-white border border-gray-200 dark:bg-dark-eval-2 dark:border-dark-eval-3 shadow-md rounded-md"
            x-show="open"
            @click.away="open = false"
        >
            <!-- Replace this with your notification items -->
            <div class="p-4">
                <div class="font-semibold mb-2">Notifications</div>
                @foreach(auth()->user()->notifications->take(4) as $notification)
                <div class="flex justify-between items-center border-b border-gray-300 py-2">
                    <div>
                        @if (isset($notification->data['link']))
                            <a href="{{ $notification->data['link'] }}" class="text-black">{{ $notification->data['message'] }}</a>
                        @else
                            <span class="text-gray-800">{{ $notification->data['message'] }}</span>
                        @endif
                            <br>
                            <small class="text-gray-500" data-timestamp="{{ $notification->created_at->timestamp }}">{{ $notification->created_at->diffInSeconds(now()) }} </small>

                        </div>
                        <div>
                            <form method="POST" action="{{ route('notifications.remove', $notification->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-500 hover:text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                        <path d="M4.293 4.293a1 1 0 0 1 1.414 0L8 6.586l2.293-2.293a1 1 0 1 1 1.414 1.414L9.414 8l2.293 2.293a1 1 0 1 1-1.414 1.414L8 9.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L6.586 8 4.293 5.707a1 1 0 0 1 0-1.414z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
                @if (auth()->user()->notifications->isEmpty())
                    <p class="text-gray-500 py-2">No new notifications.</p>
                @endif
            </div>
        </div>
    </div>
    <script>
        async function markNotificationsAsRead() {
            try {
                const response = await fetch('{{ route('notifications.markRead') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                });

                if (response.ok) {
                    // The notification was marked as read successfully, so you can update the UI here
                    const badgeElement = document.querySelector('.bg-red-500');
                    if (badgeElement) {
                        badgeElement.style.display = 'none';
                    }
                } else {
                    // Handle errors here
                }
            } catch (error) {
                console.error(error);
            }
        }

        function updateTimestamp() {
            const timestampElements = document.querySelectorAll("[data-timestamp]");

            timestampElements.forEach((element) => {
                const timestampInSeconds = parseInt(element.getAttribute("data-timestamp"));
                const currentTime = Math.floor(new Date().getTime() / 1000); // Current time in seconds
                const timeDifference = Math.max(currentTime - timestampInSeconds, 1); // Ensure a minimum of 1 second

                if (timeDifference < 60) {
                    element.textContent = `${timeDifference} second${timeDifference > 1 ? 's' : ''} ago`;
                } else if (timeDifference < 3600) {
                    const minutes = Math.floor(timeDifference / 60);
                    element.textContent = `${minutes} minute${minutes > 1 ? 's' : ''} ago`;
                } else if (timeDifference < 86400) {
                    const hours = Math.floor(timeDifference / 3600);
                    element.textContent = `${hours} hour${hours > 1 ? 's' : ''} ago`;
                } else if (timeDifference < 86400 * 30) { // Assuming a month has around 30 days
                    const days = Math.floor(timeDifference / 86400);
                    element.textContent = `${days} day${days > 1 ? 's' : ''} ago`;
                } else {
                    // If the notification is older than a month, display the formatted date
                    const notificationDate = new Date(timestampInSeconds * 1000).toLocaleDateString(undefined, {
                        year: 'numeric',
                        month: 'short',
                        day: 'numeric',
                    });
                    element.textContent = notificationDate;
                }
            });
        }

        // Initial update
        updateTimestamp();

        // Update the timestamp every second
        setInterval(updateTimestamp, 1000);


    </script>
