{{-- resources/views/profile-card --}}
<div class="card card-main" style="width: 18rem;">
    <!-- Profile Picture -->
    <img src="{{ asset($user->profile_picture) }}" class="card-img-top" alt="Profile Picture">

    <div class="card-body">
        <!-- User Name -->
        <h5 class="card-title">{{ $user->name }}</h5>

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

        <!-- Optional: Add any button or links -->
        {{-- <a href="{{ route('user.profile', $user->id) }}" class="btn btn-primary">View Profile</a> --}}
    </div>
</div>

<style>
    .card-main {
    transition: transform 0.3s ease-in-out; /* Smooth transition */
}
    .card-main:hover {
        transform: scale(1.05); /* Zoom effect */
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
