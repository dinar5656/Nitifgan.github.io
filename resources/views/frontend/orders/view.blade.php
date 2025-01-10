@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="py-3 py-md-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="shadow bg-white p-3">
                    <h4 class="text-primary">
                        <i class="fa fa-shopping-cart text-dark"></i> My Order Details
                        <a href="{{ url('orders') }}" class="btn btn-danger btn-sm float-end">Back</a>
                    </h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Order Details</h5>
                            <hr>
                            <h6>Order ID: {{ $order->id }}</h6>
                            <h6>Tracking ID/No.: {{ $order->tracking_no }}</h6>
                            <h6>Order Date: {{ $order->created_at->format('d-m-Y h:i A') }}</h6>
                            <h6>Payment Mode: {{ $order->payment_mode }}</h6>
                            <h6 class="border p-2 text-success">
                                Order Status: <span class="text-uppercase">{{ $order->status_message }}</span>
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <h5>User Details</h5>
                            <hr>
                            <h6>Full Name: {{ $order->fullname }}</h6>
                            <h6>Email: {{ $order->email }}</h6>
                            <h6>Phone: {{ $order->phone }}</h6>
                            <h6>Address: {{ $order->address }}</h6>
                            <h6>Pincode: {{ $order->pincode }}</h6>
                        </div>
                    </div>
                    <br/>
                    <h5>Order Items</h5>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Item ID</th>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalPrice = 0;
                                @endphp
                                @foreach ($order->orderItems as $orderItem)
                                <tr>
                                    <td>{{ $orderItem->id }}</td>
                                    <td>
                                        @if ($orderItem->product->productImages->isNotEmpty())
                                            <img src="{{ asset($orderItem->product->productImages[0]->image) }}" 
                                                 class="me-3" style="width: 60px; height: 60px; object-fit: cover;" alt="Product Image">
                                        @else
                                            <img src="{{ asset('images/no-image.png') }}" 
                                                 class="me-3" style="width: 60px; height: 60px; object-fit: cover;" alt="No Image">
                                        @endif
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-bold">{{ $orderItem->product->name }}</p>
                                        @if ($orderItem->productColor && $orderItem->productColor->color)
                                            <span class="text-muted small">Color: {{ $orderItem->productColor->color->name }}</span>
                                        @endif
                                    </td>
                                    <td>${{ $orderItem->price }}</td>
                                    <td>{{ $orderItem->quantity }}</td>
                                    <td>${{ $orderItem->quantity * $orderItem->price }}</td>
                                    @php
                                        $totalPrice += $orderItem->quantity * $orderItem->price;
                                    @endphp
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5" class="fw-bold text-end">Total Shopping Price</td>
                                    <td class="fw-bold">${{ $totalPrice }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
