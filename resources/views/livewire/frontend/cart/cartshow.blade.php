<div>
    <div class="py-3 py-md-5">
        <div class="container">
            <h4>Cart List</h4>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                    <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                    <div class="row cart-header">
                    <div class="row align-items-center mb-2">
                            <div class="col-md-6 d-flex align-items-center">
                                <h4>Products</h4>
                            </div>
                            <div class="col-md-2 text-center">
                                <h4>Price</h4>
                            </div>
                            <div class="col-md-2 text-center">
                                <h4>Quantity</h4>
                            </div>
                            <div class="col-md-1 text-center">
                                <h4>Total</h4>
                            </div>
                            <div class="col-md-1 text-center">
                                <h4>Remove</h4>
                            </div>
                        </div>

                        @forelse ($cart as $cartItem)
                            @if ($cartItem->product)
                                <div class="row align-items-center mb-3 border-bottom pb-2">
                                    <!-- Product Information -->
                                    <div class="col-md-6 d-flex align-items-center">
                                        <a href="{{ url('collections/'.$cartItem->product->category->slug.'/'.$cartItem->product->slug) }}">
                                            @if ($cartItem->product->productImages)
                                                <img src="{{ asset($cartItem->product->productImages[0]->image) }}" 
                                                    class="me-3" style="width: 60px; height: 60px; object-fit: cover;" alt="">
                                            @else
                                                <img src="" class="me-3" style="width: 60px; height: 60px; object-fit: cover;" alt="">
                                            @endif
                                        </a>
                                        <div>
                                            <p class="mb-0 fw-bold">{{ $cartItem->product->name }}</p>
                                            @if ($cartItem->productColor && $cartItem->productColor->color)
                                                <span class="text-muted small">Color: {{ $cartItem->productColor->color->name }}</span>
                                            @endif
                                        </div>
                                    </div>


                                    <!-- Price -->
                                    <div class="col-md-2 text-center">
                                        <p class="mb-0">${{ $cartItem->product->selling_price }}</p>
                                    </div>

                                    <!-- Quantity -->
                                    <div class="col-md-2 text-center">
                                        <div class="input-group justify-content-center">
                                            <button type="button" 
                                                    wire:loading.attr="disabled" 
                                                    wire:click="decrementQuantity({{ $cartItem->id }})" 
                                                    class="btn btn-outline-secondary btn-sm">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                            <input type="text" value="{{ $cartItem->quantity }}" 
                                                class="form-control text-center mx-1" style="width: 50px;" readonly />
                                            <button type="button" 
                                                    wire:loading.attr="disabled" 
                                                    wire:click="incrementQuantity({{ $cartItem->id }})" 
                                                    class="btn btn-outline-secondary btn-sm">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Total -->
                                    <div class="col-md-1 text-center">
                                        <p class="mb-0">${{ $cartItem->product->selling_price * $cartItem->quantity }}</p>
                                        @php $totalPrice += $cartItem->product->selling_price * $cartItem->quantity @endphp
                                    </div>

                                    <!-- Remove Button -->
                                    <div class="col-md-1 text-center">
                                        <button type="button" 
                                                wire:click="removeCartItem({{ $cartItem->id }})" 
                                                class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="text-center">
                                <h5>No Cart Item</h5>
                            </div>
                        @endforelse

                             
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 my-md-auto mt-3">
                    <h4>
                        Get the best deals & Offers <a href="{{ url('/collections') }}">shop now</a>
                    </h4>

                </div>
                <div class="col-md-4 mt-3">
                    <div class="shadow-sm bg-white p-3">
                        <h5>Total:
                            <span class="float-end">${{ $totalPrice }}</span>
                        </h5>
                        <hr>
                        <a href="{{ url('/checkout') }}" class="btn btn-primary w-100">Checkout</a>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
