<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // ✅ Tambahkan ini agar Auth dikenali
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\Backend\KuponController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\SocialiteController;
use App\Models\Order;
use App\Models\ShippingArea;
use App\Models\User;

use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderSuccessMail;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route login admin (prefix & middleware khusus admin)
Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function () {
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('admin.dashboard'); // Ganti name agar tidak bentrok dengan user

    // Route Admin Profile
    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');
    Route::get('/admin/profile/edit', [AdminProfileController::class, 'adminProfileEdit'])->name('admin.profile.edit');
    Route::post('/admin/profile/update', [AdminProfileController::class, 'adminProfileUpdate'])->name('admin.profile.update');
    Route::get('/admin/change/password', [AdminProfileController::class, 'adminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminProfileController::class, 'adminUpdatePassword'])->name('admin.password.update');

    Route::prefix('admin')->group(function () {

        Route::prefix('brand')->group(function () {

            Route::get('/view', [BrandController::class, 'viewBrand'])->name('all.brand');

            Route::post('/store', [BrandController::class, 'brandStore'])->name('brand.store');

            Route::get('/edit/{id}', [BrandController::class, 'brandEdit'])->name('brand.edit');

            Route::post('/update/{id}', [BrandController::class, 'brandUpdate'])->name('brand.update');

            Route::get('/delete/{id}', [BrandController::class, 'brandDelete'])->name('brand.delete');
        });


        Route::prefix('category')->group(function () {

            Route::get('/view', [CategoryController::class, 'viewCategory'])->name('all.category');

            Route::post('/store', [CategoryController::class, 'categoryStore'])->name('category.store');

            Route::get('/edit/{id}', [CategoryController::class, 'categoryEdit'])->name('category.edit');

            Route::post('/update/{id}', [CategoryController::class, 'categoryUpdate'])->name('category.update');

            // Route untuk proses DELETE (yang akan dipanggil jika konfirmasi OK)
            Route::get('/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('category.delete'); // Menggunakan GET untuk simplicity sesuai kode Anda

            // Route untuk AJAX check products (penting!)
            Route::get('/check-products/{id}', [CategoryController::class, 'checkProducts'])->name('category.check_products');
        });


        Route::prefix('products')->group(function () {

            // Halaman tambah produk
            Route::get('/add', [ProductController::class, 'addProduct'])->name('product.add');

            // Simpan produk baru
            Route::post('/store', [ProductController::class, 'storeProduct'])->name('product.store');

            // Halaman kelola semua produk
            Route::get('/manage', [ProductController::class, 'manageProduct'])->name('product.manage');

            // Edit Produk
            Route::get('/edit/{id}', [ProductController::class, 'editProduct'])->name('product.edit');

            // Update Produk
            Route::post('/update/data/{id}', [ProductController::class, 'updateDataProduct'])->name('product.data.update');

            // Update images

            Route::post('/update/images', [ProductController::class, 'updateDataImages'])->name('images.update');

            // Update images

            Route::post('/update/thumbnail/{id}', [ProductController::class, 'updateThumbnail'])->name('thumbnail.update');

            // Hapus Produk
            Route::get('/imgs/delete/{id}', [ProductController::class, 'imgsDelete'])->name('product.imgs.delete');

            Route::get('/active/{id}', [ProductController::class, 'productActive'])->name('product.active');

            Route::get('/inactive/{id}', [ProductController::class, 'productInactive'])->name('product.inactive');

            Route::get('/delete/{id}', [ProductController::class, 'productDelete'])->name('product.delete');

        });

        Route::prefix('slider')->group(function () {

            Route::get('/view', [SliderController::class, 'viewSlider'])->name('manage.slider');

            Route::post('/store', [SliderController::class, 'sliderStore'])->name('slider.store');

            Route::get('/edit/{id}', [SliderController::class, 'sliderEdit'])->name('slider.edit');

            Route::post('/update/{id}', [SliderController::class, 'sliderUpdate'])->name('slider.update');

            Route::get('/active/{id}', [SliderController::class, 'sliderActive'])->name('slider.active');

            Route::get('/inactive/{id}', [SliderController::class, 'sliderInactive'])->name('slider.inactive');

            Route::get('/delete/{id}', [SliderController::class, 'sliderDelete'])->name('slider.delete');


             Route::prefix('kupon')->group(function () {

            Route::get('/view', [KuponController::class, 'viewKupon'])->name('manage.kupon');

            Route::post('/store', [KuponController::class, 'kuponStore'])->name('kupon.store');

            Route::get('/edit/{id}', [KuponController::class, 'kuponEdit'])->name('kupon.edit');

            Route::post('/update/{id}', [KuponController::class, 'kuponUpdate'])->name('kupon.update');

            Route::get('/delete/{id}', [KuponController::class, 'kuponDelete'])->name('kupon.delete');
        });
        });
    });

    // order route 
            Route::prefix('order')->group(function () {

            Route::get('/', [OrderController::class, 'ordersView'])->name('manage.orders');

            Route::get('/detail/{id}', [OrderController::class, 'ordersDetail'])->name('admin.detail.order');

            Route::get('/invoice/{id}', [OrderController::class, 'downloadInvoice'])->name('admin.invoice');

        });

        // reports route 
            Route::prefix('reports')->group(function () {

            Route::get('/', [ReportController::class, 'reportView'])->name('admin.reports');

            Route::post('/search-by-date', [ReportController::class, 'reportByDate'])->name('admin.search.by.date');

             Route::post('/search-by-month', [ReportController::class, 'reportByMonth'])->name('admin.search.by.month');

              Route::post('/search-by-yaer', [ReportController::class, 'reportByYear'])->name('admin.search.by.year');

        });

        // users admin route 
            Route::prefix('users')->group(function () {

            Route::get('/', [UsersController::class, 'userView'])->name('admin.users');

            
        });

});//end group middlewaare admin



// shipping route 
Route::prefix('shipping')->group(function () {

            Route::get('/view', [ShippingAreaController::class, 'viewShipping'])->name('manage.area');

            Route::post('/get-regency', [ShippingAreaController::class, 'getRegency'])->name('get.regency');

            Route::post('/get-district', [ShippingAreaController::class, 'getDistrict'])->name('get.district');

            Route::post('/get-village', [ShippingAreaController::class, 'getVillage'])->name('get.village');

            Route::post('/store', [ShippingAreaController::class, 'shippingStore'])->name('shipping.store');

            Route::get('/edit/{id}', [ShippingAreaController::class, 'shippingEdit'])->name('shipping.edit');

            Route::post('/update/{id}', [ShippingAreaController::class, 'shippingUpdate'])->name('shipping.update');

            Route::get('/delete/{id}', [ShippingAreaController::class, 'shippingDelete'])->name('shipping.delete');

        });

// shipping raja ongkir route 





// ========================
// Route Frontend (guard web)
// ========================
Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id = Auth::user()->id;
    $user = User::find($id);
    return view('dashboard', compact('user'));
})->name('dashboard');






