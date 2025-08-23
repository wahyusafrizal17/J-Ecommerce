@extends('admin.admin_master')
@section('content')

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <!-- Shipping Address -->
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title align-items-start flex-column">Shipping Address</h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-border">
                                <thead>
                                    <tr class="text-uppercase bg-lightest">
                                        <th style="min-width: 250px"><span class="text-white">User</span></th>
                                        <th style="min-width: 100px"><span class="text-fade">Phone</span></th>
                                        <th style="min-width: 100px"><span class="text-fade">Address</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <span class="text-fade font-weight-600 d-block font-size-16">{{ $order->name }}</span>
                                        </td>
                                        <td>
                                            <span class="text-white font-weight-600 d-block font-size-16">{{ $order->phone }}</span>
                                        </td>
                                        <td>
                                            <span class="text-fade font-weight-600 d-block font-size-16">
                                                {{ $order->village->name }} {{ $order->district->name }},
                                                {{ $order->regency->name }} {{ $order->province->name }}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Notes -->
            <div class="col-12">
                <div class="box">
                    <div class="box-body">
                        <p>
                            <strong>Notes: </strong> {{ $order->notes }}
                        </p>
                        <hr>
                        <p>
                            <strong>Status Payment: </strong>
                            <span class="badge badge-pill badge-success">{{ $order->status }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Data Order -->
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title align-items-start flex-column">Data Order</h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-border">
                                <thead>
                                    <tr class="text-uppercase bg-lightest">
                                        <th style="min-width: 250px"><span class="text-white">Image</span></th>
                                        <th style="min-width: 100px"><span class="text-fade">Product Name</span></th>
                                        <th style="min-width: 100px"><span class="text-fade">Color</span></th>
                                        <th style="min-width: 150px"><span class="text-fade">Size</span></th>
                                        <th style="min-width: 130px"><span class="text-fade">Qty</span></th>
                                        <th style="min-width: 130px"><span class="text-fade">Price</span></th>
                                        <th style="min-width: 130px"><span class="text-fade">Total Price</span></th>
                                        <th style="min-width: 120px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orderItem as $item)
                                    <tr>
                                        <td>
                                            <img src="{{ asset($item->product->product_thumbnail) }}" alt="Product Image" style="width: 80px; height: 80px;">
                                        </td>
                                        <td>{{ $item->product->product_name_en }}</td>
                                        <td>{{ $item->color }}</td>
                                        <td>{{ $item->size }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td>Rp. {{ number_format($item->price * $item->qty, 0, ',', '.') }}</td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

@endsection
