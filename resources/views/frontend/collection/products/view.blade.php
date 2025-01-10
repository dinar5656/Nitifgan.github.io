@extends('layouts.app')

@section('title')
{{ $product->meta_title ?? 'Default Title' }}
@endsection

@section('meta_keyword')
{{ $product->meta_keyword ?? 'Default Keyword' }}
@endsection

@section('meta_description')
{{ $product->meta_description ?? 'Default Description' }}
@endsection

@section('content')

    <div>
        <livewire:frontend.product.view :category="$category" :product="$product" />
    </div>

@endsection