// Route umum (frontend user)
Route::get('/', [IndexController::class, 'index']);
Route::get('/user/logout', [IndexController::class, 'userLogout'])->name('user.logout');
Route::get('/user/profile/edit', [IndexController::class, 'userProfileEdit'])->name('user.profile.edit');
Route::post('/user/profile/update', [IndexController::class, 'userProfileUpdate'])->name('user.profile.update');
Route::get('/user/change/password', [IndexController::class, 'changePassword'])->name('change.password');
Route::post('/user/update/password', [IndexController::class, 'userUpdatePassword'])->name('user.update.password');


Route::get('/language/ind', [LanguageController::class, 'ind'])->name('language.ind');

Route::get('/language/en', [LanguageController::class, 'en'])->name('language.en');

Route::get('/detail/{id}/{slug}', [IndexController::class, 'detail']);


Route::get('/product/tag/{tag}', [IndexController::class, 'tagProduct'])->name('product.tag');

//routing get data by ajax
Route::get('/product/view/modal/{id}', [IndexController::class, 'getProductModal']);

Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');

// web.php
Route::get('/product/mini/cart', [CartController::class, 'addMiniCart'])->name('mini.cart');

Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'removeMiniCart'])->name('minicart.remove');

Route::get('/cart/remove/{rowId}', [CartController::class, 'removeCartItem']);




Route::group(['prefix' => 'user', 'middleware' =>['user','auth'],'namespace'=>'User'], function(){
// route wishlist product
Route::post('/add-to-wishlist/{product_id}', [CartController::class, 'addToWishlist'])->name('wishlist.add');

Route::get('/wishlist', [WishlistController::class, 'viewWishlist'])->name('wishlist');

Route::get('/get-wishlist-product', [WishlistController::class, 'getWishlist']);

Route::delete('/remove-wishlist/{id}', [WishlistController::class, 'removeWishlist'])->name('wishlist.remove');

Route::get('/my-order', [CheckoutController::class, 'myOrders'])->name('my.order');

Route::get('/invoice/{id}', [CheckoutController::class, 'downloadInvoice'])->name('invoice');



});


Route::get('/mycart', [CartPageController::class, 'myCart'])->name('mycart');

Route::get('/get-mycart-product', [CartPageController::class, 'getMyCart']);

Route::post('/cart/remove/{id}', [CartPageController::class, 'removeCartItem'])->name('cartitem.remove');


Route::get('/cart-increment/{rowId}', [CartPageController::class, 'incrementMyCart']);
Route::get('/cart-decrement/{rowId}', [CartPageController::class, 'decrementMyCart']);

//route kupon
Route::post('/kupon-apply', [CartController::class, 'kuponApply'])->name('kupon.apply');
Route::get('/kupon-calculation', [CartController::class, 'kuponCalculation'])->name('kupon.calculation');
Route::get('/kupon-remove', [CartController::class, 'kuponRemove'])->name('kupon.remove');
//end route kupon

//checkout routes
Route::get('/checkout', [CartController::class, 'checkoutCreate'])->name('checkout');

Route::post('/checkout-detail', [CheckoutController::class, 'checkoutDetail'])->name('checkout.detail');

Route::post('/checkout-store', [CheckoutController::class, 'checkoutStore'])->name('checkout.store');

Route::get('/my-order', [CheckoutController::class, 'myOrders'])->name('my.order');

Route::get('/order-detail/{id}', [CheckoutController::class, 'orderDetail'])->name('order.detail');


Route::get('/invoice/{id}', [CheckoutController::class, 'downloadInvoice'])->name('invoice');

//end checkout routes

// search admin route 
Route::get('/search-product', [IndexController::class, 'ProductSearch'])->name('product.search');

// Midtrans route



Route::post('/midtrans/callback', [MidtransController::class, 'midtransCallback']);



Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [\App\Http\Controllers\Backend\AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // ... route admin lainnya
});

Route::get('/auth/redirect',[SocialiteController::class, 'redirect']);

Route::get('/callback',[SocialiteController::class, 'callback']);


//Route::get('/test-email', function () {
   // $order = Order::latest()->first(); // ambil order terakhir sebagai contoh
    ///Mail::to('deviramdhani09@gmail.com')->send(new OrderSuccessMail($order));
    //return "Email berhasil dikirim.";
//});
