<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Slider;

use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class SliderController extends Controller
{

    public function viewSlider()
    {
        $sliders = Slider::latest()->get();
        return view('admin.sliders.view_slider', compact('sliders'));
    }

    public function sliderStore(Request $request)
    {
        $request->validate([
            'slider_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ], [
            'slider_img.required' => 'Slider harus diisi!',
        ]);

        $image = $request->file('slider_img');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(870, 370)->save(public_path('upload/slider/' . $name_gen));
        $save_url = 'upload/slider/' . $name_gen;

        \App\Models\Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'slider_img' => $save_url,
            'created_at' => now(), // optional jika kamu menggunakan timestamps
        ]);

        $notification = [
            'message' => 'Slider Berhasil Ditambahkan',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function sliderEdit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.sliders.edit_slider', compact('slider'));
    }

   public function sliderUpdate(Request $request, $id)
{
    
    $old_img = $request->old_image;

    if ($request->file('slider_img')) {

        // Hapus gambar lama jika ada
        $old_path = public_path($old_img);
        if (file_exists($old_path)) {
            unlink($old_img);
        }

        // Upload gambar baru
        $image = $request->file('slider_img');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(870, 370)->save(public_path('upload/slider/' . $name_gen));
        $save_url = 'upload/slider/' . $name_gen;

        Slider::findOrFail($id)->update([
            'title'        => $request->title,
            'description'  => $request->description,
            'slider_img'   => $save_url,
        ]);

    } else {
        // Update tanpa ganti gambar
        Slider::findOrFail($id)->update([
            'title'       => $request->title,
            'description' => $request->description,
        ]);
    }

    $notification = [
        'message'    => 'Slider Berhasil Diupdate',
        'alert-type' => 'success',
    ];

    return redirect()->route('manage.slider')->with($notification);
}

public function sliderActive($id)
    {
        Slider::findOrFail($id)->update([
            'status' => 1,
        ]);

        $notification = array(
            'message' => 'Slider Actived!',
            'alert-type' => 'success',
        );

         return redirect()->back()->with($notification);
    }

    public function sliderInactive($id)
    {
        Slider::findOrFail($id)->update([
            'status' => 0,
        ]);

        $notification = array(
            'message' => 'Slider InActived!',
            'alert-type' => 'success',
        );

         return redirect()->back()->with($notification);
    }

     public function sliderDelete($id)
    {
        $slider = Slider::findOrFail($id);
        $img_path = public_path($slider->slider_img);

        if (file_exists($img_path)) {
            unlink($img_path);
        }

        $slider->delete();

        $notification = [
            'message' => 'Brand Berhasil Di Hapus',
            'alert-type' => 'danger',
        ];

        return redirect()->back()->with($notification);
    }
}