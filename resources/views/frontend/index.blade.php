@extends('frontend.main_master')
@section('content')

@section('title')
    Sonbill Apparel - Home
@endsection()

  <div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">
    <div class="row">
      <!-- ============================================== SIDEBAR ============================================== -->
      <div class="col-xs-12 col-sm-12 col-md-3 sidebar">

      <!-- ================================== TOP NAVIGATION ================================== -->

      <!-- /.side-menu -->
      <!-- ================================== TOP NAVIGATION : END ================================== -->

      <!-- ============================================== HOT DEALS ============================================== -->
   @include('frontend.common.hotdeals_product')
<!-- /.sidebar-widget -->

      <!-- ============================================== HOT DEALS: END ============================================== -->

      <!-- ============================================== SPECIAL OFFER ============================================== -->
<div class="sidebar-widget outer-bottom-small wow fadeInUp">
  <h3 class="section-title">Special Offer</h3>
  <div class="sidebar-widget-body outer-top-xs">
    <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">

      @foreach ($specialOffer as $product)
        <div class="item">
          <div class="products special-product">
            <div class="product">
              <div class="product-micro">
                <div class="row product-micro-row">
                  <div class="col col-xs-5">
                    <div class="product-image">
                      <div class="image">
                        <a href="{{ url('/detail/' . $product->id . '/' . $product->product_slug_en) }}">
                          <img src="{{ asset($product->product_thumbnail) }}" alt="">
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="col col-xs-7">
                    <div class="product-info">
                      <h3 class="name">
                        <a href="{{ url('/detail/' . $product->id . '/' . $product->product_slug_en) }}">
                          @if(session()->get('language') == 'ind')
                            {{ $product->product_name_ind }}
                          @else
                            {{ $product->product_name_en }}
                          @endif
                        </a>
                      </h3>
                      <div class="rating rateit-small"></div>
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
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach

    </div>
  </div>
