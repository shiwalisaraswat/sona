@extends('layouts.pages')
@section('title', 'Our Rooms')


@section('breadcrumb')
<h2>Our Rooms</h2>
<div class="bt-option">
    <a href="{{ route('home') }}">Home</a>
    <span>Rooms</span>
</div>
@endsection


@section('content')
    <!-- Rooms Section Begin -->
    <section class="rooms-section spad">
        <div class="container">
            <div class="row">
                @foreach($records as $record)
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="{{ $record->first_image?->image_url ?? asset('public/admin/images/default/placeholder1.png') }}" alt="{{ $record->first_image->image ?? 'placeholder1' }}" width="370" height="240">
                        <div class="ri-text">
                            <h4>{{ $record->room_type->name }}</h4>
                            <h3>{{ $record->price }}$<span>/Pernight</span></h3>
                            <table>
                                <tbody>
                                    {{-- @if(isset($record->room_feature)) --}}
                                    <tr>
                                        <td class="r-o">Size:</td>
                                        <td>{{ $record->room_feature->size ?? 'N\A' }} ft</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Capacity:</td>
                                        <td>Max persion {{ $record->room_feature->capacity ?? 'N\A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Bed:</td>
                                        <td>{{ $record->room_feature->bed ?? 'N\A' }}</td>
                                    </tr>
                                    {{-- @endif --}}

                                    {{-- @if($record->services && $record->services->isNotEmpty()) --}}
                                    <tr>
                                        <td class="r-o">Services:</td>
                                        <td>
                                            @if($record->services && $record->services->isNotEmpty())
                                                {{ $record->services->pluck('name')->implode(', ') }}
                                            @else
                                                N\A
                                            @endif
                                        </td>
                                    </tr>
                                    {{-- @endif --}}
                                </tbody>
                            </table>
                            <a href="{{ route('rooms.detail', $record->id) }}" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
                
                @include('elements.pagination')
            </div>
        </div>
    </section>
    <!-- Rooms Section End -->
@endsection
    