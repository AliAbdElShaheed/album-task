<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dashboard_files/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Ali Mohammed</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-th"></i><span>@lang('site.dashboard')</span></a></li>

            @if (auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('admin') || auth()->user()->hasPermission('users_read'))
                <li><a href="{{ route('users.index') }}"><i class="fa fa-users"></i><span>@lang('site.users')</span></a></li>
            @endif


            @if (auth()->user()->hasPermission('categories_read'))
                <li><a href="{{ route('categories.index') }}"><i class="fa fa-th"></i><span>@lang('site.albums')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('products_read'))
                <li><a href="{{ route('products.index') }}"><i class="fa fa-th"></i><span>@lang('site.photos')</span></a></li>
            @endif
{{--

            @if (auth()->user()->hasPermission('read_users'))
                <li><a href="{{ route('dashboard.users.index') }}"><i class="fa fa-th"></i><span>@lang('site.users')</span></a></li>
            @endif
--}}


        </ul>

    </section>

</aside>

