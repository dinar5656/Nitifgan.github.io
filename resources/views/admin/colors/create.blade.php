@extends('layouts.admin')

@section('content')

<div class="card-box mb-30">
    <div class="h5 pd-20 mb-0">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        
        @endif
        <div class="card-header">
        <div class="card-header d-flex align-items-center justify-content-between">
                <h4>Add Color</h4>
                <a href="{{ url('admin/colors') }}" class="btn btn-danger btn-sm text white" style="position: relative; right: 0;">
                    Back
                </a>
                </div>
                <div class="card-body"></div>
                <form action="{{ route('admin.colors.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Color Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Color Code</label>
                        <input type="text" name="code" class="form-control">
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