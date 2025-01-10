@extends('layouts.app')

@section('title', 'Thank you for ordering')

@section('content')
    <div class="py-3 pyt-md-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="p-4 shadow bg-white">
                    @if (session('message'))
                    <h5 class="alert alert-success">{{ session('message') }}</h5>
                    @endif
                    
                    <h2>You Logo</h2>
                        <h4>Thank You for Shopping with NitipGan</h4>
                        <a href="{{ url('collections') }}" class="btn btn-primary">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
