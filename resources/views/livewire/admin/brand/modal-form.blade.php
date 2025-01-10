<!-- Modal -->
<div wire:ignore.self class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Brands</h5>
                <button type="button" wire:click="closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Form menggunakan metode Livewire untuk storeBrand -->
            <form wire:submit.prevent="storeBrand">
                <div class="modal-body">
                <div class="mb-3">
                    <label>Select Category</label>
                    <select wire:model.defer="category_id" required class="form-control">
                        <option value="">--Select Category--</option>
                        @foreach ($categories as $cateItem )
                        <option value="{{ $cateItem->id }}">{{ $cateItem->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                    <!-- Input untuk Brand Name -->
                    <div class="mb-3">
                        <label for="brandNameAdd" class="form-label">Brand Name</label>
                        <input type="text" id="brandNameAdd" wire:model.defer="name" class="form-control" placeholder="Enter Brand Name">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    
                    <!-- Input untuk Brand Slug -->
                    <div class="mb-3">
                        <label for="brandSlugAdd" class="form-label">Brand Slug</label>
                        <input type="text" id="brandSlugAdd" wire:model.defer="slug" class="form-control" placeholder="Enter Brand Slug">
                        @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    
                    <!-- Checkbox untuk Status -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" wire:model.defer="status" class="form-check-input" id="statusCheckboxAdd">
                        <label for="statusCheckboxAdd" class="form-check-label">Checked = Hidden, Un-Checked = Visible</label>
                        @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Brand Update Modal -->
<div wire:ignore.self class="modal fade" id="updateBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Brand</h5>
                <button type="button" wire:click="closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="updateBrand">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Select Category</label>
                        <select wire:model.defer="category_id" class="form-control">
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $cateItem)
                                <option value="{{ $cateItem->id }}">{{ $cateItem->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Brand Name</label>
                        <input type="text" wire:model.defer="name" class="form-control" placeholder="Enter Brand Name">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Brand Slug</label>
                        <input type="text" wire:model.defer="slug" class="form-control" placeholder="Enter Brand Slug">
                        @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-check">
                        <input type="checkbox" wire:model.defer="status" class="form-check-input">
                        <label class="form-check-label">Checked = Hidden, Unchecked = Visible</label>
                        @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Brand delete Modal -->
<div wire:ignore.self class="modal fade" id="deleteBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Confirmation</h5>
                <button type="button" wire:click="closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this brand?</p>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" wire:click="destroyBrand" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>


<!-- JavaScript untuk menutup modal otomatis -->
<script>
    window.addEventListener('close-modal', event => {
        $('#addBrandModal').modal('hide');
        $('#updateBrandModal').modal('hide');
        $('#deleteBrandModal').modal('hide');
    });
</script>
