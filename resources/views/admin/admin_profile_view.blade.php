@extends('admin.admin_master')
@section('content')


<div class="container-full">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-black" style="background: url('../images/gallery/full/10.jpg') center center;">

                    <a href="{{ route('admin.profile.edit') }}" style="float: right;" class="btn btn-rounded btn-success mb-5">
                    Edit Profile </a>
                  <h3 class="widget-user-username">Admin Name : {{ $adminData->name }}</h3>
                  <h6 class="widget-user-desc">Admin Email : {{ $adminData->email }} </h6>
                </div>

                <div class="widget-user-image">
                  <img class="rounded-circle" src="{{ (!empty($adminData->profile_photo_path))? 
                  url('upload/admin_images/'.$adminData->profile_photo_path):url('upload/no_image.jpg') }}" alt="User Avatar">
                </div>

<!-- Awal footer box -->
<!-- <div class="box-footer"> -->
    <!-- Awal baris row -->
    <!-- <div class="row"> -->

        <!-- Kolom pertama -->
        <!-- <div class="col-sm-4"> -->
            <!-- Blok deskripsi -->
            <!-- <div class="description-block"> -->
                <!-- Angka followers -->
                <!-- <h5 class="description-header">12K</h5> -->
                <!-- Teks followers -->
                <!-- <span class="description-text">FOLLOWERS</span> -->
            <!-- </div> -->
            <!-- /.description-block -->
        <!-- </div> -->
        <!-- /.col -->

        <!-- Kolom kedua dengan border kiri & kanan -->
        <!-- <div class="col-sm-4 br-1 bl-1"> -->
            <!-- Blok deskripsi -->
            <!-- <div class="description-block"> -->
                <!-- Angka followers -->
                <!-- <h5 class="description-header">550</h5> -->
                <!-- Teks followers -->
                <!-- <span class="description-text">FOLLOWERS</span> -->
            <!-- </div> -->
            <!-- /.description-block -->
        <!-- </div> -->
        <!-- /.col -->

        <!-- Kolom ketiga -->
        <!-- <div class="col-sm-4"> -->
            <!-- Blok deskripsi -->
            <!-- <div class="description-block"> -->
                <!-- Angka tweets -->
                <!-- <h5 class="description-header">158</h5> -->
                <!-- Teks tweets -->
                <!-- <span class="description-text">TWEETS</span> -->
            <!-- </div> -->
            <!-- /.description-block -->
        <!-- </div> -->

    <!-- </div> -->
    <!-- /.row -->
<!-- </div> -->
<!-- /.box-footer -->

                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
              </div>
            
        </div>
    </section>
    <!-- /.content -->
  </div>

  @endsection
