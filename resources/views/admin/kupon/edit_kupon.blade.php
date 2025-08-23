@extends('admin.admin_master')
@section('content')

<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Edit Kupon</h3>
               </div>
               <div class="box-body">
                   <div class="table-responsive">
                     
                    <form method="post" action="{{ route('kupon.update', $kupon->id) }}">
                        @csrf

                        <input type="hidden" name="id" value="{{ $kupon->id }}">

                        <div class="col-12">

                            <div class="form-group">
                                <h5>Kupon Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="kupon_name" class="form-control" 
                                           value="{{ $kupon->kupon_name }}">
                                    @error('kupon_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Kupon Discount <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="kupon_discount" class="form-control"
                                           value="{{ $kupon->kupon_discount }}">
                                    @error('kupon_discount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Kupon Validity <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="date" name="kupon_validity" class="form-control"
                                           value="{{ $kupon->kupon_validity }}"
                                           min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                    @error('kupon_validity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Kupon">
                            </div>

                        </div>
                    </form>

                   </div>
               </div>
             </div>
        </div>
    </div>
</section>

@endsection
