@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni explicabo omnis, magnam consequatur quaerat itaque ratione saepe voluptates? Sed nostrum nam eum enim facere obcaecati officiis accusamus, libero dolorum debitis!</p>

            <!-- Language Switcher -->
            <div class="d-flex justify-content-center mb-4">
                <a href="/locale/en" class="btn btn-link {{ app()->getLocale() == 'en' ? 'font-weight-bold' : '' }}">EN</a> |
                <a href="/locale/id" class="btn btn-link {{ app()->getLocale() == 'id' ? 'font-weight-bold' : '' }}">ID</a>
            </div>

            <!-- Search and Filter Form -->
            <form method="GET" action="{{ route('home') }}" class="mb-4">
                <div class="row">
                    <!-- Search by Name -->
                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control" placeholder="Search by name" value="{{ request()->search }}">
                    </div>

                    <!-- Gender Filter -->
                    <div class="col-md-3">
                        <select name="gender" class="form-control">
                            <option value="">Filter by Gender</option>
                            <option value="male" {{ request()->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ request()->gender == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ request()->gender == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <!-- Hobbies Filter -->
                    <div class="col-md-3">
                        <select name="hobby" class="form-control">
                            <option value="">Filter by Hobby</option>
                            @foreach($hobbies as $hobby)
                                <option value="{{ $hobby }}" {{ request()->hobby == $hobby ? 'selected' : '' }}>{{ ucfirst($hobby) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                    </div>
                </div>
            </form>

            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Flexbox to center the profile cards -->
                    <div class="row justify-content-center">
                        @foreach ($users as $user)
                            <div class="col-md-4 mb-4">
                                @include('profile-card', ['user' => $user])
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-center align-items-center">
                        {{ $users->links() }}
                    </div>

                    <style>
                        svg{
                            width: 7%;
                        }
                    </style>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
