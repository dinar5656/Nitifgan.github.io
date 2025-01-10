<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <h4>Wishlist List</h4>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <!-- Header -->
                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row align-items-center mb-2">
                                <div class="col-md-6 d-flex align-items-center">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-2 text-center">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>

                        <!-- Wishlist Items -->
                        @forelse ($wishlist as $wishlistItem)
                            @if ($wishlistItem->product)
                                <div class="row align-items-center mb-3 border-bottom pb-2">
                                    <!-- Product Information -->
                                    <div class="col-md-6 d-flex align-items-center">
                                        <a href="{{ url('collections/'.$wishlistItem->product->category->slug.'/'.$wishlistItem->product->slug) }}">
                                            <img src="{{ $wishlistItem->product->productImages[0]->image }}" 
                                                 style="width: 60px; height: 60px; object-fit: cover; margin-right: 15px;" 
                                                 alt="{{ $wishlistItem->product->name }}">
                                        </a>
                                        <div>
                                            <a href="{{ url('collections/'.$wishlistItem->product->category->slug.'/'.$wishlistItem->product->slug) }}" 
                                               class="text-decoration-none text-dark">
                                                <p class="mb-0 fw-bold">{{ $wishlistItem->product->name }}</p>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Price -->
                                    <div class="col-md-2 text-center">
                                        <p class="mb-0">${{ $wishlistItem->product->selling_price }}</p>
                                    </div>

                                    <!-- Remove Button -->
                                    <div class="col-md-4 text-center">
                                        <button type="button" 
                                                wire:click="removeWishlistItem({{ $wishlistItem->id }})" 
                                                class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="text-center">
                                <h5>No Wishlist Items</h5>
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
