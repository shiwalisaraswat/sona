@extends('admin.layouts.master')
@section('title', 'Edit Service')


@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.services.index') }}">Services</a>
    </li>
    <li class="breadcrumb-item active">
        Edit
    </li>
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Service</h4>
                <form class="forms-sample" method="post" action="{{ route('admin.services.update', $record->id) }}" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label for="name">Service Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name', $record->name) }}">
                        @error('name')
                            <span class="error-message">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-select" name="status" id="status">
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