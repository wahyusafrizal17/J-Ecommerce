@extends('frontend.main_master')

@section('title')
    Products
@endsection

@section('content')
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row'>
            <!-- Sidebar -->
            <div class='col-md-3 sidebar'> 
                <!-- ================================== TOP NAVIGATION ================================== -->
                <!-- ================================== TOP NAVIGATION : END ================================== -->
                
                <div class="sidebar-module-container">
                    <div class="sidebar-filter"> 
                        <!-- ============================================== SIDEBAR CATEGORY ============================================== -->
                        <!-- /.sidebar-widget --> 
                        <!-- ============================================== SIDEBAR CATEGORY : END ============================================== --> 
                        
                        <!-- ============================================== PRICE SILDER============================================== -->
                        <!-- /.sidebar-widget --> 
                        <!-- ============================================== PRICE SILDER : END ============================================== --> 
                        
                        <!-- ============================================== MANUFACTURES============================================== -->
                        <!-- /.sidebar-widget --> 
                        <!-- ============================================== MANUFACTURES: END ============================================== --> 
                        
                        <!-- ============================================== COLOR============================================== -->
                        <!-- /.sidebar-widget --> 
                        <!-- ============================================== COLOR: END ============================================== --> 
                        
                        <!-- ============================================== COMPARE============================================== -->
                        <!-- /.sidebar-widget --> 
                        <!-- ============================================== COMPARE: END ============================================== --> 
                        
                        @include('frontend.common.product_tags')
                        
                        <!-- ============================================== PRODUCT TAGS ============================================== -->
                        <!-- /.sidebar-widget --> 
                        
                        <!----------- Testimonials----------->
                        <!-- ============================================== Testimonials: END ============================================== -->
                    </div>
                    <!-- /.sidebar-filter --> 
                </div>
                <!-- /.sidebar-module-container --> 
            </div>
            <!-- /.sidebar -->
            
            <!-- Main Content -->
            <div class='col-md-9'> 
                <!-- ========================================== SECTION – HERO ========================================= -->
                <div id="category" class="category-carousel hidden-xs">
                    <div class="item">
                        <div class="image"> 
                            <img src="{{ asset('frontend/assets/images/banners/bigsale.png') }}" alt="Big Sale Banner" class="img-responsive" style="width: 850px; height: 360px;"> 
                        </div>
                        <div class="container-fluid">
                            <div class="caption vertical-top text-left">
                                <div class="big-text">Big Sale</div>
                                <div class="excerpt hidden-sm hidden-md">Save up to 49% off</div>
                                <div class="excerpt-normal hidden-sm hidden-md">Lorem ipsum dolor sit amet, consectetur adipiscing elit</div>
                            </div>
                            <!-- /.caption --> 
                        </div>
                        <!-- /.container-fluid --> 
                    </div>
                </div>
                
                <!-- Filters and Controls -->
                <div class="clearfix filters-container m-t-10">
                    <div class="row">
                        <!-- View Toggle -->
                        <div class="col col-sm-6 col-md-2">
                            <div class="filter-tabs">
                                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                                    <li class="active"> 
                                        <a data-toggle="tab" href="#grid-container">
                                            <i class="icon fa fa-th-large"></i>Grid
                                        </a> 
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#list-container">
                                            <i class="icon fa fa-th-list"></i>List
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.filter-tabs --> 
                        </div>
                        <!-- /.col -->
                        
                        <!-- Sort and Show Options -->
                        <div class="col col-sm-12 col-md-6">
                            <div class="col col-sm-3 col-md-6 no-padding">
                                <div class="lbl-cnt"> 
                                    <span class="lbl">Sort by</span>
                                    <div class="fld inline">
                                        <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                            <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 
                                                Position <span class="caret"></span> 
                                            </button>
                                            <ul role="menu" class="dropdown-menu">
                                                <li role="presentation"><a href="#">Position</a></li>
                                                <li role="presentation"><a href="#">Price: Lowest first</a></li>
                                                <li role="presentation"><a href="#">Price: Highest first</a></li>
                                                <li role="presentation"><a href="#">Product Name: A to Z</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /.fld --> 
                                </div>
                                <!-- /.lbl-cnt --> 
                            </div>
                            <!-- /.col -->
                            
                            <div class="col col-sm-3 col-md-6 no-padding">
                                <div class="lbl-cnt"> 
                                    <span class="lbl">Show</span>
                                    <div class="fld inline">
                                        <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                            <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 
                                                1 <span class="caret"></span> 
                                            </button>
                                            <ul role="menu" class="dropdown-menu">
                                                @for ($i = 1; $i <= 10; $i++)
                                                    <li role="presentation"><a href="#">{{ $i }}</a></li>
                                                @endfor
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /.fld --> 
                                </div>
                                <!-- /.lbl-cnt --> 
                            </div>
                            <!-- /.col --> 
                        </div>
                        <!-- /.col -->
                        
                        <!-- Pagination -->
                        <div class="col col-sm-6 col-md-4 text-right">
                            <div class="pagination-container">
                                <ul class="list-inline list-unstyled">
                                    <li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                    <li><a href="#">1</a></li>
                                    <li class="active"><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                </ul>
                                <!-- /.list-inline --> 
                            </div>
                            <!-- /.pagination-container --> 
                        </div>
                        <!-- /.col --> 
                    </div>
                    <!-- /.row --> 
                </div>
                <!-- /.filters-container -->

                <!-- Product Display -->
                <div class="search-result-container">
                    <div id="myTabContent" class="tab-content category-list">
                        
                        <!-- Grid View -->
                        <div class="tab-pane active" id="grid-container">
                            <div class="category-product">
                                <div class="row">
                                    @foreach ($products as $product)
                                        <div class="col-sm-6 col-md-4 wow fadeInUp">
                                            <div class="products">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image"> 
                                                            <a href="{{ url('/detail/'.$product->id.'/'.$product->product_slug_en) }}">
                                                                <img src="{{ asset($product->product_thumbnail) }}" alt="{{ $product->product_name_en }}">
                                                            </a> 
                                                        </div>
                                                        <!-- /.image -->
                                                        
                                                        @php
                                                            $discount = 0;
                                                            if ($product->discount_price != null) {
                                                                $amount = $product->selling_price - $product->discount_price;
                                                                $discount = ($amount / $product->selling_price) * 100;
                                                            }
                                                        @endphp

                                                        @if ($product->discount_price == null)
                                                            <div class="tag new"><span>new</span></div>
                                                        @else 
                                                            <div class="tag new"><span>{{ round($discount) }}%</span></div>
                                                        @endif
                                                    </div>
                                                    <!-- /.product-image -->
                                                    
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

                                                        @if ($product->discount_price == null)
                                                            <div class="product-price">
                                                                <span class="price">Rp. {{ number_format($product->selling_price, 0, ',', '.') }}</span>
                                                            </div>
                                                        @else
                                                            <div class="product-price">
                                                                <span class="price">Rp. {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                                                                <span class="price-before-discount">Rp. {{ number_format($product->selling_price, 0, ',', '.') }}</span>
                                                            </div>
                                                        @endif
                                                        <!-- /.product-price --> 
                                                    </div>
                                                    <!-- /.product-info -->
                                                    
                                                    <div class="cart clearfix animate-effect">
                                                        <div class="action">
                                                            <ul class="list-unstyled">
                                                                <li class="add-cart-button btn-group">
                                                                    <button data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView({{ $product->id }})" class="btn btn-primary icon" type="button" title="Add Cart"> 
                                                                        <i class="fa fa-shopping-cart"></i> 
                                                                    </button>
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
                                                        <!-- /.action --> 
                                                    </div>
                                                    <!-- /.cart --> 
                                                </div>
                                                <!-- /.product --> 
                                            </div>
                                            <!-- /.products --> 
                                        </div>
                                        <!-- /.col -->
                                    @endforeach
                                </div>
                                <!-- /.row --> 
                            </div>
                            <!-- /.category-product --> 
                        </div>
                        <!-- /.tab-pane -->
                        
                        <!-- List View -->
                        <div class="tab-pane" id="list-container">
                            <div class="category-product">
                                @foreach ($products as $product)
                                    <div class="category-product-inner wow fadeInUp">
                                        <div class="products">
                                            <div class="product-list product">
                                                <div class="row product-list-row">
                                                    <!-- Product Image -->
                                                    <div class="col col-sm-4 col-lg-4">
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <a href="{{ url('/detail/'.$product->id.'/'.$product->product_slug_en) }}">
                                                                    <img src="{{ asset($product->product_thumbnail) }}" alt="{{ $product->product_name_en }}">
                                                                </a>
                                                            </div>

                                                            @php
                                                                $discount = 0;
                                                                if ($product->discount_price != null) {
                                                                    $amount = $product->selling_price - $product->discount_price;
                                                                    $discount = ($amount / $product->selling_price) * 100;
                                                                }
                                                            @endphp

                                                            @if ($product->discount_price == null)
                                                                <div class="tag new"><span>new</span></div>
                                                            @else
                                                                <div class="tag new"><span>{{ round($discount) }}%</span></div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!-- /.col -->

                                                    <!-- Product Info -->
                                                    <div class="col col-sm-8 col-lg-8">
                                                        <div class="product-info">
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

                                                            <div class="description m-t-10">
                                                                @if(session()->get('language') == 'ind')
                                                                    {{ $product->short_descp_ind }}
                                                                @else
                                                                    {{ $product->short_descp_en }}
                                                                @endif
                                                            </div>

                                                            @if ($product->discount_price == null)
                                                                <div class="product-price">
                                                                    <span class="price">Rp. {{ number_format($product->selling_price, 0, ',', '.') }}</span>
                                                                </div>
                                                            @else
                                                                <div class="product-price">
                                                                    <span class="price">Rp. {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                                                                    <span class="price-before-discount">Rp. {{ number_format($product->selling_price, 0, ',', '.') }}</span>
                                                                </div>
                                                            @endif

                                                            <div class="cart clearfix animate-effect">
                                                                <div class="action">
                                                                    <ul class="list-unstyled">
                                                                        <li class="add-cart-button btn-group">
                                                                            <button data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView({{ $product->id }})" class="btn btn-primary icon" type="button" title="Add Cart"> 
                                                                                <i class="fa fa-shopping-cart"></i> 
                                                                            </button>
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
                                                                <!-- /.action -->
                                                            </div>
                                                            <!-- /.cart -->
                                                        </div>
                                                        <!-- /.product-info -->
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                            <!-- /.product-list -->
                                        </div>
                                        <!-- /.products -->
                                    </div>
                                    <!-- /.category-product-inner -->
                                @endforeach
                            </div>
                            <!-- /.category-product -->
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->

                    <!-- Bottom Pagination -->
                    <div class="clearfix filters-container" style="margin-bottom: 40px;">
                        <div class="text-right">
                            <div class="pagination-container">
                                <ul class="list-inline list-unstyled">
                                    <li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                    <li><a href="#">1</a></li>
                                    <li class="active"><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                </ul>
                                <!-- /.list-inline --> 
                            </div>
                            <!-- /.pagination-container --> 
                        </div>
                        <!-- /.text-right --> 
                    </div>
                    <!-- /.filters-container --> 
                </div>
                <!-- /.search-result-container --> 
            </div>
            <!-- /.col --> 
        </div>
        <!-- /.row --> 
    </div>
    <!-- /.container -->
</div>
<!-- /.body-content -->

<!-- Additional spacing before footer -->
<div style="height: 50px; background-color: ;"></div>
@endsection