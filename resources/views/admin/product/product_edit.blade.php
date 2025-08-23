@extends('admin.admin_master')
@section('content')


    <div class="container-full">
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Edit Product</h4>
                </div>

                <div class="box-body">
                    <form method="post" action="{{ route('product.data.update', $products->id) }}">
                        @csrf
                        <div class="row">
                            <!-- Category -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Category <span class="text-danger">*</span></h5>
                                    <select name="category_id" class="form-control" required>
                                        <option selected disabled>-- Pilih Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $products->category_id ? 'selected' : ''}}>{{ $category->category_name_ind }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Brand -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Brand <span class="text-danger">*</span></h5>
                                    <select name="brand_id" class="form-control" required>
                                        <option selected disabled>-- Pilih Brand --</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ $brand->id == $products->brand_id ? 'selected' : ''}}>{{ $brand->brand_name_ind }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Product Name -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Name En <span class="text-danger">*</span></h5>
                                    <input type="text" name="product_name_en" class="form-control" value="{{ 
                                    $products->product_name_en }}" required>
                                    @error('product_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Name Ind <span class="text-danger">*</span></h5>
                                    <input type="text" name="product_name_ind" class="form-control" value="{{ 
                                    $products->product_name_ind }}" required>
                                    @error('product_name_ind')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Code <span class="text-danger">*</span></h5>
                                    <input type="text" name="product_code" class="form-control" value="{{ 
                                    $products->product_code }}" required>
                                    @error('product_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Quantity & Price -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Quantity <span class="text-danger">*</span></h5>
                                    <input type="text" name="product_qty" class="form-control" value="{{ 
                                    $products->product_qty }}" required>
                                    @error('product_qty')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Selling Price <span class="text-danger">*</span></h5>
                                    <input type="text" name="selling_price" class="form-control" value="{{ 
                                    $products->selling_price }}" required>
                                    @error('selling_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Discount Price</h5>
                                    <input type="text" name="discount_price" class="form-control" value="{{ 
                                    $products->discount_price }}">
                                    @error('discount_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Short Description -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Short Description (English) <span class="text-danger">*</span></h5>
                                    <textarea name="short_descp_en" class="form-control"
                                        required>{!! $products->short_descp_en!!}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Short Description (Indonesia) <span class="text-danger">*</span></h5>
                                    <textarea name="short_descp_ind" class="form-control"
                                        required>{!! $products->short_descp_ind!!}</textarea>
                                </div>
                            </div>

                            <!-- Long Description -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Long Description (English) <span class="text-danger">*</span></h5>
                                    <textarea id="editor1" name="long_descp_en" rows="10" cols="80">
                                     {!! $products->long_descp_en!!}
                                    </textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Long Description (Indonesia) <span class="text-danger">*</span></h5>
                                    <textarea id="editor2" name="long_descp_ind" rows="10" cols="80">
                                        {!! $products->long_descp_ind!!}
                                    </textarea>
                                </div>
                            </div>
                            <!-- Product Tags En -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Tags En <span class="text-danger">*</span></h5>
                                    <input type="text" name="product_tags_en" class="form-control"
                                        value="{{ old('product_tags_en', $products->product_tags_en) }}"
                                        data-role="tagsinput" placeholder="add tags" />
                                    @error('product_tags_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Product Tags Ind -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Tags Ind <span class="text-danger">*</span></h5>
                                    <input type="text" name="product_tags_ind" class="form-control"
                                        value="{{ old('product_tags_ind', $products->product_tags_ind) }}"
                                        data-role="tagsinput" placeholder="add tags" />
                                    @error('product_tags_ind')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Product Size En -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Size En <span class="text-danger">*</span></h5>
                                    <input type="text" name="product_size_en" class="form-control"
                                        value="{{ old('product_size_en', $products->product_size_en) }}"
                                        data-role="tagsinput" placeholder="add tags" />
                                    @error('product_size_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Product Size Ind -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Size Ind <span class="text-danger">*</span></h5>
                                    <input type="text" name="product_size_ind" class="form-control"
                                        value="{{ old('product_size_ind', $products->product_size_ind) }}"
                                        data-role="tagsinput" placeholder="add tags" />
                                    @error('product_size_ind')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Product Color En -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Color En <span class="text-danger">*</span></h5>
                                    <input type="text" name="product_color_en" class="form-control"
                                        value="{{ old('product_color_en', $products->product_color_en) }}"
                                        data-role="tagsinput" placeholder="add tags" />
                                    @error('product_color_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Product Color Ind -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Color Ind <span class="text-danger">*</span></h5>
                                    <input type="text" name="product_color_ind" class="form-control"
                                        value="{{ old('product_color_ind', $products->product_color_ind) }}"
                                        data-role="tagsinput" placeholder="add tags" />
                                    @error('product_color_ind')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <hr>

                            <!-- Checkbox -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_2" name="hot_deals" value="1" {{ $products->hot_deals == 1 ? 'checked' : '' }}>
                                            <label for="checkbox_2">Hot Deals</label>
                                        </fieldset>
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_3" name="featured" value="1" {{ $products->featured == 1 ? 'checked' : '' }}>
                                            <label for="checkbox_3">Featured</label>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>

                            <!-- Checkbox Group -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_4" name="special_offer" value="1" {{ $products->special_offer == 1 ? 'checked' : '' }}>
                                            <label for="checkbox_4">Special Offer</label>
                                        </fieldset>
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_5" name="special_deals" value="1" {{ $products->special_deals == 1 ? 'checked' : '' }}>
                                            <label for="checkbox_5">Special Deals</label>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="text-xs-right mt-4">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Product">
                        </div>
                    </form>
                </div>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box bt-3 border-info">
                            <div class="box-header">
                                <h4 class="box-title">Product Multiple Image Update</h4>
                            </div>

                            <div class="box-body">
                                <form method="post" action="{{ route('images.update') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        @foreach($multipleImg as $img)
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img src="{{ asset($img->photo_name) }}" class="card-img-top"
                                                        style="width: 300px;" alt="Product Image">

                                                    <div class="card-body">
                                                        <div class="card-text mb-2">
                                                            <a href="{{ route('product.imgs.delete',$img->id) }}" class="btn btn-sm btn-danger" id="delete"title="Delete Data">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="form-control-label">Change Image <span
                                                                    class="tx-danger">*</span></label>
                                                            <input type="file" name="multiple_img[{{ $img->id }}]"
                                                                class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="card-footer">
                                                        {{-- Tambahkan tombol atau informasi footer jika ada --}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="text-xs-right mt-4">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                            value="Update Multiple Image">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box bt-3 border-info">
                            <div class="box-header">
                                <h4 class="box-title">Product Thumbnail Update</h4>
                            </div>

                            <div class="box-body">
                                <form method="post" action="{{ route('thumbnail.update',$products->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img src="{{ asset($products->product_thumbnail) }}" class="card-img-top"
                                                        style="width: 300px;" alt="Product Image">

                                                    <div class="card-body">
                                                        <div class="card-text mb-2">
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="form-control-label">Change Thumbnail <span
                                                                    class="tx-danger">*</span></label>
                                                            <input type="hidden" name="old_image" value="{{ $products->product_thumbnail }}">
                                                            <input type="file" name="product_thumbnail" class="form-control" onChange="mainThumUrl(this)">
                                                             <img src="" id="mainThum">
                                                        </div>
                                                    </div>

                                                    <div class="card-footer">
                                                        {{-- Tambahkan tombol atau informasi footer jika ada --}}
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="text-xs-right mt-4">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                            value="Update Thumbnail">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </section>
    </div>

    <script type="text/javascript">
        function mainThumUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#mainThum')  // pakai '#' untuk ID selector
                        .attr('src', e.target.result) // penulisan atribut yang benar
                        .width(80)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#multiImg').on('change', function () {
                if (window.File && window.FileReader && window.FileList && window.Blob) {
                    var files = $(this)[0].files;
                    $('#preview_img').html(''); // Kosongkan container preview

                    $.each(files, function (index, file) {
                        if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) {
                            var fRead = new FileReader();

                            fRead.onload = function (e) {
                                var img = $('<img/>')
                                    .addClass('thumb')
                                    .attr('src', e.target.result)
                                    .css({
                                        'width': '80px',
                                        'height': '80px',
                                        'margin': '5px',
                                        'object-fit': 'cover',
                                        'border': '1px solid #ddd',
                                        'border-radius': '5px'
                                    });
                                $('#preview_img').append(img);
                            };

                            fRead.readAsDataURL(file);
                        }
                    });
                } else {
                    alert("Your browser doesn't support File API!");
                }
            });
        });
    </script>



@endsection