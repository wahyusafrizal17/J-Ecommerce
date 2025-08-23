<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function viewBrand()
    {
        $brands = Brand::latest()->get();
        return view('admin.brands.brand_view', compact('brands'));
    }

    public function brandStore(Request $request)
    {
        $request->validate([
            'brand_name_en' => 'required',
            'brand_name_ind' => 'required',
            'brand_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save(public_path('upload/brand/' . $name_gen));
        $save_url = 'upload/brand/' . $name_gen;

        Brand::insert([
            'brand_name_en' => $request->brand_name_en,
            'brand_name_ind' => $request->brand_name_ind,
            'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
            'brand_slug_ind' => strtolower(str_replace(' ', '-', $request->brand_name_ind)),
            'brand_image' => $save_url,
        ]);

        $notification = [
            'message' => 'Brand Berhasil Di Tambahkan',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function brandEdit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brands.brand_edit', compact('brand'));
    }

    public function brandUpdate(Request $request, $id)
    {
        $brand_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('brand_image')) {

            $old_path = public_path($old_img);
            if (file_exists($old_path)) {
                unlink($old_path);
            }

            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save(public_path('upload/brand/' . $name_gen));
            $save_url = 'upload/brand/' . $name_gen;

            Brand::findOrFail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_ind' => $request->brand_name_ind,
                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                'brand_slug_ind' => strtolower(str_replace(' ', '-', $request->brand_name_ind)),
                'brand_image' => $save_url,
            ]);

        } else {
            Brand::findOrFail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_ind' => $request->brand_name_ind,
                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                'brand_slug_ind' => strtolower(str_replace(' ', '-', $request->brand_name_ind)),
            ]);
        }

        $notification = [
            'message' => 'Brand Berhasil Diupdate',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.brand')->with($notification);
    }

    public function brandDelete($id)
    {
        $brand = Brand::findOrFail($id);
        $img_path = public_path($brand->brand_image);

        if (file_exists($img_path)) {
            unlink($img_path); 
        }

        $brand->delete();

        $notification = [
            'message' => 'Brand Berhasil Di Hapus',
            'alert-type' => 'danger',
        ];

        return redirect()->back()->with($notification);
    }
}
