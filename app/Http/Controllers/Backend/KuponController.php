<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kupon;
use Carbon\Carbon;
class KuponController extends Controller
{
    public function viewKupon()
    {
        $kupon = Kupon::latest()->get();
        return view('admin.kupon.view_kupon', compact('kupon'));
    }

    public function kuponStore(Request $request)
{
    $request->validate([
        'kupon_name' => 'required',
        'kupon_discount' => 'required',
        'kupon_validity' => 'required',
    ], [
        'kupon_name.required' => 'Nama Kupon Wajib Diisi!',
        'kupon_discount.required' => 'Diskon Kupon Wajib Diisi!',
        'kupon_validity.required' => 'Tanggal Validitas Kupon Wajib Diisi!',
    ]);

    Kupon::insert([
        'kupon_name' => $request->kupon_name,
        'kupon_discount' => $request->kupon_discount,
        'kupon_validity' => $request->kupon_validity,
        'created_at' => Carbon::now(),
    ]);

    $notification = [
        'message' => 'Kupon berhasil ditambahkan',
        'alert-type' => 'success',
    ];

    return redirect()->back()->with($notification);
}

public function kuponEdit($id)
{
    $kupon = Kupon::findOrFail($id);
    return view('admin.kupon.edit_kupon', compact('kupon'));
}

public function kuponUpdate(Request $request, $id)
{
    $request->validate([
        'kupon_name' => 'required',
        'kupon_discount' => 'required',
        'kupon_validity' => 'required',
    ], [
        'kupon_name.required' => 'Nama Kupon Wajib Diisi!',
        'kupon_discount.required' => 'Diskon Kupon Wajib Diisi!',
        'kupon_validity.required' => 'Tanggal Validitas Kupon Wajib Diisi!',
    ]);

    Kupon::findOrFail($id)->update([
        'kupon_name' => $request->kupon_name,
        'kupon_discount' => $request->kupon_discount,
        'kupon_validity' => $request->kupon_validity,
        'updated_at' => Carbon::now(),
    ]);

    $notification = [
        'message' => 'Kupon berhasil diupdate',
        'alert-type' => 'success',
    ];

    return redirect()->route('manage.kupon')->with($notification);
}

public function kuponDelete($id)
    {
        Kupon::findOrFail($id)->delete();

        $notification = [
            'message' => 'Kupon berhasil dihapus',
            'alert-type' => 'warning',
        ];

        return redirect()->back()->with($notification);
    }
}

