<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Kupon;

use App\Models\Shipping;
use App\Models\Regency;
use App\Models\Province;
use App\Models\District;
use App\Models\Village;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Products;

use Carbon\Carbon;

use Barryvdh\DomPDF\Facade\Pdf;

class CheckoutController extends Controller
{
    public function checkoutDetail(Request $request)
{
    // Cek jika kupon aktif
    if (Session::has('kupon')) {
        $total_amount = Session::get('kupon')['total_amount'];
    } else {
        $total_amount = (int)str_replace(',', '', Cart::subtotal());
    }

    // Validasi stok sebelum membuat order
    $carts = Cart::content();
    foreach ($carts as $cart) {
        $product = \App\Models\Products::find($cart->id);
        if ($product && $product->product_qty < $cart->qty) {
            return redirect()->back()->with('error', 'Stok produk "' . $product->product_name . '" tidak mencukupi');
        }
    }

    // Ambil data input
    $name = $request->name;
    $email = $request->email;
    $phone = $request->phone;
    $postCode = $request->post_code;
    $notes = $request->notes;

    // Ambil wilayah
    $province = Province::where('id', $request->province_id)->first();
    $regency = Regency::where('id', $request->regency_id)->first();
    $district = District::where('id', $request->district_id)->first();
    $village = Village::where('id', $request->village_id)->first();

    // Simpan order
    $order_id = Order::insertGetId([
        'user_id' => Auth::id(),
        'province_id' => $request->province_id,
        'regency_id' => $request->regency_id,
        'district_id' => $request->district_id,
        'village_id' => $request->village_id,
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'post_code' => $request->post_code,
        'notes' => $request->notes,
        'amount' => $total_amount,
        'invoice_no' => 'MS' . mt_rand(10000000, 99999999),
        'order_date' => Carbon::now()->format('d F Y'),
        'order_month' => Carbon::now()->format('F'),
        'order_Year' => Carbon::now()->format('Y'),
        'status' => 'Pending',
        'created_at' => Carbon::now(),
    ]);

    // Simpan item satu per satu
    foreach ($carts as $cart) {
        OrderItem::insert([
            'order_id' => $order_id,
            'product_id' => $cart->id,
            'color' => $cart->options->color,
            'size' => $cart->options->size,
            'qty' => $cart->qty,
            'price' => $cart->price,
            'created_at' => Carbon::now(),
        ]);
    }

    // Konfigurasi Midtrans
    \Midtrans\Config::$serverKey = config('midtrans.server_key');
    \Midtrans\Config::$isProduction = false;
    \Midtrans\Config::$isSanitized = true;
    \Midtrans\Config::$is3ds = true;

    $params = array(
        'transaction_details' => array(
            'order_id' => rand(),
            'gross_amount' => $total_amount,
        ),
        'customer_details' => array(
            'first_name' => $name,
            'email' => $email,
            'phone' => $phone,
        ),
    );

    $snapToken = \Midtrans\Snap::getSnapToken($params);

    // Hapus kupon jika ada
    if (Session::has('kupon')) {
        Session::forget('kupon');
    }
    

    // Kosongkan keranjang
    //Cart::destroy();
    // Kirim ke view
    return view('frontend.checkout.detail_checkout', compact(
        'carts', 'name', 'email', 'phone', 'province', 'regency',
        'district', 'village', 'postCode', 'notes', 'total_amount', 'snapToken', 'order_id',
    ));
}


    public function checkoutStore(Request $request)
{
    $id_order = $request->id_order;
    $data = json_decode($request->get('json'));

    Order::findOrFail($id_order)->update([
        'status' => 'Success',
        'payment_type' => $data->payment_type,
        'transaction_id' => $data->transaction_id,
    ]);

    $order = Order::with('user')->findOrFail($id_order);

    $orderItems = OrderItem::where('order_id', $id_order)->get();
    foreach ($orderItems as $item) {
        $product = \App\Models\Products::find($item->product_id);
        if ($product) {
            $product->product_qty -= $item->qty;
            if ($product->product_qty < 0) {
                $product->product_qty = 0;
            }
            $product->save();
        }
    }

    // Kirim email ke user setelah pembayaran sukses
    $user = Auth::user();
    Mail::to($user->email)->send(new \App\Mail\OrderSuccessMail($order));

    $notification = array(
        'message' => 'Pembayaran Berhasil! Email telah dikirim.',
        'alert-type' => 'success',
    );

    Cart::destroy();
    return redirect()->route('dashboard')->with([
    'message' => 'Pembayaran Berhasil! Email telah dikirim.',
    'alert-type' => 'success',
]);


}

    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('id','DESC')->get();
        return view('frontend.user.order.view_order', compact('orders'));
    }

    public function orderDetail($id)
    {
        $order =  Order::with('province','regency','district','village')->where('id', $id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id',$id)->orderBy('id','desc')->get();
        return view('frontend.user.order.order_detail', compact('order', 'orderItem'));
    }

    public function downloadInvoice($id)
    {
        $order =  Order::with('province','regency','district','village')->where('id', $id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id',$id)->orderBy('id','desc')->get();
        //return view('frontend.user.invoice.view_invoice', compact('order', 'orderItem'));

        $pdf = Pdf::loadView('frontend.user.invoice.view_invoice', compact('order', 'orderItem'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
                
        ]);
        return $pdf->download('invoice.pdf');
    }
}
