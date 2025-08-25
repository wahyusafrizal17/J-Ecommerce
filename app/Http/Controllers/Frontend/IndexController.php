<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // ✅ Tambahkan ini
use Intervention\Image\Facades\Image;

use App\Models\User;
use App\Models\Category;
use App\Models\Multiimg;
use App\Models\Slider;
use App\Models\Products;

class IndexController extends Controller
{ 
    public function index()
    {
        $sliders = Slider::where('status',1)->limit(3)->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $products = Products::where('status', 1)->orderBy('id','DESC')->limit(6)->get();
        $featured = Products::where('featured', 1)->orderBy('id','DESC')->limit(6)->get();
        $hotDeals = Products::where('hot_deals', 1)->orderBy('id','DESC')->limit(3)->get();
        $specialOffer = Products::where('special_offer', 1)->orderBy('id','DESC')->limit(3)->get();
        $specialDeals = Products::where('special_deals', 1)->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.index', compact('sliders', 'categories', 'products', 'featured', 'hotDeals', 'specialOffer','specialDeals'));
    }

    public function detail($id, $slug)
{
    $product = Products::findOrFail($id); // ✅ Ganti $products jadi $product

    $color_en = $product->product_color_en;
    $product_color_en = explode(',',$color_en);

    $color_ind = $product->product_color_ind;
    $product_color_ind = explode(',',$color_ind);

    $size_en = $product->product_size_en;
    $product_size_en = explode(',',$size_en);

    $size_ind = $product->product_size_ind;
    $product_size_ind = explode(',',$size_ind);


            $multiImg = Multiimg::where('product_id', $id)->get();
    $hotDeals = Products::where('hot_deals', 1)->orderBy('id','DESC')->limit(3)->get();

    $relatedProduct = Products::where('category_id',$product->category_id)->where('id','!=',$id)->orderBy('id','DESC')->get();
    return view('frontend.product.detail_product', compact('product', 'multiImg','product_color_en','product_color_ind',
    'product_size_en','product_size_ind','relatedProduct','hotDeals'));
}

 
    public function userLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function userProfileEdit()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('frontend.profile.user_profile', compact('user'));
    }

    public function userProfileUpdate(Request $request)
    {
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $data->profile_photo_path = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Data User Berhasil Diupdate!',
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($notification);
    }

    public function changePassword()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('frontend.profile.change_password', compact('user'));
    }

    public function userUpdatePassword(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('user.logout');
        } else {
            return redirect()->back();
        }
}

public function tagProduct($tag)
    {
        $products = Products::where('status', 1)
                    ->where(function($query) use ($tag) {
                        $query->where('product_tags_en', $tag)
                              ->orWhere('product_tags_ind', $tag);
                    })
                    ->orderBy('id','DESC')->get();

        $categories = Category::orderBy('category_name_en','ASC')->get();

        return view('frontend.tags.tags_view', compact('products', 'categories'));
    }


    //get data product by ajax
     public function getProductModal($id)
     {
        $product = Products::with('category','brand')->findOrFail($id);

        $color = $product->product_color_en;
        $product_color = explode(',',$color);

        $size = $product->product_size_en;
        $product_size = explode(',',$size);

        return response()->json(array(
            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,
        ));
     }

     public function ProductSearch(Request $request)
{
    $request->validate(['search' => 'required']);

    $item = $request->search;

    $products = Products::where('product_name_en', 'LIKE', "%$item%")
                        ->orWhere('product_name_ind', 'LIKE', "%$item%")
                        ->latest()->get();

    return view('frontend.product.search_product', compact('products', 'item'));
}



}
