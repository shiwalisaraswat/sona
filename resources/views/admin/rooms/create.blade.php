@extends('admin.layouts.master')
@section('title', 'Create Room')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.rooms.index') }}">Room</a>
    </li>
    <li class="breadcrumb-item active">
        Create
    </li>
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create Room Type</h4>
                <form class="forms-sample" method="post" action="{{ route('admin.rooms.store') }}" enctype="multipart/form-data" autocomplete="off">
                    @csrf

                    <div class="form-group">
                        <label for="room_type_id">Room Type</label>
                        <select class="form-select" name="room_type_id" id="room_type_id">
                            <option value="">Select</option>
                            @php $options = \App\Models\RoomType::getRoomTypesListing(); @endphp
                            @foreach($options as $key => $value)
                                <option value="{{ $key }}" {{ old('room_type_id', $record->room_type_id) == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <span class="error-message">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="room_number">Room Number</label>
                        <input type="text" class="form-control" id="room_number" name="room_number" placeholder="Room Number" value="{{ old('room_number', $record->room_number) }}">
                        @error('room_number')
                            <span class="error-message">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Price" value="{{ old('price', $record->price) }}">
                        @error('price')
                            <span class="error-message">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Status</label>
                        <select class="form-select" name="status" id="exampleSelectGender">
                            @php $options = \App\Helpers\CommonHelper::getRoomStatusOption(); @endphp
                            @foreach($options as $key => $value)
                                <option value="{{ $key }}" {{ old('status', $record->status) == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
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