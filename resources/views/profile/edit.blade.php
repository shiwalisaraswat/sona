@extends('layouts.master')
@section('title', 'Edit Profile')

@section('content')
    <!-- Profile Section Begin -->
    <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="contact-text">
                        <h2>Profile</h2>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="c-o">Name:</td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td class="c-o">Email:</td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-7 offset-lg-1">
                    <form class="contact-form" method="post" action="{{ route('profile.update') }}" autocomplete="off">
                        @csrf
                        @method('patch')

                        {{--  @if ($errors->any()) --}}
                            {{-- <div class="alert alert-danger">
                                <ul> --}}
                                    {{--  @foreach ($errors->all() as $error)  --}}
                                        {{-- <li>{{ $error  }}</li> --}}
                                    {{--  @endforeach  --}}
                                {{-- </ul>
                            </div> --}}
                        {{--  @endif  --}}

                        <div class="row">
                            <div class="col-lg-6 mb-1">
                                <label for="date-out">Name</label>
                                <input type="text" name="name" placeholder="Your Name" value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <span class="error-message">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-1">
                                <label for="date-out">Email</label>
                                <input type="text" name="email" placeholder="Your Email" value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <span class="error-message">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-12 mt-1">
                                <button type="submit">Submit Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Profile Section End -->

    <!-- Update Password Section Begin -->
    <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="contact-text">
                        <h2>{{ __('Update Password') }}</h2>
                        <p>{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
                    </div>
                </div>
                <div class="col-lg-7 offset-lg-1">
                    <form class="contact-form" method="post" action="{{ route('password.update') }}" autocomplete="off">
                        @csrf
                        @method('put')

                        <div class="row">
                            <div class="col-lg-6">
                                <label for="date-out">Current Password</label>
                                <input type="password" name="current_password">
                                @error('current_password', 'updatePassword')
                                    <span class="error-message">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="date-out">New Confirm Password</label>
                                <input type="password" name="password">
                                @error('password', 'updatePassword')
                                    <span class="error-message">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="date-out">Confirm New Password</label>
                                <input type="password" name="password_confirmation">
                                @error('password_confirmation', 'updatePassword')
                                    <span class="error-message">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <button type="submit">Submit Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </section>
    <!-- Update Password  Section End -->
@endsection
