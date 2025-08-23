@extends('admin.admin_master')
@section('content')

<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Edit Category</h3>
               </div>
               <div class="box-body">
                   <div class="table-responsive">
                     
                    <form method="post" action="{{ route('category.update', $category->id) }}">
                        @csrf

                        <input type="hidden" name="id" value="{{ $category->id }}">

                        <div class="col-12">

                            <div class="form-group">
                                <h5>Category Name En<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="category_name_en" class="form-control" 
                                           value="{{ $category->category_name_en }}">
                                    @error('category_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Category Name Ind<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="category_name_ind" class="form-control"
                                           value="{{ $category->category_name_ind }}">
                                    @error('category_name_ind')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Category Item<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="category_item" class="form-control"
                                           value="{{ $category->category_item }}">
                                    @error('category_item')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Edit Category">
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
