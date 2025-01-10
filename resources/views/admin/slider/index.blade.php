@extends('layouts.admin')

@section('content')

<div class="card-box mb-30">
    <div class="h5 pd-20 mb-0">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        
        @endif
        <div class="card-header">
        <div class="card-header d-flex align-items-center justify-content-between">
                <h4>Slider List</h4>
                <a href="{{ url('admin/sliders/create') }}" class="btn btn-primary btn-sm text white" style="position: relative; right: 0;">
                    Add Slider
                </a>
                </div>
                <div class="card-body"></div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
             @foreach ($sliders as $slider)
                <tr>
                    <td>{{ $slider->id }}</td>
                    <td>{{ $slider->title }}</td>
                    <td>{{ $slider->description }}</td>
                    <td>
                        <img src="{{ asset("$slider->image") }}" style="width: 70px; height: 70px" alt="Slider">
                    </td>
                    <td>{{ $slider->status == '0' ? 'Visible':'Hidden' }}</td>
                    <td>
                        <a href="{{ url('admin/sliders/'.$slider->id.'/edit') }}" class="btn btn-success">Edit</a>
                        <a href="{{ url('admin/sliders/'.$slider->id.'/delete') }}" 
                            onclick="return confirm('Are you sure?');" 
                            class="btn btn-danger">Delete</a>

                    </td>
                </tr>
             @endforeach   
            </tbody>
        </table>
        </div>
    </div>
</div>

@endsection