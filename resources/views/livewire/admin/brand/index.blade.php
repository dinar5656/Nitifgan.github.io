<div>
   
    @include('livewire.admin.brand.modal-form')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>List Brands</h4>
                <a href="#" data-bs-toggle="modal" data-bs-target="#addBrandModal" class="btn btn-primary btn-sm">Add Brands</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($brands as $brand)
                    <tr>
                            <td>{{ $brand->id }}</td>
                            <td>{{ $brand->name }}</td>
                            <td>
                                @if ($brand->category)
                                    {{ $brand->category->name }}
                                @else
                                    No Category 
                                @endif
                            </td>
                            <td>{{ $brand->slug }}</td>
                            <td>{{ $brand->status == '1' ? 'hidden':'visible'}}</td>
                            <td>
                                <a href="#" wire:click="editBrand({{$brand->id}})" data-bs-toggle="modal" data-bs-target="#updateBrandModal" class="btn btn-sm btn-success">Edit</a>
                                <a href="#" wire:click="deleteBrand({{$brand->id}})" data-bs-toggle="modal" data-bs-target="#deleteBrandModal" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    
                    @empty
                    <tr>
                        <td colspan="5">No Brands Found</td>
                    </tr>

                    @endforelse
                        
                        <!-- Baris tambahan dapat ditambahkan di sini -->
                    </tbody>
                </table>
                <div>
                     {{ $brands->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan Script Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

<!-- Script untuk menutup modal setelah data disimpan -->
<script>
    window.addEventListener('close-modal', event => {
        var modal = new bootstrap.Modal(document.getElementById('addBrandModal'));
        modal.hide();
        var modal = new bootstrap.Modal(document.getElementById('updateBrandModal'));
        modal.hide();
        var modal = new bootstrap.Modal(document.getElementById('deleteBrandModal'));
        modal.hide();
    });
</script>
