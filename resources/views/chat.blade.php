@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Chat with {{ $friend->username }}</h3>

    <!-- Display chat messages -->
    <div class="chat-box" style="max-height: 400px; overflow-y: scroll;">
        @php
            $previousDate = null;
        @endphp

        @foreach ($chats as $chat)
            @php
                $chatDate = $chat->created_at->toDateString();
                $isUserMessage = $chat->id_sender == Auth::id();
                // Generate font color for the name (this can be improved as needed)
                $userNameColor = $isUserMessage ? 'red' : 'green'; // Red for user1, Green for user2
            @endphp

            <!-- If the chat is on a new day, add a break line -->
            @if ($chatDate !== $previousDate)
                <div class="text-center my-2">
                    <strong>{{ \Carbon\Carbon::parse($chatDate)->format('F j, Y') }}</strong>
                </div>
            @endif

            <!-- Chat Message -->
            <div class="message @if($isUserMessage) message-right @else message-left @endif">
                <div class="message-bubble">
                    <strong style="color: {{ $userNameColor }};">
                        {{ $chat->id_sender == Auth::id() ? 'You' : $friend->username }}:
                    </strong>
                    {{ $chat->message }}
                </div>
            </div>

            @php
                $previousDate = $chatDate;
            @endphp
        @endforeach
    </div>

    <!-- Chat input form -->
    <form action="{{ route('chat', ['friendId' => $friend->id]) }}" method="POST">
        @csrf
        <div class="input-group mt-3">
            <input type="text" name="message" class="form-control" placeholder="Type a message" required>
            <button class="btn btn-primary" type="submit">Send</button>
        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
    /* Chat layout */
    .chat-box {
        padding: 10px;
        max-height: 400px;
        overflow-y: scroll;
    }

    .message {
        display: flex;
        margin-bottom: 10px;
    }

    .message-left {
        justify-content: flex-start;
    }

    .message-right {
        justify-content: flex-end;
    }

    .message-bubble {
        padding: 10px;
        border-radius: 10px;
        max-width: 60%;
        word-wrap: break-word;
    }

    .text-center {
        font-size: 12px;
        color: #888;
    }

    .input-group {
        width: 100%;
    }

    .input-group input {
        border-radius: 20px;
    }

    .input-group button {
        border-radius: 20px;
    }
</style>
@endpush
