@extends('admin.admin_master')
@section('content')

<section class="content">
    <div class="row">

        <!-- Category List -->
        <div class="col-8">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Kupon List</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <form method="POST" action="{{ route('kupon.store') }}">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Kupon Name</th>
                                    <th>Kupon Discount</th>
                                    <th>Kupon Validity</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kupon as $item)
                                    <tr>
                                        <td>{{ $item->kupon_name }}</td>
                                        <td>{{ $item->kupon_discount}}%</td>
                                        <td>{{ Carbon\Carbon::parse($item->kupon_validity)->format('D, d F Y') }}</td>
                                        <td>
                                            @if( $item->kupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))

                                                <span class="badge badge-pill badge-success">Valid</span>
                                            @else
                                                <span class="badge badge-pill badge-danger">Invalid</span>
                                            @endif
                                        </td>
                                        <td>
                                            <!-- Edit Button with Icon -->
                                            <a href="{{ route('kupon.edit', $item->id) }}" class="btn btn-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <!-- Delete Button with Icon -->
                                            <a href="{{ route('kupon.delete',$item->id) }}" class="btn btn-danger" id="delete">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Category Form -->
        <div class="col-4">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Kupon</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <form method="POST" action="{{ route('category.store') }}">
                            @csrf
                            <div class="form-group">
                                <h5>Kupon Name  <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="kupon_name" class="form-control">
                                    @error('kupon_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Kupon Discount (%)<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="kupon_discount" class="form-control">
                                    @error('kupon_discount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Kupon Validity <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="date" name="kupon_validity" class="form-control" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                    @error('kupon_validity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Kupon">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
