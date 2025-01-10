@extends('layouts.app')

@section('title', 'Search Product')

@section('content')
<div class="py-5 bg-light">
  <div class="container">
    <div class="row mb-4">
      <div class="col-md-12 text-center">
        <h2 class="fw-bold">Search Product Results</h2>
        <p class="text-muted">Hasil pencarian untuk produk yang Anda cari.</p>
        <div class="underline bg-primary mx-auto"></div>
      </div>
    </div>

    <div class="row">
      @if ($searchProducts && $searchProducts->count() > 0)
        @foreach ($searchProducts as $productItem)
          <div class="col-md-3 mb-4">
            <div class="card shadow-sm h-100">
              <div class="position-relative">
                @if ($productItem->productImages->count() > 0)
                  <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                    <img src="{{ asset($productItem->productImages[0]->image) }}" 
                         class="card-img-top product-image" 
                         alt="{{ $productItem->name }}">
                  </a>
                @else
                  <img src="path/to/default-image.jpg" 
                       class="card-img-top product-image" 
                       alt="Default Image">
                @endif
                <span class="badge bg-danger position-absolute top-0 start-0 m-2 px-3 py-1">New</span>
              </div>
              <div class="card-body">
                <h5 class="card-title text-truncate">
                  <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}" 
                     class="text-dark text-decoration-none">
                    {{ $productItem->name }}
                  </a>
                </h5>
                <p class="card-text text-muted mb-1">{{ $productItem->brand }}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <span class="text-primary fw-bold">${{ $productItem->selling_price }}</span>
                  <small class="text-muted text-decoration-line-through">${{ $productItem->original_price }}</small>
                </div>
              </div>
            </div>
          </div>
        @endforeach

        <!-- Tombol View More -->
        <div class="col-md-12 text-center mt-4">
          <a href="{{ url('/collections') }}" class="btn btn-primary px-4 py-2">
            View More Products
          </a>
        </div>
      @else
        <div class="col-md-12 text-center">
          <div class="alert alert-warning py-5">
            <h4>No Products Available</h4>
            <p class="mb-0">Coba gunakan kata kunci yang berbeda untuk pencarian Anda.</p>
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection
