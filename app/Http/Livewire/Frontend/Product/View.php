<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Product;
use App\Models\Cart;

class View extends Component
{
    public $category, $product, $prodColorSelectedQuantity, $quantityCount = 1, $productColorId;

    public function addToWishlist($productId)
    {
        if(Auth::check())
        {
            if(Wishlist::where('user_id',auth()->user()->id)->where('product_id',$productId)->exists())
            {
                session()->flash('message','Already add successful');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Already add successful',
                    'type' => 'notify',
                    'status' => 409
                ]);
                return false;
            }
            else
            {
                $wishlist = Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId
                ]);
                $this->emit('wishlistAddedUpdated');
                session()->flash('message','add successful');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'add successful',
                    'type' => 'success',
                    'status' => 200
                ]);
            }
        }
        else
        {
            session()->flash('message','Please log in first');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please log in first',
                'type' => 'info',
                'status' => 401
            ]);
            return false;
        }
    }
    public function colorSelected($productColorId)
    {
        $this->productColorId = $productColorId; // Menyimpan ID warna yang dipilih
        $productColor = $this->product->productColors()->where('id', $productColorId)->first();
        $this->prodColorSelectedQuantity = $productColor ? $productColor->quantity : 0; // Mengambil jumlah produk berdasarkan warna yang dipilih

        if ($this->prodColorSelectedQuantity == 0) {
            $this->prodColorSelectedQuantity = 'outOfStock';
        }
    }
    public function incrementQuantity()
    {
        if($this->quantityCount < 10){
            $this->quantityCount++;
        }
    }
    public function decrementQuantity()
    {
        if($this->quantityCount > 1){
            $this->quantityCount--;
        }
    }
    public function addToCart(int $productId)
    {
        if (Auth::check()) {
            // Cek apakah produk dengan ID yang diberikan ada dan aktif
            if ($this->product->where('id', $productId)->where('status', '0')->exists()) {
                // Periksa apakah produk memiliki warna
                if ($this->product->productColors()->count() > 1) {
                    if($this->prodColorSelectedQuantity != NULL)
                    {
                       if(Cart::where('user_id',auth()->user()->id)
                            ->where('product_id', $productId)
                            ->where('product_color_id', $this->productColorId)
                            ->exists())
                        {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Product Already',
                                'type' => 'warning',
                                'status' => 200
                            ]);   
                        }
                        else
                        {

                        
                            $productColor = $this->product->productColors()->where('id', $this->productColorId)->first();
                            if($productColor->quantity > 0)
                            {
                                    if ($this->product->quantity >= $this->quantityCount) 
                                    {
                                        Cart::create([
                                            'user_id' => auth()->user()->id,
                                            'product_id' => $productId,
                                            'product_color_id' => $this->productColorId,
                                            'quantity' => $this->quantityCount
                                        ]);
                                        $this->emit('CartAddedUpdate');
                                        $this->dispatchBrowserEvent('message', [
                                            'text' => 'Product Added to Cart',
                                            'type' => 'success',
                                            'status' => 200
                                        ]);
                                    } 
                                    else {
                                        $this->dispatchBrowserEvent('message', [
                                            'text' => 'Only ' . $this->product->quantity . ' quantity available',
                                            'type' => 'warning',
                                            'status' => 404
                                        ]);
                                    }
                            } else{
                                    $this->dispatchBrowserEvent('message', [
                                        'text' => 'Out of stock',
                                        'type' => 'info',
                                        'status' => 404
                                    ]);
                            }
                       }
                    }
                    else
                    {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Select Your Product Color',
                            'type' => 'info',
                            'status' => 404
                        ]);
                    }
                } 
                else 
                {
                    if(Cart::where('user_id',auth()->user()->id)->where('product_id', $productId)->exists())
                    {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Product Already',
                            'type' => 'warning',
                            'status' => 200
                        ]);
                    }
                    else
                    {                   
                        // Cek apakah stok produk tersedia
                        if ($this->product->quantity > 0) {
                            // Pastikan jumlah yang diminta tidak melebihi stok yang tersedia
                            if ($this->product->quantity >= $this->quantityCount) 
                            {
                                Cart::create([
                                    'user_id' => auth()->user()->id,
                                    'product_id' => $productId,
                                    'quantity' => $this->quantityCount
                                ]);
                                $this->emit('CartAddedUpdate');
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Product Added to Cart',
                                    'type' => 'success',
                                    'status' => 200
                                ]);
                            } 
                            else {
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Only ' . $this->product->quantity . ' quantity available',
                                    'type' => 'warning',
                                    'status' => 404
                                ]);
                            }
                        } else {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Out of stock',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        }    
                    }
                }
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Product does not exist',
                    'type' => 'warning',
                    'status' => 404
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please log in first',
                'type' => 'info',
                'status' => 401
            ]);
        }
    }

    public function mount($category, $product)
    {
        $this->category = $category;
        $this->product = $product;
        if (!$this->category || !$this->product) {
            abort(404, 'Category or Product not found');
        }
    }

    public function render()
    {
        return view('livewire.frontend.product.view', [
            'category' => $this->category,
            'product' => $this->product,
        ]);
    }
}