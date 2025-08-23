<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Products;
use App\Models\Cart;

class MidtransController extends Controller
{
    public function midtransCallback(Request $request)
    {
        $serverKey = config('midtrans.serverKey');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed === $request->signature_key && $request->transaction_status == 'settlement') {
            $order = Order::where('order_number', $request->order_id)->first();

            if ($order && $order->status == 'pending') {
                // Ubah status order jadi sukses
                $order->status = 'success';
                $order->save();

                // Kurangi stok produk
                foreach ($order->orderItems as $item) {
                    $product = Products::find($item->product_id);
                    if ($product) {
                        $product->product_qty -= $item->qty;
                        $product->save();
                    }
                }

                // Kosongkan keranjang user
                Cart::where('user_id', $order->user_id)->delete();
                
            }
        }

        return response()->json(['message' => 'Callback diproses']);
    }

    public function notificationHandler(Request $request)
{
    $notif = new \Midtrans\Notification();
    $transaction = $notif->transaction_status;
    $order_id = $notif->order_id;

    $order = Order::where('invoice_no', $order_id)->first();

    if ($transaction == 'settlement') {
        $order->status = 'success';
        $order->save();

        // Kurangi stok produk
        foreach ($order->orderItems as $item) {
            $product = Products::find($item->product_id);
            if ($product) {
                $product->product_qty -= $item->qty;
                $product->save();
            }
        }

    } elseif (in_array($transaction, ['pending', 'deny', 'expire', 'cancel'])) {
        $order->status = $transaction;
        $order->save();
        // Tidak mengurangi stok
    }
}




}
