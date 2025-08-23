@extends('frontend.main_master')
@section('content')

<div class="body-content">
    <div class="container">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-2">
                 @include('frontend.common.user_sidebar')
            </div>

            <!-- Spacer -->
            <div class="col-md-1"></div>

            <!-- Edit Profile Form -->
            <div class="col-md-6">
                <div class="card shadow p-4">
                    <h3 class="text-center text-dark mb-4">
                        <span class="text-danger">Hi,</span> <strong>{{ Auth::user()->name }}</strong><br>
                        Edit Profile
                    </h3>

                    <form method="post" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Profile Photo</label>
                            <input type="file" name="profile_photo_path" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-danger mt-3">Update</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