</div>

      <!-- ============================================== SPECIAL OFFER : END ============================================== -->
      <!-- ============================================== PRODUCT TAGS ============================================== -->
      @include('frontend.common.product_tags')
      

      <!-- ============================================== PRODUCT TAGS : END ============================================== -->
      <!-- ============================================== SPECIAL DEALS ============================================== -->

    <div class="sidebar-widget outer-bottom-small wow fadeInUp">
    <h3 class="section-title">Special Deals</h3>
    <div class="sidebar-widget-body outer-top-xs">
        @foreach ($specialDeals as $product)
        <div class="product special-product mb-3">
            <div class="product-micro">
                <div class="row product-micro-row">
                    <div class="col col-xs-5">
                        <div class="product-image">
                            <div class="image">
                                <a href="{{ url('/detail/' . $product->id . '/' . $product->product_slug_en) }}">
                                    <img src="{{ asset($product->product_thumbnail) }}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-xs-7">
                        <div class="product-info">
                            <h3 class="name">
                                <a href="{{ url('/detail/' . $product->id . '/' . $product->product_slug_en) }}">
                                    @if(session()->get('language') == 'ind')
                                        {{ $product->product_name_ind }}
                                    @else
                                        {{ $product->product_name_en }}
                                    @endif
                                </a>
                            </h3>
                            <div class="rating rateit-small"></div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


      <!-- ============================================== SPECIAL DEALS : END ============================================== -->
      <!-- ============================================== NEWSLETTER ============================================== -->
     
      <!-- /.sidebar-widget -->
      <!-- ============================================== NEWSLETTER: END ============================================== -->

      <!-- ============================================== Testimonials============================================== -->
      

      <!-- ============================================== Testimonials: END ============================================== -->

      
      </div>
      <!-- /.sidemenu-holder -->
      <!-- ============================================== SIDEBAR : END ============================================== -->

      <!-- ============================================== CONTENT ============================================== -->
      <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
      <!-- ========================================== SECTION – HERO ========================================= -->

      <div id="hero">
        <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
        @foreach($sliders as $slider)
      <div class="item" style="background-image: url({{ asset($slider->slider_img) }});">
        <div class="container-fluid">
        <div class="caption bg-color vertical-center text-left">
        <div class="slider-header fadeInDown-1">Top Brands</div>
        <div class="big-text fadeInDown-1">{{ $slider->title }}</div>
        <div class="excerpt fadeInDown-2 hidden-xs"> <span>{{ $slider->description }}</span> </div>
        <div class="button-holder fadeInDown-3"> <a href="index.php?page=single-product"
          class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a> </div>
        </div>
        <!-- /.caption -->
        </div>
        <!-- /.container-fluid -->
      </div>
      @endforeach


        </div>
        <!-- /.owl-carousel -->
      </div>

      <!-- ========================================= SECTION – HERO : END ========================================= -->

      <!-- ============================================== INFO BOXES ============================================== -->
      <div class="info-boxes wow fadeInUp">
        <div class="info-boxes-inner">
        <div class="row">
          <div class="col-md-6 col-sm-4 col-lg-4">
          <div class="info-box">
            <div class="row">
            <div class="col-xs-12">
              <h4 class="info-box-heading green">Get Voucher</h4>
            </div>
            </div>
            <h6 class="text">Ayo Gunakan Voucher Belanjamu</h6>
          </div>
          </div>
          <!-- .col -->

          <div class="hidden-md col-sm-4 col-lg-4">
          <div class="info-box">
            <div class="row">
            <div class="col-xs-12">
              <h4 class="info-box-heading green">free shipping</h4>
            </div>
            </div>
            <h6 class="text">Shipping on orders</h6>
          </div>
          </div>
          <!-- .col -->

          <div class="col-md-6 col-sm-4 col-lg-4">
          <div class="info-box">
            <div class="row">
            <div class="col-xs-12">
              <h4 class="info-box-heading green">Special Sale</h4>
            </div>
            </div>
            <h6 class="text">Extra 5% off on all items </h6>
          </div>
          </div>
          <!-- .col -->
        </div>
        <!-- /.row -->
        </div>
        <!-- /.info-boxes-inner -->

      </div>
      <!-- /.info-boxes -->
      <!-- ============================================== INFO BOXES : END ============================================== -->
      <!-- ============================================== SCROLL TABS ============================================== -->
      <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
    <div class="more-info-tab clearfix">
        <h3 class="new-product-title pull-left">New Products</h3>
        <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
            <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a></li>
            @foreach($categories as $category)
                <li><a data-transition-type="backSlide" href="#category{{ $category->id }}" data-toggle="tab">
                    @if(session()->get('language') == 'ind') {{ $category->category_name_ind }} 
                    @else {{ $category->category_name_en }} @endif
                </a></li>
            @endforeach
        </ul>
    </div>

    <div class="tab-content outer-top-xs">
        <div class="tab-pane in active" id="all">
            <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">

                    @foreach($products as $product)
                    <div class="item item-carousel">
                        <div class="products">
                            <div class="product">
                                <div class="product-image">
                                    <div class="image">
                                        <a href="{{ url('/detail/'.$product->id.'/'.$product->product_slug_en) }}">
                                            <img src="{{ asset($product->product_thumbnail) }}" alt="">
                                        </a>
                                    </div>
                                    @php
                                        $amount = $product->selling_price - $product->discount_price;
                                        $discount = ($amount / $product->selling_price) * 100;
                                    @endphp

                                    @if ($product->discount_price == NULL)
                                        <div class="tag new"><span>new</span></div>
                                    @else
                                        <div class="tag new"><span>{{ round($discount) }}%</span></div>
                                    @endif
                                </div>

                                <div class="product-info text-left">
                                    <h3 class="name">
                                        <a href="{{ url('/detail/'.$product->id.'/'.$product->product_slug_en) }}">
                                            @if(session()->get('language') == 'ind') {{ $product->product_name_ind }} 
                                            @else {{ $product->product_name_en }} @endif
                                        </a>
                                    </h3>
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
                                </div>

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
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>

        @foreach($categories as $category)
        @php
            $productsByCategory = App\Models\Products::where('category_id', $category->id)->orderBy('id', 'DESC')->get();
        @endphp

        <div class="tab-pane" id="category{{ $category->id }}">
            <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                    @forelse($productsByCategory as $product)
                        @php
                            $discount = 0;
                            if ($product->discount_price != null) {
                                $amount = $product->selling_price - $product->discount_price;
                                $discount = ($amount / $product->selling_price) * 100;
                            }
                        @endphp

                        <div class="item item-carousel">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image">
                                            <a href="{{ url('/detail/'.$product->id.'/'.$product->product_slug_en) }}">
                                                <img src="{{ asset($product->product_thumbnail) }}" alt="">
                                            </a>
                                        </div>

                                        @if ($product->discount_price == NULL)
                                            <div class="tag new"><span>new</span></div>
                                        @else 
                                            <div class="tag new"><span>{{ round($discount) }}%</span></div>
                                        @endif
                                    </div>

                                    <div class="product-info text-left">
                                        <h3 class="name">
                                            <a href="{{ url('/detail/'.$product->id.'/'.$product->product_slug_en) }}">
                                                @if(session()->get('language') == 'ind')
                                                    {{ $product->product_name_ind }}
                                                @else
                                                    {{ $product->product_name_en }}
                                                @endif
                                            </a>
                                        </h3>
                                        <div class="rating rateit-small"></div>
                                        <div class="description"></div>

                                        @if ($product->discount_price == NULL)
                                            <div class="product-price">
                                                <span class="price">{{ number_format($product->selling_price, 0, ',', '.') }}</span>
                                            </div>
                                        @else
                                            <div class="product-price">
                                                <span class="price">{{ number_format($product->discount_price, 0, ',', '.') }}</span>
                                                <span class="price-before-discount">{{ number_format($product->selling_price, 0, ',', '.') }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">
                                                <li class="add-cart-button btn-group">
                                                    <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title="Add Cart">
                                                        <i class="fa fa-shopping-cart"></i>
                                                    </button>
                                                    <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                </li>
                                                <li class="lnk wishlist">
                                                    <a data-toggle="tooltip" class="add-to-cart" href="{{ url('/detail/'.$product->id.'/'.$product->product_slug_en) }}" title="Wishlist">
                                                        <i class="icon fa fa-heart"></i>
                                                    </a>
                                                </li>
                                                <li class="lnk">
                                                    <a data-toggle="tooltip" class="add-to-cart" href="{{ url('/detail/'.$product->id.'/'.$product->product_slug_en) }}" title="Compare">
                                                        <i class="fa fa-signal" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-danger">No Product</div>
                    @endforelse
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

      <!-- /.scroll-tabs -->
      <!-- ============================================== SCROLL TABS : END ============================================== -->
      <!-- ============================================== WIDE PRODUCTS ============================================== -->
      <div class="wide-banners wow fadeInUp outer-bottom-xs">
        <div class="row">
        <div class="col-md-7 col-sm-7">
          <div class="wide-banner cnt-strip">
          <div class="image"> <img class="img-responsive" src={{ asset('frontend/assets/images/banners/banner3.jpg') }} alt=""> </div>
          </div>
          <!-- /.wide-banner -->
        </div>
        <!-- /.col -->
        <div class="col-md-5 col-sm-5">
          <div class="wide-banner cnt-strip">
          <div class="image"> <img class="img-responsive" src={{ asset('frontend/assets/images/banners/banner4.jpg') }} alt=""> </div>
          </div>
          <!-- /.wide-banner -->
        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.wide-banners -->

      <!-- ============================================== WIDE PRODUCTS : END ============================================== -->
      <!-- ============================================== FEATURED PRODUCTS ============================================== -->
     <section class="section featured-product wow fadeInUp">
    <h3 class="section-title">Featured products</h3>
    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
        @foreach ($featured as $product)
            @php
                $discount = 0;
                if ($product->discount_price != null) {
                    $amount = $product->selling_price - $product->discount_price;
                    $discount = ($amount / $product->selling_price) * 100;
                }
            @endphp

            <div class="item item-carousel">
                <div class="products">
                    <div class="product">
                        <div class="product-image">
                            <div class="image">
                                <a href="{{ url('/detail/'.$product->id.'/'.$product->product_slug_en) }}">
                                    <img src="{{ asset($product->product_thumbnail) }}" alt="">
                                </a>
                            </div>

                            @if ($product->discount_price == NULL)
                                <div class="tag new"><span>new</span></div>
                            @else 
                                <div class="tag new"><span>{{ round($discount) }}%</span></div>
                            @endif
                        </div>

                        <div class="product-info text-left">
                            <h3 class="name">
                                <a href="{{ url('/detail/'.$product->id.'/'.$product->product_slug_en) }}">
                                    @if(session()->get('language') == 'ind')
                                        {{ $product->product_name_ind }}
                                    @else
                                        {{ $product->product_name_en }}
                                    @endif
                                </a>
                            </h3>
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
                        </div>

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
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
      <!-- /.section -->
      <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->
      <!-- ============================================== WIDE PRODUCTS ============================================== -->
      <div class="wide-banners wow fadeInUp outer-bottom-xs">
        <div class="row">
        <div class="col-md-12">
          <div class="wide-banner cnt-strip">
          <div class="image"> <img class="img-responsive" src{{ asset('frontend/assets/images/banners/home-banner.jpg') }} alt=""> </div>
          <div class="strip strip-text">
            <div class="strip-inner">
            <h2 class="text-right">New Mens Fashion<br>
              <span class="shopping-needs">Save up to 40% off</span>
            </h2>
            </div>
          </div>
          <div class="new-label">
            <div class="text">NEW</div>
          </div>
          <!-- /.new-label -->
          </div>
          <!-- /.wide-banner -->
        </div>
        <!-- /.col -->

        </div>
        <!-- /.row -->
      </div>
      <!-- /.wide-banners -->
      <!-- ============================================== WIDE PRODUCTS : END ============================================== -->
      <!-- ============================================== BEST SELLER ============================================== -->

    
      <!-- /.sidebar-widget -->
      <!-- ============================================== BEST SELLER : END ============================================== -->

      <!-- ============================================== BLOG SLIDER ============================================== -->
      
      <!-- /.section -->
      <!-- ============================================== BLOG SLIDER : END ============================================== -->

      <!-- ============================================== FEATURED PRODUCTS ============================================== -->
     
      <!-- /.section -->
      <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->

      </div>
      <!-- /.homebanner-holder -->
      <!-- ============================================== CONTENT : END ============================================== -->
    </div>
    <!-- /.row -->
    <!-- ============================================== BRANDS CAROUSEL ============================================== -->
    @include('frontend.body.brands')
    <!-- /.logo-slider -->
    <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div>
    <!-- /.container -->
  </div>
  


@endsection