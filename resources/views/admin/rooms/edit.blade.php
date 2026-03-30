@extends('admin.layouts.master')
@section('title', 'Edit Room')


@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.rooms.index') }}">Rooms</a>
    </li>
    <li class="breadcrumb-item active">
        Edit
    </li>
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Room Type</h4>
                <form class="forms-sample" method="post" action="{{ route('admin.rooms.update', $record->id) }}" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('put')

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
                        <label for="size">Size</label>
                        <input type="text" class="form-control" id="size" name="size" placeholder="Size" value="{{ old('size', $record->room_feature->size) }}">
                        @error('size')
                            <span class="error-message">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="capacity">Capacity</label>
                        <input type="text" class="form-control" id="capacity" name="capacity" placeholder="Capacity" value="{{ old('capacity', $record->room_feature->capacity) }}">
                        @error('capacity')
                            <span class="error-message">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="bed">Bed</label>
                        <input type="text" class="form-control" id="bed" name="bed" placeholder="Bed" value="{{ old('bed', $record->room_feature->bed) }}">
                        @error('bed')
                            <span class="error-message">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="4" placeholder="Description">{{ old('description', $record->room_feature->description) }}</textarea>
                        @error('description')
                            <span class="error-message">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-select" name="status" id="status">
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
                    <div class="form-group">
                        <label>File upload</label>
                        <input type="file" name="images[]" class="file-upload-default" multiple>
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image" multiple>
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-gradient-primary py-3" type="button">Upload</button>
                            </span>
                        </div>
                        @error('images.*')
                            <span class="error-message">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="images">Images</label>
                        <br/>
                        @foreach($record->room_images as $image)
                            <img src="{{ $image->image_url }}" class="me-2 mb-2" width="100" height="100">
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label>Room Services</label>
                        <br/>
                        @php $servicesOptions = \App\Models\Service::getServicesListing(); @endphp
                        @foreach($servicesOptions as $key => $service)
                            <div class="form-check form-check-flat form-check-primary">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="services[]" value="{{ $key }}" 
                                    {{ in_array($key, old('services', isset($record) ? $record->services->pluck('id')->toArray() : [])) ? 'checked' : '' }}>
                                    {{ $service }}
                                    <i class="input-helper"></i>
                                </label>
                            </div>
                        @endforeach
                        @error('services.*')
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