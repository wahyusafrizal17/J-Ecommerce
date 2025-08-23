@extends('frontend.main_master')
@section('content')

    @section('title')
        My Cart Page
    @endsection()

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>My Cart</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="row">
		<div class="my-wishlist-page">
				<div class="col-md-12 my-wishlist">
	<div class="table-responsive">
		<table class="table">
			
				
					<th colspan="4" class="heading-title">My Cart
				
			
			<tr>
					<th class="cart-product-name item">Image</th>
					<th class="cart-product-name item">Product Name</th>
					<th class="cart-product-name item">Color</th>
					<th class="cart-product-name item">Size</th>
					<th class="cart-product-name item">Qty</th>
					<th class="cart-product-name item">Subtotal</th>
					<th class="cart-product-name item">Remove</th>
			</tr>
			
			<tbody id="getMyCart">
				
			</tbody>
		</table>
	</div>
</div>			

<div class="row">

    <!-- Coupon Section -->
    <div class="col-md-4 col-sm-12 estimate-ship-tax"></div>
    <div class="col-md-4 col-sm-12 estimate-ship-tax">

		@if(Session::has('kupon'))

		@else
            <table class="table" id="kuponFild">
                <thead>
                    <tr>
                        <th>
                            <span class="estimate-title">Discount Code</span>
                            <p>Enter your coupon code if you have one..</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-group">
                                <input type="text" id="kupon_name" class="form-control unicase-form-control text-input" placeholder="Kode Kupon..">
                            </div>
                            <div class="text-end">
                               <button type="button" onclick="applyKupon()" class="btn-upper btn btn-primary"> 
                                    APPLY COUPON
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
			@endif
    </div>

    <!-- Checkout Summary Section -->
    <div class="col-md-4 col-sm-12 cart-shopping-total">
        <table class="table">
            <thead id="kuponData">
                <tr>
                    <th>
                        <div class="cart-sub-total">
                            <strong>Subtotal</strong>
                            <span class="inner-left-md" id="subtotalDisplay"><span class="inner-left-md" id="subtotalDisplay">{{ number_format((float) str_replace(',', '', Cart::subtotal()), 0, ',', '.') }}</span></span>
                        </div>
                        <div class="cart-grand-total">
                            <strong style="color: green;">Grand Total</strong>
                            <span class="inner-left-md" style="color: green;" id="grandtotalDisplay"><span class="inner-left-md" id="subtotalDisplay">{{ number_format((float) str_replace(',', '', Cart::subtotal()), 0, ',', '.') }}</span></span>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="cart-checkout-btn text-end">
                            <a href="{{ route('checkout') }}" type="submit" class="btn btn-warning checkout-btn">
                                PROCEED TO CHECKOUT
                            </a>
                            <br>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div> <!-- /.row -->


		<!-- ============================================== BRANDS CAROUSEL ============================================== -->
<div id="brands-carousel" class="logo-slider wow fadeInUp">

		<div class="logo-slider-inner">	
			<div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
				<div class="item m-t-15">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item m-t-10">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand3.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand6.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->
		    </div><!-- /.owl-carousel #logo-slider -->
		</div><!-- /.logo-slider-inner -->
	
</div><!-- /.logo-slider -->
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
</div><!-- /.body-content -->
	</div>


    @endsection