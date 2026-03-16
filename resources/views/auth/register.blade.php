@extends('layouts.master')
@section('title', 'Register')

@section('content')
    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-5 offset-xl-2 offset-lg-1">
                    <div class="booking-form">
                        <h3>Register</h3>
                        <form method="POST" action="{{ route('register') }}" autocomplete="off">
                            @csrf
                            
                            <div class="check-date">
                                <label for="date-in">Name</label>
                                <input type="text" name="name" value="{{ old('name') }}">
                            </div>
                            <div class="check-date">
                                <label for="date-out">Email</label>
                                <input type="text" name="email" value="{{ old('email') }}">
                            </div>
                            <div class="check-date">
                                <label for="guest">Password</label>
                                <input type="password" name="password" value="{{ old('password') }}">
                            </div>
                            <div class="check-date">
                                <label for="room">Confirm Password </label>
                                <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}">
                            </div>
                            <button type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-slider owl-carousel">
            <div class="hs-item set-bg" data-setbg="{{ asset('public/img/hero/hero-1.jpg') }}"></div>
        </div>
    </section>
    <!-- Hero Section End -->
@endsection