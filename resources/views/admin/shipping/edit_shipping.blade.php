@extends('admin.admin_master')
@section('content')

<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Edit Shipping Area</h3>
               </div>
               <div class="box-body">
                   <div class="table-responsive">

                    <form method="post" action="{{ route('shipping.update',$area->id) }}">
                        @csrf

                        <input type="hidden" name="id" value="">

                        <div class="col-12">

                            <div class="form-group">
                                <h5>Province <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="province" class="form-control" id="province" required="">
                                        @foreach($provinces as $province)
                                        <option value="{{ $province->id }}" {{ ($province->id == $area->province_id) ? 'selected' : ''}}>{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Regency <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="regency" class="form-control" id="regency" required>
                                         <option disabled selected>{{ $area->regency->name }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>District <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="district" class="form-control" id="district" required>
                                         <option disabled selected>{{ $area->district->name }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Village <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="village" class="form-control" id="village" required>
                                        <option disabled selected>{{ $area->village->name }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Shipping">
                            </div>

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
