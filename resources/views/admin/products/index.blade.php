@extends('layouts.admin')

@section('content')

<div class="card-box mb-30">
    <div class="h5 pd-20 mb-0">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        
        @endif
        <div class="card-header">
        <div class="card-header d-flex align-items-center justify-content-between">
                <h4>Products</h4>
                <a href="{{ url('admin/products/create') }}" class="btn btn-primary btn-sm text white" style="position: relative; right: 0;">
                    Add Products
                </a>
                </div>
                <div class="card-body"></div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                @if ($product->category)
                                     {{ $product->category->name }}
                                @else
                                    No Category
                                @endif                                
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->selling_price }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->status == '1' ? 'hiddeb':'Visible'  }}</td>
                            <td>
                                <a href="{{ url('admin/products/'.$product->id.'/edit') }}" class="btn btn-sm btn-success">Edit</a>
                                <a href="{{ url('admin/products/'.$product->id.'/delete') }}" onclick="return confirm('Are You Sure?')" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">No Products Available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
        </div>
    </div>
</div>

@endsection