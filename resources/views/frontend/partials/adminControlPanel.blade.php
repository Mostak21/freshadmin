{{--adminControlPanel--}}
{{--{{dd(isset($detailedProduct))}}--}}
<div class="bg-soft-dark  ">
    {{--    <span class="badge badge-inline badge-soft-dark hov-bg-dark"><a class="text-reset hov-text-secondary fw-500 " href="{{ route('cache.clear')}}"><i class="las la-hdd "></i> Clear Cache</a></span>--}}
    <div class="row" >
        <div class="col-6">
            <span class="badge badge-inline badge-soft-dark ml-2"><a class="text-reset hov-text-primary fw-500 " href="{{ route('admin.dashboard')}}"><i class="las la-server "></i>Dashboard</a></span>
            <span class="badge badge-inline badge-soft-dark "><a class="text-reset hov-text-primary fw-500 " href="{{ route('cache.clear')}}"><i class="las la-hdd "></i> Clear Cache</a></span>
{{--            <span class="badge badge-inline badge-soft-dark "><a class="text-reset hov-text-primary fw-500 " href=""><i class="las la-pen "></i> Edit Page</a></span>--}}
            @if(isset($detailedProduct))
            <span class="badge badge-inline badge-soft-dark "><a class="text-reset hov-text-primary fw-500 " href="{{route('products.seller.edit', ['id'=>$detailedProduct->id, 'lang'=>env('DEFAULT_LANGUAGE')] )}}">
                    <i class="las la-pen "></i> Edit This Product</a>
            </span>
            @endif
        </div>
        <div class="col-6 text-right ">
            <div>
                <i class="las la-user-circle"></i>
                <span class=" mr-2" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false"> {{Auth::user()->name}} </span>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-md z-1035">
                    <a href="{{ route('profile.index') }}" class="dropdown-item">
                        <i class="las la-user-circle"></i>
                        <span>Profile</span>
                    </a>

                    <a href="{{ route('logout')}}" class="dropdown-item">
                        <i class="las la-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>



