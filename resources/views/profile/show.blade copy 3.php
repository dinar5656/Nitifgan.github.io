@extends('layouts.app')

@section('content')
<div class="container mb-5"> <!-- Menambahkan margin-bottom untuk jarak ke footer -->
    <h1 class="mb-4">Your Profile</h1> <!-- Menambahkan margin-bottom pada judul -->
    <div class="card">
        <div class="card-header">
            <strong>Profile Details</strong> <!-- Label untuk card header -->
        </div>
        <div class="card-body">
            <p><strong>Address:</strong> {{ $profile->address ?? 'N/A' }}</p>
            <p><strong>Phone:</strong> {{ $profile->phone ?? 'N/A' }}</p>
            <p><strong>Bio:</strong> {{ $profile->bio ?? 'N/A' }}</p>
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>
</div>
@endsection
