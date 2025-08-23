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
                        <span class="text-danger">Change Password</span></h3>

                    <form method="post" action="{{ route('user.update.password') }}">
                        @csrf

                        <div class="form-group">
                            <label>Cureent Password</label>
                            <input type="password" id="current_password" name="oldpassword" value="{{ $user->name }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" id="password" name="password" value="{{ $user->name }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" value="{{ $user->name }}" class="form-control" required>
                        </div>

                       

                        <button type="submit" class="btn btn-danger mt-3">Update</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
