@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.albums')
                <small>all albums starts here</small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"> <i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><a href="{{route('categories.index')}}"> @lang('site.albums')</a></li>
                <li class="active"> @lang('site.edit_album')</li>
            </ol>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <div class="card card-primary">

                                <div class="card-header">
                                    <h3 class="card-title">@lang('site.edit_album')</h3>

                                </div>
                                <!-- /.card-header -->
                                @include('partials._errors')

                                <!-- form start -->
                                <form method="post" action="{{route('category.update', $category->id)}}" >

                                    {{csrf_field()}}
                                    {{--{{method_field('put')}}--}}

                                    <div class="card-body">

                                        {{-- Category Arabic Name--}}
                                        <div class="form-group">
                                            <label for="exampleInputNameAr">@lang('site.name_ar')</label>
                                            <input type="text" name="name_ar" class="form-control" id="exampleInputNameAr"
                                                   value="{{ $category->getTranslation('name', 'ar') }}" >
                                        </div>

                                        {{-- Category English Name--}}
                                        <div class="form-group">
                                            <label for="exampleInputName">@lang('site.name_en')</label>
                                            <input type="text" name="name" class="form-control" id="exampleInputName"
                                                   value="{{ $category->getTranslation('name', 'en') }}" >
                                        </div>


                                        {{-- Category Notes--}}
                                        <div class="form-group">
                                            <label for="exampleInputNotes">@lang('site.notes')</label>
                                            <input type="text" name="notes" class="form-control" id="exampleInputNotes"
                                                   value="{{ $category->notes }}">
                                        </div>

                                    </div>


                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="fa fa-edit"></i> @lang('site.edit') </button>
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
