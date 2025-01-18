@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni explicabo omnis, magnam consequatur quaerat itaque ratione saepe voluptates? Sed nostrum nam eum enim facere obcaecati officiis accusamus, libero dolorum debitis!
            </p>
            {{-- cara pake language diabwah--}}
            <p>{{__('pagination.test') }}</p>
            <a href="/locale/en">en</a>
            <a href="/locale/id">id</a>

            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach ($users as $user)
                        @include('profile-card', ['user' => $user])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
