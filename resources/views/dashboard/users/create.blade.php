@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.users')
                <small>all users starts here</small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"> <i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><a href="{{route('users.index')}}"> @lang('site.users')</a></li>
                <li class="active"> @lang('site.add_user')</li>
            </ol>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <div class="card card-primary">

                                <div class="card-header">
                                    <h3 class="card-title">@lang('site.add_new_user')</h3>
                                </div>
                                <!-- /.card-header -->
                                @include('partials._errors')

                                <!-- form start -->
                                <form method="post" action="{{route('user.store')}}" enctype="multipart/form-data">

                                    {{csrf_field()}}
                                    {{method_field('post')}}

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputName">@lang('site.name')</label>
                                            <input type="text" name="name" class="form-control" id="exampleInputName"
                                                   value="{{old('name')}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('site.email')</label>
                                            <input type="email" name="email" class="form-control"
                                                   id="exampleInputEmail1" value="{{old('email')}}">
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputimage">@lang('site.choose_image')</label>
                                            <input type="file" name="image" class="form-control"
                                                   id="exampleInputimage"
                                                   onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"
                                            >
                                        </div>

                                        <div class="form-group">
                                            <img src="{{ asset('uploads/users_img/default.png') }}" alt="Your Photo"
                                                 id="blah" class="img-thumbnail" style="height: 75px; width: 55px;">

                                        </div>


                                        <div class="form-group">
                                            <label for="password">@lang('site.password')</label>
                                            <input type="password" name="password" class="form-control"
                                                   id="password">
                                        </div>

                                        <div class="form-group">
                                            <label for="passwordConf">@lang('site.password_confirmation')</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                   id="passwordConf">
                                        </div>


                                        {{--
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                        </div>--}}
                                    </div>

                                    {{--Attach Roles to The User --}}
                                    <div class="card card-secondary">
                                        <div class="card-header">
                                            <h3 class="card-title">@lang('site.user_roles') :</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    {{--{{ old('role') }}--}}
                                                    <!-- select -->
                                                    <div class="form-group">
                                                        <label for="Select">@lang('site.role_select')</label>
                                                        <select id="Select" class="custom-select form-control"
                                                                name="role">
                                                            <option value="">---</option>
                                                            @foreach($roles as $role)

                                                                <option value="{{$role->id}}"
                                                                    {{ old('role') == $role->id ? 'selected' : '' }}>
                                                                    {{$role->name}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                {{-- Radio Buttons
                                                <div class="col-sm-6">
                                                    <!-- radio -->
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input" type="radio" id="customRadio" name="role">
                                                            <label for="customRadio" class="custom-control-label" value="super admin">Super Admin</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input" type="radio" id="customRadio1" name="role">
                                                            <label for="customRadio1" class="custom-control-label" value="admin">Admin</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input" type="radio" id="customRadio2" name="role" checked>
                                                            <label for="customRadio2" class="custom-control-label" value="user">User</label>
                                                        </div>
                                                    </div>
                                                </div>--}}
                                            </div>

                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="fa fa-plus"></i> @lang('site.add') </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </div><!-- end of content wrapper -->

@endsection


@push('scripts')

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>

    <!-- Page specific script -->
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endpush
