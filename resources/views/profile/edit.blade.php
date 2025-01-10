@extends('layouts.app')

@section('content')

<div class="container mb-5"> <!-- Tambahkan kelas mb-5 untuk jarak bawah -->
    <h1>Edit Profile</h1>
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Menampilkan pesan error jika ada -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="mb-3">
            <label for="photo" class="form-label">Upload Photo</label>
            <input type="file" class="form-control" id="photo" name="photo">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $profile->username ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $profile->email ?? '') }}">
        </div>
        <!-- Address -->
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $profile->address ?? '') }}">
        </div>

        <!-- Phone -->
        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $profile->phone ?? '') }}">
        </div>

        <!-- Bio -->
        <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea class="form-control" id="bio" name="bio" rows="4">{{ old('bio', $profile->bio ?? '') }}</textarea>
        </div>

        <!-- Button -->
        <button type="submit" class="btn btn-success">Save Data</button>
    </form>
</div>

@endsection
