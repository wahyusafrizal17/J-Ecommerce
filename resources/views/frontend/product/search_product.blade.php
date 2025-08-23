@extends('frontend.main_master')
@section('content')

<div class="container">
    <h3>Hasil Pencarian: {{ $item }}</h3>
    
    @if($products->count() > 0)
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3">
                    <div class="product">
                        <img src="{{ asset($product->product_thumbnail) }}" style="width:100%; height:auto;">
                        <h5>{{ $product->product_name_en }}</h5>
                        <p>Rp{{ number_format($product->selling_price, 0, ',', '.') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Tidak ada produk ditemukan.</p>
    @endif
</div>

@endsection
