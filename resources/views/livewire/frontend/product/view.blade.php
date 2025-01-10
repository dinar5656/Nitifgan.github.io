<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="row">
                <!-- Gambar Produk -->
                <div class="col-md-5 mt-3">
                    <div id="productImageCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
                    <div class="carousel-inner bg-white border">
                            @if ($product->productImages->count() > 0)
                                @foreach ($product->productImages as $key => $image)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset($image->image) }}" class="d-block w-100" alt="Product Image">
                                    </div>
                                @endforeach
                            @else
                                <div class="carousel-item active">
                                    <p class="text-center py-5">No Images Available</p>
                                </div>
                            @endif
                        </div>
                        <!-- Tombol Navigasi -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#productImageCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productImageCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

                <!-- Detail Produk -->
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{ $product->name }}
                        </h4>
                        <hr>
                        <p class="product-path">
                            Home / {{ $product->category->name }} / {{ $product->name }}
                        </p>
                        <div>
                            <span class="selling-price">${{ $product->selling_price }}</span>
                            <span class="original-price">${{ $product->original_price }}</span>
                        </div>
                        @if ($product->productColors->count() > 0)
                            <div>
                                @foreach ($product->productColors as $colorItem)
                                    <label 
                                        wire:click="colorSelected({{ $colorItem->id }})"
                                        @class([
                                            'btn btn-sm text-uppercase fw-bold px-2 py-1 my-1 border',
                                            'btn-dark text-white' => $this->productColorId === $colorItem->id, // Gunakan $productColorId
                                            'btn-light text-dark' => $this->productColorId !== $colorItem->id, // Gunakan $productColorId
                                        ])
                                        style="border-width: 2px;"
                                    >
                                        <input type="radio" name="colorSelection" value="{{ $colorItem->id }}" hidden>
                                        {{ $colorItem->color->name }}
                                    </label>
                                @endforeach
                            </div>
                            <div class="mt-2">
                                @if ($this->prodColorSelectedQuantity === 'outOfStock')
                                    <label class="btn-sm py-1 text-white bg-danger border">Out Of Stock</label>
                                @elseif ($this->prodColorSelectedQuantity > 0)
                                    <label class="btn-sm py-1 text-white bg-success border">In Stock</label>
                                @endif
                            </div>
                        @else
                            <div>
                                @if ($product->quantity > 0)
                                    <label class="btn-sm py-1 text-white bg-success border">In Stock</label>
                                @else
                                    <label class="btn-sm py-1 text-white bg-danger border">Out Of Stock</label>
                                @endif
                            </div>
                        @endif

                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn-sm btn1" wire:click="decrementQuantity"><i class="fa fa-minus"></i></span>
                                <input type="text" wire:model="quantityCount" value="{{ $this->quantityCount }}" readonly class="input-quantity" />
                                <span class="btn btn-sm btn1" wire:click="incrementQuantity"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                        <button type="button" 
                                wire:click="addToCart({{ $product->id }})" 
                                class="btn btn-primary" 
                                style="margin-top: 10px;">
                            <i class="fa fa-shopping-cart"></i> Add To Cart
                            <span wire:loading wire:target="addToWishlist">Loading...</span>
                        </button>

                            <button type="button" wire:click="addToWishlist({{ $product->id }})" class="btn btn1">
                                <span wire:loading.remove wire:target="addToWishlist">
                                    <i class="fa fa-heart"></i> Add To Wishlist 
                                </span>
                                <span wire:loading wire:target="addToWishlist">Loading...</span>
                            </button>
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">Small Description</h5>
                            <p>
                                {!! $product->small_description !!}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi Produk -->
                <div class="row">
                    <div class="col-md-12 mt-3">
                        <div class="card">
                            <div class="card-header bg-white">
                                <h4>Description</h4>
                            </div>
                            <div class="card-body">
                                <p>
                                    {!! $product->description !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>