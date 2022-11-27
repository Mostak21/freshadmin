<div class=" mb-3">
    <div class="card-mobile p-2 py-3 my-3">
		
			
        {{--phone--}}
        <div class="row ">
            <div class="col-3 text-center">
              <span class=" mb-3 shadow-sm border">
                    @if (Auth::user()->avatar_original != null)
                        <img class="p-img-round img-fit" src="{{ uploaded_asset(Auth::user()->avatar_original) }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                    @else
                        <img class="p-img-round img-fit" src="{{ static_asset('assets/img/avatar-place.png') }}" class="image rounded-circle" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                    @endif
              </span>
            </div>
            <div class="col-9 text-left">
                <div class="">
                    <h4 class="h5 fs-16 mb-1 fw-600">{{ Auth::user()->name }}</h4>
                    @if(Auth::user()->phone != null)
                        <div class="text-truncate ">{{ Auth::user()->phone }}</div>
                    @else
                        <div class="text-truncate">{{ Auth::user()->email }}</div>
                    @endif
                </div>
            </div>
        </div>  
        
    </div>

    @if(Route::currentRouteName()=='dashboard')
        
  
    <div class=" p-2 card-mobile">
        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
    <div class="row">
        <div class="col-3 ">
            <div class="d-flex position-relative align-items-center container-custom h-100">
            <span>
                Name:
            </span>
             </div>
        </div>
        <div class="col-9">

            <input type="text" class="form-control-custom" placeholder="{{ translate('Your Name') }}" name="name" value="{{ Auth::user()->name }}">

        </div>
    </div>
    <input type="hidden" name="photo" value="{{ Auth::user()->avatar_original }}">
    

    <div class="row my-1"> 
        <div class="col-3">
            <div class="d-flex position-relative align-items-center container-custom h-100">
                <span>
                    Gender:
                </span>
                 </div>
        </div>
        <div class="col-9">
            <label class=" border border-sm rounded  p-2 mr-2"> <input type="radio" class=" mr-2 " name="gender" value="male"  @if( Auth::user()->gender == "male" )checked @endif>Male</label>
            <label class=" border border-sm rounded  p-2"> <input type="radio" class=" mr-2 " name="gender" value="female" @if( Auth::user()->gender == "female" )checked @endif>Female</label>
            
            

        </div>
    </div>
    
    <div class="row">
        <div class="col-3">
            <div class="d-flex position-relative align-items-center container-custom h-100">
                <span>
                    Phone:
                </span>
                 </div>
        </div>
        <div class="col-9">
            <input type="text" class="form-control-custom" placeholder="{{ translate('Your Phone')}}" name="phone" value="{{ Auth::user()->phone }}">
        </div>
    </div>
    <!--  when user doing shortcut login// order without password// provider use so that social login dont interapt here  -->
    @if(Auth::user()->password==null && Auth::user()->provider_id==null)
    <div class="row my-2">
        <span class="text-danger">*please add password for future login</span>
    </div>
    <div class="row">
        <div class="col-3">
            <div class="d-flex position-relative align-items-center container-custom h-100">
                <span>
                    Password:
                </span>
                 </div>
        </div>
        <div class="col-9">
            <input type="password" class="form-control-custom" placeholder="{{ translate('New Password') }}" name="new_password">        </div>
    </div>
  
    <div class="row">
        <div class="col-3">
            <div class="d-flex position-relative align-items-center container-custom h-100">
                <span>
                    Confirm Password:
                </span>
                 </div>
        </div>
        <div class="col-9">
            <input type="password" class="form-control-custom" placeholder="{{ translate('Confirm Password') }}" name="confirm_password">
        </div>
    </div>
    @endif
    <div class="form-group mb-0 text-right">
        <button type="submit" class="btn btn-primary btn-sm m-1">{{translate('Save')}}</button>
    </div>
        </form>
</div>  
@endif
    <div class="text-center my-3">
		<button class="btn btn-dark" onclick="growDiv()"><i class="ci-menu mr-2"></i>Account menu</button>
	</div>
