<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Kupon;

use App\Models\Shipping;
use App\Models\Regency;
use App\Models\Province;
use App\Models\District;
use App\Models\Village;

use App\Models\Order;
use App\Models\OrderItem;

use Carbon\Carbon;

use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function ordersView()
    {
        $orders = Order::orderBy('id','desc')->get();
        return view('admin.order.order_view', compact('orders'));
    }

    public function ordersDetail($id)
    {
        $order = Order::with('province','regency','district','village')->where('id',$id)->first();
        $orderItem = OrderItem::with('product')->where('order_id',$id)->orderBy('id','desc')->get();
        return view('admin.order.order_detail',compact('order','orderItem'));
    }

    public function downloadInvoice($id)
    {
         $order =  Order::with('province','regency','district','village')->where('id', $id)->first();
        $orderItem = OrderItem::with('product')->where('order_id',$id)->orderBy('id','desc')->get();
        //return view('frontend.user.invoice.view_invoice', compact('order', 'orderItem'));

        $pdf = Pdf::loadView('admin.order.view_invoice', compact('order', 'orderItem'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
            
        ]);
        return $pdf->download('invoice.pdf');
    }



    
}
