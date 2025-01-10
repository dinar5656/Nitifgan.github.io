@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

<!-- Carousel Slider -->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    @foreach ($sliders as $key => $sliderItem)
      <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
        @if ($sliderItem->image)
          <img src="{{ asset("$sliderItem->image") }}" class="d-block w-100" alt="Slider Image">
        @endif
        <div class="carousel-caption d-none d-md-block">
          <div class="custom-carousel-content">
            <h1 class="text-primary">{!! $sliderItem->title !!}</h1>
            <p class="text-dark">{!! $sliderItem->description !!}</p>
            <a href="{{ url('/collections') }}" class="btn btn-slider text-dark">Get Now</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<!-- Welcome Section -->
<section class="py-5">
<style>
        /* Header Styles */
        h4.mb-2 {
            color: #2c3e50;
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 1rem !important;
        }
        
        h2.mt-2 {
            color: #34495e;
            font-size: 1.8rem;
            font-weight: 600;
        }
        
        /* Category Item Styles */
        .wsus__categories_item_2 {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            margin: 10px;
        }
        
        .wsus__categories_item_2:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        
        .wsus__categories_item_2 .icon {
            margin-bottom: 1rem;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .wsus__categories_item_2 h5 a {
            color: #2c3e50;
            font-weight: 600;
            text-decoration: none;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }
        
        .wsus__categories_item_2 h5 a:hover {
            color: #3498db;
        }
        
        .wsus__categories_item_2 p {
            color: #7f8c8d;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }
        
        /* Carousel Styles */
        .owl-carousel .owl-stage {
            padding: 20px 0;
        }
        
        .owl-theme .owl-nav [class*='owl-'] {
            background: white;
            border-radius: 50%;
            padding: 10px;
            margin: 5px;
            color: #2c3e50;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .owl-theme .owl-nav [class*='owl-']:hover {
            background: #3498db;
            color: white;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                @if ($categories->isNotEmpty())
                    {{-- Ambil kategori pertama untuk ditampilkan di header --}}
                    <h4 class="mb-2">Welcome to NitifGan Delivery of Web E-Commerce</h4>
                    <h2 class="mt-2">Browse Best Categories</h2>
                @else
                    <h4>{{ __('No Categories Available') }}</h4>
                    <h5>{{ __('Please add categories') }}</h5>
                @endif
            </div>
        </div>

        @if ($categories->isNotEmpty())
            <div class="mt-5 owl-carousel owl-theme four-carousel">
                @foreach ($categories as $categoryItem)
                    <div class="item">
                        <div class="wsus__categories_item_2 text-center">
                            <div class="icon">
                                <img src="{{ asset($categoryItem->image) }}" alt="{{ $categoryItem->name }}" class="img-fluid w-100">
                            </div>
                            <h5>
                                <a href="{{ url('/collections/'.$categoryItem->slug) }}" class="d-inline-block">{{ $categoryItem->name }}</a>
                            </h5>
                            @php
                                $productCount = App\Models\Product::where('category_id', $categoryItem->id)->count();
                            @endphp
                            <p>{{ $productCount }} {{ __('Items') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="row">
                <div class="col-md-12">
                    <div class="p-2">
                        <h4>No Categories Available</h4>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Trending Products Section -->
<div class="py-5 py-3 py-md-5 bg-light">
   <div class="container">
       <div class="row">
           <div class="col-md-12">
               <div class="d-flex justify-content-between align-items-center">
                   <h4 class="mb-0 fw-bold">Trending Products</h4>
                   <a href="{{ url('new-arrivals') }}" class="btn btn-primary rounded-pill px-4">View More</a>
               </div>
               <div class="underline my-3 bg-primary"></div>
           </div>
       </div>

       <div class="row">
           @if ($trendigProducts && $trendigProducts->count() > 0)
               @foreach ($trendigProducts as $productItem)
                   <div class="col-6 col-md-3 mb-4">
                       <div class="category-card bg-white shadow-sm hover-shadow rounded-3 p-3 h-100">
                           <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}" class="text-decoration-none">
                               <div class="category-card-img position-relative overflow-hidden mb-3">
                                   <img src="{{ asset($productItem->productImages[0]->image) }}" 
                                        alt="{{ $productItem->name }}" 
                                        class="img-fluid w-100 rounded object-fit-cover">
                               </div>
                               <div class="category-card-body text-center">
                                   <p class="product-brand text-uppercase fw-medium text-muted small mb-1">{{ $productItem->brand }}</p>
                                   <h5 class="product-name text-dark fs-6 mb-2 text-truncate">{{ $productItem->name }}</h5>
                                   <div class="price d-flex justify-content-center align-items-center gap-2">
                                       <span class="selling-price text-success fs-5 fw-bold">${{ $productItem->selling_price }}</span>
                                       <span class="original-price text-muted text-decoration-line-through small">${{ $productItem->original_price }}</span>
                                   </div>
                               </div>
                           </a>
                       </div>
                   </div>
               @endforeach
           @else
               <div class="col-md-12">
                   <div class="alert alert-info text-center py-4 rounded-3">
                       <h5 class="m-0 text-muted">No Categories Available</h5>
                   </div>
               </div>
           @endif
       </div>
   </div>
</div>

<style>
.hover-shadow:hover {
   box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
   transform: translateY(-3px);
   transition: all .3s ease;
}

.category-card-img img {
   height: 200px;
   object-fit: cover;
   transition: transform .3s ease;
}

.category-card:hover .category-card-img img {
   transform: scale(1.05);
}

.underline {
   height: 3px;
   width: 60px;
   border-radius: 20px;
}
</style>

<div class="py-5 py-3 bg-white">
   <div class="container">
       <div class="row">
           <div class="col-md-12">
               <div class="d-flex justify-content-between align-items-center">
                   <h4 class="mb-0 fw-bold">Featured Products</h4>
                   <a href="{{ url('featured-products') }}" class="btn btn-primary rounded-pill px-4">View More</a>
               </div>
               <div class="underline my-3 bg-primary"></div>
           </div>
       </div>

       <div class="row">
           @if ($featuredProducts && $featuredProducts->count() > 0)
               @foreach ($featuredProducts as $productItem)
                   <div class="col-6 col-md-3 mb-4">
                       <div class="category-card bg-white shadow-sm hover-shadow rounded-3 p-3 h-100">
                           <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}" class="text-decoration-none">
                               <div class="category-card-img position-relative overflow-hidden mb-3">
                                   <img src="{{ asset($productItem->productImages[0]->image) }}" 
                                        alt="{{ $productItem->name }}" 
                                        class="img-fluid w-100 rounded object-fit-cover">
                               </div>
                               <div class="category-card-body text-center">
                                   <p class="product-brand text-uppercase fw-medium text-muted small mb-1">{{ $productItem->brand }}</p>
                                   <h5 class="product-name text-dark fs-6 mb-2 text-truncate">{{ $productItem->name }}</h5>
                                   <div class="price d-flex justify-content-center align-items-center gap-2">
                                       <span class="selling-price text-success fs-5 fw-bold">${{ $productItem->selling_price }}</span>
                                       <span class="original-price text-muted text-decoration-line-through small">${{ $productItem->original_price }}</span>
                                   </div>
                               </div>
                           </a>
                       </div>
                   </div>
               @endforeach
           @else
               <div class="col-md-12">
                   <div class="alert alert-info text-center py-4 rounded-3">
                       <h5 class="m-0 text-muted">No Categories Available</h5>
                   </div>
               </div>
           @endif
       </div>
   </div>
</div>

<style>
.hover-shadow:hover {
   box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
   transform: translateY(-3px);
   transition: all .3s ease;
}

.category-card-img img {
   height: 200px;
   object-fit: cover;
   transition: transform .3s ease;
}

.category-card:hover .category-card-img img {
   transform: scale(1.05);
}

.underline {
   height: 3px;
   width: 60px;
   border-radius: 20px;
}
</style>


@endsection

@section('script')
<script>
  $('.four-carousel').owlCarousel({
    loop: true,
    margin: 10,
    dots: true,
    nav: false,
    responsive: {
      0: { items: 1 },
      600: { items: 3 },
      1000: { items: 5 }
    }
  });
</script>
@endsection
