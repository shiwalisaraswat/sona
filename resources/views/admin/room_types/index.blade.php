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
                                        <a href="{{ route('admin.room_types.edit',$record->id) }}" class="icon me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
										<a href="{{ route('admin.room_types.destroy',$record->id) }}" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a>
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
$(document).on('click', '.status-toggle', function() {
    let $badge = $(this);
    let id = $badge.data('id');

    // Add a trailing slash so we can just append the ID
    let baseUrl = "{{ route('admin.room_types.changeStatus', ':id') }}";
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