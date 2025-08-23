<header class="header-style-1"> 
  <!-- ========== TOP MENU ========== -->
  <div class="top-bar animate-dropdown">
    <div class="container">
      <div class="header-top-inner">
        <div class="cnt-account">
          <ul class="list-unstyled">

            <li>
              <a href="{{ route('wishlist') }}"><i class="icon fa fa-heart"></i>
                @if(session()->get('language') == 'ind') Daftar Keinginan @else Wishlist @endif
              </a>
            </li>
            <li>
              <a href="{{ route('mycart') }}"><i class="icon fa fa-shopping-cart"></i>
                @if(session()->get('language') == 'ind') Keranjang @else My Cart @endif
              </a>
            </li>
            <li>
              <a href="{{ route('checkout') }}"><i class="icon fa fa-check"></i>
                @if(session()->get('language') == 'ind') Pembayaran @else Checkout @endif
              </a>
            </li>

            @auth
              <li>
                <a href="{{ route('dashboard') }}"><i class="icon fa fa-user"></i>
                  @if(session()->get('language') == 'ind') Profil @else User Profile @endif
                </a>
              </li>
            @else
              <li>
                <a href="{{ route('login') }}"><i class="icon fa fa-lock"></i>
                  @if(session()->get('language') == 'ind') Masuk/Daftar @else Login/Register @endif
                </a>
              </li>
            @endauth
          </ul>
        </div>

        <div class="cnt-block">
          <ul class="list-unstyled list-inline">
            

            <li class="dropdown dropdown-small">
              <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
                <span class="value">@if(session()->get('language') == 'ind') Bahasa @else Language @endif</span>
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                @if(session()->get('language') == 'ind')
                  <li><a href="{{ route('language.en') }}">English</a></li>
                @else
                  <li><a href="{{ route('language.ind') }}">Indonesia</a></li>
                @endif
              </ul>
            </li>
          </ul>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
  <!-- ========== TOP MENU : END ========== -->

  <!-- ========== MAIN HEADER ========== -->
  <div class="main-header">
    <div class="container">
      <div class="row">
        <!-- LOGO -->
        <div class="col-md-3 logo-holder">
          <div class="logo">
            <a href="{{ url('/') }}">
              <img src="{{ asset('frontend/assets/images/logow.png') }}" alt="logo" style="width: 275px; height: 70px;">
            </a>
          </div>
        </div>

       <!-- SEARCH AREA -->
<div class="col-md-7 top-search-holder">
  <div class="search-area">
    <form method="GET" action="{{ route('product.search') }}">
      <div class="control-group">
        <input 
          class="search-field" 
          name="search" 
          required 
          type="text" 
          placeholder="@if(session()->get('language') == 'ind') Cari disini... @else Search here... @endif" />
        
        <button type="submit" class="search-button"></button>
      </div>
    </form>
  </div>
</div>


        <!-- CART -->
        <div class="col-md-2 top-cart-row">
          <div class="dropdown dropdown-cart">
            <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
              <div class="items-cart-inner">
                <div class="basket"><i class="glyphicon glyphicon-shopping-cart"></i></div>
                <div class="basket-item-count"><span class="count" id="cartQty"></span></div>
                <div class="total-price-basket">
                  <span class="lbl">@if(session()->get('language') == 'ind') Keranjang - @else Cart - @endif</span>
                  <span class="total-price"><span class="sign"></span><span class="value" id="cartSubTotalTop"></span></span>
                </div>
              </div>
            </a>
            <ul class="dropdown-menu">
              <li>


                <div id="miniCart">
                 
                </div>

                
                  <div class="clearfix cart-total">
                  <div class="pull-right">
                    <span class="text">@if(session()->get('language') == 'ind') Sub Total: @else Sub Total: @endif</span>
                    <span class="price" id="cartSubTotalBottom"></span>
                  </div>
                  <a href="{{ route('checkout') }}" class="btn btn-primary btn-block m-t-20">
                    @if(session()->get('language') == 'ind') Pembayaran @else Checkout @endif
                  </a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ========== MAIN HEADER : END ========== -->

  <!-- ========== NAVBAR ========== -->
 <!-- ========== NAVBAR ========== -->
<div class="header-nav animate-dropdown">
  <div class="container">
    <div class="navbar navbar-default" role="navigation">
      <div class="navbar-header">
        <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      @php
        $tags_en = App\Models\Products::groupBy('product_tags_en')->select('product_tags_en')->get();
        $tags_ind = App\Models\Products::groupBy('product_tags_ind')->select('product_tags_ind')->get();

        // Mapping label menu
        $menu_items = [
          'clothes'   => ['ind' => 'Baju',   'en' => 'Clothes'],
          'pants' => ['ind' => 'Celana', 'en' => 'Pants'],
          'sandals' => ['ind' => 'Sandal', 'en' => 'Sandals'],
          'hat'   => ['ind' => 'Topi',   'en' => 'Hat'],
          'bag'    => ['ind' => 'Tas',    'en' => 'Bag'],
          'belt'  => ['ind' => 'Sabuk',  'en' => 'Belt'],
          'wallet' => ['ind' => 'Dompet', 'en' => 'Wallet'],
        ];
        $lang = session()->get('language') == 'ind' ? 'ind' : 'en';
      @endphp

      <div class="nav-bg-class">
        <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
          <div class="nav-outer">
            <ul class="nav navbar-nav">
              <li class="active dropdown yamm-fw">
                <a href="{{ url('/') }}">
                  {{ $lang == 'ind' ? 'Beranda' : 'Home' }}
                </a>
              </li>
              @foreach($menu_items as $slug => $label)
                <li class="dropdown yamm">
                  <a href="{{ url('/product/tag/' . urlencode($slug)) }}">
                    {{ $label[$lang] }}
                  </a>
                </li>
              @endforeach
            </ul>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- ========== NAVBAR : END ========== -->
</header>

