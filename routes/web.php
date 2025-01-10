<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Frontend\Product\View as ProductView;
use App\Http\Controllers\Admin\OrderController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();
Route::get('/login', function () {
    return view('login');
})->middleware('guest')->name('login');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::get('/about-us', function () {
    return view('about-us');
})->name('about.us');
Route::get('/',[App\Http\Controllers\Frontend\FrontendController::class, 'index']);
Route::get('/collections',[App\Http\Controllers\Frontend\FrontendController::class, 'categories']);
Route::get('/collections/{category_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'products']);
Route::get('/collections/{category_slug}/{product_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'productView']);
Route::get('/new-arrivals', [FrontendController::class, 'newArrivals']);
Route::get('/featured-products', [FrontendController::class, 'featuredProducts']);
Route::get('/electronics-products', [FrontendController::class, 'electronicsProducts']);
Route::get('/fashions-products', [FrontendController::class, 'fashionsProducts']);
Route::get('/accessories-products', [FrontendController::class, 'accessoriesProducts']);
Route::get('/appliances-products', [FrontendController::class, 'appliancesProducts']);
Route::get('search', [FrontendController::class, 'searchProducts'])->name('search');
Route::middleware(['auth'])->group(function () {
    Route::get('wishlist', [App\Http\Controllers\Frontend\WishlistController::class, 'index'])->name('wishlist.index');
    Route::get('cart', [App\Http\Controllers\Frontend\CartController::class, 'index'])->name('cart.index');
    Route::get('checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'index']);
    Route::get('orders',[App\Http\Controllers\Frontend\OrderController::class, 'index']);
    Route::get('orders/{orderId}',[App\Http\Controllers\Frontend\OrderController::class, 'show']);
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
Route::get('Thank-you', [App\Http\Controllers\Frontend\FrontendController::class, 'Thankyou']);
Route::get('/product/{category}/{product}', ProductView::class)->name('product.view');

Route::get('/collections/{category_slug}/{product_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'productView']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function(){
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('settings', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('admin.settings');
    Route::post('settings', [App\Http\Controllers\Admin\SettingsController::class, 'store']);
    Route::controller(App\Http\Controllers\Admin\SliderController::class)->group(function () {
        Route::get('sliders', 'index')->name('admin.sliders');
        Route::get('sliders/create', 'create');
        Route::post('sliders/create', 'store');
        Route::get('sliders/{slider}/edit','edit');
        Route::put('sliders/{slider}', 'update');
        Route::get('sliders/{slider}/delete','destroy');
    });
    
    //Category Route
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/{category}/edit', 'edit');
        Route::put('/category/{category}', 'update');
    });
    Route::get('category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('category/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('category', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.category.store');
    //admin/category/'.$category.'/edi
    
    Route::get('/brands', App\Http\Livewire\Admin\Brand\Index::class)->name('admin.brands');

    Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function () {
        Route::get('/products', 'index');
        Route::get('/products/create', 'create');
        Route::post('/products','store');
        Route::get('/products/{product}/edit','edit');
        Route::put('/products/{product}','update');
        Route::get('product-image/{product_image_id}/delete','destroyImage');
        Route::get('products/{product_id}/delete','destroy');
        Route::post('product-color/{prod_color_id}','updateProdColorQty');
        Route::get('product-color/{prod_color_id}/delete','deleteProdColor');
        
    });
    Route::controller(App\Http\Controllers\Admin\ColorController::class)->group(function () {
        Route::get('/colors', 'index')->name('admin.colors'); // Route GET untuk halaman daftar warna
        Route::get('/colors/create', 'create')->name('admin.colors.create'); // Route GET untuk halaman form create
        Route::post('/colors/create', 'store')->name('admin.colors.store'); // Route POST untuk menyimpan data
        Route::get('/colors/{color}/edit','edit');
        Route::put('/colors/{color_id}','update');
        Route::get('/colors/{color_id}/delete','destroy');
    });
    
    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders', 'index')->name('admin.orders');
        Route::get('/orders/{orderId}', 'show')->name('admin.orderDetails');
        Route::put('/orders/{orderId}', 'updateOrderStatus')->name('admin.updateOrderStatus');
        Route::get('/invoice/{orderId}','viewInvoice');
        Route::get('/invoice/{orderId}/generate','generateInvoice');
        
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/create', 'create');
        Route::post('/users', 'store');
        Route::get('/users/{user_id}/edit', 'edit');
        Route::put('/users/{user_id}', 'update');  // Pastikan URL ini benar
        Route::get('/users/{user_id}', 'destroy');
        Route::get('users/{user_id}/delete','destroy');

    });    
});
