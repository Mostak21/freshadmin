@if(Auth::user() !=null && Auth::user()->user_type == 'admin' || Auth::user() !=null && Auth::user()->user_type == 'staff')
    @include('frontend.partials.adminControlPanel')
@endif
@if(get_setting('topbar_banner') != null)
<div class="position-relative top-banner removable-session z-1035 d-none" data-key="top-banner" data-value="removed">
    <a href="{{ get_setting('topbar_banner_link') }}" class="d-block text-reset">
        <img src="{{ Cache::rememberForever('topbar_banner', function () { return uploaded_asset(get_setting('topbar_banner')); }) }}" class="w-100 mw-100 h-50px h-lg-auto img-fit">


    </a>
    <button class="btn text-white absolute-top-right set-session" data-key="top-banner" data-value="removed" data-toggle="remove-parent" data-parent=".top-banner">
        <i class="la la-close la-2x"></i>
    </button>
</div>
@endif
<!-- Top Bar -->
<div class="top-navbar bg-white border-bottom border-soft-secondary z-1035">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col">
                <ul class="list-inline d-flex justify-content-between justify-content-lg-start mb-0">
{{--                    @if(get_setting('show_language_switcher') == 'on')--}}
{{--                    <li class="list-inline-item dropdown mr-3" id="lang-change">--}}
{{--                        @php--}}
{{--                            if(Session::has('locale')){--}}
{{--                                $locale = Session::get('locale', Config::get('app.locale'));--}}
{{--                            }--}}
{{--                            else{--}}
{{--                                $locale = 'en';--}}
{{--                            }--}}
{{--                        @endphp--}}
{{--                        <a href="javascript:void(0)" class="dropdown-toggle text-reset py-2" data-toggle="dropdown" data-display="static">--}}
{{--                            <img src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ static_asset('assets/img/flags/'.$locale.'.png') }}" class="mr-2 lazyload" alt="{{ \App\Models\Language::where('code', $locale)->first()->name }}" height="11">--}}
{{--                            <span class="opacity-60">{{ \App\Models\Language::where('code', $locale)->first()->name }}</span>--}}
{{--                        </a>--}}
{{--                        <ul class="dropdown-menu dropdown-menu-left">--}}
{{--                            @foreach (\App\Models\Language::all() as $key => $language)--}}
{{--                                <li>--}}
{{--                                    <a href="javascript:void(0)" data-flag="{{ $language->code }}" class="dropdown-item @if($locale == $language) active @endif">--}}
{{--                                        <img src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" class="mr-1 lazyload" alt="{{ $language->name }}" height="11">--}}
{{--                                        <span class="language">{{ $language->name }}</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    @endif--}}

{{--                    @if(get_setting('show_currency_switcher') == 'on')--}}
{{--                    <li class="list-inline-item dropdown ml-auto ml-lg-0 mr-0" id="currency-change">--}}
{{--                        @php--}}
{{--                            if(Session::has('currency_code')){--}}
{{--                                $currency_code = Session::get('currency_code');--}}
{{--                            }--}}
{{--                            else{--}}
{{--                                $currency_code = \App\Models\Currency::findOrFail(get_setting('system_default_currency'))->code;--}}
{{--                            }--}}
{{--                        @endphp--}}
{{--                        <a href="javascript:void(0)" class="dropdown-toggle text-reset py-2 opacity-60" data-toggle="dropdown" data-display="static">--}}
{{--                            {{ \App\Models\Currency::where('code', $currency_code)->first()->name }} {{ (\App\Models\Currency::where('code', $currency_code)->first()->symbol) }}--}}
{{--                        </a>--}}
{{--                        <ul class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">--}}
{{--                            @foreach (\App\Models\Currency::where('status', 1)->get() as $key => $currency)--}}
{{--                                <li>--}}
{{--                                    <a class="dropdown-item @if($currency_code == $currency->code) active @endif" href="javascript:void(0)" data-currency="{{ $currency->code }}">{{ $currency->name }} ({{ $currency->symbol }})</a>--}}
{{--                                </li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    @endif--}}
                </ul>
            </div>

            <div class="col-5 text-right d-none d-lg-block">
                <ul class="list-inline mb-0 h-100 d-flex justify-content-end align-items-center">
                    @if (get_setting('helpline_number'))
                        <li class="list-inline-item mr-3 border-right border-left-0 pr-3 pl-0">
                            <a href="tel:{{ get_setting('helpline_number') }}" class="text-reset d-inline-block opacity-60 py-2">
                                <i class="la la-phone"></i>
                                <span>Help line</span>
                                <span>{{ get_setting('helpline_number') }}</span>
                            </a>
                        </li>
                    @endif
                {{--    @auth
                        @if(isAdmin())
                            <li class="list-inline-item mr-3 border-right border-left-0 pr-3 pl-0">
                                <a href="{{ route('admin.dashboard') }}" class="text-reset d-inline-block opacity-60 py-2">{{ translate('My Panel')}}</a>
                            </li>
                        @else

                            <li class="list-inline-item mr-3 border-right border-left-0 pr-3 pl-0 dropdown">
                                <a class="dropdown-toggle no-arrow text-reset" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                                    <span class="">
                                        <span class="position-relative d-inline-block">
                                            <i class="las la-bell fs-18"></i>
                                            @if(count(Auth::user()->unreadNotifications) > 0)
                                                <span class="badge badge-sm badge-dot badge-circle badge-primary position-absolute absolute-top-right"></span>
                                            @endif
                                        </span>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg py-0">
                                    <div class="p-3 bg-light border-bottom">
                                        <h6 class="mb-0">{{ translate('Notifications') }}</h6>
                                    </div>
                                    <div class="px-3 c-scrollbar-light overflow-auto " style="max-height:300px;">
                                        <ul class="list-group list-group-flush" >
                                            @forelse(Auth::user()->unreadNotifications as $notification)
                                                <li class="list-group-item">
                                                    @if($notification->type == 'App\Notifications\OrderNotification')
                                                        @if(Auth::user()->user_type == 'customer')
                                                        <a href="javascript:void(0)" onclick="show_purchase_history_details({{ $notification->data['order_id'] }})" class="text-reset">
                                                            <span class="ml-2">
                                                                {{translate('Order code: ')}} {{$notification->data['order_code']}} {{ translate('has been '. ucfirst(str_replace('_', ' ', $notification->data['status'])))}}
                                                            </span>
                                                        </a>
                                                        @elseif (Auth::user()->user_type == 'seller')
                                                            @if(Auth::user()->id == $notification->data['user_id'])
                                                                <a href="javascript:void(0)" onclick="show_purchase_history_details({{ $notification->data['order_id'] }})" class="text-reset">
                                                                    <span class="ml-2">
                                                                        {{translate('Order code: ')}} {{$notification->data['order_code']}} {{ translate('has been '. ucfirst(str_replace('_', ' ', $notification->data['status'])))}}
                                                                    </span>
                                                                </a>
                                                            @else
                                                                <a href="javascript:void(0)" onclick="show_order_details({{ $notification->data['order_id'] }})" class="text-reset">
                                                                    <span class="ml-2">
                                                                        {{translate('Order code: ')}} {{$notification->data['order_code']}} {{ translate('has been '. ucfirst(str_replace('_', ' ', $notification->data['status'])))}}
                                                                    </span>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </li>
                                            @empty
                                                <li class="list-group-item">
                                                    <div class="py-4 text-center fs-16">
                                                        {{ translate('No notification found') }}
                                                    </div>
                                                </li>
                                            @endforelse
                                        </ul>
                                    </div>
                                    <div class="text-center border-top">
                                        <a href="{{ route('all-notifications') }}" class="text-reset d-block py-2">
                                            {{translate('View All Notifications')}}
                                        </a>
                                    </div>
                                </div>
                            </li>

                            <li class="list-inline-item mr-3 border-right border-left-0 pr-3 pl-0">
                                <a href="{{ route('dashboard') }}" class="text-reset d-inline-block opacity-60 py-2">{{ translate('My Panel')}}</a>
                            </li>
                        @endif
                        <li class="list-inline-item">
                            <a href="{{ route('logout') }}" class="text-reset d-inline-block opacity-60 py-2">{{ translate('Logout')}}</a>
                        </li>
                    @else
                        <li class="list-inline-item mr-3 border-right border-left-0 pr-3 pl-0">
                            <a href="{{ route('user.login') }}" class="text-reset d-inline-block opacity-60 py-2">{{ translate('Login')}}</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ route('user.registration') }}" class="text-reset d-inline-block opacity-60 py-2">{{ translate('Registration')}}</a>
                        </li>
                    @endauth--}}
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- END Top Bar -->
<header class="@if(get_setting('header_stikcy') == 'on')  @endif mostak22 z-1020 bg-white " id="navbar_top">
    <div class="position-relative logo-bar-area z-1">
        <div class="container">
            <div class="d-flex align-items-center">

                <div class="col-auto col-xl-2 pl-0 d-flex align-items-center">

                    <a class="d-block py-20px ml-0" href="{{ route('home') }}">
                        @php
                            $header_logo = get_setting('header_logo');
                        @endphp
                        @if($header_logo != null)
                            <img src="{{Cache::rememberForever('header_logo', function () { return uploaded_asset(get_setting('header_logo')); })}}" alt="{{ env('APP_NAME') }}" class="mw-100 h-30px h-md-40px" height="40">
{{--                            <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-30px h-md-40px" height="40">--}}
                        @else
                            <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-30px h-md-40px" height="40">
                        @endif
                    </a>


                </div>
             {{--   <div class="d-lg-none ml-auto mr-0">
                    <a class="p-2 d-block text-reset" href="javascript:void(0);" data-toggle="class-toggle" data-target=".front-header-search">
                        <i class="las la-search la-flip-horizontal la-2x"></i>
                    </a>
                </div>--}}

                <div class="flex-grow-1 front-header-search d-flex align-items-center bg-white" style="max-width: 740px;">
                    <div class="position-relative flex-grow-1">
                        <form action="{{ route('search') }}" method="GET" class="stop-propagation">
                            <div class="d-flex position-relative align-items-center">
                                <div class="d-lg-none" data-toggle="class-toggle" data-target=".front-header-search">
                                    <button class="btn px-2" type="button"><i class="la la-2x la-long-arrow-left"></i></button>
                                </div>
                                <div class="input-group">
                                    <input class="form-control rounded-end search-field " type="text" id="search" name="keyword" @isset($query)
                                    value="{{ $query }}"
                                @endisset placeholder="Search for products" autocomplete="off"><i class="ci-search position-absolute top-50 end-0 translate-middle-y text-muted fs-base me-3"></i>
                                  </div>
                             {{--  <div class="input-group">
                                    <input type="text" class="border-0 border-lg form-control" id="search" name="keyword" @isset($query)
                                        value="{{ $query }}"
                                    @endisset placeholder="{{translate('I am shopping for...')}}" autocomplete="off">
                                    <div class="input-group-append d-none d-lg-block">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="la la-search la-flip-horizontal fs-18"></i>
                                        </button>
                                    </div>
                                </div>--}}
                            </div>
                        </form>
                        <div class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100" style="min-height: 200px">
                            <div class="search-preloader absolute-top-center">
                                <div class="dot-loader"><div></div><div></div><div></div></div>
                            </div>
                            <div class="search-nothing d-none p-3 text-center fs-16">

                            </div>
                            <div id="search-content" class="text-left">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-none d-lg-none ml-3 mr-0">
                    <div class="nav-search-box">
                        <a href="#" class="nav-box-link">
                            <i class="la la-search la-flip-horizontal d-inline-block nav-box-icon"></i>
                        </a>
                    </div>
                </div>

                   <div class="d-flex align-items-center ml-auto d-none">
                       <div class="pl-lg-6"></div>

                <div class="d-none d-lg-none  mr-4 opacity-80" id="ci-menu">
                    <div class="d-flex align-items-center" style="vertical-align: middle;">
                        <i class="ci-menu fs-22 " onclick="dclicknav()"></i>
                    </div>
                </div>

               <div class="d-none d-lg-block mr-3">
                   <div class="" id="compare">
                       @include('frontend.partials.compare')
                   </div>
               </div>

                <div class="d-none  d-lg-block mr-2">
                    <span class="navbar-tool-tooltip">Wishlist</span>
                    <div class="pr-2 " id="wishlist">
                        @include('frontend.partials.wishlist')
                    </div>
                </div>

                <div class="d-none  d-lg-block mr-2">
                    <div class="d-flex align-items-center pr-2" style="vertical-align: middle;">
                       <span class="pr-2"> <i class="fs-22  ci-user opacity-80"></i></span><span>@auth
						@if(isAdmin())
						<div class="">

                        <a href="{{ route('admin.dashboard') }}" class="text-reset d-inline-block opacity-60">
							My Panel</a></div>
                         <div><a href="{{ route('logout') }}">Logout</a></div>
						 @else
						<div class="">
						 <a href="{{ route('dashboard') }}" class="text-reset d-inline-block opacity-60 ">
							My Panel</a></div>
                         <div><a href="{{ route('logout') }}"> Logout</a></div>
						@endif
						@else
						<div class="">

                        <a href="{{ route('user.registration') }}" class="text-reset d-inline-block opacity-60 ">
							Registration</a></div>
                         <div><a href="{{ route('user.login') }}">Login</a></div>
						@endauth
						</span>
                    </div>
                </div>

{{--
                @auth
                        @if(isAdmin())
                            <li class="list-inline-item mr-3 border-right border-left-0 pr-3 pl-0">
                                <a href="{{ route('admin.dashboard') }}" class="text-reset d-inline-block opacity-60 py-2">
									{{ translate('My Panel')}}</a>
                            </li>
                        @else
                            <li class="list-inline-item mr-3 border-right border-left-0 pr-3 pl-0">
                                <a href="{{ route('dashboard') }}" class="text-reset d-inline-block opacity-60 py-2">{{ translate('My Panel')}}</a>
                            </li>
                        @endif
                        <li class="list-inline-item">
                            <a href="{{ route('logout') }}" class="text-reset d-inline-block opacity-60 py-2">
								{{ translate('Logout')}}</a>
                        </li>
                    @else
                        <li class="list-inline-item mr-3 border-right border-left-0 pr-3 pl-0">
                            <a href="{{ route('user.login') }}" class="text-reset d-inline-block opacity-60 py-2">{{ translate('Login')}}</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ route('user.registration') }}" class="text-reset d-inline-block opacity-60 py-2">{{ translate('Registration')}}</a>
                        </li>
                    @endauth--}}

                <div class="d-none d-lg-block" data-hover="dropdown">
                    <div class="nav-cart-box dropdown h-100" id="cart_items">
                        @include('frontend.partials.cart')
                    </div>
                </div>

				</div>
<div class="d-lg-none ml-auto d-flex">
                 <div class=" mr-0">
                    <a class="p-2 d-block text-reset" href="javascript:void(0);" data-toggle="class-toggle" data-target=".front-header-search">
                        <i class="las la-search la-flip-horizontal la-2x"></i>
                    </a>
                </div>
				{{--<div class=" mr-2">
                    <div class="d-flex align-items-center" style="vertical-align: middle;">
                       <span class="pr-2"> <i class="fs-22  ci-user"></i></span><span>@auth
						@if(isAdmin())
						<div class="">

                        <a href="{{ route('admin.dashboard') }}" class="text-reset d-inline-block opacity-60">
							{{ translate('My Panel')}}</a></div>
                         <div><a href="{{ route('logout') }}">{{ translate('Logout')}}</a></div>
						 @else
						<div class="">
						 <a href="{{ route('dashboard') }}" class="text-reset d-inline-block opacity-60 ">
							{{ translate('My Panel')}}</a></div>
                         <div><a href="{{ route('logout') }}">{{ translate('Logout')}}</a></div>
						@endif
						@else
						<div class="">

                        <a href="{{ route('user.registration') }}" class="text-reset d-inline-block opacity-60 ">
							{{ translate('Registration')}}</a></div>
                         <div><a href="{{ route('user.login') }}">{{ translate('Login')}}</a></div>
						@endauth
						</span>
                    </div>
                </div>--}}
			</div>
            </div>
        </div>

    </div>
    @if ( get_setting('header_menu_labels') !=  null )
      <div class="bg-white  " >
            <div class="container d-none d-lg-block" id="dnav">
                <div class="row">

                 <span class=" py-1 pb-3"  onmouseout="categoryhoverMouseout(this)" onmouseover="categoryhoverMouseover(this)">
                     <a class="text-reset" href="{{route('categories.all')}}">
                         <span class="d-none d-lg-block fs-16 bg-white px-1 py-1 hov-text-primary c-pointer">
                             <li class="list-inline-item pr-4 pl-2 w-100 fs-16" id="category-menu-icon" >
                                 <i class="ci-view-grid fs-16 pr-2"></i>
                                 All Categories
                                 <i class="fa fa-caret-down pl-2"></i>
                             </li>
                         </span>
                     </a>
                 </span>

               <span class=" py-1 pb-3" > <span class="d-none d-lg-block fs-16 bg-white py-3 hov-text-primary c-pointer" style="border-right:solid 1px #cccdce"></span> </span>
                <ul class="list-inline mb-0 pl-1 mobile-hor-swipe text-center py-1 pb-3 ">
                    @foreach (json_decode( get_setting('header_menu_labels'), true) as $key => $value)
                    <li class="list-inline-item mr-0">
                    <span class=" bg-white px-1 py-1 hov-text-primary">
                        <a href="{{ json_decode( get_setting('header_menu_links'), true)[$key] }}" class="fs-16 px-3 py-1 d-inline-block hov-opacity-100 text-reset">
                            {{ $value }}
                        </a>
                    </span>
                    </li>
                    @endforeach
                </ul>

                </div>
            </div>
			   <div class="container d-lg-none" >
                <div class="row">
                <ul class="list-inline mb-0 pl-0 mobile-hor-swipe text-center">
                    @foreach (json_decode( get_setting('header_menu_labels'), true) as $key => $value)
                    <li class="list-inline-item mr-0">
                    <span class=" bg-white px-1 py-2 hov-text-primary">
                        <a href="{{ json_decode( get_setting('header_menu_links'), true)[$key] }}" class="fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">
                            {{ $value }}
                        </a>
                    </span>
                    </li>
                    @endforeach
                </ul>

                </div>
            </div>
        </div>
    @endif
        {{-- <div class=" hover-category-menu  w-100 top-100 left-0 right-0 d-none z-3" style="" id="hover-category-menu1">
            <div class="container">
                <div class="row gutters-10 ">
                    <div class="col-lg-3 d-none d-lg-block">
                        @include('frontend.partials.category_menu')
                    </div>
                </div>
            </div>
        </div> --}}

        <div class=" hover-category-menu position-absolute w-100 left-0 right-0 d-none z-3" style="" id="hover-category-menu1">
            <div class="container">
                <div class="row gutters-10 position-relative">
                    <div class="col-lg-3 position-static">
                        @include('frontend.partials.category_menu')
                    </div>
                </div>
            </div>
        </div>

</header>

<div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div id="order-details-modal-body">

            </div>
        </div>
    </div>
</div>

@section('script')
    <script type="text/javascript">

        function show_order_details(order_id)
        {
            $('#order-details-modal-body').html(null);

            if(!$('#modal-size').hasClass('modal-lg')){
                $('#modal-size').addClass('modal-lg');
            }

            $.post('{{ route('orders.details') }}', { _token : AIZ.data.csrf, order_id : order_id}, function(data){
                $('#order-details-modal-body').html(data);
                $('#order_details').modal();
                $('.c-preloader').hide();
                AIZ.plugins.bootstrapSelect('refresh');
            });
        }
    </script>
@endsection
