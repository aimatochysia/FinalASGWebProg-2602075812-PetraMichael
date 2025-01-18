@extends('app')

@section('content')
    <div class="notification">
        <p>Your random number is: <span id="random-number">{{ $randomNumber }}</span></p>

        <form action="{{ route('verifyPayment') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="enteredNumber">Re-enter the number to confirm payment:</label>
                <input type="number" id="enteredNumber" name="enteredNumber" required>
            </div>

            <button type="submit" class="btn btn-primary">Pay</button>
            <a href="{{ route('home') }}" class="btn btn-secondary">Not Pay</a>
        </form>
    </div>
@endsection
