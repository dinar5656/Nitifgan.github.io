<div>
    <div class="checkout-container py-4">
        <div class="container">
            <div class="checkout-header mb-4">
                <h2 class="fw-bold">Checkout</h2>
                <div class="checkout-progress">
                    <div class="progress-step active">
                        <span class="step-number">1</span>
                        <span class="step-text">Information</span>
                    </div>
                    <div class="progress-step">
                        <span class="step-number">2</span>
                        <span class="step-text">Payment</span>
                    </div>
                    <div class="progress-step">
                        <span class="step-number">3</span>
                        <span class="step-text">Confirmation</span>
                    </div>
                </div>
            </div>

            @if ($this->totalProductAmount != '0')
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="card checkout-form-card">
                            <div class="card-body p-4">
                                <h4 class="card-title mb-4">Customer Information</h4>
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" wire:model.defer="fullname" id="fullname" class="form-control" placeholder="Enter Full Name" />
                                            <label for="fullname">Full Name</label>
                                            @error('fullname') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="tel" wire:model.defer="phone" id="phone" class="form-control" placeholder="Enter Phone Number" />
                                            <label for="phone">Phone Number</label>
                                            @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" wire:model.defer="email" id="email" class="form-control" placeholder="Enter Email Address" />
                                            <label for="email">Email Address</label>
                                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" wire:model.defer="pincode" id="pincode" class="form-control" placeholder="Enter Pin-code" />
                                            <label for="pincode">PIN Code</label>
                                            @error('pincode') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea id="address" wire:model.defer="address" class="form-control" style="height: 100px" placeholder="Enter Address"></textarea>
                                            <label for="address">Delivery Address</label>
                                            @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-4 checkout-payment-card">
                            <div class="card-body p-4">
                                <h4 class="card-title mb-4">Payment Method</h4>
                                
                                <div class="payment-methods">
                                    <div class="payment-method-tabs">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="nav flex-column nav-pills" role="tablist">
                                                    <button class="payment-option active" id="cashOnDeliveryTab-tab" data-bs-toggle="pill" data-bs-target="#cashOnDeliveryTab" type="button" role="tab" aria-selected="true">
                                                        <i class="fas fa-money-bill-wave me-2"></i>
                                                        Cash on Delivery
                                                    </button>
                                                    <button class="payment-option" id="onlinePayment-tab" data-bs-toggle="pill" data-bs-target="#onlinePayment" type="button" role="tab" aria-selected="false">
                                                        <i class="fab fa-paypal me-2"></i>
                                                        PayPal
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-8">
                                                <div class="tab-content">
                                                    <div class="tab-pane fade show active" id="cashOnDeliveryTab" role="tabpanel">
                                                        <div class="payment-details">
                                                            <p class="text-muted mb-4">Pay with cash when your order is delivered.</p>
                                                            <button type="button" wire:loading.attr="disabled" wire:click="codOrder" class="btn btn-primary btn-lg w-100">
                                                                <span wire:loading.remove wire:target="codOrder">
                                                                    <i class="fas fa-lock me-2"></i>Place Order
                                                                </span>
                                                                <span wire:loading wire:target="codOrder">
                                                                    <span class="spinner-border spinner-border-sm me-2"></span>
                                                                    Processing...
                                                                </span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="tab-pane fade" id="onlinePayment" role="tabpanel">
                                                        <div class="payment-details">
                                                            <p class="text-muted mb-4">Pay securely with PayPal.</p>
                                                            <div id="paypal-button-container"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card checkout-summary-card">
                            <div class="card-body p-4">
                                <h4 class="card-title mb-4">Order Summary</h4>
                                
                                <div class="summary-item d-flex justify-content-between mb-3">
                                    <span class="text-muted">Subtotal</span>
                                    <span class="fw-bold">${{ $this->totalProductAmount }}</span>
                                </div>
                                <div class="summary-item d-flex justify-content-between mb-3">
                                    <span class="text-muted">Shipping</span>
                                    <span class="text-success">Free</span>
                                </div>
                                <hr>
                                <div class="summary-item d-flex justify-content-between mb-3">
                                    <span class="fw-bold">Total</span>
                                    <span class="fw-bold fs-5">${{ $this->totalProductAmount }}</span>
                                </div>
                                
                                <div class="delivery-info mt-4">
                                    <div class="delivery-item d-flex align-items-center mb-2">
                                        <i class="fas fa-truck text-primary me-2"></i>
                                        <small>Delivery within 3-5 business days</small>
                                    </div>
                                    <div class="delivery-item d-flex align-items-center">
                                        <i class="fas fa-shield-alt text-primary me-2"></i>
                                        <small>Secure checkout with SSL encryption</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="empty-cart-container text-center py-5">
                    <div class="empty-cart-icon mb-4">
                        <i class="fas fa-shopping-cart fa-4x text-muted"></i>
                    </div>
                    <h3 class="mb-3">Your Cart is Empty</h3>
                    <p class="text-muted mb-4">Looks like you haven't added anything to your cart yet.</p>
                    <a href="{{ url('collections') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.checkout-container {
    background-color: #f8f9fa;
    min-height: 100vh;
}

