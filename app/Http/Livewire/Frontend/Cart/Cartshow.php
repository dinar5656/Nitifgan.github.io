<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Cartshow extends Component
{
    public $cart, $totalPrice = 0;
    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect ke halaman login
        }

        // Muat data keranjang
        $this->cart = Cart::where('user_id', Auth::id())->get();
    }
    public function decrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id',$cartId)->where('user_id',auth()->user()->id)->first();
        if ($cartData) {
            // Memeriksa apakah ada warna produk yang terkait dengan keranjang
            if ($cartData->productColor()->where('id', $cartData->product_color_id)->exists()) {
                $productColor = $cartData->productColor()->where('id', $cartData->product_color_id)->first();
                // Jika quantity produk warna lebih besar dari quantity keranjang, increment quantity
                if ($productColor->quantity > $cartData->quantity) {
                    $cartData->decrement('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity Updated',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }else{
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'only'.$productColor->quantity.'Quantity Available',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
            } else {
                // Jika tidak ada warna produk, cek quantity produk secara keseluruhan
                if ($cartData->product->quantity > $cartData->quantity) {
                    $cartData->decrement('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity Updated',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }else{
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'only'.$cartData->product->quantity.'Quantity Available',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
            }
        } else {
            // Jika data keranjang tidak ditemukan
            $this->dispatchBrowserEvent('message', [
                'text' => 'Cant be updated',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }
    public function incrementQuantity(int $cartId)
    {
        // Mencari data keranjang berdasarkan ID dan user yang sedang login
        $cartData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
    
        if ($cartData) {
            // Memeriksa apakah ada warna produk yang terkait dengan keranjang
            if ($cartData->productColor()->where('id', $cartData->product_color_id)->exists()) {
                $productColor = $cartData->productColor()->where('id', $cartData->product_color_id)->first();
                // Jika quantity produk warna lebih besar dari quantity keranjang, increment quantity
                if ($productColor->quantity > $cartData->quantity) {
                    $cartData->increment('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity Updated',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }else{
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'only'.$productColor->quantity.'Quantity Available',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
            } else {
                // Jika tidak ada warna produk, cek quantity produk secara keseluruhan
                if ($cartData->product->quantity > $cartData->quantity) {
                    $cartData->increment('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity Updated',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }else{
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'only'.$cartData->product->quantity.'Quantity Available',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
            }
        } else {
            // Jika data keranjang tidak ditemukan
            $this->dispatchBrowserEvent('message', [
                'text' => 'Cant be updated',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }
    
    public function render()
    {
        $this->cart = Cart::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.cart.cartshow',[
            'cart' => $this->cart
        ]);
    }
    public function removeCartItem($cartItemId)
    {
        // Mencari item keranjang berdasarkan ID dan user_id
        $cartItem = Cart::where('id', $cartItemId)->where('user_id', Auth::id())->first();
        

        if ($cartItem) {
            // Menghapus item dari keranjang
            $cartItem->delete();

            // Mengambil data keranjang terbaru untuk user yang sama
            $this->cart = Cart::where('user_id', Auth::id())->get();

            // Menghitung total item keranjang setelah penghapusan
            $this->totalCartItems = $this->cart->count(); 
            
            // Mengirimkan event browser untuk mengupdate tampilan
            $this->emit('CartAddedUpdate');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Item removed successfully.',
                'type' => 'success',
                'status' => 200,
            ]);
        }else{
            $this->dispatchBrowserEvent('message', [
                'text' => 'Item deletion error.',
                'type' => 'error',
                'status' => 500,
            ]);
        }

    }
}
