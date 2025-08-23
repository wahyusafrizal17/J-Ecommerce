@extends('admin.admin_master')
@section('content')

<section class="content">
    <div class="row">

        <div class="col-8">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Slider List</h3>
                </div>

                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Slider Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sliders as $item)
                                    <tr>
                                        <td><img style="width: 100px" src="{{ asset($item->slider_img) }}"></td>
                                        <td>
                                            @if($item->title === null)
                                                <span class="badge badge-danger">No Title</span>
                                            @else
                                                {{ $item->title }}
                                            @endif
                                        </td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            @if($item->status === 1)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('slider.edit', $item->id) }}" class="btn btn-primary btn-sm" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="{{ route('slider.delete', $item->id) }}" class="btn btn-danger btn-sm" id="delete" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                @if($item->status === 1)
                                                    <a href="{{ route('slider.inactive', $item->id) }}" class="btn btn-warning btn-sm" title="Set Inactive">
                                                        <i class="fa fa-arrow-down"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('slider.active', $item->id) }}" class="btn btn-success btn-sm" title="Set Active">
                                                        <i class="fa fa-arrow-up"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Slider</h3>
                </div>

                <div class="box-body">
                    <div class="table-responsive">
                        <form method="post" action="{{ route('slider.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <h5>Title</h5>
                                <div class="controls">
                                    <input type="text" name="title" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Description</h5>
                                <div class="controls">
                                    <input type="text" name="description" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Slider Image <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="file" name="slider_img" class="form-control">
                                    @error('slider_img')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-xs-right mt-3">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Slider">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
