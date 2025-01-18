<!-- resources/views/profile-card.blade.php -->

<div class="card" style="width: 18rem;">
    <!-- Profile Picture -->
    <img src="{{ asset('storage/' . $user->profile_picture) }}" class="card-img-top" alt="Profile Picture">

    <div class="card-body">
        <!-- User Name -->
        <h5 class="card-title">{{ $user->name }}</h5>

        <!-- Instagram Username -->
        <p class="card-text"><strong>Instagram:</strong> {{ '@' . $user->instagram_username }}</p>

        <!-- Hobbies -->
        <p class="card-text"><strong>Mobile Number:</strong> {{ $user->mobile_number }}</p>

        <!-- Gender -->
        <p class="card-text"><strong>Gender:</strong> {{ ucfirst($user->gender) }}</p>

        <!-- Optional: Add any button or links -->
        {{-- <a href="{{ route('user.profile', $user->id) }}" class="btn btn-primary">View Profile</a> --}}
    </div>
</div>
