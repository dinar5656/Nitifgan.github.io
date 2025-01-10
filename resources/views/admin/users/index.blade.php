@extends('layouts.admin')

@section('title', 'User List')

@section('content')
<div class="card-box mb-30">
    <div class="h5 pd-20 mb-0">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <div class="card-header d-flex align-items-center justify-content-between">
            <h4>Users</h4>
            <a href="{{ url('admin/users/create') }}" class="btn btn-primary btn-sm text-white">
                Add User
            </a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->role_as == '0')
                                    <label class="badge btn-primary">User</label>
                                @elseif ($user->role_as == '1')
                                    <label class="badge btn-success">Admin</label>
                                @else
                                    <label class="badge btn-danger">None</label>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('admin/users/'.$user->id.'/edit') }}" class="btn btn-sm btn-success">
                                    Edit
                                </a>
                                <a href="{{ url('admin/users/'.$user->id.'/delete') }}" onclick="return confirm('Are You Sure?')" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No Users Available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
