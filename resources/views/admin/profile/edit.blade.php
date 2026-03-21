@extends('admin.layouts.master')
@section('title', 'Edit Profile')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Profile</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
    </ol>
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Profile</h4>
                <form class="forms-sample" method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('patch')

                    {{-- @if (session('status') === 'profile-updated')
                        <div class="alert alert-success">
                            Profile updated successfully!
                        </div>
                    @else
                        <div class="alert alert-danger">
                            Something went wrong!
                        </div>
                    @endif --}}

                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" id="exampleInputName1" name="name" placeholder="Name" value="{{ old('name', $admin->name) }}">
                        @error('name')
                            <span class="error-message">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail3" name="email" placeholder="Email" value="{{ old('email', $admin->email) }}">
                        @error('email')
                            <span class="error-message">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>File upload</label>
                        <input type="file" name="profile_pic" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-gradient-primary py-3" type="button">Upload</button>
                            </span>
                        </div>
                        @error('profile_pic')
                            <span class="error-message">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Profile Pic</label>
                        <br/>
                        <img src="{{ $admin->profile_pic_url }}" class="me-2" alt="image" width="100" height="100">
                    </div>
                    <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                    <button type="reset" class="btn btn-gradient-secondary">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection