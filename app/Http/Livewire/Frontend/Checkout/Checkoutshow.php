<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Orderitem;
use Livewire\Component;
use Illuminate\Support\Str;

class Checkoutshow extends Component
{
    public $carts, $totalProductAmount = 0;
    public $fullname, $email, $phone, $pincode, $address, $payment_mode = NULL, $payment_id = NULL;
    protected $listeners = [
        'validateForAll',
        'transactionEmit' => 'paidOnlineOrder'
    ];
    public function paidOnlineOrder($value)
    {
        $this->payment_id = $value;
        $this->payment_mode = 'Paid by PayPal';
        $order = $this->placeOrder(); // Panggil fungsi placeOrder
        
        if ($order) {
            // Menghapus cart setelah order berhasil
            Cart::where('user_id', auth()->user()->id)->delete();

            // Memberikan feedback ke user
            session()->flash('message','Place Order Successful');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Place Order Successful',
                'type' => 'success',
                'status' => 200
            ]);
            return redirect()->to('Thank-you');
        } else {
            // Jika order gagal
            $this->dispatchBrowserEvent('message', [
                'text' => 'Order Failed',
                'type' => 'error',
                'status' => 500
            ]);
        }
    }
    public function validateForAll()
    {
        $this->validate();
    }
    // Aturan validasi input
    public function rules()
    {
        return [
            'fullname' => 'required|string|max:121',
            'email' => 'required|email|max:121',
            'phone' => 'required|string|max:11|min:10',
            'pincode' => 'required|string|max:6|min:6',
            'address' => 'required|string|max:500',
        ];
    }

    // Fungsi untuk memproses order
    public function placeOrder()
    {
        // Validasi input
        $this->validate();

        // Pastikan address terisi
        if (empty($this->address)) {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Address is required.',
                'type' => 'error',
                'status' => 500
            ]);
            return false; // Menghentikan eksekusi jika address kosong
        }

        // Membuat order baru
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'tracking_no' => 'nitipgan-' . Str::random(10),
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'pincode' => $this->pincode,
            'address' => $this->address,
            'status_message' => 'in progress',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id,
        ]);

        // Menambahkan item ke dalam order
        foreach ($this->carts as $cartItem) {
            Orderitem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_color_id' => $cartItem->product_color_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->selling_price
            ]);
            if($cartItem->product_color_id !=NULL){
                $cartItem->productColor()->where('id',$cartItem->product_color_id)->decrement('quantity',$cartItem->quantity);
            }else{
                $cartItem->product()->where('id',$cartItem->product_id)->decrement('quantity',$cartItem->quantity);
            }
        }

        return $order; // Mengembalikan objek order
    }

    // Fungsi untuk memproses COD
    public function codOrder()
    {
        $this->payment_mode = 'Cash on Delivery';
        $order = $this->placeOrder(); // Panggil fungsi placeOrder
        
        if ($order) {
            // Menghapus cart setelah order berhasil
            Cart::where('user_id', auth()->user()->id)->delete();

            // Memberikan feedback ke user
            session()->flash('message','Place Order Successful');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Place Order Successful',
                'type' => 'success',
                'status' => 200
            ]);
            return redirect()->to('Thank-you');
        } else {
            // Jika order gagal
            $this->dispatchBrowserEvent('message', [
                'text' => 'Order Failed',
                'type' => 'error',
                'status' => 500
            ]);
        }
    }

    // Fungsi untuk menghitung total produk di cart
    public function totalProductAmount()
    {
        $this->totalProductAmount = 0;
        $this->carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($this->carts as $cartItem) {
            $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
        }
        return $this->totalProductAmount;
    }

    // Render halaman
    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->totalProductAmount = $this->totalProductAmount();
        
        return view('livewire.frontend.checkout.checkoutshow', [
            'totalProductAmount' => $this->totalProductAmount
        ]);
    }
}
