<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
Use App\Models\Wishlist;

class WhishlistShow extends Component
{
    public function removeWishlistItem(int $wishlistId)
    {
        Wishlist::where('user_id', auth()->user()->id)->where('id',$wishlistId)->delete();
        session()->flash('message','Delete Successful');
        $this->emit('wishlistAddedUpdated'); 
        $this->dispatchBrowserEvent('message', [
            'text' => 'Delete Successful',
            'type' => 'success',
            'status' => 200
        ]);
    }
    public function render()
    {
        // Cek apakah pengguna sudah login
        if (!auth()->check()) {
            return redirect()->route('login'); // Mengarahkan ke login jika belum login
        }

        $wishlist = Wishlist::where('user_id', auth()->user()->id)->get();
        
        // Mengembalikan tampilan yang sesuai
        return view('livewire.frontend.whishlist-show', [
            'wishlist' => $wishlist
        ]);
    }
}
