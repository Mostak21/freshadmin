@extends('frontend.layouts.app')

@section('content')
<div class="container-custom mb-2">
<div class="w100 rounded-slider">
    @if (get_setting('home_slider_images') != null)
        <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height " data-dots="true" data-autoplay="true">
            @php $slider_images = json_decode(get_setting('home_slider_images'), true);  @endphp
            @foreach ($slider_images as $key => $value)
                <div class="carousel-box rounded-slider">
                    <a href="{{ json_decode(get_setting('home_slider_links'), true)[$key] }}">
                        <img
                            class="d-block mw-100 img-fit rounded-slider shadow-sm overflow-hidden"
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

</div>
</div>
<div id="custom_section">

</div>
<div id="section_home_categories">

</div>


<div id="section_best_selling">

</div>

@if (get_setting('top10_brands') != null)
<div class="container-custom">
    <div class=" py-3 bg-white "> 
        <div class=" mb-3 d-flex justify-content-between ">
            <div>
                <h3 class="h5 fw-700 mb-0">
                    Top Brands
                </h3>
            </div>
            <div>
                <a href="{{ route('brands.all') }}" class="text-black">View All</a> 

            </div>
           
        </div>
        
    
        <div class="row row-cols-xxl-7 row-cols-xl-7 row-cols-lg-4 row-cols-md-3 row-cols-2 gutters-300">
        @php $top10_brands = json_decode(get_setting('top10_brands')); @endphp
        @foreach ($top10_brands as $key => $value)
            @php $brand = \App\Models\Brand::find($value); @endphp
            @if ($brand != null)
            <div class="col text-center">
                <a href="{{ route('products.brand', $brand->slug) }}" class="d-block p-4 mb-4 card-mobile">
                    <img src="{{ uploaded_asset($brand->logo) }}" class="lazyload mx-auto h-90px mw-100" alt="{{ $brand->getTranslation('name') }}">
                </a>
            </div>
            @endif
        @endforeach
    </div>
</div>
</div>

<div id="section_best_sellers">

</div>



<footer>
<div class="pt-5 pb-3" style="background: #4b566b">
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

</footer>
@endif
    
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $.post('{{ route('home.section.featured') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_featured').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.best_selling') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_selling').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.auction_products') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#auction_products').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.home_categories') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_home_categories').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.best_sellers') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_sellers').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.custom_section') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#custom_section').html(data);
                AIZ.plugins.slickCarousel();
            });
        });
    </script>
@endsection
