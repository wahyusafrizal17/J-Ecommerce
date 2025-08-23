@extends('frontend.main_master')

@section('title', 'Checkout Page')

@section('content')

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class='active'>Checkout</li>
            </ul>
        </div>
    </div>
</div>

<div class="body-content">
    <div class="container">
        <div class="checkout-box">
            <div class="row">

                {{-- Form utama checkout --}}
                <div class="col-md-8">
                    <div class="panel-group checkout-steps" id="accordion">
                        <div class="panel panel-default checkout-step-01">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="row">

                                        {{-- Kolom kiri: Form user dan alamat --}}
                                        <div class="col-md-6 col-sm-6 guest-login">

                                            @foreach ($carts as $cart)
                                                @php
                                                    $product = \App\Models\Products::find($cart->id);
                                                @endphp
                                                @if ($product->product_qty <= 0)
                                                    <span class="badge badge-danger">Stok Habis</span>
                                                    <button class="btn btn-secondary" disabled>Habis</button>
                                                @else
                                                    <span class="badge badge-success">Tersedia</span>
                                                @endif
                                            @endforeach

                                            <h4 class="checkout-subtitle"><b>Alamat Pengiriman</b></h4>

                                            <form class="register-form" role="form" method="post" action="{{ route('checkout.detail') }}">
                                                @csrf

                                                <div class="form-group">
                                                    <label for="nama" class="info-title">Nama <span class="text-danger">*</span></label>
                                                    <input type="text" name="name" id="nama" class="form-control unicase-form-control text-input" placeholder="Masukkan Nama" value="{{ Auth::user()->name }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email" class="info-title">Email <span class="text-danger">*</span></label>
                                                    <input type="email" name="email" id="email" class="form-control unicase-form-control text-input" placeholder="Masukkan Email" value="{{ Auth::user()->email }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="phone" class="info-title">No Telepon <span class="text-danger">*</span></label>
                                                    <input type="number" name="phone" id="phone" class="form-control unicase-form-control text-input" placeholder="Masukkan Nomor Telepon" value="{{ Auth::user()->phone }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="postcode" class="info-title">Kode Pos <span class="text-danger">*</span></label>
                                                    <input type="text" name="post_code" id="postcode" class="form-control unicase-form-control text-input" placeholder="Masukkan Kode Pos">
                                                </div>

                                        </div>

                                        {{-- Kolom kanan: Wilayah & kurir --}}
                                        <div class="col-md-6 col-sm-6 already-registered-login">

                                            <div class="form-group">
                                                <br>
                                                <h5><b>Province</b><span class="text-danger">*</span></h5>
                                                <select name="province_id" id="province" class="form-control" required>
                                                    <option disabled selected>Pilih Provinsi</option>
                                                    @foreach($provinces as $province)
                                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <h5><b>Regency</b><span class="text-danger">*</span></h5>
                                                <select name="regency_id" id="regency" class="form-control" required></select>
                                            </div>

                                            <div class="form-group">
                                                <h5><b>Districts</b><span class="text-danger">*</span></h5>
                                                <select name="district_id" id="district" class="form-control" required></select>
                                            </div>

                                            <div class="form-group">
                                                <h5><b>Village</b><span class="text-danger">*</span></h5>
                                                <select name="village_id" id="village" class="form-control" required></select>
                                            </div>

                                            <hr>

                                            
                                            <div class="form-group mt-3">
                                                <h5><b>Note</b></h5>
                                                <textarea class="form-control" name="notes" rows="3"></textarea>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-md-4">
                    <div class="checkout-progress-sidebar">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
                            </div>
                            <div class="panel-body">
                                <ul class="nav nav-checkout-progress list-unstyled">

                                    @foreach($carts as $item)
                                        <li>
                                            <strong>Image:</strong>
                                            <img src="{{ asset($item->options->image) }}" style="height: 50px; width: 50px;">
                                        </li>

                                        <li>
                                            <strong>Qty:</strong> ({{ $item->qty }})  
                                            <strong>Color:</strong> {{ $item->options->color }}  
                                            <strong>Size:</strong> {{ $item->options->size }}
                                        </li>
                                    @endforeach

                                    @if(Session::has('kupon'))
                                        <hr>
                                        <strong>Subtotal: </strong>Rp. {{ $total }}
                                        <hr>
                                        <strong>Nama Kupon: </strong>{{ session()->get('kupon')['kupon_name'] }} ({{ session()->get('kupon')['kupon_discount'] }}%)
                                        <hr>
                                        <strong>Kupon Diskon: </strong>Rp. {{ formatRupiah(session()->get('kupon')['discount_amount']) }}
                                        <hr>
                                        <strong>Total: </strong>Rp. {{ formatRupiah(session()->get('kupon')['total_amount']) }}
                                        <hr>
                                    @else
                                        <hr>
                                        <strong>Subtotal:</strong> Rp. {{ $total }}
                                        <hr>
                                        <strong>Total:</strong> Rp. {{ $total }}
                                        <hr>
                                    @endif

                                    <hr>
                                    <button type="submit" class="btn btn-primary">Lanjutkan Ke Checkout</button>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- /.row -->
        </div> <!-- /.checkout-box -->
    </div> <!-- /.container -->
</div> <!-- /.body-content -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
        $(document).ready(function () {

            // Saat provinsi dipilih
            $('#province').on('change', function () {
                let id_province = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('get.regency') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_province: id_province
                    },
                    cache: false,
                    success: function (response) {
                        $('#regency').html(response);
                        $('#district').html('');
                        $('#village').html('');
                    }
                });
            });

            // Saat kabupaten/kota dipilih
            $('#regency').on('change', function () {
                let id_regency = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('get.district') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_regency: id_regency
                    },
                    success: function (response) {
                        $('#district').html(response);
                        $('#village').html('');
                    }
                });
            });

            // Saat kecamatan dipilih
            $('#district').on('change', function () {
                let id_district = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('get.village') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_district: id_district
                    },
                    success: function (response) {
                        $('#village').html(response);
                    }
                });
            });

        });
    </script>

@endsection()