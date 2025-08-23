@extends('admin.admin_master')
@section('content')

<section class="content">
    <div class="row">

        <!-- Order List -->
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Order List</h3>
                </div>

                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>No Invoice</th>
                                    <th>Date</th>
                                    <th>Total Price</th>
                                    <th>Status Payment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->invoice_no }}</td>
                                        <td>{{ $item->order_date }}</td>
                                        <td>Rp. {{ number_format($item->amount, 0, ',', '.') }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            <a href="{{ route('admin.detail.order',$item->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('admin.invoice', $item->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-download"></i>Invoice</a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- /.table-responsive -->
                </div> <!-- /.box-body -->
            </div> <!-- /.box -->
        </div> <!-- /.col-12 -->

    </div> <!-- /.row -->
</section>

@endsection
