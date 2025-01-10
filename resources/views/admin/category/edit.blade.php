@extends('layouts.admin')

@section('content')

<div class="card-box mb-30">
    <div class="h5 pd-20 mb-0">
        <div class="card-header">
        <div class="card-header d-flex align-items-center justify-content-between">
                <h4>Edit Category</h4>
                <a href="{{ url('admin/category') }}" class="btn btn-primary btn-sm text white" style="position: relative; right: 0;">BACK</a>
                </div>
                <div class="card-body"></div>
                <form action="{{ url('admin/category/'.$category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" value="{{ $category->name }}" class="form-control" />
                            @error('name') <small class="text-danger">{{$message}}</small> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" name="slug" value="{{ $category->slug }}" class="form-control" />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ $category->description }}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" name="image"  class="form-control" />
                            <img src="{{ asset('/uploads/category/'.$category->image) }}" width="60px" height="60px"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label><br/>
                            <input type="checkbox" name="status" {{ $category->status =='1' ? 'checked':'' }}/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" value="{{ $category->meta_title }}" class="form-control" />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Meta Keyword</label>
                            <textarea name="meta_keyword" class="form-control" rows="3">{{ $category->meta_keyword }}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="3">{{ $category->meta_description }}</textarea>
                        </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="" class="btn btn-primary fload end">Update</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
</div>
@endsection
