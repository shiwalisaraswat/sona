@extends('admin.layouts.master')
@section('title', 'Room Type')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Room Type</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Room Type</li>
    </ol>
@endsection

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Room Type List</h4>
                <table class="table table-striped custom-table">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> Name </th>
                            <th> Description </th>
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
                                    <td>{{ $slNo++ }}</td> {{-- align="center" --}}
                                    <td> {{ $record->name }} </td>
                                    <td class="desc-cell"> 
                                        <div class="content-wrapper">
                                            <span class="short-text">
                                                {{ \Illuminate\Support\Str::limit($record->description, 40) }}
                                            </span>

                                            <span class="full-text d-none">
                                                {{ $record->description }}
                                            </span>

                                            @if(strlen($record->description) > 40)
                                                <br>
                                                <a href="javascript:void(0)" class="toggle-text text-primary" style="font-size: 0.85rem;">Show more</a>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <label class="badge status-toggle cursor-pointer badge-gradient-{{ $record->status == 'Active' ? 'success' : 'danger' }}" data-id="{{ $record->id }}" style="cursor: pointer;">
                                            {{ $record->status }}
                                        </label>
                                    </td>
                                    <td> {{ date('d-m-Y', strtotime($record->created_at)) }} </td>
                                    <td>
                                        @if($record->trashed())
                                            <a href="#" class="icon restore_icon me-2" data-url="{{ route('admin.room_types.restore', $record->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Restore"><i class="fa fa-undo"></i></a>

                                            <a href="#" class="icon force_delete_icon" data-url="{{ route('admin.room_types.force_delete', $record->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanent Delete"><i class="fa fa-trash-o"></i></a>
                                        @else
                                            <a href="{{ route('admin.room_types.edit',$record->id) }}" class="icon edit_icon me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fa fa-edit"></i></a>

										    <a href="#" class="icon soft_delete_icon" data-url="{{ route('admin.room_types.destroy', $record->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Soft Delete"><i class="fa fa-trash-o"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="6">No Record Found!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <br/>
                @include('admin.elements.pagination')
            </div>
        </div>
    </div>

<script>
$(document).on('click', '.soft_delete_icon', function() {
    let url = $(this).data('url');
    let $row = $(this).closest('tr');

    Swal.fire({
        title: 'Are you sure?',
        text: "This action can be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        // Disable default SWAL button styles
        buttonsStyling: false, 
        // Inject your custom gradient classes
        customClass: {
            confirmButton: 'btn btn-gradient-danger mx-2', 
            cancelButton: 'btn btn-gradient-secondary mx-2'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'DELETE',
                data: { _token: "{{ csrf_token() }}" },
                success: function(res) {
                    if (res.success) {
                        $row.fadeOut(500, function() { $(this).remove(); });
                        toastr.success(res.message);
                    }
                },
                error: function() {
                    toastr.error("Could not delete this item.");
                }
            });
        }
    });
});

$(document).on('click', '.restore_icon', function() {
    let url = $(this).data('url');

    Swal.fire({
        title: 'Restore this item?',
        text: "It will appear back in your active list.",
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Yes, Restore!',
        cancelButtonText: 'Cancel',
        // Disable default SWAL button styles
        buttonsStyling: false, 
        // Inject your custom gradient classes
        customClass: {
            confirmButton: 'btn btn-gradient-danger mx-2', 
            cancelButton: 'btn btn-gradient-secondary mx-2'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'POST', // We use POST for state changes
                data: { 
                    _token: "{{ csrf_token() }}" 
                },
                success: function(res) {
                    if (res.success) {
                        toastr.success(res.message);
                        // Reload to refresh the action buttons (Edit/Delete)
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                },
                error: function() {
                    toastr.error("Failed to restore record.");
                }
            });
        }
    });
});

$(document).on('click', '.force_delete_icon', function() {
    let url = $(this).data('url');
    let $row = $(this).closest('tr');

    Swal.fire({
        title: 'PERMANENT DELETE?',
        text: "This will remove the record from the database FOREVER!",
        icon: 'error', // Error icon for dangerous actions
        showCancelButton: true,
        confirmButtonText: 'Yes, Wipe it!',
        buttonsStyling: false,
        customClass: {
            confirmButton: 'btn btn-danger mx-2',
            cancelButton: 'btn btn-light mx-2'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'DELETE',
                data: { _token: "{{ csrf_token() }}" },
                success: function(res) {
                    if (res.success) {
                        $row.fadeOut(500, function() { $(this).remove(); });
                        toastr.error(res.message); // Using error toast for "Deleted"
                    }
                }
            });
        }
    });
});

$(document).on('click', '.status-toggle', function() {
    let $badge = $(this);
    let id = $badge.data('id');

    // Add a trailing slash so we can just append the ID
    let baseUrl = "{{ route('admin.room_types.change_status', ':id') }}";
    let url = baseUrl.replace(':id', id);
    console.log('Final URL: ' + url);

    $.ajax({
        url: url, // Ensure this route exists
        type: 'POST',
        data: { _token: '{{ csrf_token() }}' },
        success: function(response) {
            if (response.success) {
                // Update Text
                $badge.text(response.new_status);

                // Update Colors
                if (response.new_status === 'Active') {
                    $badge.removeClass('badge-gradient-danger').addClass('badge-gradient-success');
                } else {
                    $badge.removeClass('badge-gradient-success').addClass('badge-gradient-danger');
                }

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