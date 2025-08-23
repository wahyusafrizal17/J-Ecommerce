@extends('frontend.main_master')
@section('content')

<div class="body-content" style="margin-top: 30px;"> {{-- Tambah jarak dari navbar --}}
    <div class="container">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-2">
                @include('frontend.common.user_sidebar')
            </div>

            <!-- Konten Utama -->
            <div class="col-md-10 mt-4"> {{-- Tambah jarak atas --}}
                <div class="table-responsive shadow-sm p-3 bg-white rounded"> {{-- Tambah padding, border, dan shadow --}}
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nama</th>
                                <th>No Telepon</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->phone }}</td>
                                <td class="text-wrap">
                                    {{ $order->village->name }}, 
                                    {{ $order->district->name }}, 
                                    {{ $order->regency->name }}, 
                                    {{ $order->province->name }} 
                                    ({{ $order->post_code }})
                                </td>
                               
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p>
                    <strong>Notes: </strong> {{ $order->notes }}
                </p>
            
                <div class="row">
                    <div class="col-md-12">
                     <div class="table-responsive shadow-sm p-3 bg-white rounded"> {{-- Tambah padding, border, dan shadow --}}
                    <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orderItem as $item)
                                    <tr>
                                        <td>
                                            <img src="{{ asset($item->product->product_thumbnail) }}" style="height: 50px; width: 50px;">
                                        </td>
                                        <td>{{ $item->product->product_name_en }}</td>
                                        <td>{{ $item->color }}</td>
                                        <td>{{ $item->size }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td>Rp. {{ number_format($item->price * $item->qty, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
