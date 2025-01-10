@extends('layouts.admin')

@section('content')
<div class="card-box mb-30">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h4>Add Product</h4>
        <a href="{{ url('admin/products') }}" class="btn btn-danger btn-sm">Back</a>
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error )
                <div>{{$error}}</div>
            @endforeach
        </div>      
        @endif
        <form action="{{ url('admin/products') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <ul class="nav nav-tabs" id="productTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="seotag-tab" data-bs-toggle="tab" href="#seotag" role="tab">SEO Tags</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="details-tab" data-bs-toggle="tab" href="#details" role="tab">Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="image-tab" data-bs-toggle="tab" href="#image" role="tab">Product Image</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="color-tab" data-bs-toggle="tab" href="#color" role="tab">Product Color</a>
                </li>
            </ul>

            <div class="tab-content" id="productTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="form-group mt-3">
                        <label>Category</label>
                        <select name="category_id" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Product Slug</label>
                        <input type="text" name="slug" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Brand</label>
                        <select name="brand" class="form-control">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Small Description</label>
                        <textarea name="small_description" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="4"></textarea>
                    </div>
                </div>

                <div class="tab-pane fade" id="seotag" role="tabpanel" aria-labelledby="seotag-tab">
                    <div class="form-group mt-3">
                        <label>Meta Title</label>
                        <input type="text" name="meta_title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Meta Description</label>
                        <textarea name="meta_description" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Meta Keywords</label>
                        <textarea name="meta_keyword" class="form-control" rows="4"></textarea>
                    </div>
                </div>

                <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                    <div class="form-row mt-3">
                        <div class="col-md-4">
                            <label>Original Price</label>
                            <input type="text" name="original_price" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Selling Price</label>
                            <input type="text" name="selling_price" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Trending</label>
                            <input type="checkbox" name="trending">
                        </div>
                        <div class="col-md-4">
                            <label>Status</label>
                            <input type="checkbox" name="status">
                        </div>
                        <div class="col-md-4">
                            <label>Featured</label>
                            <input type="checkbox" name="featured">
                        </div>
                        <div class="col-md-4">
                            <label>Electronics</label>
                            <input type="checkbox" name="electronics">
                        </div>
                        <div class="col-md-4">
                            <label>Fashions</label>
                            <input type="checkbox" name="fashions">
                        </div>
                        <div class="col-md-4">
                            <label>Accessories</label>
                            <input type="checkbox" name="accessories">
                        </div>
                        <div class="col-md-4">
                            <label>Appliances</label>
                            <input type="checkbox" name="appliances">
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="image-tab">
                    <div class="form-group mt-3">
                        <label>Upload Product Image</label>
                        <input type="file" name="image[]" multiple class="form-control">
                    </div>
                </div>
                <div class="tab-pane fade" id="color" role="tabpanel" aria-labelledby="color-tab">
                    <div class="form-group mt-3">
                        <label>Select Color</label>
                        <hr/>
                        <div class="row">
                            @forelse ($colors as $coloritem)
                                <div class="col-md-3">
                                    <div class="p-2 border mb-3">
                                        Color: <input type="checkbox" name="colors[{{ $coloritem->id }}]" value="{{ $coloritem->id }}"/> 
                                        {{ $coloritem->name }}
                                        <br/>
                                        Quantity: <input type="number" name="colorquantity[{{ $coloritem->id }}]" style="width:70px; border:1px solid" />
                                </div>
                            </div>
                            @empty
                            <div class="col-md-12">
                                <h1>No colors found</h1>
                            </div>
                            @endforelse                            
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
</div>

<!-- Tambahkan Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
