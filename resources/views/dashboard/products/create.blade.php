@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.photos')
                <small>all photos starts here</small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"> <i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><a href="{{route('products.index')}}"> @lang('site.photos')</a></li>
                <li class="active"> @lang('site.add_photo')</li>
            </ol>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <div class="card card-primary">

                                <div class="card-header">
                                    <h3 class="card-title">@lang('site.add_new_photo')</h3>
                                </div>
                                <!-- /.card-header -->
                                @include('partials._errors')

                                <!-- form start -->
                                <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data" class="dropzone dz-clickable" id="image-upload">
                                    @csrf
                                    {{method_field('post')}}
                                    <!-- Hidden input field to specify the file name for Dropzone.js -->
                                    <input type="file" name="file" style="display:none;" />

                                    <div class="card-body">

                                        {{-- product Category--}}
                                        <div class="card-body">
                                            {{--{{old ('category_id')}}--}}
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- select -->
                                                    <div class="form-group">
                                                        <label for="Select">@lang('site.album')</label>
                                                        <select id="Select" class="custom-select form-control"
                                                                name="category_id">
                                                            <option value="">---</option>
                                                            @foreach($categories as $category)

                                                                <option
                                                                    value="{{$category->id}}"
                                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                                    {{$category->name}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- product Image --}}
                                        <div class="col-10">
                                                    <p class="card-text">@lang('site.choose_image')</p>
                                                    <div class="dropzone dz-clickable" id="image-upload">

                                                        <div class="dz-default dz-message">
                                                            <h3>Drop files here or click to upload.</h3>
                                                        </div>
                                                    </div>
                                        </div>
                                    </div>


                                    <!-- /.card-body -->
                                    <div class="row" style="padding-top: 10px">
                                        <div class="card-footer">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="fa fa-plus"></i> @lang('site.add') </button>
                                            </div>
                                        </div>
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
    {{--<script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>--}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.js"
            integrity="sha512-8l10HpXwk93V4i9Sm38Y1F3H4KJlarwdLndY9S5v+hSAODWMx3QcAVECA23NTMKPtDOi53VFfhIuSsBjjfNGnA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
