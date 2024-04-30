@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.albums')
                <small>all albums starts here </small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"> <i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><a href="{{route('categories.index')}}"> @lang('site.albums')</a></li>
            </ol>


            <div class="container-fluid text-center">
                <div class="row">

                    <h1>Delete Album Confirmation</h1>
                    <p class="alert alert-danger">The album <b> "{{ $albumName }}" </b> contains photos. Please choose
                        an option:</p>
                    {{--    @dd( $albumName)--}}
                    <form method="post" action="{{ route('categories.destroy', $category->id) }}">
                        @csrf
                        @method('GET')

                        <div class="col-md-6 ">
                            <button type="submit" name="action" value="delete_photos" class="btn btn-danger">Delete
                                Photos and Album
                            </button>
                        </div>
                        <div class="col-md-6 ">
                            <span class="col-md-6">
                                <button type="submit" name="action" value="move_photos" class="btn btn-info">Move Photos to
                                    Another Album
                                </button>
                            </span>
                            <span class="col-md-6">
                                <select name="category_id" class="form-control" name="target_album_id">
                                    @foreach($categories as $category)
                                        <option
                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </span>
                        </div>

                    </form>
                </div>
            </div>
        </section>

    </div>

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


