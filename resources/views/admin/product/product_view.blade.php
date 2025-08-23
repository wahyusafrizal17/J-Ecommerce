@extends('admin.admin_master')

@if(Session::has('message'))
<script>
    Swal.fire({
        icon: '{{ Session::get("alert-type") }}',
        title: '{{ Session::get("message") }}',
        showConfirmButton: false,
        timer: 2500
    });
</script>
@endif

@section('content')

    <section class="content">
        <div class="row">

            <!-- Category List -->
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Product List</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product as $item)
                                        <tr>
                                            <td>
                                                <img src="{{ asset($item->product_thumbnail) }}" width="80px;">
                                            </td>
                                            <td>{{ $item->product_name_en }}</td>
                                            <td>{{ $item->selling_price }}</td>
                                            <td>
                                                @if($item->discount_price == NULL)
                                                    <span class="badge badge-danger badge-pill">No Discount</span>
                                                @else
                                                    @php
                                                        $amount = $item->selling_price - $item->discount_price;
                                                        $discount = ($amount / $item->selling_price) * 100;
                                                    @endphp
                                                    <span class="badge badge-success badge-pill">{{ round($discount) }} %</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->product_qty }}</td>
                                            <td>
                                                @if($item->status === 1)
                                                    <span class="badge badge-success badge-pill">Active</span>
                                                @else
                                                    <span class="badge badge-danger badge-pill">InActive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <!-- Edit Button with Icon -->
                                                <a href="{{ route('product.edit', $item->id) }}" class="btn btn-primary">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <!-- Delete Button with Icon -->
                                                <a href="{{ route('product.delete', $item->id) }}" class="btn btn-danger"
                                                    id="delete">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                @if($item->status === 1)
                                                    <a href="{{ route('product.inactive', $item->id) }}" class="btn btn-danger"
                                                        title="Inactive">
                                                        <i class="fa fa-arrow-down"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('product.active', $item->id) }}" class="btn btn-primary"
                                                         title="Active">
                                                        <i class="fa fa-arrow-up"></i>
                                                    </a>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

    </section>

@endsection