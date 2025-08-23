<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Products;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function viewCategory()
    {
        $category = Category::latest()->get();
        return view('admin.category.category_view', compact('category'));
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'category_name_en' => 'required',
            'category_name_ind' => 'required',
            'category_item'    => 'required|string|max:255',
        ]);

        Category::insert([
            'category_name_en' => $request->category_name_en,
            'category_name_ind' => $request->category_name_ind,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_slug_ind' => strtolower(str_replace(' ', '-', $request->category_name_ind)),
            'category_item' => $request->category_item,
        ]);

        $notification = [
            'message' => 'Kategori berhasil ditambahkan',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function categoryEdit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.category_edit', compact('category'));
    }

    public function categoryUpdate(Request $request)
    {
        $category_id = $request->id;

        $request->validate([
            'category_name_en' => 'required',
            'category_name_ind' => 'required',
            'category_item'    => 'required|string|max:255',
        ]);

        Category::findOrFail($category_id)->update([
            'category_name_en' => $request->category_name_en,
            'category_name_ind' => $request->category_name_ind,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_slug_ind' => strtolower(str_replace(' ', '-', $request->category_name_ind)),
            'category_item' => $request->category_item,
        ]);

        $notification = [
            'message' => 'Kategori berhasil diupdate',
            'alert-type' => 'info',
        ];

        return redirect()->route('all.category')->with($notification);
    }

     public function categoryDelete($id)
    {
        $defaultCategoryId = 1; // Id kategori default yang tidak boleh dihapus
        $defaultCategoryName = 'Tanpa Kategori'; // Nama kategori default untuk pesan

        if ($id == $defaultCategoryId) {
            $notification = [
                'message' => 'Kategori default tidak boleh dihapus.',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

        // Cek apakah ada produk dengan category_id = $id
        $produkTerkaitCount = Products::where('category_id', $id)->count();

        if ($produkTerkaitCount > 0) {
            // Pindahkan produk terkait ke kategori default
            Products::where('category_id', $id)->update(['category_id' => $defaultCategoryId]);
            $pesanNotifikasi = "Kategori berhasil dihapus dan $produkTerkaitCount produk telah dipindahkan ke kategori '{$defaultCategoryName}'.";
        } else {
            $pesanNotifikasi = 'Kategori berhasil dihapus.';
        }

        // Hapus kategori
        Category::findOrFail($id)->delete();

        $notification = [
            'message' => $pesanNotifikasi,
            'alert-type' => 'success', // Ganti ke success atau info jika lebih cocok
        ];

        return redirect()->back()->with($notification);
    }

    // Method untuk cek produk terkait (digunakan oleh AJAX di frontend)
    public function checkProducts($id)
    {
        $count = Products::where('category_id', $id)->count();
        return response()->json(['products_count' => $count]);
    }
}