<div class="mt-5">
</div>

@if(Route::currentRouteName()!='product')
<div class="rit-mobile-bottom-nav d-xl-none fixed-bottom bg-white shadow-lg border-top rounded-footer-top" style="box-shadow: 0px -1px 20px rgb(0 0 0 / 15%)!important; ">
    <div class="mx-4 mb-3"><div class="row align-items-center gutters-5">
         <div class="col">
             <a href="{{ route('home') }}" class="text-reset d-block text-center pb-2 pt-3">
                 {{-- <i class="las la-home fs-20 opacity-60 {{ areActiveRoutes(['home'],'opacity-100 text-primary')}}"></i> --}}
                 <img class="footer_icon_size" src="{{ static_asset('m_asset/home.png') }}" alt="">
             </a>
         </div>
         <div class="col">
             <a href="{{ route('categories.all') }}" class="text-reset d-block text-center pb-2 pt-3">
                 <img src="{{ static_asset('m_asset/category.png') }}" class="footer_icon_size {{ areActiveRoutes(['categories.all'],'opacity-100 ')}}"/>
            
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
         <div class="col">
             <a href="{{ route('cart') }}" class="text-reset d-block text-center pb-2 pt-3">
                 {{-- <span class="align-items-center bg-primary border border-white border-width-4 d-flex justify-content-center position-relative rounded-circle size-50px" style="margin-top: -33px;box-shadow: 0px -5px 10px rgb(0 0 0 / 15%);border-color: #fff !important;">
                     <i class="las la-shopping-bag la-2x text-white"></i>
                 </span>
                 <span class="d-block mt-1 fs-10 fw-600 opacity-60 {{ areActiveRoutes(['cart'],'opacity-100 fw-600')}}">
                     {{ translate('Cart') }}
                     @php
                         $count = (isset($cart) && count($cart)) ? count($cart) : 0;
                     @endphp
                     (<span class="cart-count">{{$count}}</span>)
                 </span> --}}
                    @php
                         $count = (isset($cart) && count($cart)) ? count($cart) : 0;
                     @endphp
                 <img class="footer_icon_size mr-1" src="{{ static_asset('m_asset/cart.png') }}" alt=""><span class="rounded-circle bg-dark text-light fw-500" id="cart_items_sidenav" style=" padding-left: 6px; padding-right: 6px; margin-top: -5px; position: absolute; ">{{$count}}</span>
             </a>
         </div>
         {{-- <div class="col">
             <a href="{{ route('all-notifications') }}" class="text-reset d-block text-center pb-2 pt-3">
                 <span class="d-inline-block position-relative px-2">
                     <i class="las la-bell fs-20 opacity-60 {{ areActiveRoutes(['all-notifications'],'opacity-100 text-primary')}}"></i>
                     @if(Auth::check() && count(Auth::user()->unreadNotifications) > 0)
                         <span class="badge badge-sm badge-dot badge-circle badge-primary position-absolute absolute-top-right" style="right: 7px;top: -2px;"></span>
                     @endif
                 </span>
                 <span class="d-block fs-10 fw-600 opacity-60 {{ areActiveRoutes(['all-notifications'],'opacity-100 fw-600')}}">{{ translate('Notifications') }}</span>
                 <img class="footer_icon_size" src="{{ static_asset('m_asset/notification.png') }}" alt="">
             </a>
         </div> --}}
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
                    
                 </a>
             @endif
         @else
             <a href="{{ route('user.login') }}" class="text-reset d-block text-center pb-2 pt-3">
                 <span class="d-block mx-auto">
                     <img class="footer_icon_size" src="{{ static_asset('m_asset/profile.png') }}" alt="">
                 </span>
                 
             </a>
         @endif
         </div></div> 
     </div>
 </div>
 @endif
 @if (Auth::check() && !isAdmin())
     <div class="rit-mobile-side-nav collapxe-sidebar-wrap sidebar-xl d-xl-none z-1035">
         <div class="overlay dark c-pointer overlay-fixed" data-toggle="class-toggle" data-backdrop="static" data-target=".rit-mobile-side-nav" data-same=".mobile-side-nav-thumb"></div>
         <div class="collapxe-sidebar bg-white">
             @include('frontend.inc.user_side_nav')
         </div>
     </div>
 @endif
