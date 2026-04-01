@extends('admin.layouts.master')
@section('title', 'Admin')


@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">
        Admins
    </li>
@endsection

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped custom-table">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> Profile Pic </th>
                            <th> Role </th>
                            <th> Name </th>
                            <th> Email </th>
                            <th> Created </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($records->count())
                            @php $slNo = $records->firstItem() @endphp
                            @foreach($records as $record)
                                <tr>
                                    <td>{{ $slNo++ }}</td>
                                    <td>
                                        <div class="gallery">
                                            <a href="{{ $record->profile_pic_url ?? asset('public/admin/images/default/placeholder1.png') }}" data-fancybox="gallery">
                                                <img src="{{ $record->profile_pic_url ?? asset('public/admin/images/default/placeholder1.png') }}" class="me-2 mb-2" width="100" height="100" />
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $roleClasses = [
                                                'super_admin' => 'danger',
                                                'sub_admin' => 'primary',
                                                'staff' => 'success',
                                            ];
                                        @endphp

                                        <label 
                                            class="badge badge-gradient-{{ $roleClasses[$record->role] ?? 'dark' }} badge-rounded ">
                                            {{ ucwords(str_replace('_', ' ', $record->role)) }}
                                        </label>
                                    </td>
                                    <td> {{ $record->name }} </td>
                                    <td> {{ $record->email }} </td>
                                    <td> {{ date('d-m-Y', strtotime($record->created_at)) }} </td>
                                    <td>
                                        @if($record->trashed())
                                            <a href="#" class="icon restore_icon me-2" data-url="{{ route('admin.admins.restore', $record->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Restore"><i class="fa fa-undo"></i></a>

                                            <a href="#" class="icon force_delete_icon" data-url="{{ route('admin.admins.force_delete', $record->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanent Delete"><i class="fa fa-trash-o"></i></a>
                                        @else
                                            <a href="{{ route('admin.admins.edit', $record->id) }}" class="icon edit_icon me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fa fa-edit"></i></a>

										    <a href="#" class="icon soft_delete_icon" data-url="{{ route('admin.admins.destroy', $record->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Soft Delete"><i class="fa fa-trash-o"></i></a>
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
</script>

@endsection