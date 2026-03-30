@extends('admin.layouts.master')
@section('title', 'Room')


@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">
        Rooms
    </li>
@endsection

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> Image </th>
                            <th> Room Type </th>
                            <th> Room Number </th>
                            <th> Size <br/>(in ft) </th>
                            <th> Capacity <br/>(Max person) </th>
                            <th> Price </th>
                            <th> Status </th>
                            <th> Created </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($records->count())
                            @php $slNo =  $records->firstItem() @endphp
                            @foreach($records as $record)
                                <tr>
                                    <td>{{ $slNo++ }}</td>
                                    <td>
                                        <img src="{{ $record->first_image?->image_url ?? asset('public/admin/images/default/placeholder1.png') }}" class="me-2 mb-2" width="100" height="100">
                                    </td>
                                    <td>{{ $record->room_type->name ?? 'N\A' }}</td>
                                    <td>{{ $record->room_number }}</td>
                                    <td>{{  $record->room_feature->size ?? 'N\A' }}</td>
                                    <td>{{ $record->room_feature->capacity ?? 'N\A' }}</td>
                                    <td>{{ $record->price }}</td>
                                    <td>
                                        @php
                                            $statusClasses = [
                                                'Available' => 'success',
                                                'Booked' => 'primary',
                                                'Maintenance' => 'danger',
                                            ];
                                        @endphp

                                        <label 
                                            class="badge status-toggle cursor-pointer badge-gradient-{{ $statusClasses[$record->status] ?? 'dark' }}" data-id="{{ $record->id }}" data-status="{{ $record->status }}" style="cursor: pointer;">
                                            {{ $record->status }}
                                        </label>
                                    </td>
                                    <td> {{ date('d-m-Y', strtotime($record->created_at)) }} </td>
                                    <td>
                                        @if($record->trashed())
                                            <a href="#" class="icon restore_icon me-2" data-url="{{ route('admin.rooms.restore', $record->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Restore"><i class="fa fa-undo"></i></a>

                                            <a href="#" class="icon force_delete_icon" data-url="{{ route('admin.rooms.force_delete', $record->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanent Delete"><i class="fa fa-trash-o"></i></a>
                                        @else
                                            <a href="{{ route('admin.rooms.edit',$record->id) }}" class="icon edit_icon me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fa fa-edit"></i></a>

										    <a href="#" class="icon soft_delete_icon" data-url="{{ route('admin.rooms.destroy', $record->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Soft Delete"><i class="fa fa-trash-o"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="7">No Record Found!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <br/>
                @include('admin.elements.pagination')
            </div>
        </div>
    </div>

@push('scripts')
    <script>
        console.log('Page specific JS');
    </script>
@endpush

@pushOnce('scripts', 'soft_delete-js')
<script src="{{ asset('public/admin/js/soft_delete.js') }}"></script>
@endPushOnce

@pushOnce('scripts', 'restore-js')
<script src="{{ asset('public/admin/js/restore.js') }}"></script>
@endPushOnce

@pushOnce('scripts', 'force_delete-js')
<script src="{{ asset('public/admin/js/force_delete.js') }}"></script>
@endPushOnce

<script>
$(document).on('click', '.status-toggle', function() {
    let $badge = $(this);
    let id = $badge.data('id');

    // Add a trailing slash so we can just append the ID
    let baseUrl = "{{ route('admin.rooms.change_status', ':id') }}";
    let url = baseUrl.replace(':id', id);
    console.log('Final URL: ' + url);

    $.ajax({
        url: url, // Ensure this route exists
        type: 'POST',
        data: { _token: '{{ csrf_token() }}' },
        success: function(response) {
            if (response.success) {
                // Update text
                $badge.text(response.new_status);

                // Remove all status classes
                $badge.removeClass('badge-gradient-success badge-gradient-primary badge-gradient-danger');

                // Add new class dynamically
                let statusClassMap = {
                    'Available': 'badge-gradient-success',
                    'Booked': 'badge-gradient-primary',
                    'Maintenance': 'badge-gradient-danger'
                };

                $badge.addClass(statusClassMap[response.new_status]);

                // Show Toastr
                toastr.success(response.message);
            }
        },
        error: function() {
            toastr.error("Something went wrong!");
        }
    });
});
</script>

@endsection