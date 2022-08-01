<footer>
{{--<section class="bg-white border-top mt-auto">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-3 col-md-6">
                <a class="text-reset border-left text-center p-4 d-block" href="{{ route('terms') }}">
                    <i class="la la-file-text la-3x text-primary mb-2"></i>
                    <h4 class="h6">{{ translate('Terms & conditions') }}</h4>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a class="text-reset border-left text-center p-4 d-block" href="{{ route('returnpolicy') }}">
                    <i class="la la-mail-reply la-3x text-primary mb-2"></i>
                    <h4 class="h6">{{ translate('Return Policy') }}</h4>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a class="text-reset border-left text-center p-4 d-block" href="{{ route('supportpolicy') }}">
                    <i class="la la-support la-3x text-primary mb-2"></i>
                    <h4 class="h6">{{ translate('Support Policy') }}</h4>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a class="text-reset border-left border-right text-center p-4 d-block" href="{{ route('privacypolicy') }}">
                    <i class="las la-exclamation-circle la-3x text-primary mb-2"></i>
                    <h4 class="h6">{{ translate('Privacy Policy') }}</h4>
                </a>
            </div>
        </div>
    </div>
</section>--}}
<div class="pt-5" style="background: #4b566b">
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
{{--                @if(get_setting('play_store_link') != null)--}}
{{--                    <a href="{{ get_setting('play_store_link') }}" target="_blank" class="d-inline-block ml-0 mb-3 mb-md-3">--}}
{{--                        <img src="{{ static_asset('assets/img/play.png') }}" class="mx-100 h-40px">--}}
{{--                    </a>--}}
{{--                @endif--}}
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


<div class="aiz-mobile-bottom-nav d-xl-none fixed-bottom bg-white shadow-lg border-top rounded-top" style="box-shadow: 0px -1px 10px rgb(0 0 0 / 15%)!important; ">
    <div class="row align-items-center gutters-5">
        <div class="col">
            <a href="{{ route('home') }}" class="text-reset d-block text-center pb-2 pt-3">
                <i class="las la-home fs-20 opacity-60 {{ areActiveRoutes(['home'],'opacity-100 text-primary')}}"></i>
                <span class="d-block fs-10 fw-600 opacity-60 {{ areActiveRoutes(['home'],'opacity-100 fw-600')}}">{{ translate('Home') }}</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('categories.all') }}" class="text-reset d-block text-center pb-2 pt-3">
                <i class="las la-list-ul fs-20 opacity-60 {{ areActiveRoutes(['categories.all'],'opacity-100 text-primary')}}"></i>
                <span class="d-block fs-10 fw-600 opacity-60 {{ areActiveRoutes(['categories.all'],'opacity-100 fw-600')}}">{{ translate('Categories') }}</span>
            </a>
        </div>
        @php
            if(auth()->user() != null) {
                $user_id = Auth::user()->id;
                $cart = \App\Models\Cart::where('user_id', $user_id)->get();
            } else {
                $temp_user_id = Session()->get('temp_user_id');
                if($temp_user_id) {
                    $cart = \App\Models\Cart::where('temp_user_id', $temp_user_id)->get();
                }
            }
        @endphp
        <div class="col-auto">
            <a href="{{ route('cart') }}" class="text-reset d-block text-center pb-2 pt-3">
                <span class="align-items-center bg-primary border border-white border-width-4 d-flex justify-content-center position-relative rounded-circle size-50px" style="margin-top: -33px;box-shadow: 0px -5px 10px rgb(0 0 0 / 15%);border-color: #fff !important;">
                    <i class="las la-shopping-bag la-2x text-white"></i>
                </span>
                <span class="d-block mt-1 fs-10 fw-600 opacity-60 {{ areActiveRoutes(['cart'],'opacity-100 fw-600')}}">
                    {{ translate('Cart') }}
                    @php
                        $count = (isset($cart) && count($cart)) ? count($cart) : 0;
                    @endphp
                    (<span class="cart-count">{{$count}}</span>)
                </span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('all-notifications') }}" class="text-reset d-block text-center pb-2 pt-3">
                <span class="d-inline-block position-relative px-2">
                    <i class="las la-bell fs-20 opacity-60 {{ areActiveRoutes(['all-notifications'],'opacity-100 text-primary')}}"></i>
                    @if(Auth::check() && count(Auth::user()->unreadNotifications) > 0)
                        <span class="badge badge-sm badge-dot badge-circle badge-primary position-absolute absolute-top-right" style="right: 7px;top: -2px;"></span>
                    @endif
                </span>
                <span class="d-block fs-10 fw-600 opacity-60 {{ areActiveRoutes(['all-notifications'],'opacity-100 fw-600')}}">{{ translate('Notifications') }}</span>
            </a>
        </div>
        <div class="col">
        @if (Auth::check())
            @if(isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="text-reset d-block text-center pb-2 pt-3">
                    <span class="d-block mx-auto">
                        @if(Auth::user()->photo != null)
                            <img src="{{ custom_asset(Auth::user()->avatar_original)}}" class="rounded-circle size-20px">
                        @else
                            <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="rounded-circle size-20px">
                        @endif
                    </span>
                    <span class="d-block fs-10 fw-600 opacity-60">{{ translate('Account') }}</span>
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="text-reset d-block text-center pb-2 pt-3 mobile-side-nav-thumb" >
                    <span class="d-block mx-auto">
                        @if(Auth::user()->photo != null)
                            <img src="{{ custom_asset(Auth::user()->avatar_original)}}" class="rounded-circle size-20px">
                        @else
                            <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="rounded-circle size-20px">
                        @endif
                    </span>
                    <span class="d-block fs-10 fw-600 opacity-60">{{ translate('Account') }}</span>
                </a>
            @endif
        @else
            <a href="{{ route('user.login') }}" class="text-reset d-block text-center pb-2 pt-3">
                <span class="d-block mx-auto">
                    <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="rounded-circle size-20px">
                </span>
                <span class="d-block fs-10 fw-600 opacity-60">{{ translate('Account') }}</span>
            </a>
        @endif
        </div>
    </div>
</div>
@if (Auth::check() && !isAdmin())
    <div class="aiz-mobile-side-nav collapxe-sidebar-wrap sidebar-xl d-xl-none z-1035">
        <div class="overlay dark c-pointer overlay-fixed" data-toggle="class-toggle" data-backdrop="static" data-target=".aiz-mobile-side-nav" data-same=".mobile-side-nav-thumb"></div>
        <div class="collapxe-sidebar bg-white">
            @include('frontend.inc.user_side_nav')
        </div>
    </div>
@endif
