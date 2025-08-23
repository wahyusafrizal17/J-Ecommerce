@extends('frontend.main_master')

@section('content')

<div class="body.content" style="margin-top: 30px;">
    <div class="container">
        <div class="row">

            <!-- Sidebar User -->
            <div class="col-md-2">
                @include('frontend.common.user_sidebar')
            </div>

            <!-- Spacer -->
            <div class="col-md-2"></div>

            <!-- Main Content -->
            <div class="col-md-6 offset-md-1">
                <div class="card shadow p-4 text-center">
                    <h3 class="text-center">
                        <span class="text-danger">Hi,</span> 
                        <strong>{{ Auth::user()->name }}</strong><br>
                        <span class="text-center">Welcome to Sonbill Store</span>
                    </h3>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Tambahkan SweetAlert di bawah ini --}}

@endsection
