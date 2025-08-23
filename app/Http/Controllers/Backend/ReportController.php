<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;
use App\Models\Order;

class ReportController extends Controller
{
    public function reportView()
    {
        return view('admin.reports.view_report');
    }

    public function reportByDate(Request $request)
    {
        // Validasi input date
        if (!$request->date) {
            return back()->with('error', 'Tanggal wajib diisi.');
        }

        // Format ke tanggal database (misalnya: Y-m-d)
        $data = new DateTime($request->date);
        $formatDate = $data->format('d F Y'); // Atau sesuaikan dengan format database

        // Ambil data order berdasarkan tanggal
        $orders = Order::where('order_date', $formatDate)->latest()->get();

        // Tampilkan hasil
        return view('admin.reports.report_show', compact('orders'));
    }

    public function reportByMonth(Request $request)
    {
        

        // Ambil data order berdasarkan tanggal
        $orders = Order::where('order_month',$request->month)->where('order_year', $request->year)->latest()->get();

        // Tampilkan hasil
        return view('admin.reports.report_show', compact('orders'));
    }

    public function reportByYear(Request $request)
    {
        

        // Ambil data order berdasarkan tanggal
        $orders = Order::where('order_year',$request->year)->latest()->get();

        // Tampilkan hasil
        return view('admin.reports.report_show', compact('orders'));
    }


}
