<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $sliders = Slider::where('status','0')->get();
        $trendigProducts = Product::where('trending','1')->latest()->take(15)->get();
        $featuredProducts = Product::where('featured', '1')->latest()->take(14)->get();
        return view('frontend.index', compact('sliders','trendigProducts','featuredProducts', 'categories'));
    }
     public function searchProducts(Request $request)
    {
        if ($request->search) {
            $searchProducts = Product::where('name', 'LIKE', '%' . $request->search . '%')->latest()->paginate(15);
            return view('frontend.pages.search', compact('searchProducts'));
        } else {
            return redirect()->back()->with('message', 'Empty Search');
        }
    }
    public function newArrivals()
    {
        $newArrivalProducts = Product::latest()
        ->paginate(15); // Menampilkan 15 produk per halaman

        return view('frontend.new-arrivals', compact('newArrivalProducts'));
    }
    public function featuredProducts()
    {
        $featuredProducts = Product::where('featured', '1')
            ->latest()
            ->take(15) // Menampilkan maksimal 15 produk
            ->get();

        return view('frontend.featured-products', compact('featuredProducts'));
    }
    public function electronicsProducts()
    {
        $electronicsProducts = Product::where('electronics', '1')
            ->latest()
            ->take(15) // Menampilkan maksimal 15 produk
            ->get();

        return view('frontend.electronics-products', compact('electronicsProducts'));
    }
    public function appliancesProducts()
    {
        $appliancesProducts = Product::where('appliances', '1')
            ->latest()
            ->take(15) // Menampilkan maksimal 15 produk
            ->get();

        return view('frontend.appliances-products', compact('appliancesProducts'));
    }
    public function fashionsProducts()
    {
        $fashionsProducts = Product::where('fashions', '1')
            ->latest()
            ->take(15) // Menampilkan maksimal 15 produk
            ->get();

        return view('frontend.fashions-products', compact('fashionsProducts'));
    }
    public function accessoriesProducts()
    {
        $accessoriesProducts = Product::where('accessories', '1')
            ->latest()
            ->take(15) // Menampilkan maksimal 15 produk
            ->get();

        return view('frontend.accessories-products', compact('accessoriesProducts'));
    }

    public function categories()
    {
        $categories = Category::where('status','0')->get();
        return view('frontend.collection.category.index', compact('categories'));
    }
    public function products($category_slug)
    {
        $category = Category::where('slug',$category_slug)->first();
        if($category){

            return view('frontend.collection.products.index', compact('category'));
        }else{
            return redirect()->back();
        }
    }
    public function productView(string $category_slug, string $product_slug)
    {

        $category = Category::where('slug', $category_slug)->first();
        if($category){
            $product = $category->products()->where('slug',$product_slug)->where('status','0')->first();
            if($product)
            {
                return view('frontend.collection.products.view', compact('product','category'));
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }
    public function Thankyou()
    {
        return view('frontend.Thank-you');
    }
    
}
