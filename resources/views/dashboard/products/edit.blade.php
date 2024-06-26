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
                <li class="active"> @lang('site.edit_photo')</li>
            </ol>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <div class="card card-primary">

                                <div class="card-header">
                                    <h3 class="card-title">@lang('site.edit_photo')</h3>
                                </div>
                                <!-- /.card-header -->
                                @include('partials._errors')

                                <!-- form start -->
                                <form method="post" action="{{route('product.update', $product->id)}}" enctype="multipart/form-data">

                                    @csrf
                                    {{method_field('post')}}

                                    <div class="card-body">


                                        {{-- product Image --}}
                                        <div class=" col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputimage">@lang('site.choose_image')</label>
                                                <input type="file" name="image" class="form-control "
                                                       id="exampleInputimage"
                                                       onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"
                                                >
                                            </div>

                                            <div class="form-group">
                                                <img src="{{ $product->image_path }}"
                                                     alt="Your Photo"
                                                     id="blah" class="img-thumbnail" style="height: 50px; width: 75px;">
                                            </div>
                                        </div>


                                        {{-- product Category--}}
                                        <div class="card-body">
                                            {{--{{ $product->category_id }}--}}
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- select -->
                                                    <div class="form-group">
                                                        <label for="Select">@lang('site.category')</label>
                                                        <select id="Select" class="custom-select form-control"
                                                                name="category_id">
                                                            <option value="">---</option>
                                                            @foreach($categories as $category)

                                                                <option
                                                                    value="{{$category->id}}"
                                                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                                    {{$category->name}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fa fa-edit"></i> @lang('site.edit') </button>
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
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endpush
