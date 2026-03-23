@extends('admin.layouts.master')
@section('title', 'Create Room Type')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Room Type</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Room Type</li>
    </ol>
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create Room Type</h4>
                <form class="forms-sample" method="post" action="{{ route('admin.room_types.store') }}" enctype="multipart/form-data" autocomplete="off">
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" id="exampleInputName1" name="name" placeholder="Name" value="{{ old('name', $record->name) }}">
                        @error('name')
                            <span class="error-message">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Description</label>
                        <textarea class="form-control" name="description" id="exampleTextarea1" rows="4" placeholder="Description">{{ old('description', $record->description) }}</textarea>
                        @error('description')
                            <span class="error-message">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Status</label>
                        <select class="form-select" name="status" id="exampleSelectGender">
                            @php $options = \App\Helpers\CommonHelper::getStatusOption(); @endphp
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