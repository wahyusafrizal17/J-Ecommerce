@extends('admin.admin_master')
@section('content')

<section class="content">
    <div class="row">

        <!-- Form Search By Date 1 -->
       <div class="col-4">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Search By Date</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <form method="POST" action="{{ route('admin.search.by.date') }}">
                    @csrf
                    <div class="form-group">
                        <h5>Select Date <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="date" name="date" class="form-control" required>
                        </div>
                    </div>
                    <div class="text-xs-right">
                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Search">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


        <!-- Form Search By Month 2 -->
        <div class="col-4">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Search By Month</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <form method="POST" action="{{ route('admin.search.by.month') }}">
                            @csrf
                            <div class="form-group">
                                <h5>Select Month <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select class="form-control" name="month" id="" required>
                                        <option disabled selected>Select Month</option>
                                        <option value="January" class="Januari">Januari</option>
                                        <option value="February" class="Februari">Februari</option>
                                        <option value="March" class="Maret">Maret</option>
                                        <option value="April" class="April">April</option>
                                        <option value="May" class="Mei">Mei</option>
                                        <option value="June" class="Juni">Juni</option>
                                        <option value="July" class="Juli">Juli</option>
                                        <option value="August" class="Agustus">Agustus</option>
                                        <option value="September" class="September">September</option>
                                        <option value="October" class="Oktober">Oktober</option>
                                        <option value="November" class="November">November</option>
                                        <option value="December" class="Desember">Desember</option>
                                    </select>
                                </div>
                            </div>

                             <div class="form-group">
                                <h5>Select Year <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select class="form-control" name="year" id="" required>
                                        <option disabled selected>Select Year</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                        <option value="2031">2031</option>
                                        <option value="2032">2032</option>
                                        <option value="2033">2033</option>
                                        <option value="2034">2034</option>
                                        <option value="2035">2035</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Search">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Search By Year 3 -->
        <div class="col-4">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Search By Year</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <form method="POST" action="{{ route('admin.search.by.year') }}">
                            @csrf
                            <div class="form-group">
                                <h5>Select Year <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select class="form-control" name="year" id="" required>
                                        <option disabled selected>Select Year</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                        <option value="2031">2031</option>
                                        <option value="2032">2032</option>
                                        <option value="2033">2033</option>
                                        <option value="2034">2034</option>
                                        <option value="2035">2035</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Search">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
