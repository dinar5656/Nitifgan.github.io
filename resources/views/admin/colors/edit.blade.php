@extends('layouts.admin')

@section('content')

<div class="card-box mb-30">
    <div class="h5 pd-20 mb-0">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        
        @endif
        <div class="card-header">
        <div class="card-header d-flex align-items-center justify-content-between">
                <h4>Edit Color</h4>
                <a href="{{ url('admin/colors') }}" class="btn btn-danger btn-sm text white" style="position: relative; right: 0;">
                    Back
                </a>
                </div>
                <div class="card-body"></div>
                <form action="{{ url('admin/colors/'.$color->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Color Name</label>
                        <input type="text" name="name" value="{{ $color->name }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Color Code</label>
                        <input type="text" name="code" value="{{ $color->code }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Status</label> <br/>
                        <input type="checkbox" name="status" {{ $color->status ? 'checked':'' }} style="width: 20px; height: 20px;" />
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
 
        </div>
    </div>
</div>

@endsection