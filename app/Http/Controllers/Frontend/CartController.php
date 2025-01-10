<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Middleware untuk memastikan pengguna sudah login
    }

    public function index()
    {
        return view('frontend.cart.index');
    }
}
