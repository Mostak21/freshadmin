@extends('frontend.layouts.app')

@section('content')


{{--    {{dd(Cache::get('featured_categories'))}}--}}

    {{-- Categories , Sliders . Today's deal --}}
    <div class="container-custom">
    <div class="home-banner-area overflow-hidden mb-3">
        <div class="">
            <div class="row gutters-10 position-relative overflow-hidden">
             {{--  <div class="col-lg-3 position-static d-none d-lg-block">
                  @include('frontend.partials.category_menu')
                </div>--}}

                @php
                    $num_todays_deal = count($todays_deal_products);
                @endphp

                <div class="@if($num_todays_deal > 0) col-lg-12 @else col-lg-12 @endif">
                    @if (get_setting('home_slider_images') != null)
                        <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height rounded-slider" data-dots="true" data-autoplay="true">
                            @php $slider_images = json_decode(get_setting('home_slider_images'), true);  @endphp
                            @foreach ($slider_images as $key => $value)
                                <div class="carousel-box">
                                    <a href="{{ json_decode(get_setting('home_slider_links'), true)[$key] }}">
                                        <img
                                            class="d-block mw-100 img-fit rounded-slider overflow-hidden"
                                            src="{{ uploaded_asset($slider_images[$key]) }}"
                                            alt="{{ env('APP_NAME')}} promo"
                                            @if(count($featured_categories) == 0)
                                            height="auto"
                                            @else
                                            height="auto"
                                            @endif
                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';"
                                        >
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                   @if (count($featured_categories) > 0)
                        <ul class="list-unstyled mb-0 row gutters-5">
                            @foreach ($featured_categories as $key => $category)
                                <li class="minw-0 col-4 col-md mt-3">
                                    <a href="{{ route('products.category', $category->slug) }}" class="card-mobile">
                                        <img
                                            src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                            data-src="{{ uploaded_asset($category->banner) }}"
                                            alt="{{ $category->getTranslation('name') }}"
                                            class="lazyload img-fit p-img-round"
                                            height="80"
                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';"
                                        >
                                        <div class="text-truncate mt-1 fs-14 fw-600 text-center">{{ $category->getTranslation('name') }}</div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                @if($num_todays_deal > 0)
                <div class="col-lg-2 order-3 mt-3 mt-lg-0">
                    <div class="bg-white rounded shadow-sm">
                        <div class="bg-soft-primary rounded-top p-3 d-flex align-items-center justify-content-center">
                            <span class="fw-600 fs-16 mr-2 text-truncate">
                                {{ translate('Todays Deal') }}
                            </span>
                            <span class="badge badge-primary badge-inline">{{ translate('Hot') }}</span>
                        </div>
                        <div class="c-scrollbar-light overflow-auto h-lg-400px p-2 bg-primary rounded-bottom">
                            <div class="gutters-5 lg-no-gutters row row-cols-2 row-cols-lg-1">
                            @foreach ($todays_deal_products as $key => $product)
                                @if ($product != null)
                                <div class="col mb-2">
                                    <a href="{{ route('product', $product->slug) }}" class="d-block p-2 text-reset bg-white h-100 rounded">
                                        <div class="row gutters-5 align-items-center">
                                            <div class="col-xxl">
                                                <div class="img">
                                                    <img
                                                        class="lazyload img-fit h-140px h-lg-80px"
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                        alt="{{ $product->getTranslation('name') }}"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-xxl">
                                                <div class="fs-16">
                                                    <span class="d-block text-primary fw-600">{{ home_discounted_base_price($product) }}</span>
                                                    @if(home_base_price($product) != home_discounted_base_price($product))
                                                        <del class="d-block opacity-70">{{ home_base_price($product) }}</del>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endif
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
    </div>

{{-- Flash Deal --}}
    @php
        $flash_deal = \App\Models\FlashDeal::where('status', 1)->where('featured', 1)->first();
    @endphp
    @if($flash_deal != null && strtotime(date('Y-m-d H:i:s')) >= $flash_deal->start_date && strtotime(date('Y-m-d H:i:s')) <= $flash_deal->end_date)
    <section class="">
        <div class="container mt-4">
            <div class="px-2 py-4 px-md-4 py-md-3 bg-white">

                <div class="d-flex flex-wrap mb-3 align-items-baseline border-bottom">
                    <h3 class="h5 fw-700 mb-0">
                        <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">Brand Of The Week</span>
                    </h3>
                    <div class="aiz-count-down ml-auto ml-lg-3 align-items-center" data-date="{{ date('Y/m/d H:i:s', $flash_deal->end_date) }}"></div>
                    <a href="{{ route('flash-deal-details', $flash_deal->slug) }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md w-100 w-md-auto">{{ translate('View More') }}</a>
                </div>

                <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true'>
                    @foreach ($flash_deal->flash_deal_products->take(20) as $key => $flash_deal_product)
                        @php
                            $product = \App\Models\Product::find($flash_deal_product->product_id);
                        @endphp
                        @if ($product != null && $product->published != 0)
                            <div class="carousel-box pb-lg-7">
                                @include('frontend.partials.product_box_home',['product' => $product])
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif


 {{-- Featured Section --}}
<div id="section_featured">

</div>

{{-- Custom Section --}}
    <div id="custom_section1">
        @include('frontend.partials.home_custom_section_left',['section_data' => Cache::get('home_custom_section1')??null])
    </div>
    <div id="custom_section2">
        @include('frontend.partials.home_custom_section_right',['section_data' => Cache::get('home_custom_section2')??null])
    </div>
    <div id="custom_section3">
        @include('frontend.partials.home_custom_section_left',['section_data' => Cache::get('home_custom_section3')??null])
    </div>
    <div id="custom_section4">
        @include('frontend.partials.home_custom_section_right',['section_data' => Cache::get('home_custom_section4')??null])
    </div>

{{-- Flash Deal
    @php
        $flash_deal = \App\Models\FlashDeal::where('status', 1)->where('featured', 1)->first();
    @endphp
    @if($flash_deal != null && strtotime(date('Y-m-d H:i:s')) >= $flash_deal->start_date && strtotime(date('Y-m-d H:i:s')) <= $flash_deal->end_date)
    <section class="mb-4">
        <div class="container">
            <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">

                <div class="d-flex flex-wrap mb-3 align-items-baseline border-bottom">
                    <h3 class="h5 fw-700 mb-0">
                        <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Flash Sale') }}</span>
                    </h3>
                    <div class="aiz-count-down ml-auto ml-lg-3 align-items-center" data-date="{{ date('Y/m/d H:i:s', $flash_deal->end_date) }}"></div>
                    <a href="{{ route('flash-deal-details', $flash_deal->slug) }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md w-100 w-md-auto">{{ translate('View More') }}</a>
                </div>

                <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true'>
                    @foreach ($flash_deal->flash_deal_products->take(20) as $key => $flash_deal_product)
                        @php
                            $product = \App\Models\Product::find($flash_deal_product->product_id);
                        @endphp
                        @if ($product != null && $product->published != 0)
                            <div class="carousel-box">
                                @include('frontend.partials.product_box_home',['product' => $product])
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

 --}}




    <!-- Auction Product -->
    @if(addon_is_activated('auction'))
        <div id="auction_products">

        </div>
    @endif


    {{-- Category wise Products --}}
    <div id="section_home_categories">

    </div>

    {{-- Classified Product --}}
    @if(get_setting('classified_product') == 1)
        @php
            $classified_products = \App\Models\CustomerProduct::where('status', '1')->where('published', '1')->take(10)->get();
        @endphp
           @if (count($classified_products) > 0)
               <section class="mb-4">
                   <div class="container">
                       <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">
                            <div class="d-flex mb-3 align-items-baseline border-bottom">
                                <h3 class="h5 fw-700 mb-0">
                                    <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Classified Ads') }}</span>
                                </h3>
                                <a href="{{ route('customer.products') }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">{{ translate('View More') }}</a>
                            </div>
                           <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true'>
                               @foreach ($classified_products as $key => $classified_product)
                                   <div class="carousel-box">
                                        <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                                            <div class="position-relative">
                                                <a href="{{ route('customer.product', $classified_product->slug) }}" class="d-block">
                                                    <img
                                                        class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        data-src="{{ uploaded_asset($classified_product->thumbnail_img) }}"
                                                        alt="{{ $classified_product->getTranslation('name') }}"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                    >
                                                </a>
                                                <div class="absolute-top-left pt-2 pl-2">
                                                    @if($classified_product->conditon == 'new')
                                                       <span class="badge badge-inline badge-success">{{translate('new')}}</span>
                                                    @elseif($classified_product->conditon == 'used')
                                                       <span class="badge badge-inline badge-danger">{{translate('Used')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="p-md-3 p-2 text-left">
                                                <div class="fs-15 mb-1">
                                                    <span class="fw-700 text-primary">{{ single_price($classified_product->unit_price) }}</span>
                                                </div>
                                                <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                    <a href="{{ route('customer.product', $classified_product->slug) }}" class="d-block text-reset">{{ $classified_product->getTranslation('name') }}</a>
                                                </h3>
                                            </div>
                                       </div>
                                   </div>
                               @endforeach
                           </div>
                       </div>
                   </div>
               </section>
           @endif
       @endif

	 {{-- Best Selling  --}}
    <div id="section_best_selling">

    </div>

    <div id="section_top10_brands">

    </div>


    {{-- Best Seller --}}
    <div id="section_best_sellers">

    </div>

    <div class="container-custom mb-3" id="blog_post">
        @include('frontend.partials.bloglist')
    </div>

    <div class="pt-5" style="background: #1a1f29">
    <div class="container">
      <div class="row pb-3">
        <div class="col-md-3 col-sm-6 mb-4">
          <div class="d-flex"><i class="ci-document text-brand-gray" style="font-size: 2.25rem;"></i>
            <div class="px-3">
                <a class="text-light fs-16 fw-500" href="{{ route('terms') }}" style="font-size: 1rem !important;">{{ translate('Terms & Conditions') }}</a>
                <p class="mb-0 fs-ms fw-300 text-light opacity-50">Outline the rules and regulations</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
          <div class="d-flex"><i class="ci-currency-exchange text-brand-gray" style="font-size: 2.25rem;"></i>
            <div class="px-3">
                <a class="text-light fs-16 fw-500" href="{{ route('returnpolicy') }}">{{ translate('Return Policy') }}</a>
              	<p class="mb-0 fs-ms fw-300 text-light opacity-50">We return money within 14 days</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
          <div class="d-flex"><i class="ci-support text-brand-gray" style="font-size: 2.25rem;"></i>
            <div class="px-3">

             <a class="text-light fs-16 fw-500" href="{{ route('supportpolicy') }}">{{ translate('Support Policy') }}</a>
			<p class="mb-0 fs-ms fw-300 text-light opacity-50">Friendly 24/7 customer support</p>

            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
          <div class="d-flex"><i class="ci-security-check text-brand-gray" style="font-size: 2.25rem;"></i>
            <div class="px-3">

       <a class="text-light fs-16 fw-500" href="{{ route('privacypolicy') }}"> {{ translate('Privacy Policy') }}</a>
				<p class="mb-0 fs-ms fw-300 text-light opacity-50">Information about our Privacy Policy</p>

            </div>
          </div>
        </div>
      </div>
      <hr class="border-gray-800 mb-5">
      <div class="row pb-2">
        <div class="col-md-9  mb-4">
<div class="row">
    <div class="col-6 mb-4">
        <a class="" href="{{ route('home') }}">
            @if(get_setting('footer_logo') != null)
                <img class="lazyload" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset(get_setting('footer_logo')) }}" alt="{{ env('APP_NAME') }}" height="44">
            @else
                <img class="lazyload" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" height="44">
            @endif
        </a>
    </div>
    <div class="col-6 mb-4 text-right d-md-none">
        @if ( get_setting('show_social_links') )
            @if ( get_setting('facebook_link') !=  null )
                <a href="{{ get_setting('facebook_link') }}" target="_blank" class="btn-social bs-light ms-2 mb-2 bs-facebook"><i class=" ci-facebook"></i></a>
            @endif
            @if ( get_setting('twitter_link') !=  null )
                <a href="{{ get_setting('twitter_link') }}" target="_blank" class="btn-social bs-light ms-2 mb-2 bs-twitter"><i class="ci-twitter"></i></a>
            @endif
            @if ( get_setting('instagram_link') !=  null )
                <a href="{{ get_setting('instagram_link') }}" target="_blank" class="btn-social bs-light ms-2 mb-2 bs-instagram"><i class="ci-instagram"></i></a>
            @endif
            @if ( get_setting('youtube_link') !=  null )
                <a href="{{ get_setting('youtube_link') }}" target="_blank" class="btn-social bs-light ms-2 mb-2 bs-youtube"><i class="ci-youtube"></i></a>
            @endif
            @if ( get_setting('linkedin_link') !=  null )
                <a href="{{ get_setting('linkedin_link') }}" target="_blank" class="btn-social bs-light ms-2 mb-2 bs-linkedin"><i class="ci-linkedin"></i></a>
            @endif
        @endif
    </div>
</div>

          <div class="row">
            <div class="container">
                <div class="text-center text-md-left mt-4">


                    <span class="pr-lg-2">
                        <span class=" text-light fw-600">{{ translate('Address') }}:</span>
                        <span class="  text-light ">{{ get_setting('contact_address',null,App::getLocale()) }}</span>
                     </span>
                     <span class="pr-lg-2">
                        <span class=" text-light fw-600">{{translate('Phone')}}:</span>
                        <span class=" text-light ">{{ get_setting('contact_phone') }}</span>
                     </span >
                     <span class="pr-lg-2">
                        <span class=" text-light fw-600">{{translate('Email')}}:</span>
                        <span class=" text-light ">
                            <a href="mailto:{{ get_setting('contact_email') }}" class="text-reset">{{ get_setting('contact_email')  }}</a>
                         </span>
                     </span>

                 </div>
               <div class="mt-2" style="text-decoration: underline;">


                     @if (Auth::check())
                     <span class="pr-2 fw-500">
                             <a class="text-light" href="{{ route('logout') }}">
                                 {{ translate('Logout') }}
                             </a>
                     </span>
                     @else
                     <span class="pr-2 fw-500">
                             <a class="text-light" href="{{ route('user.login') }}">
                                 {{ translate('Login') }}
                             </a>
                         </span>
                     @endif
                     <span class="pr-2">
                         <a class="text-light fw-500" href="{{ route('purchase_history.index') }}">
                             {{ translate('Order History') }}
                         </a>
                     </span>
                     <span class="pr-2">
                         <a class=" text-light fw-500" href="{{ route('wishlists.index') }}">
                             {{ translate('My Wishlist') }}
                         </a>
                     </span>
                     <span class="pr-2">
                         <a class=" text-light fw-500" href="{{ route('orders.track') }}">
                             {{ translate('Track Order') }}
                         </a>
                     </span>
				    <span class="pr-2">
                             <a class="text-light fw-500" href="/frequentlyaskquestion">FAQ</a>
                         </span>
				   <span class="pr-2">
                             <a class="text-light fw-500" href="/helpcenter">Help Center</a>
                         </span>
                     @if (addon_is_activated('affiliate_system'))
                     <span class="pr-2">
                             <a class="text-light fw-500" href="{{ route('affiliate.apply') }}">{{ translate('Be an affiliate partner')}}</a>
                         </span>

                     @endif

                     @if (get_setting('vendor_system_activation') == 1)
                            <span class="text-uppercase fw-500  ">
                            <a class="text-light" href="{{ route('shops.create') }}">  {{ translate('Be a Seller') }}</a>
                            </span>
                    @endif

				   {{-- <span class="pr-2 pl-2">
                         <a class="text-light fw-500" href="intent://com.brandhook.brandhookApp/#Intent;scheme=launch;package=com.brandhook.brandhookApp;S.content=WebContent;end">Open In app</a>
                     </span> --}}
                     <span class="pr-2 pl-2">
                                    <a class="text-light fw-500" href="/career">Career</a>
                                </span>



               </div>

            </div>

     </div>

        </div>

        <div class="col-md-3  mb-4">
          <div class="mb-3 d-none d-md-block text-right">
              @if ( get_setting('show_social_links') )
                  @if ( get_setting('facebook_link') !=  null )
                      <a href="{{ get_setting('facebook_link') }}" target="_blank" class="btn-social bs-light ms-2 mb-2 bs-facebook"><i class=" ci-facebook"></i></a>
                  @endif
                  @if ( get_setting('twitter_link') !=  null )
                      <a href="{{ get_setting('twitter_link') }}" target="_blank" class="btn-social bs-light ms-2 mb-2 bs-twitter"><i class="ci-twitter"></i></a>
                  @endif
                  @if ( get_setting('instagram_link') !=  null )
                      <a href="{{ get_setting('instagram_link') }}" target="_blank" class="btn-social bs-light ms-2 mb-2 bs-instagram"><i class="ci-instagram"></i></a>
                  @endif
                  @if ( get_setting('youtube_link') !=  null )
                      <a href="{{ get_setting('youtube_link') }}" target="_blank" class="btn-social bs-light ms-2 mb-2 bs-youtube"><i class="ci-youtube"></i></a>
                  @endif
                  @if ( get_setting('linkedin_link') !=  null )
                      <a href="{{ get_setting('linkedin_link') }}" target="_blank" class="btn-social bs-light ms-2 mb-2 bs-linkedin"><i class="ci-linkedin"></i></a>
                  @endif
              @endif
            </div>


             <div class="w-300px mw-100 mx-auto mx-md-0 text-right">
               @if(get_setting('play_store_link') != null)
                   <a href="{{ get_setting('play_store_link') }}" target="_blank" class="d-inline-block ml-0 mb-3 mb-md-3">
                       <img src="{{ static_asset('assets/img/play.png') }}" class="mx-100 h-40px">
                   </a>
               @endif
               @if(get_setting('app_store_link') != null)
                    <a href="{{ get_setting('app_store_link') }}" target="_blank" class="ml-3 d-inline-block">
                        <img src="{{ static_asset('assets/img/app.png') }}" class="mx-100 h-40px">
                    </a>
                @endif
            </div>

        </div>
      </div>
        <div class="row align-items-center" >
            <div class="col-lg-8">
                <div class="text-center pb-0 pb-md-4">
                    <ul class="list-inline mb-0 pl-4 pr-4">
                        @if ( get_setting('payment_method_images') !=  null )
                            @foreach (explode(',', get_setting('payment_method_images')) as $key => $value)
                                <li class="list-inline-item">
                                    <img src="{{ uploaded_asset($value) }}" height="30" class="mw-100 h-auto" style="max-height: 30px">
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="pb-4 fs-xs text-light opacity-50 text-center text-md-start fw-200" style="-webkit-font-smoothing: antialiased;">
                    {!! "©".now()->year." ".get_setting('frontend_copyright_text',null,App::getLocale())!!}
                </div>
            </div>

        </div>

     </div>
  </div>

@endsection

@section('script')
    <script>
        $(document).ready(function(){

            $.post('{{ route('home.section.featured') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_featured').html(data);
                AIZ.plugins.slickCarousel();
            });

            $.post('{{ route('home.section.custom_section_1') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#custom_section1').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.custom_section_2') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#custom_section2').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.custom_section_3') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#custom_section3').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.custom_section_4') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#custom_section4').html(data);
                AIZ.plugins.slickCarousel();
            });



            {{--$.post('{{ route('home.section.auction_products') }}', {_token:'{{ csrf_token() }}'}, function(data){--}}
            {{--    $('#auction_products').html(data);--}}
            {{--    AIZ.plugins.slickCarousel();--}}
            {{--});--}}

            $.post('{{ route('home.section.best_selling') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_selling').html(data);
                AIZ.plugins.slickCarousel();
            });

            $.post('{{ route('home.section.home_categories') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_home_categories').html(data);
                AIZ.plugins.slickCarousel();
            });

            $.post('{{ route('home.section.top10_brands') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_top10_brands').html(data);
                AIZ.plugins.slickCarousel();
            });

            $.post('{{ route('home.section.best_sellers') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_sellers').html(data);
                AIZ.plugins.slickCarousel();
            });

           

            
        });
    </script>
@endsection
