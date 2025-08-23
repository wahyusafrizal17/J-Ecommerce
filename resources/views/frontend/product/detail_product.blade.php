@extends('frontend.main_master')
@section('content')

    @section('title')
        Product Detail
    @endsection()

    <!-- ===== ======== HEADER : END ============================================== -->

    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row single-product'>
                <div class='col-md-3 sidebar'>
                    <div class="sidebar-module-container">
                       

                        <!-- ============================================== HOT DEALS ============================================== -->
                        @include('frontend.common.hotdeals_product')
                        <!-- ============================================== HOT DEALS: END ============================================== -->

                        <!-- HOT DEALS: END -->

                        <!-- ============================================== NEWSLETTER ============================================== -->
                       
                        <!-- ============================================== NEWSLETTER: END ============================================== -->

                        <!-- ============================================== Testimonials============================================== -->
                       

                        <!-- ============================================== Testimonials: END ============================================== -->

                    </div>
                </div><!-- /.sidebar -->
                <div class='col-md-9'>
                    <div class="detail-block">
                        <div class="row  wow fadeInUp">

                            <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                                <div class="product-item-holder size-big single-product-gallery small-gallery">

                                    <div id="owl-single-product">

                                        @foreach ($multiImg as $img)
                                            <div class="single-product-gallery-item" id="slide{{ $img->id }}">
                                                <a data-lightbox="image-1" data-title="Gallery"
                                                    href="{{ asset($img->photo_name) }}">
                                                    <img class="img-responsive" alt="" src="{{ asset($img->photo_name) }}"
                                                        data-echo="{{ asset($img->photo_name) }}" />
                                                </a>
                                            </div><!-- /.single-product-gallery-item -->
                                        @endforeach()

                                        <!-- /.single-product-gallery-item -->

                                    </div><!-- /.single-product-slider -->


                                    <div class="single-product-gallery-thumbs gallery-thumbs">

                                        <div id="owl-single-product-thumbnails">
                                            @foreach ($multiImg as $img)
                                                <div class="item">
                                                    <a class="horizontal-thumb active" data-target="#owl-single-product"
                                                        data-slide="1" href="#slide{{ $img->id }}">
                                                        <img class="img-responsive" width="85" alt=""
                                                            src="{{ asset($img->photo_name) }}"
                                                            data-echo="{{ asset($img->photo_name) }}" />
                                                    </a>
                                                </div>
                                            @endforeach()

                                        </div><!-- /#owl-single-product-thumbnails -->



                                    </div><!-- /.gallery-thumbs -->

                                </div><!-- /.single-product-gallery -->
                            </div><!-- /.gallery-holder -->


                            <div class='col-sm-6 col-md-7 product-info-block'>
                                <div class="product-info">
                                    <h1 class="name" id="pname">@if(session()->get('language') == 'ind')
                                        {{ $product->product_name_ind }}
                                    @else {{ $product->product_name_en }} @endif</h1>
                                    <div class="rating-reviews m-t-20">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="rating rateit-small"></div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="reviews">
                                                    <a href="#" class="lnk">(13 Reviews)</a>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.rating-reviews -->

                                    <div class="stock-container info-container m-t-10">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="stock-box">
                                                    <span class="label">Availability :</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="stock-box">
                                                    <span class="value">{{ $product->product_qty }}</span>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.stock-container -->

                                    <div class="description-container m-t-20">
                                        @if(session()->get('language') == 'ind') {{ $product->short_descp_ind }}
                                        @else {{ $product->short_descp_en }} @endif
                                    </div><!-- /.description-container -->

                                    <div class="price-container info-container m-t-20">
                                        <div class="row">

                                            @php
                                                $amount = $product->selling_price - $product->discount_price;
                                                $discount = ($amount / $product->selling_price) * 100;

                                            @endphp

                                            <div class="col-sm-6">
                                                <div class="price-box">
                                                    @if ($product->discount_price == NULL)
                                                        <span class="price">{{ number_format($product->selling_price, 0, ',', '.') }}</span>
                                                    @else
                                                        <span class="price">Rp.{{ number_format($product->discount_price, 0, ',', '.') }}</span>
                                                        <span class="price-strike">Rp.{{ number_format($product->selling_price, 0, ',', '.') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                          <div class="col-sm-6">
                                            <div class="favorite-button m-t-10">
                                                <button 
                                                class="btn btn-primary icon" 
                                                type="button" 
                                                title="Wishlist" 
                                                id="{{ $product->id }}" 
                                                onclick="addToWishlist(this.id)"
                                                data-toggle="tooltip" 
                                                data-placement="right"
                                                >
                                                <i class="icon fa fa-heart"></i>
                                                </button>
                                            </div>
                                            </div>


                                        </div><!-- /.row -->
                                    </div><!-- /.price-container -->

                                    <div class="price-container info-container m-t-20">
                                        <div class="row">



                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Size</label>
                                                    <select name="" class="form-control" id="size">
                                                        <option disabled selected>Pilih Size</option>
                                                        @foreach ($product_size_en as $size)
                                                            <option value="{{ $size }}">{{ $size }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Color</label>
                                                    <select name="" class="form-control" id="color">
                                                        <option disabled selected>Pilih Color</option>
                                                        @foreach ($product_color_en as $color)
                                                            <option value="{{ $color }}">{{ $color }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </div><!-- /.row -->
                                    </div>



                                    <div class="quantity-container info-container">
                                        <div class="row">

                                            <div class="col-sm-2">
                                                <span class="label">Qty :</span>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="cart-quantity">
                                                    <div class="quant-input">
                                                        <div class="arrows">
                                                            <div class="arrow plus gradient"><span class="ir"><i
                                                                        class="icon fa fa-sort-asc"></i></span></div>
                                                            <div class="arrow minus gradient"><span class="ir"><i
                                                                        class="icon fa fa-sort-desc"></i></span></div>
                                                        </div>
                                                        <input type="number" id="qty" min="1" value="1" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" id="product_id" value="{{ $product->id }}" min="1">
                        
                                            <div class="col-sm-7">
                                                <button type="submit" onclick="addToCart()" class="btn btn-primary"><i
                                                        class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</button>
                                            </div>


                                        </div><!-- /.row -->
                                    </div><!-- /.quantity-container -->






                                </div><!-- /.product-info -->
                            </div><!-- /.col-sm-7 -->
                        </div><!-- /.row -->
                    </div>

                    <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                        <div class="row">
                            <div class="col-sm-3">
                                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                    <li><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                                   
                                </ul><!-- /.nav-tabs #product-tabs -->
                            </div>
                            <div class="col-sm-9">

                                <div class="tab-content">

                                    <div id="description" class="tab-pane in active">
                                        <div class="product-tab">
                                            <p class="text"> @if(session()->get('language') == 'ind')
                                                {!!$product->long_descp_ind !!}
                                            @else {!! $product->long_descp_en !!} @endif</p>
                                        </div>
                                    </div><!-- /.tab-pane -->

                                    <div id="review" class="tab-pane">
                                        <div class="product-tab">

                                            <div class="product-reviews">
                                                <h4 class="title">Customer Reviews</h4>

                                                <div class="reviews">
                                                    <div class="review">
                                                        <div class="review-title"><span class="summary">We love this
                                                                product</span><span class="date"><i
                                                                    class="fa fa-calendar"></i><span>1 days
                                                                    ago</span></span></div>
                                                        <div class="text">"Lorem ipsum dolor sit amet, consectetur
                                                            adipiscing elit.Aliquam suscipit."</div>
                                                    </div>

                                                </div><!-- /.reviews -->
                                            </div><!-- /.product-reviews -->



                                            

                                        </div><!-- /.product-tab -->
                                    </div><!-- /.tab-pane -->

                                    

                                </div><!-- /.tab-content -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.product-tabs -->

                    <!-- ============================================== UPSELL PRODUCTS ============================================== -->
                    <section class="section featured-product wow fadeInUp">
                        <h3 class="section-title">Related products</h3>
                        <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">


                            @foreach ($relatedProduct as $product)
                                <div class="item item-carousel">
                                    <div class="products">

                                        <div class="product">
                                            <div class="product-image">
                                                <div class="image">
                                                    <a href="{{ url('/detail/' . $product->id . '/' . $product->product_slug_en) }}"><img
                                                            src="{{ asset($product->product_thumbnail) }}" alt=""></a>
                                                </div><!-- /.image -->

                                                @php
                                                    $amount = $product->selling_price - $product->discount_price;
                                                    $discount = ($amount / $product->selling_price) * 100;
                                                  @endphp

                                                @if ($product->discount_price == NULL)
                                                    <div class="tag new"><span>new</span></div>
                                                @else
                                                    <div class="tag new"><span>{{ round($discount) }}%</span></div>
                                                @endif
                                            </div><!-- /.product-image -->


                                            <div class="product-info text-left">
                                                <h3 class="name"><a
                                                        href="{{ url('/detail/' . $product->id . '/' . $product->product_slug_en) }}">@if(session()->get('language') == 'ind')
                                                        {{ $product->product_name_ind }} @else
                                                        {{ $product->product_name_en }} @endif</a></h3>
                                                <div class="rating rateit-small"></div>
                                                <div class="description"></div>

                                                @if ($product->discount_price == NULL)
                                                    <div class="product-price">
                                                        <span class="price">Rp.{{ number_format($product->selling_price, 0, ',', '.') }}</span>
                                                    </div>
                                                @else
                                                    <div class="product-price">
                                                        <span class="price">Rp.{{ number_format($product->discount_price, 0, ',', '.') }}</span>
                                                        <span class="price-before-discount">Rp.{{ number_format($product->selling_price, 0, ',', '.') }}</span>
                                                    </div>
                                                @endif
                                                <!-- /.product-price -->

                                            </div><!-- /.product-info -->
                                            <div class="cart clearfix animate-effect">
                                                <div class="action">
                                                    <ul class="list-unstyled">
                                            <li class="add-cart-button btn-group">
                                                <button data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView({{ $product->id }})" class="btn btn-primary icon" type="button" title="Add Cart"> <i class="fa fa-shopping-cart"></i> </button>
                                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                            </li>
                                            <li class="add-cart-button btn-group"> 
                                                <button class="btn btn-primary icon" type="button" title="Wishlist" id="{{ $product->id }}" onclick="addToWishlist(this.id)"> 
                                                    <i class="icon fa fa-heart"></i> 
                                                </button> 
                                            </li>
                                            <li class="lnk"> 
                                                <a data-toggle="tooltip" class="add-to-cart" href="{{ url('/detail/'.$product->id.'/'.$product->product_slug_en) }}" title="Compare"> 
                                                    <i class="fa fa-signal" aria-hidden="true"></i> 
                                                </a> 
                                            </li>
                                        </ul>
                                                </div><!-- /.action -->
                                            </div><!-- /.cart -->
                                        </div><!-- /.product -->

                                    </div><!-- /.products -->
                                </div><!-- /.item -->
                            @endforeach
                        </div><!-- /.home-owl-carousel -->
                    </section><!-- /.section -->
                    <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

                </div><!-- /.col -->
                <div class="clearfix"></div>
            </div><!-- /.row -->
        </div>






@endsection()