@extends('admin.admin_master')
@section('content')

<section class="content">
    <div class="row">

        <!-- Category List -->
        <div class="col-8">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Category List</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Category En</th>
                                    <th>Category Ind</th>
                                    <th>Category Item</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category as $item)
                                    <tr>
                                        <td>{{ $item->category_name_en }}</td>
                                        <td>{{ $item->category_name_ind }}</td>
                                        <td>{{ $item->category_item }}</td>
                                        <td>
                                            <!-- Edit Button with Icon -->
                                            <a href="{{ route('category.edit', $item->id) }}" class="btn btn-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <!-- Delete Button with Icon -->
                                            {{-- TOMBOL HAPUS BARU DENGAN CLASS DAN DATA-ID --}}
                                            <a href="#" class="btn btn-danger btn-delete-category" data-id="{{ $item->id }}">
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
                    <h3 class="box-title">Add Category</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <form method="POST" action="{{ route('category.store') }}">
                            @csrf
                            <div class="form-group">
                                <h5>Category Name En <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="category_name_en" class="form-control">
                                    @error('category_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Category Name Ind <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="category_name_ind" class="form-control">
                                    @error('category_name_ind')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Category Item <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="category_item" class="form-control">
                                    @error('category_item')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Category">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- Pastikan JQuery sudah di-load di admin_master.blade.php atau di sini --}}
<script>
    $(document).ready(function(){
        // Untuk CSRF Token pada AJAX request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.btn-delete-category').on('click', function(e) {
            e.preventDefault();

            let categoryId = $(this).data('id');
            let deleteUrl = "{{ url('admin/category/delete') }}/" + categoryId;
            let checkProductsUrl = "{{ url('admin/category/check-products') }}/" + categoryId;

            $.ajax({
                url: checkProductsUrl,
                method: 'GET',
                success: function(response) {
                    let message = "";
                    if (response.products_count > 0) {
                        message = `Kategori ini memiliki ${response.products_count} produk terkait.<br><strong>Produk akan dipindahkan ke kategori "Tanpa Kategori".</strong><br>Apakah Anda yakin ingin menghapus kategori ini?`;
                    } else {
                        message = "Apakah Anda yakin ingin menghapus kategori ini?";
                    }

                    Swal.fire({
                        title: 'Konfirmasi Penghapusan',
                        html: message,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Hapus',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = deleteUrl;
                        }
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Gagal memeriksa produk terkait. Silakan coba lagi.',
                    });
                }
            });
        });
    });
</script>


@endsection
