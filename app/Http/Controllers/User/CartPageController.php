<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use App\Models\Kupon;
use Carbon\Carbon;


class CartPageController extends Controller
{
    public function myCart()
    {
        return view('frontend.mycart.view_mycart');
    }

    public function getMyCart()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = (float)str_replace(',', '', Cart::total()); // Konversi ke float

        return response()->json([
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal
        ]);
    }

public function removeCartItem($id)
{
    Cart::remove($id);

    if(Session::has('kupon')){
        Session::forget('kupon');
    }

    return response()->json(['success' => 'Item keranjang berhasil dihapus!']);
}


public function incrementMyCart($rowId)
{
    try {
        $row = Cart::get($rowId);
        if (!$row) {
            return response()->json([
                'success' => false,
                'error' => 'Item tidak ditemukan dalam keranjang'
            ], 404);
        }

        // Update quantity
        Cart::update($rowId, $row->qty + 1);

        // Hitung ulang kupon jika ada
        if (Session::has('kupon')) {
            $kupon_name = Session::get('kupon')['kupon_name'];
            $kupon = Kupon::where('kupon_name', $kupon_name)->first();

            if ($kupon) {
                $subtotal = floatval(str_replace(',', '', Cart::subtotal()));

                $discountAmount = $subtotal * ($kupon->kupon_discount / 100);
                $totalAmount = $subtotal - $discountAmount;

                Session::put('kupon', [
                    'kupon_name' => $kupon->kupon_name,
                    'kupon_discount' => $kupon->kupon_discount,
                    'discount_amount' => $discountAmount,
                    'total_amount' => $totalAmount,
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Quantity berhasil ditambah',
            'new_qty' => $row->qty + 1,
            'cart_subtotal' => Cart::subtotal(),
            'cart_total' => Cart::total(),
            'cart_count' => Cart::count(),
            'kupon' => Session::get('kupon') // Kirim data kupon jika ada
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => 'Terjadi kesalahan saat menambah quantity: ' . $e->getMessage()
        ], 500);
    }
}

public function decrementMyCart($rowId)
{
    try {
        $row = Cart::get($rowId);
        if (!$row) {
            return response()->json([
                'success' => false,
                'error' => 'Item tidak ditemukan dalam keranjang'
            ], 404);
        }

        // Jika quantity akan menjadi 0, hapus item
        if ($row->qty <= 1) {
            Cart::remove($rowId);
            return response()->json([
                'success' => true,
                'message' => 'Item berhasil dihapus dari keranjang',
                'new_qty' => 0,
                'cart_subtotal' => Cart::subtotal(),
                'cart_total' => Cart::total(),
                'cart_count' => Cart::count(),
                'item_removed' => true,
                'kupon' => Session::get('kupon')
            ]);
        }

        // Update quantity
        Cart::update($rowId, $row->qty - 1);

        // Hitung ulang kupon jika ada
        if (Session::has('kupon')) {
            $kupon_name = Session::get('kupon')['kupon_name'];
            $kupon = Kupon::where('kupon_name', $kupon_name)->first();

            if ($kupon) {
                $subtotal = floatval(str_replace(',', '', Cart::subtotal()));

                $discountAmount = $subtotal * ($kupon->kupon_discount / 100);
                $totalAmount = $subtotal - $discountAmount;

                Session::put('kupon', [
                    'kupon_name' => $kupon->kupon_name,
                    'kupon_discount' => $kupon->kupon_discount,
                    'discount_amount' => $discountAmount,
                    'total_amount' => $totalAmount,
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Quantity berhasil dikurangi',
            'new_qty' => $row->qty - 1,
            'cart_subtotal' => Cart::subtotal(),
            'cart_total' => Cart::total(),
            'cart_count' => Cart::count(),
            'kupon' => Session::get('kupon')
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => 'Terjadi kesalahan saat mengurangi quantity: ' . $e->getMessage()
        ], 500);
    }
}


}