<div class="card-mobile border border-lg border-gray-500">
    <div class=" rounded ">
        <div class="sidemnenu mb-3 d-none d-lg-block" id='grow'>
            <ul class="rit-side-nav-list  ">
                <li class="rit-side-nav-item ">
                    <a href="{{ route('dashboard') }}" class="rit-side-nav-link {{ areActiveRoutes(['dashboard'])}}">
                       <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-home user-panel-icon  user-panel-icon rit-side-nav-icon"></i></span>
                        <span class=" rit-side-nav-text text-black">{{ translate('Dashboard') }}</span>
                    </a>
                </li>

                @if(Auth::user()->user_type == 'delivery_boy')
                    <li class="rit-side-nav-item ">
                        <a href="{{ route('assigned-deliveries') }}" class="rit-side-nav-link {{ areActiveRoutes(['completed-delivery'])}}">
                            <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-hourglass-half user-panel-icon  user-panel-icon rit-side-nav-icon"></i></span>
                            <span class=" rit-side-nav-text text-black">
                                {{ translate('Assigned Delivery') }}
                            </span>
                        </a>
                    </li>
                    <li class="rit-side-nav-item ">
                        <a href="{{ route('pickup-deliveries') }}" class="rit-side-nav-link {{ areActiveRoutes(['completed-delivery'])}}">
                            <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-luggage-cart  user-panel-icon rit-side-nav-icon"></i></span>
                            <span class=" rit-side-nav-text text-black">
                                {{ translate('Pickup Delivery') }}
                            </span>
                        </a>
                    </li>
                    <li class="rit-side-nav-item ">
                        <a href="{{ route('on-the-way-deliveries') }}" class="rit-side-nav-link {{ areActiveRoutes(['completed-delivery'])}}">
                            <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-running  user-panel-icon rit-side-nav-icon"></i></span>
                            <span class=" rit-side-nav-text text-black">
                                {{ translate('On The Way Delivery') }}
                            </span>
                        </a>
                    </li>
                    <li class="rit-side-nav-item ">
                        <a href="{{ route('completed-deliveries') }}" class="rit-side-nav-link {{ areActiveRoutes(['completed-delivery'])}}">
                            <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-check-circle  user-panel-icon rit-side-nav-icon"></i></span>
                            <span class=" rit-side-nav-text text-black">
                                {{ translate('Completed Delivery') }}
                            </span>
                        </a>
                    </li>
                    <li class="rit-side-nav-item ">
                        <a href="{{ route('pending-deliveries') }}" class="rit-side-nav-link {{ areActiveRoutes(['pending-delivery'])}}">
                            <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-clock  user-panel-icon rit-side-nav-icon"></i></span>
                            <span class=" rit-side-nav-text text-black">
                                {{ translate('Pending Delivery') }}
                            </span>
                        </a>
                    </li>
                    <li class="rit-side-nav-item ">
                        <a href="{{ route('cancelled-deliveries') }}" class="rit-side-nav-link {{ areActiveRoutes(['cancelled-delivery'])}}">
                            <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-times-circle  user-panel-icon rit-side-nav-icon"></i></span>
                            <span class=" rit-side-nav-text text-black">
                                {{ translate('Cancelled Delivery') }}
                            </span>
                        </a>
                    </li>
                    <li class="rit-side-nav-item ">
                        <a href="{{ route('cancel-request-list') }}" class="rit-side-nav-link {{ areActiveRoutes(['cancel-request-list'])}}">
                            <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-times-circle  user-panel-icon rit-side-nav-icon"></i></span>
                            <span class=" rit-side-nav-text text-black">
                                {{ translate('Request Cancelled Delivery') }}
                            </span>
                        </a>
                    </li>
                    <li class="rit-side-nav-item ">
                        <a href="{{ route('total-collection') }}" class="rit-side-nav-link {{ areActiveRoutes(['today-collection'])}}">
                            <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-comment-dollar  user-panel-icon rit-side-nav-icon"></i></span>
                            <span class=" rit-side-nav-text text-black">
                                {{ translate('Total Collections') }}
                            </span>
                        </a>
                    </li>
                    <li class="rit-side-nav-item ">
                        <a href="{{ route('total-earnings') }}" class="rit-side-nav-link {{ areActiveRoutes(['total-earnings'])}}">
                            <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-comment-dollar  user-panel-icon rit-side-nav-icon"></i></span>
                            <span class=" rit-side-nav-text text-black">
                                {{ translate('Total Earnings') }}
                            </span>
                        </a>
                    </li>
                @else

                    @php
                        $delivery_viewed = App\Models\Order::where('user_id', Auth::user()->id)->where('delivery_viewed', 0)->get()->count();
                        $payment_status_viewed = App\Models\Order::where('user_id', Auth::user()->id)->where('payment_status_viewed', 0)->get()->count();
                    @endphp
                    <li class="rit-side-nav-item">
                        <a href="{{ route('purchase_history.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['purchase_history.index'])}}">
                            <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-file-alt user-panel-icon  user-panel-icon rit-side-nav-icon"></i></span>
                            <span class=" rit-side-nav-text text-black">{{ translate('Purchase History') }}</span>
                            @if($delivery_viewed > 0 || $payment_status_viewed > 0)<span class="badge badge-inline badge-success">{{ translate('New') }}</span>@endif
                        </a>
                    </li>

                    <li class="rit-side-nav-item ">
                        <a href="{{ route('digital_purchase_history.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['digital_purchase_history.index'])}}">
                            <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-download  user-panel-icon rit-side-nav-icon"></i></span>
                            <span class=" rit-side-nav-text text-black">{{ translate('Downloads') }}</span>
                        </a>
                    </li>

                    @if (addon_is_activated('refund_request'))
                        <li class="rit-side-nav-item ">
                            <a href="{{ route('customer_refund_request') }}" class="rit-side-nav-link {{ areActiveRoutes(['customer_refund_request'])}}">
                                <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-backward  user-panel-icon rit-side-nav-icon"></i></span>
                                <span class=" rit-side-nav-text text-black">{{ translate('Sent Refund Request') }}</span>
                            </a>
                        </li>
                    @endif

                    <li class="rit-side-nav-item ">
                        <a href="{{ route('wishlists.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['wishlists.index'])}}">
                            <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="la la-heart-o  user-panel-icon rit-side-nav-icon"></i></span>
                            <span class=" rit-side-nav-text text-black">{{ translate('Wishlist') }}</span>
                        </a>
                    </li>

                    <li class="rit-side-nav-item ">
                        <a href="{{ route('compare') }}" class="rit-side-nav-link {{ areActiveRoutes(['compare'])}}">
                            <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="la la-refresh  user-panel-icon rit-side-nav-icon"></i></span>
                            <span class=" rit-side-nav-text text-black">{{ translate('Compare') }}</span>
                        </a>
                    </li>

                    @if(Auth::user()->user_type == 'seller')
                        <li class="rit-side-nav-item ">
                            <a href="{{ route('seller.products') }}" class="rit-side-nav-link {{ areActiveRoutes(['seller.products', 'seller.products.upload', 'seller.products.edit'])}}">
                                <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="lab la-sketch  user-panel-icon rit-side-nav-icon"></i></span>
                                <span class=" rit-side-nav-text text-black">{{ translate('Products') }}</span>
                            </a>
                        </li>
                        <li class="rit-side-nav-item ">
                            <a href="{{route('product_bulk_upload.index')}}" class="rit-side-nav-link {{ areActiveRoutes(['product_bulk_upload.index'])}}">
                                <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-upload  user-panel-icon rit-side-nav-icon"></i></span>
                                <span class=" rit-side-nav-text text-black">{{ translate('Product Bulk Upload') }}</span>
                            </a>
                        </li>
                        <li class="rit-side-nav-item ">
                            <a href="{{ route('seller.digitalproducts') }}" class="rit-side-nav-link {{ areActiveRoutes(['seller.digitalproducts', 'seller.digitalproducts.upload', 'seller.digitalproducts.edit'])}}">
                                <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="lab la-sketch  user-panel-icon rit-side-nav-icon"></i></span>
                                <span class=" rit-side-nav-text text-black">{{ translate('Digital Products') }}</span>
                            </a>
                        </li>
                        <li class="rit-side-nav-item ">
                            <a href="{{ route('my_uploads.all') }}" class="rit-side-nav-link {{ areActiveRoutes(['my_uploads.new'])}}">
                                <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-folder-open  user-panel-icon rit-side-nav-icon"></i></span>
                                <span class=" rit-side-nav-text text-black">{{ translate('Uploaded Files') }}</span>
                            </a>
                        </li>
                        <li class="rit-side-nav-item ">
                            <a href="{{ route('seller.coupon.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['my_uploads.new'])}}">
                                <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-bullhorn  user-panel-icon rit-side-nav-icon"></i></span>
                                <span class=" rit-side-nav-text text-black">{{ translate('Coupon') }}</span>
                            </a>
                        </li>
                    @endif

                    @if(get_setting('classified_product') == 1)
                        <li class="rit-side-nav-item ">
                            <a href="{{ route('customer_products.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['customer_products.index', 'customer_products.create', 'customer_products.edit'])}}">
                                <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="lab la-sketch  user-panel-icon rit-side-nav-icon"></i></span>
                                <span class=" rit-side-nav-text text-black">{{ translate('Classified Products') }}</span>
                            </a>
                        </li>
                    @endif

                    @if(addon_is_activated('auction'))
                        <li class="rit-side-nav-item ">
                            <a href="javascript:void(0);" class="rit-side-nav-link">
                                <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-gavel  user-panel-icon rit-side-nav-icon"></i></span>
                                <span class=" rit-side-nav-text text-black">{{ translate('Auction') }}</span>
                                <span class="rit-side-nav-arrow"></span>
                            </a>
                            <ul class="rit-side-nav-list level-2">
                                @if (Auth::user()->user_type == 'seller')
                                    <li class="rit-side-nav-item ">
                                        <a href="{{ route('auction_products.seller.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['auction_products.seller.index','auction_products.create','auction_products.edit'])}}">
                                            <span class=" rit-side-nav-text text-black">{{ translate('All Auction Products') }}</span>
                                        </a>
                                    </li>
                                    <li class="rit-side-nav-item ">
                                        <a href="{{ route('auction_products_orders.seller') }}" class="rit-side-nav-link {{ areActiveRoutes(['auction_products_orders.seller'])}}">
                                            <span class=" rit-side-nav-text text-black">{{ translate('Auction Product Orders') }}</span>
                                        </a>
                                    </li>
                                @endif
                                <li class="rit-side-nav-item ">
                                    <a href="{{ route('auction_product_bids.index') }}" class="rit-side-nav-link">
                                        <span class=" rit-side-nav-text text-black">{{ translate('Bidded Products') }}</span>
                                    </a>
                                </li>
                                <li class="rit-side-nav-item ">
                                    <a href="{{ route('auction_product.purchase_history') }}" class="rit-side-nav-link">
                                        <span class=" rit-side-nav-text text-black">{{ translate('Purchase History') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if(Auth::user()->user_type == 'seller')
                        @if (addon_is_activated('pos_system'))
                            @if (\App\Models\BusinessSetting::where('type', 'pos_activation_for_seller')->first() != null && get_setting('pos_activation_for_seller') != 0)
                                <li class="rit-side-nav-item ">
                                    <a href="{{ route('poin-of-sales.seller_index') }}" class="rit-side-nav-link {{ areActiveRoutes(['poin-of-sales.seller_index'])}}">
                                        <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-fax  user-panel-icon rit-side-nav-icon"></i></span>
                                        <span class=" rit-side-nav-text text-black">{{ translate('POS Manager') }}</span>
                                    </a>
                                </li>
                            @endif
                        @endif
                        <li class="rit-side-nav-item ">
                            <a href="{{ route('orders.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['orders.index'])}}">
                                <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-money-bill  user-panel-icon rit-side-nav-icon"></i></span>
                                <span class=" rit-side-nav-text text-black">{{ translate('Orders') }}</span>
                            </a>
                        </li>

                        @if (addon_is_activated('refund_request'))
                            <li class="rit-side-nav-item ">
                                <a href="{{ route('vendor_refund_request') }}" class="rit-side-nav-link {{ areActiveRoutes(['vendor_refund_request','reason_show'])}}">
                                    <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-backward  user-panel-icon rit-side-nav-icon"></i></span>
                                    <span class=" rit-side-nav-text text-black">{{ translate('Received Refund Request') }}</span>
                                </a>
                            </li>
                        @endif
                        <li class="rit-side-nav-item ">
                            <a href="{{ route('reviews.seller') }}" class="rit-side-nav-link {{ areActiveRoutes(['reviews.seller'])}}">
                                <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-star-half-alt  user-panel-icon rit-side-nav-icon"></i></span>
                                <span class=" rit-side-nav-text text-black">{{ translate('Product Reviews') }}</span>
                            </a>
                        </li>

                        <li class="rit-side-nav-item ">
                            <a href="{{ route('shops.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['shops.index'])}}">
                                <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-cog  user-panel-icon rit-side-nav-icon"></i></span>
                                <span class=" rit-side-nav-text text-black">{{ translate('Shop Setting') }}</span>
                            </a>
                        </li>

                        <li class="rit-side-nav-item ">
                            <a href="{{ route('payments.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['payments.index'])}}">
                                <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-history  user-panel-icon rit-side-nav-icon"></i></span>
                                <span class=" rit-side-nav-text text-black">{{ translate('Payment History') }}</span>
                            </a>
                        </li>

                        <li class="rit-side-nav-item ">
                            <a href="{{ route('withdraw_requests.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['withdraw_requests.index'])}}">
                                <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-money-bill-wave-alt  user-panel-icon rit-side-nav-icon"></i></span>
                                <span class=" rit-side-nav-text text-black">{{ translate('Money Withdraw') }}</span>
                            </a>
                        </li>

                        <li class="rit-side-nav-item ">
                            <a href="{{ route('commission-log.index') }}" class="rit-side-nav-link">
                                <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-file-alt  user-panel-icon rit-side-nav-icon"></i></span>
                                <span class=" rit-side-nav-text text-black">{{ translate('Commission History') }}</span>
                            </a>
                        </li>

                    @endif

                    @if (get_setting('conversation_system') == 1)
                        @php
                            $conversation = \App\Models\Conversation::where('sender_id', Auth::user()->id)->where('sender_viewed', 0)->get();
                        @endphp
                        <li class="rit-side-nav-item ">
                            <a href="{{ route('conversations.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['conversations.index', 'conversations.show'])}}">
                                <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-comment  user-panel-icon rit-side-nav-icon"></i></span>
                                <span class=" rit-side-nav-text text-black">{{ translate('Conversations') }}</span>
                                @if (count($conversation) > 0)
                                    <span class="badge badge-success">({{ count($conversation) }})</span>
                                @endif
                            </a>
                        </li>
                    @endif


                    @if (get_setting('wallet_system') == 1)
                        <li class="rit-side-nav-item ">
                            <a href="{{ route('wallet.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['wallet.index'])}}">
                                <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-dollar-sign  user-panel-icon rit-side-nav-icon"></i></span>
                                <span class=" rit-side-nav-text text-black">{{translate('My Wallet')}}</span>
                            </a>
                        </li>
                    @endif

                    @if (addon_is_activated('club_point'))
                        <li class="rit-side-nav-item ">
                            <a href="{{ route('earnng_point_for_user') }}" class="rit-side-nav-link {{ areActiveRoutes(['earnng_point_for_user'])}}">
                                <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-dollar-sign  user-panel-icon rit-side-nav-icon"></i></span>
                                <span class=" rit-side-nav-text text-black">{{translate('Earning Points')}}</span>
                            </a>
                        </li>
                    @endif

                    @if (addon_is_activated('affiliate_system') && Auth::user()->affiliate_user != null && Auth::user()->affiliate_user->status)
                        <li class="rit-side-nav-item ">
                            <a href="javascript:void(0);" class="rit-side-nav-link {{ areActiveRoutes(['affiliate.user.index', 'affiliate.payment_settings'])}}">
                                <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-dollar-sign  user-panel-icon rit-side-nav-icon"></i></span>
                                <span class=" rit-side-nav-text text-black">{{ translate('Affiliate') }}</span>
                                <span class="rit-side-nav-arrow"></span>
                            </a>
                            <ul class="rit-side-nav-list level-2">
                                <li class="rit-side-nav-item ">
                                    <a href="{{ route('affiliate.user.index') }}" class="rit-side-nav-link">
                                        <span class=" rit-side-nav-text text-black">{{ translate('Affiliate System') }}</span>
                                    </a>
                                </li>
                                <li class="rit-side-nav-item ">
                                    <a href="{{ route('affiliate.user.payment_history') }}" class="rit-side-nav-link">
                                        <span class=" rit-side-nav-text text-black">{{ translate('Payment History') }}</span>
                                    </a>
                                </li>
                                <li class="rit-side-nav-item ">
                                    <a href="{{ route('affiliate.user.withdraw_request_history') }}" class="rit-side-nav-link">
                                        <span class=" rit-side-nav-text text-black">{{ translate('Withdraw request history') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @php
                        $support_ticket = DB::table('tickets')
                                    ->where('client_viewed', 0)
                                    ->where('user_id', Auth::user()->id)
                                    ->count();
                    @endphp

                    <li class="rit-side-nav-item ">
                        <a href="{{ route('support_ticket.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['support_ticket.index'])}}">
                            <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-atom  user-panel-icon rit-side-nav-icon"></i></span>
                            <span class=" rit-side-nav-text text-black">{{translate('Support Ticket')}}</span>
                            @if($support_ticket > 0)<span class="badge badge-inline badge-success">{{ $support_ticket }}</span> @endif
                        </a>
                    </li>
                @endif
                <li class="rit-side-nav-item ">
                    <a href="{{ route('profile') }}" class="rit-side-nav-link {{ areActiveRoutes(['profile'])}}">
                        <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-user  user-panel-icon rit-side-nav-icon"></i></span>
                        <span class=" rit-side-nav-text text-black">{{translate('Manage Profile')}}</span>
                    </a>
                </li>
				<li class="rit-side-nav-item ">
				 <a class="rit-side-nav-link" href="{{ route('logout') }}">
            <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-sign-out-alt  user-panel-icon rit-side-nav-icon fs-18 mr-2"></i></span>
					 <span class=" rit-side-nav-text text-black">{{ translate('Logout') }}</span> 
        </a>
</li>
            </ul>
			@if (get_setting('vendor_system_activation') == 1 && Auth::user()->user_type == 'customer')
            <div class="p-2" id="beseller">
                <a href="{{ route('shops.create') }}" class="btn btn-block btn-soft-dark btn-outline-dark  rounded-custom ">
                   {{ translate('Be A Seller') }}
                </a>
            </div>
        @endif
        </div>
       
        @if(Auth::user()->user_type == 'seller')
          <hr>
          <h4 class="h5 fw-600 text-center">{{ translate('Sold Amount')}}</h4>
          @php
              $date = date("Y-m-d");
              $days_ago_30 = date('Y-m-d', strtotime('-30 days', strtotime($date)));
              $days_ago_60 = date('Y-m-d', strtotime('-60 days', strtotime($date)));
          @endphp
          <div class="widget-balance pb-3 pt-1">
            <div class="text-center">
                <div class="heading-4 strong-700 mb-4">
                    @php
                        $orderTotal = \App\Models\Order::where('seller_id', Auth::user()->id)->where("payment_status", 'paid')->where('created_at', '>=', $days_ago_30)->sum('grand_total');
                        //$orderDetails = \App\Models\OrderDetail::where('seller_id', Auth::user()->id)->where('created_at', '>=', $days_ago_30)->get();
                        //$total = 0;
                        //foreach ($orderDetails as $key => $orderDetail) {
                            //if($orderDetail->order != null && $orderDetail->order != null && $orderDetail->order->payment_status == 'paid'){
                                //$total += $orderDetail->price;
                            //}
                        //}
                    @endphp
                    <small class="d-block fs-12 mb-2">{{ translate('Your sold amount (current month)')}}</small>
                    <span class="btn btn-primary fw-600 fs-18">{{ single_price($orderTotal) }}</span>
                </div>
                <table class="table table-borderless">
                    <tr>
                        @php
                            $orderTotal = \App\Models\Order::where('seller_id', Auth::user()->id)->where("payment_status", 'paid')->sum('grand_total');
                        @endphp
                        <td class="p-1" width="60%">
                            {{ translate('Total Sold')}}:
                        </td>
                        <td class="p-1 fw-600" width="40%">
                            {{ single_price($orderTotal) }}
                        </td>
                    </tr>
                    <tr>
                        @php
                            $orderTotal = \App\Models\Order::where('seller_id', Auth::user()->id)->where("payment_status", 'paid')->where('created_at', '>=', $days_ago_60)->where('created_at', '<=', $days_ago_30)->sum('grand_total');
                        @endphp
                        <td class="p-1" width="60%">
                            {{ translate('Last Month Sold')}}:
                        </td>
                        <td class="p-1 fw-600" width="40%">
                            {{ single_price($orderTotal) }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        @endif

    </div>

    <div class="fixed-bottom d-xl-none bg-white border-top d-flex justify-content-between px-2" style="box-shadow: 0 -5px 10px rgb(0 0 0 / 10%);">
        <a class="btn btn-sm p-2 d-flex align-items-center" href="{{ route('logout') }}">
            <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-sign-out-alt fs-18 mr-2"></i></span>
            <span>{{ translate('Logout') }}</span>
        </a>
        <button class="btn btn-sm p-2 " data-toggle="class-toggle" data-backdrop="static" data-target=".rit-mobile-side-nav" data-same=".mobile-side-nav-thumb">
            <span class="user-panel-icon-bg bg-soft-dark mr-3" ><i class="las la-times la-2x"></i></span>
        </button>
    </div>
</div>
								</div>