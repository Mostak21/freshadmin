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
        <div class="container-custom">
            <div class="d-flex align-items-center py-2">

               

                <div class="col-auto col-xl-2 pl-0 d-flex align-items-center">
                    @if(Route::currentRouteName()!='home')
                    <img class="pr-2" src="{{ static_asset('m_asset/arrow.png') }}" height="32px" alt="" onclick="history.back()">
                    @else
                    <img src="{{ static_asset('m_asset/menu.png') }}" height="32px" alt="" onclick="dclicknav()">
                    @endif
                    
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

                <div class="flex-grow-1 front-header-search d-flex align-items-center bg-white">
                    <div class="position-relative flex-grow-1">
                        <form action="{{ route('search') }}" method="GET" class="stop-propagation">
                            <div class="d-flex position-relative align-items-center container-custom">
                                <div class="d-lg-none" data-toggle="class-toggle" data-target=".front-header-search">
                                   <i class="la la-2x la-long-arrow-left"></i>
                                </div>
                                <div class="input-group">
                                    <input class="form-control rounded-end search-field " type="text" id="search" name="keyword" @isset($query)
                                    value="{{ $query }}"
                                @endisset placeholder="Search for products" autocomplete="off"><i class="ci-search position-absolute top-50 end-0 translate-middle-y text-muted fs-base me-3"></i>
                                  </div>
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
                <div class="d-flex align-items-center ml-auto d-none">
				</div>

                 <div class=" mr-0">
                    <a class="py-2 d-block text-reset" href="javascript:void(0);" data-toggle="class-toggle" data-target=".front-header-search">
                        <i class="las la-search la-flip-horizontal la-2x"></i>
                    </a>
                </div>
                <div class="mr-0">
                    
                    <div class="py-2 d-block text-reset " id="wishlist">
                        @include('frontend.partials.wishlist')
                    </div>
                </div>
                <div class="mr-1">
                    
                    <div class="py-2 d-block text-reset " id="app">
{{--                        @if($iphone)--}}
                            @if(get_setting('app_store_link') != null)
                            <a href="{{ get_setting('app_store_link') }}" target="blank">
                                <i class="fa-brands fa-app-store fs-22"></i>
                            </a>
                            @endif
{{--                        @else--}}
                            @if(get_setting('play_store_link') != null)
                                 <a href="{{ get_setting('play_store_link') }}" target="blank">
                                    <i class="fa-brands fa-google-play fs-20"></i>
                                 </a>
                            @endif
                      
{{--                        @endif--}}
                    </div>
                </div>


   
		
			
            </div>
        </div>

    </div>
<div class="container-custom d-none "  id="dnav" >
    <div class="d-flex justify-content-start mb-2" >
        @foreach (json_decode( get_setting('header_menu_labels'), true) as $key => $value)
        <div>
        <span class=" bg-dark rounded-custom py-2 mr-2">
            <a href="{{ json_decode( get_setting('header_menu_links'), true)[$key] }}" class="fs-14 px-2 py-1 d-inline-block  text-light">
                {{ $value }}
            </a>
        </span>
        </div>
        @endforeach
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
