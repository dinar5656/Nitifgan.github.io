<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\ProductFormRequest;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ColorFormRequest;
use App\Models\Color;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::where('status','0')->get();
        return view('admin.products.create', compact('categories','brands','colors'));
    }
    public function store(ProductFormRequest $request)
    {
        $validateData = $request->validated(); // Memastikan data yang sudah divalidasi
        $category = Category::findOrFail($validateData['category_id']);

        $product = $category->products()->create([
            'category_id' => $validateData['category_id'],
            'name' => $validateData['name'],
            'slug' => Str::slug($validateData['slug']),
            'brand' => $validateData['brand'],
            'small_description' => $validateData['small_description'],
            'description' => $validateData['description'],
            'original_price' => $validateData['original_price'],
            'selling_price' => $validateData['selling_price'],
            'quantity' => $validateData['quantity'],
            'trending' => $request->trending == true ? '1' : '0',
            'status' => $request->status == true ? '1' : '0',
            'featured' => $request->featured == true ? '1' : '0',
            'electronics' => $request->electronics == true ? '1' : '0',
            'fashions' => $request->fashions == true ? '1' : '0',
            'accessories' => $request->accessories == true ? '1' : '0',
            'appliances' => $request->appliances == true ? '1' : '0',
            'meta_title' => $validateData['meta_title'],
            'meta_keyword' => $validateData['meta_keyword'],
            'meta_description' => $validateData['meta_description'],
        ]);
        if ($request->hasFile('image')) {
            $uploadPath = 'uploads/products/';  // Tentukan folder upload
            $i = 1;
            foreach ($request->file('image') as $imageFile) {  // Iterasi setiap file gambar
                // Mendapatkan ekstensi file gambar
                $extension = $imageFile->getClientOriginalExtension();
                
                // Membuat nama file unik
                $filename = time().$i++ . '.' . $extension;
        
                // Memindahkan file ke folder yang ditentukan
                $imageFile->move(public_path($uploadPath), $filename);
        
                // Menyimpan path gambar yang disimpan
                $finalImagePathName = $uploadPath . $filename;
        
                // Menyimpan data gambar ke dalam database
                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName,  // Gambar yang ingin disimpan
                ]);
            }
        }
        if($request->colors){
            foreach($request->colors as $key => $color){
                $product->productColors()->create([
                    'product_id' => $product->id,
                    'color_id'=> $color,
                    'quantity' =>$request->colorquantity[$key] ?? 0
                ]);
            }
        }
        
        return redirect('/admin/products')->with('message','Product added successfully');

    }
    public function edit(int $product_id)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $product = Product::findOrFail($product_id);
        $product_color = $product->productColors->pluck('color_id')->toArray();
        $colors = Color::whereNotIn('id', $product_color)->get();
        return view('admin.products.edit', compact('categories','brands','product','colors'));
    }
    public function update(ProductFormRequest $request, int $product_id)
    {
        $validatedData = $request->validated();
        $product = Category::findOrFail($validatedData['category_id'])
                        ->products()->where('id', $product_id)->first();

        if ($product) {
            $product->update([
                'category_id' => $validatedData['category_id'],
                'name' => $validatedData['name'],
                'slug' => Str::slug($validatedData['slug']),
                'brand' => $validatedData['brand'],
                'small_description' => $validatedData['small_description'],
                'description' => $validatedData['description'],
                'original_price' => $validatedData['original_price'],
                'selling_price' => $validatedData['selling_price'],
                'quantity' => $validatedData['quantity'],
                'trending' => $request->trending == true ? '1' : '0',
                'status' => $request->status == true ? '1' : '0',
                'featured' => $request->featured == true ? '1' : '0',
                'electronics' => $request->electronics == true ? '1' : '0',
                'fashions' => $request->fashions == true ? '1' : '0',
                'accessories' => $request->accessories == true ? '1' : '0',
                'appliances' => $request->appliances == true ? '1' : '0',
                'meta_title' => $validatedData['meta_title'],
                'meta_keyword' => $validatedData['meta_keyword'],
                'meta_description' => $validatedData['meta_description'],
            ]);

            if ($request->hasFile('image')) {
                $uploadPath = 'uploads/products/';
                $i = 1;
                foreach ($request->file('image') as $imageFile) {
                    $extension = $imageFile->getClientOriginalExtension();
                    $filename = time().$i++ . '.' . $extension;
                    $imageFile->move($uploadPath, $filename);
                    $finalImagePathName = $uploadPath . $filename;

                    $product->productImages()->create([
                        'product_id' => $product->id,
                        'image' => $finalImagePathName,
                    ]);
                }
            }
            if($request->colors){
                foreach($request->colors as $key => $color){
                    $product->productColors()->create([
                        'product_id' => $product->id,
                        'color_id'=> $color,
                        'quantity' =>$request->colorquantity[$key] ?? 0
                    ]);
                }
            }

            return redirect('/admin/products')->with('message', 'Product updated successfully');
        } else {
            return redirect('admin/products')->with('message', 'No Such Product Id Found');
        }
    }
    public function destroyImage(int $product_image_id)
    {
        $productImage = ProductImage::findOrFail($product_image_id);
        if(File::exists($productImage->image)){
            File::delete($productImage->image);
        }
        $productImage->delete();
        return redirect()->back()->with('message','Product Image Deleted');
    }
    public function destroy(int $product_id)
    {
        $product =  Product::findOrFail($product_id);
        if($product->productImages){
            foreach($product -> productImages as $image){
                if(File::exists($image->image)){
                    File::delete($image->image);

                }
            }
        }
        $product->delete();
        return redirect()->back()->with('message','Product Deleted');
    }
    public function updateProdColorQty(Request $request, $prod_color_id)
    {
    // Cari data warna produk berdasarkan product_id dan prod_color_id
    $productColorData = Product::findOrFail($request->product_id)
                                ->productColors()->where('id', $prod_color_id)->first();

    // Jika data ditemukan, update quantity
    if ($productColorData) {
        $productColorData->update([
            'quantity' => $request->qty  // Update quantity
        ]);
        return response()->json(['message' => 'Product Color Quantity updated successfully']);
        }

    // Jika tidak ditemukan, kirimkan error
    return response()->json(['message' => 'Error: Product Color not found'], 404);
    }
    public function deleteProdColor($prod_color_id)
    {
        // Cari warna produk berdasarkan ID
        $prodColor = ProductColor::find($prod_color_id);

        if (!$prodColor) {
            return response()->json(['message' => 'Product color not found'], 404);
        }

        // Hapus warna produk
        $prodColor->delete();

        return response()->json(['message' => 'Product color deleted successfully']);
    }

}