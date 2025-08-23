@extends('admin.admin_master')
@section('content')

    <section class="content">
        <div class="row">

            <!-- Category List -->
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Shipping List</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="POST" action="{{ route('shipping.store') }}">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Province</th>
                                            <th>Regencies</th>
                                            <th>Districts</th>
                                            <th>Village</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($area as $item)
                                            <tr>
                                                <td>{{ $item->province->name ?? '-' }}</td>
                                                <td>{{ $item->regency->name ?? '-' }}</td>
                                                <td>{{ $item->district->name ?? '-' }}</td>
                                                <td>{{ $item->village->name ?? '-' }}</td>
                                                <td>
                                                    <a href="{{ route('shipping.edit', $item->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                                    <a href="{{ route('shipping.delete',$item->id) }}" class="btn btn-danger" id="delete"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Shipping Form -->
            <div class="col-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Shipping</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="POST" action="{{ route('shipping.store') }}">
                                @csrf
                                <div class="col-12">


                                <div class="form-group">
                                    <h5>Province <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="province" id="province" class="form-control" required="">
                                            <option disabled selected>Pilih Provinsi</option>
                                            @foreach($provinces as $province)
                                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Regencie <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="regency" id="regency" class="form-control" required="">

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Districts <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="district" id="district" class="form-control" required="">

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Village <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="village" id="village" class="form-control" required="">

                                        </select>
                                    </div>
                                </div>

                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Shipping">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

@endsection