.checkout-header {
    position: relative;
}

.checkout-progress {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
}

.progress-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    padding: 0 2rem;
}

.progress-step::after {
    content: '';
    position: absolute;
    right: -50%;
    top: 15px;
    width: 100%;
    height: 2px;
    background-color: #dee2e6;
    z-index: 1;
}

.progress-step:last-child::after {
    display: none;
}

.progress-step.active .step-number {
    background-color: #007bff;
    color: white;
}

.step-number {
    width: 30px;
    height: 30px;
    background-color: #dee2e6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-bottom: 0.5rem;
    z-index: 2;
}

.step-text {
    font-size: 0.875rem;
    color: #6c757d;
}

.checkout-form-card,
.checkout-payment-card,
.checkout-summary-card {
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border-radius: 0.5rem;
}

.form-floating > .form-control {
    height: calc(3.5rem + 2px);
    padding: 1rem 0.75rem;
}

.form-floating > textarea.form-control {
    height: auto;
}

.payment-option {
    width: 100%;
    padding: 1rem;
    margin-bottom: 0.5rem;
    border: 1px solid #dee2e6;
    border-radius: 0.5rem;
    background-color: white;
    text-align: left;
    transition: all 0.3s ease;
}

.payment-option:hover,
.payment-option.active {
    background-color: #f8f9fa;
    border-color: #007bff;
    color: #007bff;
}

.payment-details {
    padding: 1rem;
    background-color: #f8f9fa;
    border-radius: 0.5rem;
}

.empty-cart-container {
    background-color: white;
    border-radius: 0.5rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.btn-primary {
    padding: 0.8rem 1.5rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.delivery-info {
    font-size: 0.875rem;
}

@media (max-width: 768px) {
    .checkout-progress {
        display: none;
    }
    
    .col-lg-4 {
        order: -1;
    }
}
</style>

@push('scripts')
<script src="https://kit.fontawesome.com/your-font-awesome-kit.js"></script>
<script src="https://www.paypal.com/sdk/js?client-id=AQ49cucEqCnQvz8Z9PsULM3LRgDyqtomYvUZ_6u_rQy7tdk1bor2kGQHegIj20SHQRlq4cXKQU16lzla&components=buttons"></script>
<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            if (!document.getElementById("fullname").value
                || !document.getElementById("phone").value
                || !document.getElementById("email").value
                || !document.getElementById("pincode").value
                || !document.getElementById("address").value
            ) {
                Livewire.emit('validateForAll');
                return false;
            } else {
                @this.set('fullname', document.getElementById("fullname").value);
                @this.set('phone', document.getElementById("phone").value);
                @this.set('email', document.getElementById("email").value);
                @this.set('pincode', document.getElementById("pincode").value);
                @this.set('address', document.getElementById("address").value);
            }

            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '0.1'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                console.log('Capture result', details);
                if(details.status == "COMPLETED"){
                    Livewire.emit('transactionEmit', details.id);
                }
            });
        }
    }).render('#paypal-button-container');
</script>
@endpush