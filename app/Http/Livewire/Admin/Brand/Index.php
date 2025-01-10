<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Category;
use Livewire\Component;
use App\Models\Brand;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $name, $slug, $status, $brand_id, $category_id;

    public function rules()
    {
        return [
            'name' => 'required|string',
            'slug' => 'required|string',
            'category_id' => 'required|integer',
            'status' => 'nullable'
        ];
    }

    public function updatedName()
    {
        // Secara otomatis membuat slug dari name
        $this->slug = Str::slug($this->name);
    }

    public function resetInput()
    {
        // Mengosongkan input setelah penyimpanan data
        $this->name = null;
        $this->slug = null;
        $this->status = null;
        $this->brand_id = null;
        $this->category_id = null;
    }

    public function storeBrand()
    {
        // Validasi data sesuai aturan yang didefinisikan
        $validatedData = $this->validate();

        // Simpan data brand ke dalam database
        Brand::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'status' => $this->status == true ? '1' : '0',
            'category_id' => $this->category_id
        ]);

        // Menampilkan pesan konfirmasi
        session()->flash('message', 'Brand Berhasil Ditambahkan');

        // Memicu event untuk menutup modal
        $this->dispatchBrowserEvent('close-modal');
        
        // Reset form input
        $this->resetInput();
    }
    public function closeModal()
    {
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

    public function editBrand(int $brand_id)
    {
        $this->brand_id = $brand_id;
        $brand = Brand::findOrFail($brand_id);
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->status = $brand->status;
        $this->category_id = $brand->category_id;
    }

    public function updateBrand()
    {
         // Validasi data sesuai aturan yang didefinisikan
         $validatedData = $this->validate();

         // Simpan data brand ke dalam database
         Brand::findOrFail($this->brand_id)->update([
             'name' => $this->name,
             'slug' => $this->slug,
             'status' => $this->status == true ? '1' : '0',
             'category_id' => $this->category_id
         ]);
 
         // Menampilkan pesan konfirmasi
         session()->flash('message', 'Brand Update Berhasil Ditambahkan');
 
         // Memicu event untuk menutup modal
         $this->dispatchBrowserEvent('close-modal');
         
         // Reset form input
         $this->resetInput();
    }

    public function deleteBrand($brand_id)
    {
        $this->brand_id = $brand_id;
    }

    public function destroyBrand()
    {
        Brand::findOrFail(id: $this->brand_id)->delete();
        // Menampilkan pesan konfirmasi
        session()->flash('message', 'Data Brand berhasil dihapus');
 
        // Memicu event untuk menutup modal
        $this->dispatchBrowserEvent('close-modal');
        
        // Reset form input
        $this->resetInput();
    }

    public function render(): mixed
    {
        $categories = Category::where('status', '0')->get();
        // Ambil data brand untuk ditampilkan di tabel
        $brands = Brand::orderBy('id', 'DESC')->paginate(10);
        
        return view('livewire.admin.brand.index', ['brands' => $brands, 'categories' => $categories])
                    ->extends('layouts.admin')
                    ->section('content');
    }
}
