<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Multiimg;
use App\Models\Products;
use App\Models\OrderItem;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Menampilkan form tambah produk.
     */
    public function addProduct()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('admin.product.product_add', compact('categories', 'brands'));
    }

    /**
     * Menyimpan data produk baru dari form utama.
     */
    public function storeProduct(Request $request)
    {
        $request->validate([
            'brand_id' => 'required',
            'category_id' => 'required',
            'product_name_en' => 'required',
            'product_name_ind' => 'required',
            'product_thumbnail' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $product_slug_en = Str::slug($request->product_name_en);
        $product_slug_ind = Str::slug($request->product_name_ind);

        // Simpan Thumbnail
        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $save_url = 'upload/products/thumbnail/' . $name_gen;
        Image::make($image)->resize(917, 1000)->save(public_path($save_url));

        // Simpan Data Produk
        $product_id = Products::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'product_code' => $request->product_code,
            'product_name_en' => $request->product_name_en,
            'product_name_ind' => $request->product_name_ind,
            'product_slug_en' => $product_slug_en,
            'product_slug_ind' => $product_slug_ind,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_ind' => $request->product_tags_ind,
            'product_size_en' => $request->product_size_en,
            'product_size_ind' => $request->product_size_ind,
            'product_color_en' => $request->product_color_en,
            'product_color_ind' => $request->product_color_ind,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_ind' => $request->short_descp_ind,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_ind' => $request->long_descp_ind,
            'product_thumbnail' => $save_url,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        // Simpan Multiple Images
        if ($request->file('multiple_img')) {
            foreach ($request->file('multiple_img') as $img) {
                $make_img = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                $save_img_path = 'upload/products/product_img/' . $make_img;
                Image::make($img)->resize(917, 1000)->save(public_path($save_img_path));

                Multiimg::insert([
                    'product_id' => $product_id,
                    'photo_name' => $save_img_path,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        return redirect()->back()->with([
            'message' => 'Product Berhasil di Tambahkan',
            'alert-type' => 'success',
        ]);
    }

    /**
     * Menyimpan produk dari form alternatif.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'email' => 'required|email',
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $product = new Products();
        $product->category_id = $request->category_id;
        $product->email = $request->email;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/product/'), $filename);
            $product->file_path = 'upload/product/' . $filename;
        }

        $product->city = $request->select ?? null;
        $product->description = $request->textarea ?? null;
        $product->checkbox_single = $request->checkbox_single ?? null;
        $product->checkbox_group = isset($request->checkbox_group)
            ? json_encode($request->checkbox_group)
            : null;

        $product->save();

        return redirect()->back()->with('success', 'Product berhasil ditambahkan!');
    }

    /**
     * Menampilkan daftar produk.
     */
    public function manageProduct()
    {
        $product = Products::latest()->get();
        return view('admin.product.product_view', compact('product'));
    }

    /**
     * Menampilkan form edit produk.
     */
    public function editProduct($id)
    {
        $multipleImg = Multiimg::where('product_id', $id)->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $products = Products::findOrFail($id);

        return view('admin.product.product_edit', compact('brands', 'categories', 'products', 'multipleImg'));
    }

    /**
     * Update data produk.
     */
    public function updateDataProduct(Request $request, $id)
    {
        $product_slug_en = Str::slug($request->product_name_en);
        $product_slug_ind = Str::slug($request->product_name_ind);

        Products::findOrFail($id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'product_code' => $request->product_code,
            'product_name_en' => $request->product_name_en,
            'product_name_ind' => $request->product_name_ind,
            'product_slug_en' => $product_slug_en,
            'product_slug_ind' => $product_slug_ind,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_ind' => $request->product_tags_ind,
            'product_size_en' => $request->product_size_en,
            'product_size_ind' => $request->product_size_ind,
            'product_color_en' => $request->product_color_en,
            'product_color_ind' => $request->product_color_ind,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_ind' => $request->short_descp_ind,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_ind' => $request->long_descp_ind,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('product.manage')->with([
            'message' => 'Product Berhasil di Update',
            'alert-type' => 'success',
        ]);
    }

   public function updateDataImages(Request $request)
{
    $request->validate([
        'multiple_img' => 'required|array',
        'multiple_img.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $imgs = $request->multiple_img;

    foreach ($imgs as $id => $img) {
        $imgDel = Multiimg::findOrFail($id);

        if (file_exists(public_path($imgDel->photo_name))) {
            unlink(public_path($imgDel->photo_name));
        }

        $make_img = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
        $save_path = 'upload/products/product_img/' . $make_img;
        Image::make($img)->resize(917, 1000)->save(public_path($save_path));

        Multiimg::where('id', $id)->update([
            'photo_name' => $save_path,
            'updated_at' => now(),
        ]);
    }

    $notification = [
        'message' => 'Product Image Berhasil Di Update!',
        'alert-type' => 'info',
    ];

    return redirect()->back()->with($notification);
}


    public function updateThumbnail(Request $request, $id)
{
    $request->validate([
        'product_thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'old_image' => 'required|string',
    ]);

    $oldImg = $request->old_image;
    if (file_exists(public_path($oldImg))) {
        unlink(public_path($oldImg));
    }

    $image = $request->file('product_thumbnail');
    $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
    $save_url = 'upload/products/thumbnail/' . $name_gen;
    Image::make($image)->resize(917, 1000)->save(public_path($save_url));

    Products::findOrFail($id)->update([
        'product_thumbnail' => $save_url,
        'updated_at' => now(),
    ]);

    $notification = [
        'message' => 'Product Thumbnail Berhasil Di Update!',
        'alert-type' => 'info',
    ];

    return redirect()->back()->with($notification);
}


    public function imgsDelete($id)
    {
        $imgs = Multiimg::findOrFail($id);
        unlink($imgs->photo_name);
        Multiimg::findOrFail($id)->delete();

        $notification = [
            'message' => 'Multiple Image Berhasil Di Delete!',
            'alert-type' => 'danger',
        ];
        
        return redirect()->back()->with($notification);

    }

    public function productActive($id)
    {
        Products::findOrFail($id)->update([
            'status' => 1,
        ]);

        $notification = array(
            'message' => 'Product Actived!',
            'alert-type' => 'success',
        );

         return redirect()->back()->with($notification);
    }

    public function productInactive($id)
    {
        Products::findOrFail($id)->update([
            'status' => 0,
        ]);

        $notification = array(
            'message' => 'Product InActived!',
            'alert-type' => 'success',
        );

         return redirect()->back()->with($notification);
    }

 

public function productDelete($id)
{
    // Cek apakah produk sedang dibeli (status belum selesai)
    $orderItems = OrderItem::where('product_id', $id)
        ->whereHas('order', function ($query) {
            $query->whereIn('status', ['pending', 'processing']);
        })->get();

    if ($orderItems->count() > 0) {
        return redirect()->back()->with([
            'message' => 'Produk ini masih dalam proses pembelian!',
            'alert-type' => 'error'
        ]);
    }

    // Lanjut hapus produk
    $product = Products::findOrFail($id);

    // Hapus thumbnail
    if (file_exists(public_path($product->product_thumbnail))) {
        unlink(public_path($product->product_thumbnail));
    }

    // Hapus semua gambar multiple
            $multiImgs = Multiimg::where('product_id', $id)->get();
    foreach ($multiImgs as $img) {
        if (file_exists(public_path($img->photo_name))) {
            unlink(public_path($img->photo_name));
        }
        $img->delete();
    }

    $product->delete();

    return redirect()->back()->with([
        'message' => 'Produk berhasil dihapus!',
        'alert-type' => 'success'
    ]);
}



}
