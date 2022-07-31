@if(get_setting('topbar_banner') != null)
<div class="position-relative top-banner removable-session z-1035 d-none" data-key="top-banner" data-value="removed">
    <a href="{{ get_setting('topbar_banner_link') }}" class="d-block text-reset">
        <img src="{{ uploaded_asset(get_setting('topbar_banner')) }}" class="w-100 mw-100 h-50px h-lg-auto img-fit">
    </a>
    <button class="btn text-white absolute-top-right set-session" data-key="top-banner" data-value="removed" data-toggle="remove-parent" data-parent=".top-banner">
        <i class="la la-close la-2x"></i>
    </button>
</div>
@endif
<header class="@if(get_setting('header_stikcy') == 'on')  @endif mostak22 z-1020 bg-white " id="navbar_top">
    <div class="position-relative logo-bar-area z-1">
        <div class="container">
            <div class="d-flex align-items-center py-2">

               

                <div class="col-auto col-xl-2 pl-0 d-flex align-items-center">
                    <img src="{{ static_asset('m_asset/menu.png') }}" height="32px" alt="">
                    {{-- <a class="d-block py-20px ml-0" href="{{ route('home') }}">
                        @php
                            $header_logo = get_setting('header_logo');
                        @endphp
                        @if($header_logo != null)
                            <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-30px h-md-40px" height="40">
                        @else
                            <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-30px h-md-40px" height="40">
                        @endif
                    </a> --}}


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
                                @endisset placeholder="{{translate('Search for products')}}" autocomplete="off"><i class="ci-search position-absolute top-50 end-0 translate-middle-y text-muted fs-base me-3"></i>
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
               {{-- <div class="d-none d-lg-block mr-0">
                    <div class="" id="compare">
                        @include('frontend.partials.compare')
                    </div>
                </div>--}}

                <div class="pl-lg-6"></div>
                <div class="d-none d-lg-none  mr-3" id="ci-menu">
                    <div class="d-flex align-items-center" style="vertical-align: middle;">
                        <i class="ci-menu fs-22 " onclick="dclicknav()"></i>
                    </div>
                </div>

                <div class="d-none  d-lg-block mr-2">
                    <span class="navbar-tool-tooltip">Wishlist</span>
                    <div class="pr-2 " id="wishlist">
                        @include('frontend.partials.wishlist')
                    </div>
                </div>

          


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
