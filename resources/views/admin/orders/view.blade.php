@extends('layouts.admin')

@section('title', 'Order Details')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success mb-3">{{ session('message') }}</div>
        @endif
        <div class="card">
            <div class="col-md-12">
                <div class="card-header">
                    <h4 class="mb-4 mt-4">My Order Details</h4>
                        <div class="card-body">
                        <!-- Tombol Back di pojok kanan atas -->
                        <a href="{{ route('admin.orders') }}" class="btn btn-danger btn-sm" 
                           style="position: absolute; top: 20px; right: 40px;">
                            Back
                        </a>
                        <a href="{{ url('admin/invoice/'.$order->id.'/generate') }}" class="btn btn-primary btn-sm"
                            style="position: absolute; top: 20px; right: 110px;">
                            Download Invoice
                        </a>
                        <a href="{{ url('admin/invoice/'.$order->id) }}" target="_blank" class="btn btn-warning btn-sm float-end"
                            style="position: absolute; top: 20px; right: 266px;">
                            View Invoice
                        </a>
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
                <div class="card border mt-3">
                    <div class="card-body">
                        <h4>Order process (Order Status updates)</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-5">
                            <form action="{{ route('admin.updateOrderStatus', ['orderId' => $order->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <label>Update Your Order Status</label>
                                <div class="input-group">
                                    <select name="order_status" class="form-select">
                                        <option value="">Select Order Status</option>
                                        <option value="in progress" {{ $order->status_message == 'in progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="completed" {{ $order->status_message == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="pending" {{ $order->status_message == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="cancelled" {{ $order->status_message == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        <option value="out-for-delivery" {{ $order->status_message == 'out-for-delivery' ? 'selected' : '' }}>Out For Delivery</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary text-white">Update</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-7">
                            <br/>
                            <h4 class="mt-3">Current Order Status: <span class="text-uppercase">{{ $order->status_message }}</span></h4>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
