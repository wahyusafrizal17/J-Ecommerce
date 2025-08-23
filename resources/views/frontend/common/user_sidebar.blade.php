<div>
  <br>
<img class="card-img-top mb-3" style="border-radius: 50%;"
     src="{{ (!empty(Auth::user()->profile_photo_path)) 
            ? url('upload/user_images/' . Auth::user()->profile_photo_path) 
            : url('upload/no_image.jpg') }}" 
     height="100%" width="100%">

                    <li class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="" class="btn btn-primary btn-sm btn-block">Home</a>
                        </li>

                        <li class="list-group-item">
                        <a href="{{ route('my.order') }}" class="btn btn-primary btn-sm btn-block">Orders</a>
                      </li>

                        <li class="list-group-item">
                            <a href="{{ route('user.profile.edit') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                        </li>

                       <li class="list-group-item">
                        <a href="{{ route('change.password') }}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                       </li>

                         <li class="list-group-item">
                        <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                    </li>
                    </li>
                    </ul>
                  </br>
                    </div>
                 