<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Wishlist;
use App\Models\Kupon;
use App\Models\Province;
use App\Models\Regency;

use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
  public function addToCart(Request $request, $id)
{
    if(Session::has('kupon')){
        Session::forget('kupon');
    }

    $request->validate([
        'qty' => 'required|numeric|min:1',
        'color' => 'nullable|string',
        'size' => 'nullable|string'
    ]);

    $product = Products::findOrFail($id);

    // ✅ CEK JIKA STOK HABIS
    if ($product->product_qty < 1) {
        return response()->json([
            'status' => false,
            'message' => 'Produk ini sedang habis!'
        ]);
    }

    // ✅ CEK JIKA QTY MELEBIHI STOK
    if ($request->qty > $product->product_qty) {
        return response()->json([
            'status' => false,
            'message' => 'Jumlah yang diminta melebihi stok produk!'
        ]);
    }

    // ✅ JIKA SEMUA AMAN, TAMBAHKAN KE KERANJANG
    $data = [
        'id' => $id,
        'name' => $product->product_name_en,
        'qty' => $request->qty,
        'price' => $product->discount_price ?? $product->selling_price,
        'weight' => 1,
        'options' => [
            'size' => $request->size,
            'color' => $request->color,
            'image' => $product->product_thumbnail,
        ]
    ];

    Cart::add($data);

    return response()->json([
        'status' => true,
        'message' => 'Produk berhasil ditambahkan ke keranjang'
    ]);
}


    public function addMiniCart()
{
    try {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = (float)str_replace(',', '', Cart::total()); // Konversi ke float

        return response()->json([
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Gagal memuat keranjang: ' . $e->getMessage()
        ], 500);
    }
}

    public function removeMiniCart($rowId)
{
    $cart = Cart::content();
    if (!$cart->where('rowId', $rowId)->count()) {
        return response()->json(['error' => 'Item tidak ditemukan di keranjang'], 404);
    }
    Cart::remove($rowId);
    return response()->json(['success'=> 'Data Keranjang Berhasil Dihapus']);
}


public function addToWishlist(Request $request, $product_id)
{
    if(Auth::check()){
        $exists = Wishlist::where('user_id', Auth::id())
                          ->where('product_id', $product_id)
                          ->first();

        if ($exists) {
            return response()->json(['error' => 'Produk sudah ada di wishlist']);
        }

        Wishlist::insert([
            'user_id' => Auth::id(),
            'product_id' => $product_id,
            'created_at' => Carbon::now(),  // perbaikan tanda panah
            'updated_at' => Carbon::now(),
        ]);

        return response()->json(['success' => 'Produk berhasil ditambahkan ke wishlist']);
    } else {
        return response()->json(['error' => 'Silahkan login terlebih dahulu'], 401);
    }
}

public function kuponApply(Request $request)
{
    $kupon = Kupon::where('kupon_name', $request->kupon_name)
                ->where('kupon_validity', '>=', Carbon::now()->format('Y-m-d'))
                ->first();

    if ($kupon) {
        $subtotal = floatval(str_replace(',', '', Cart::subtotal())); // ✅ PERBAIKAN

        $discountAmount = $subtotal * ($kupon->kupon_discount / 100);
        $totalAmount = $subtotal - $discountAmount;

        Session::put('kupon', [
            'kupon_name' => $kupon->kupon_name,
            'kupon_discount' => $kupon->kupon_discount,
            'discount_amount' => $discountAmount,
            'total_amount' => $totalAmount,
        ]);

        return response()->json(['success' => true]);
    }

    return response()->json(['error' => 'Kupon tidak valid!'], 400);
}


    public function kuponCalculation()
{
    if (Cart::count() == 0 && Session::has('kupon')) {
        Session::forget('kupon'); // Hapus kupon kalau cart kosong
    }

    if(Session::has('kupon')) {
        return response()->json([
            'subtotal' => (int) str_replace(',', '', Cart::subtotal()),
            'kupon_name' => session('kupon.kupon_name'),
            'kupon_discount' => session('kupon.kupon_discount'),
            'discount_amount' => session('kupon.discount_amount'),
            'total_amount' => session('kupon.total_amount'),
        ]);
    }

    return response()->json(['total' => (int) str_replace(',', '', Cart::subtotal())]);
}

public function kuponRemove()
{
    Session::forget('kupon');
    return response()->json(['success' => 'Kupon berhasil dihapus']);
}

public function checkoutCreate()
{
    if(Auth::check()){

        if(Cart::subtotal() > 0){

            $carts = Cart::content();
            $cartQty = Cart::count();
            $total = Cart::subtotal();

            $provinces = Province::all();

           return view('frontend.checkout.checkout_view', compact('carts', 'cartQty', 'total', 'provinces'));

        }else{

            $notification = array(
                'message' => 'Ayoo Isi Keranjang Muuu >.<',
                'alert-type' => 'info',
            );
            return redirect()->to('/')->with($notification);
        }

    }else{

        $notification = array(
            'message' => 'Silahkan Login Terlebih Dahulu!',
            'alert-type' => 'info',
        );
        return redirect()->route('login')->with($notification);
    }
}

public function removeCartItem($rowId)
{
    try {
        Cart::remove($rowId);
        return response()->json(['success' => 'Produk berhasil dihapus dari keranjang']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Gagal menghapus item: ' . $e->getMessage()]);
    }
}



}

