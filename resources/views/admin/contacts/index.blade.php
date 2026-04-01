@extends('admin.layouts.master')
@section('title', 'Contact')


@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">
        Contacts
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
                            <th> Name </th>
                            <th> Email </th>
                            <th> Message </th>
                            <th> Created </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($records->count())
                            @php $slNo =  $records->firstItem() @endphp
                            @foreach($records as $record)
                                <tr>
                                    <td>{{ $slNo++ }}</td>
                                    <td>{{ $record->name }}</td>
                                    <td>{{ $record->email }}</td>
                                    <td class="desc-cell"> 
                                        <div class="content-wrapper">
                                            <span class="short-text">
                                                {{ \Illuminate\Support\Str::limit($record->message, 40) }}
                                            </span>

                                            <span class="full-text d-none">
                                                {{ $record->message }}
                                            </span>

                                            @if(strlen($record->message) > 40)
                                                <br>
                                                <a href="javascript:void(0)" class="toggle-text text-primary" style="font-size: 0.85rem;">Show more</a>
                                            @endif
                                        </div>
                                    </td>
                                    <td> {{ date('d-m-Y', strtotime($record->created_at)) }} </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="5">No Record Found!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <br/>
                @include('admin.elements.pagination')
            </div>
        </div>
    </div>
@endsection