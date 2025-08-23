  <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
    <h3 class="section-title">Hot Deals</h3>
    <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">

        @foreach ($hotDeals as $product)
            @php
                $amount = $product->selling_price - $product->discount_price;
                $discount = ($amount / $product->selling_price) * 100;
            @endphp

            <div class="item">
                <div class="products">
                    <div class="hot-deal-wrapper">
                        <div class="image">
                            <img src="{{ asset($product->product_thumbnail) }}" alt="">
                        </div>

                        @if ($product->discount_price == NULL)
                            <div class="tag new"><span>new</span></div>
                        @else
                            <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                        @endif
                    </div>
                    <!-- /.hot-deal-wrapper -->

                    <div class="product-info text-left m-t-20">
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
                    </div>
                    <!-- /.product-info -->

                    <div class="cart clearfix animate-effect">
                        <div class="action">
                            <div class="add-cart-button btn-group">
                              <button data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView({{ $product->id }})" class="btn btn-primary icon" type="button" title="Add Cart"> <i class="fa fa-shopping-cart"></i> </button>
                                <button data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView({{ $product->id }})" class="btn btn-primary cart-btn" type="button">Add to cart</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.cart -->
                </div>
            </div>
        @endforeach

    </div>
    <!-- /.owl-carousel -->
</div>