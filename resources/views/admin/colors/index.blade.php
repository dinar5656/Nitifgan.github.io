@extends('layouts.admin')

@section('content')

<div class="card-box mb-30">
    <div class="h5 pd-20 mb-0">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        
        @endif
        <div class="card-header">
        <div class="card-header d-flex align-items-center justify-content-between">
                <h4>Colors List</h4>
                <a href="{{ url('admin/colors/create') }}" class="btn btn-primary btn-sm text white" style="position: relative; right: 0;">
                    Add Color
                </a>
                </div>
                <div class="card-body"></div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Color Name</th>
                    <th>Color Code</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($colors as $item)                
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->status ? 'Hidden':'Visible' }}</td>
                    <td>
                        <a href="{{ url('admin/colors/'.$item->id.'/edit') }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{ url('admin/colors/'.$item->id.'/delete') }}" onclick="return confirm('Are You Sure?')" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>

@endsection