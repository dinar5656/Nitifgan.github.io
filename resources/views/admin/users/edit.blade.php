@extends('layouts.admin')

@section('title', 'Update User List')

@section('content')
<div class="card-box mb-30">
    <div class="h5 pd-20 mb-0">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error )
                <div>{{$error}}</div>
            @endforeach
        </div>      
        @endif

        <div class="card-header d-flex align-items-center justify-content-between">
            <h4>Update Users</h4>
            <a href="{{ url('admin/users'.$user->id) }}" class="btn btn-danger btn-sm text-white">
                Back
            </a>
        </div>

        <div class="card-body"></div>
        <form action="{{ url('admin/users/' . $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" />
                </div>
                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="text" name="email" readonly value="{{ $user->email }}" class="form-control" />
                </div>
                <div class="col-md-6 mb-3">
                    <label>Password</label>
                    <input type="text" name="password"  class="form-control" />
                </div>
                <div class="col-md-6 mb-3">
                    <label>Select Role</label>
                    <select name="role_as" class="form-control">
                        <option value="">Select Role</option>
                        <option value="0" {{ $user->role_as == 0 ? 'selected' : '' }}>User</option>
                        <option value="1" {{ $user->role_as == 1 ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                <div class="col-md-12 text-end">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>

            </div>
        </div>
    </div>
</div>
@endsection
