@extends('layouts.admin')

@section('content')

<div class="card-box mb-30">
    <div class="h5 pd-20 mb-0">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        
        @endif
        <div class="card-header">
        <div class="card-header d-flex align-items-center justify-content-between">
                <h4>Add Slider</h4>
                <a href="{{ url('admin/sliders') }}" class="btn btn-danger btn-sm text white" style="position: relative; right: 0;">
                    Back
                </a>
                </div>
                <div class="card-body"></div>
                <form action="{{ url('admin/sliders/create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label>Status</label> <br/>
                        <input type="checkbox" name="status" style="width: 20px; height: 20px;" />
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
 
        </div>
    </div>
</div>

@endsection