<div>
    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card-box mb-30">
        <div class="h5 pd-20 mb-0">
            <div class="card-header">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4>Category</h4>
                    <a href="{{ url('admin/category/create') }}" class="btn btn-primary btn-sm" style="position: relative; right: 0;">Add Category</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->status == '1' ? 'Hidden' : 'Visible' }}</td>
                            <td>
                                <a href="{{ url('admin/category/'.$category->id.'/edit') }}" class="btn btn-success">Edit</a>
                                <button wire:click="deleteCategory({{ $category->id }})" class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
