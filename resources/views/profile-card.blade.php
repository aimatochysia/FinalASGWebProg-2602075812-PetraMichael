{{-- resources/views/profile-card --}}
<div class="card card-main" style="width: 18rem;">
    <!-- Profile Picture -->
    <img src="{{ asset($user->profile_picture) }}" class="card-img-top" alt="Profile Picture">

    <div class="card-body">
        <!-- User Name -->
        <h5 class="card-title">{{ $user->username }}</h5>

        <!-- Instagram Username -->
        <p class="card-text"><strong>Instagram:</strong> {{ '@' . $user->instagram_username }}</p>

        <!-- Hobbies (displayed as tags) -->
        @if ($user->hobbies->count())
            <p class="card-text"><strong>Hobbies:</strong></p>
            <div class="hobbies-tags">
                @foreach ($user->hobbies as $hobby)
                    @php
                        $colors = ['#FF6347', '#4682B4', '#32CD32', '#FF4500', '#008080', '#800080']; // Exclude yellow and light colors
                        $color = $colors[array_rand($colors)];
                    @endphp
                    <span class="badge badge-pill" style="background-color: {{ $color }}">{{ $hobby->name }}</span>
                @endforeach
            </div>
        @else
            <p class="card-text"><strong>Hobbies:</strong> Not listed</p>
        @endif

        <!-- Mobile Number -->
        <p class="card-text"><strong>Mobile Number:</strong> {{ $user->mobile_number }}</p>

        <!-- Gender -->
        <p class="card-text"><strong>Gender:</strong> {{ ucfirst($user->gender) }}</p>

        <!-- friend-->
        @if (Auth::check())
            @php
                $loggedInUser = Auth::user();
                $isFriend = $loggedInUser->isFriend($user->id);
            @endphp

            @if ($loggedInUser->id !== $user->id) <!-- Skip for the current user -->
                @if ($isFriend)
                    <form action="{{ route('friends.remove', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Unfriend</button>
                    </form>
                @else
                    <form action="{{ route('friends.add', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">Add Friend</button>
                    </form>
                @endif
            @endif
        @endif
    </div>
</div>

<style>
    .card-main {
    transition: transform 0.3s ease-in-out;
}
    .card-main:hover {
        transform: scale(1.05);
    }
    .hobbies-tags {
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .badge {
        margin-right: 5px;
        margin-bottom: 5px;
        font-weight: bold;
    }
</style>
