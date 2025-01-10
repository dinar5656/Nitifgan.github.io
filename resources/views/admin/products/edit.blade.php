@extends('layouts.admin')

@section('content')
<div class="card-box mb-30">
    @if (session('message'))
        <h5 class="alert alert-success mb-2">{{ session('message') }}</h5>
    @endif
    <div class="card-header d-flex align-items-center justify-content-between">
        <h4>Edit Product</h4>
        <a href="{{ url('admin/products') }}" class="btn btn-danger btn-sm">Back</a>
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error )
                <div>{{ $error }}</div>
            @endforeach
        </div>
        @endif

        <form action="{{ url('admin/products/'.$product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Tab Navigation -->
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
                    <a class="nav-link" id="colors-tab" data-bs-toggle="tab" href="#colors" role="tab">Product Colors</a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="productTabContent">
                <!-- Home Tab -->
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="form-group mt-3">
                        <label>Category</label>
                        <select name="category_id" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $product->category->id ? 'selected':'' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" name="name" value="{{ $product->name }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Product Slug</label>
                        <input type="text" name="slug" value="{{ $product->slug }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Brand</label>
                        <select name="brand" class="form-control">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->name }}" {{ $brand->id == $product->brand ? 'selected':'' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Small Description</label>
                        <textarea name="small_description" class="form-control" rows="4">{{ $product->small_description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ $product->description }}</textarea>
                    </div>
                </div>

                <!-- SEO Tags Tab -->
                <div class="tab-pane fade" id="seotag" role="tabpanel" aria-labelledby="seotag-tab">
                    <div class="form-group mt-3">
                        <label>Meta Title</label>
                        <input type="text" name="meta_title" value="{{ $product->meta_title }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Meta Description</label>
                        <textarea name="meta_description" class="form-control" rows="4">{{ $product->meta_description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Meta Keywords</label>
                        <textarea name="meta_keyword" class="form-control" rows="4">{{ $product->meta_keyword }}</textarea>
                    </div>
                </div>

                <!-- Details Tab -->
                <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                    <div class="form-row mt-3">
                        <div class="col-md-4">
                            <label>Original Price</label>
                            <input type="text" name="original_price" value="{{ $product->original_price }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Selling Price</label>
                            <input type="text" name="selling_price" value="{{ $product->selling_price }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Quantity</label>
                            <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Trending</label>
                            <input type="checkbox" name="trending" {{ $product->trending == '1' ? 'checked':'' }}>
                        </div>
                        <div class="col-md-4">
                            <label>Status</label>
                            <input type="checkbox" name="status" {{ $product->status == '1' ? 'checked':'' }}>
                        </div>
                        <div class="col-md-4">
                            <label>Featured</label>
                            <input type="checkbox" name="featured" {{ $product->featured == '1' ? 'checked':'' }}>
                        </div>
                        <div class="col-md-4">
                            <label>Electronics</label>
                            <input type="checkbox" name="electronics" {{ $product->electronics == '1' ? 'checked':'' }}>
                        </div>
                        <div class="col-md-4">
                            <label>Fashions</label>
                            <input type="checkbox" name="fashions" {{ $product->fashions == '1' ? 'checked':'' }}>
                        </div>
                        <div class="col-md-4">
                            <label>Accessories</label>
                            <input type="checkbox" name="accessories" {{ $product->accessories == '1' ? 'checked':'' }}>
                        </div>
                        <div class="col-md-4">
                            <label>Appliances</label>
                            <input type="checkbox" name="appliances" {{ $product->appliances == '1' ? 'checked':'' }}>
                        </div>
                    </div>
                </div>

                <!-- Product Image Tab -->
                <div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="image-tab">
                    <div class="form-group mt-3">
                        <label>Upload Product Image</label>
                        <input type="file" name="image[]" multiple class="form-control">
                    </div>
                    <div>
                        @if ($product->productImages)
                        <div class="row">
                            @foreach ($product->productImages as $image)
                            <div class="col-md-2">
                                <img src="{{ asset($image->image) }}" style="width: 80px;height:80px;" class="me-4 border" alt="img">
                                <a href="{{ url('admin/product-image/'.$image->id.'/delete') }}" class="d-block">Remove</a>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <h5>No Image Added</h5>
                        @endif
                    </div>
                </div>

                <!-- Product Colors Tab -->
                <div class="tab-pane fade" id="colors" role="tabpanel" aria-labelledby="colors-tab">
                    <div class="form-group mt-3">
                        <h4>Add Product Color</h4>
                        <label>Select Color</label>
                        <hr>
                        <div class="row">
                            @forelse ($colors as $coloritem)
                                <div class="col-md-3">
                                    <div class="p-2 border mb-3">
                                        Color: <input type="checkbox" name="colors[{{ $coloritem->id }}]" value="{{ $coloritem->id }}">
                                        {{ $coloritem->name }}
                                        <br>
                                        Quantity: <input type="number" name="colorquantity[{{ $coloritem->id }}]" style="width:70px; border:1px solid">
                                    </div>
                                </div>
                            @empty
                            <div class="col-md-12">
                                <h1>No colors found</h1>
                            </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Color Name</th>
                                    <th>Quantity</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product->productColors as $prodColor)
                                <tr class="prod-color-tr">
                                    <td>
                                        @if ($prodColor->color->name)
                                        {{ $prodColor->color->name }}
                                        @else
                                        No Color Found
                                        @endif
                                    </td>
                                    <td>
                                        <div class="input-group mb-3" style="width:150px">
                                            <input type="text" value="{{ $prodColor->quantity }}" class="productColorQuantity form-control form-control-sm">
                                            <button type="button" value="{{ $prodColor->id }}" class="updateProductColorBtn btn btn-primary btn-sm text-white">Update</button>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" value="{{ $prodColor->id }}" class="deleteProductColorBtn btn btn-danger btn-sm text-white">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Update Product Color Quantity
        $(document).on('click', '.updateProductColorBtn', function() {
            var product_id = "{{ $product->id }}";
            var prod_color_id = $(this).val();
            var qty = $(this).closest('.prod-color-tr').find('.productColorQuantity').val();

            if (qty <= 0) {
                alert('Quantity is required');
                return false;
            }

            $.ajax({
                type: "POST",
                url: "/admin/product-color/" + prod_color_id,
                data: {
                    'product_id': product_id,
                    'qty': qty
                },
                success: function(response) {
                    alert(response.message);
                },
                error: function() {
                    alert("An error occurred while updating color quantity");
                }
            });
        });

        // Delete Product Color
        $(document).on('click', '.deleteProductColorBtn', function() {
            var prod_color_id = $(this).val();
            var thisClick = $(this);

            $.ajax({
                type: "GET",
                url: "/admin/product-color/" + prod_color_id + "/delete",
                success: function(response) {
                    if(response.message) {
                        thisClick.closest('.prod-color-tr').remove();
                        alert(response.message);
                    }
                },
                error: function() {
                    alert("An error occurred while deleting product color");
                }
            });
        });
    });
</script>
@endsection
