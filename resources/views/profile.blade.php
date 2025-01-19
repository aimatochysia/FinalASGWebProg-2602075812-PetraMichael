{{-- resources/views/profile.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your Profile</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <h3>Personal Information</h3>
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>Username:</strong> {{ $user->username }}
                    </li>
                    <li class="list-group-item">
                        <strong>Instagram Username:</strong> {{ $user->instagram_username ?? 'Not provided' }}
                    </li>
                    <li class="list-group-item">
                        <strong>Email:</strong> {{ $user->email }}
                    </li>
                    <li class="list-group-item">
                        <strong>Gender:</strong> {{ ucfirst($user->gender) }}
                    </li>
                    <li class="list-group-item">
                        <strong>Mobile Number:</strong> {{ $user->mobile_number }}
                    </li>
                    <li class="list-group-item">
                        <strong>Price:</strong> ${{ $user->price }}
                    </li>
                </ul>

                <h3>Profile Image</h3>
                <img src="{{ asset($user->profile_picture) }}" alt="Profile Image" class="img-fluid" style="max-width: 200px;">

            </div>

            <div class="col-md-6">
                <h3>Hobbies</h3>
                <ul class="list-group">
                    @foreach ($user->hobbies as $hobby)
                        <li class="list-group-item">
                            {{ $hobby->name }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <h3>Your Friends</h3>
            <div class="row">
                @foreach ($friends as $friend)
            <div class="col-md-4 mb-4">
                <div class="d-flex align-items-center">
                    <!-- Profile Picture -->
                    <img src="{{asset($friend->profile_picture) }}"
                         alt="Profile Image"
                         class="rounded-circle"
                         style="height: 50px; width: 50px; object-fit: cover; margin-right: 10px;">

                    <!-- Friend Info -->
                    <div>
                        <h5 class="mb-1">{{ $friend->username }}</h5>
                        <p class="mb-0">Instagram: {{ $friend->instagram_username ?? 'Not provided' }}</p>
                    </div>

                    <!-- Chat Button -->
                    <a href="{{ route('chat', ['friendId' => $friend->id]) }}" class="btn btn-primary ms-auto" style="height: 35px; margin-left: 10px;">Chat</a>
                </div>
            </div>
        @endforeach
            </div>
        </div>
    </div>
@endsection
