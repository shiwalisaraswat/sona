@extends('admin.layouts.master')
@section('title', 'Change Password')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Profile</a></li>
        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
    </ol>
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Change Password</h4>
                <p class="card-description">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
                <form class="forms-sample" method="post" action="{{ route('admin.password.update') }}" autocomplete="off">
                    @csrf
                    @method('put')

                    @if (session('status') === 'password-updated')
                        <div class="alert alert-success">
                            Password updated successfully!
                        </div>
                    @else
                        <div class="alert alert-danger">
                            Something went wrong!
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="exampleInputPassword4">Current Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword4" name="current_password" placeholder="Password">
                        @error('current_password', 'updatePassword')
                            <span class="error-message">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">New Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword4" name="password" placeholder="Password">
                        @error('password', 'updatePassword')
                            <span class="error-message">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Confirm New Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword4" name="password_confirmation" placeholder="Password">
                        @error('password_confirmation', 'updatePassword')
                            <span class="error-message">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                    <button type="reset" class="btn btn-gradient-secondary">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection