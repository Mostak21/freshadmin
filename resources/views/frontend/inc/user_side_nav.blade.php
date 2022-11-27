<div class="pr-lg-5 mb-3">

<div class="shadow-lg bg-white">
    <div class=" rounded pb-5 pb-xl-0">
        <div class="p-4">
			<div class="row">
				<div class="col-md-5  d-none d-lg-block">
				  <span class="avatar avatar-lg mb-3 shadow-sm border">
                @if (Auth::user()->avatar_original != null)
                    <img src="{{ uploaded_asset(Auth::user()->avatar_original) }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                @else
                    <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="image rounded-circle" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                @endif
            </span>
				</div>
				<div class="col-md-7  d-none d-lg-block">
					<div class="my-auto"   style="padding: 30px 0;">
				<h4 class="h5 fs-16 mb-1 fw-600">{{ Auth::user()->name }}</h4>
            @if(Auth::user()->phone != null)
                <div class="text-truncate ">{{ Auth::user()->phone }}</div>
            @else
                <div class="text-truncate">{{ Auth::user()->email }}</div>
            @endif</div>
				</div>
			</div>
			
			{{--phone--}}
			<div class="row d-lg-none">
				<div class="col-md-5 text-center">
				  <span class="avatar avatar-lg mb-3 shadow-sm border">
                @if (Auth::user()->avatar_original != null)
                    <img src="{{ uploaded_asset(Auth::user()->avatar_original) }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                @else
                    <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="image rounded-circle" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                @endif
            </span>
				</div>
				<div class="col-md-7 text-center">
					<div class="">
				<h4 class="h5 fs-16 mb-1 fw-600">{{ Auth::user()->name }}</h4>
            @if(Auth::user()->phone != null)
                <div class="text-truncate ">{{ Auth::user()->phone }}</div>
            @else
                <div class="text-truncate">{{ Auth::user()->email }}</div>
            @endif</div>
				</div>
			</div>
			
			
          
            
        </div>
		<div class="text-center">
		<button class="btn btn-primary d-lg-none" onclick="growDiv()"><i class="ci-menu mr-2"></i>Account menu</button>
		</div>
        <div class="sidemnenu mb-3 d-none d-lg-block" id='grow'>
            <ul class="rit-side-nav-list  ">

                <li class="rit-side-nav-item py-2 border-bottom">
                    <a href="{{ route('dashboard') }}" class="rit-side-nav-link {{ areActiveRoutes(['dashboard'])}}">
                        <i class="las la-home rit-side-nav-icon"></i>
                        <span class="rit-side-nav-text">{{ translate('Dashboard') }}</span>
                    </a>
                </li>

                @if(Auth::user()->user_type == 'delivery_boy')
                    <li class="rit-side-nav-item py-2 border-bottom">
                        <a href="{{ route('assigned-deliveries') }}" class="rit-side-nav-link {{ areActiveRoutes(['completed-delivery'])}}">
                            <i class="las la-hourglass-half rit-side-nav-icon"></i>
                            <span class="rit-side-nav-text">
                                {{ translate('Assigned Delivery') }}
                            </span>
                        </a>
                    </li>
                    <li class="rit-side-nav-item py-2 border-bottom">
                        <a href="{{ route('pickup-deliveries') }}" class="rit-side-nav-link {{ areActiveRoutes(['completed-delivery'])}}">
                            <i class="las la-luggage-cart rit-side-nav-icon"></i>
                            <span class="rit-side-nav-text">
                                {{ translate('Pickup Delivery') }}
                            </span>
                        </a>
                    </li>
                    <li class="rit-side-nav-item py-2 border-bottom">
                        <a href="{{ route('on-the-way-deliveries') }}" class="rit-side-nav-link {{ areActiveRoutes(['completed-delivery'])}}">
                            <i class="las la-running rit-side-nav-icon"></i>
                            <span class="rit-side-nav-text">
                                {{ translate('On The Way Delivery') }}
                            </span>
                        </a>
                    </li>
                    <li class="rit-side-nav-item py-2 border-bottom">
                        <a href="{{ route('completed-deliveries') }}" class="rit-side-nav-link {{ areActiveRoutes(['completed-delivery'])}}">
                            <i class="las la-check-circle rit-side-nav-icon"></i>
                            <span class="rit-side-nav-text">
                                {{ translate('Completed Delivery') }}
                            </span>
                        </a>
                    </li>
                    <li class="rit-side-nav-item py-2 border-bottom">
                        <a href="{{ route('pending-deliveries') }}" class="rit-side-nav-link {{ areActiveRoutes(['pending-delivery'])}}">
                            <i class="las la-clock rit-side-nav-icon"></i>
                            <span class="rit-side-nav-text">
                                {{ translate('Pending Delivery') }}
                            </span>
                        </a>
                    </li>
                    <li class="rit-side-nav-item py-2 border-bottom">
                        <a href="{{ route('cancelled-deliveries') }}" class="rit-side-nav-link {{ areActiveRoutes(['cancelled-delivery'])}}">
                            <i class="las la-times-circle rit-side-nav-icon"></i>
                            <span class="rit-side-nav-text">
                                {{ translate('Cancelled Delivery') }}
                            </span>
                        </a>
                    </li>
                    <li class="rit-side-nav-item py-2 border-bottom">
                        <a href="{{ route('cancel-request-list') }}" class="rit-side-nav-link {{ areActiveRoutes(['cancel-request-list'])}}">
                            <i class="las la-times-circle rit-side-nav-icon"></i>
                            <span class="rit-side-nav-text">
                                {{ translate('Request Cancelled Delivery') }}
                            </span>
                        </a>
                    </li>
                    <li class="rit-side-nav-item py-2 border-bottom">
                        <a href="{{ route('total-collection') }}" class="rit-side-nav-link {{ areActiveRoutes(['today-collection'])}}">
                            <i class="las la-comment-dollar rit-side-nav-icon"></i>
                            <span class="rit-side-nav-text">
                                {{ translate('Total Collections') }}
                            </span>
                        </a>
                    </li>
                    <li class="rit-side-nav-item py-2 border-bottom">
                        <a href="{{ route('total-earnings') }}" class="rit-side-nav-link {{ areActiveRoutes(['total-earnings'])}}">
                            <i class="las la-comment-dollar rit-side-nav-icon"></i>
                            <span class="rit-side-nav-text">
                                {{ translate('Total Earnings') }}
                            </span>
                        </a>
                    </li>
                @else

                    @php
                        $delivery_viewed = App\Models\Order::where('user_id', Auth::user()->id)->where('delivery_viewed', 0)->get()->count();
                        $payment_status_viewed = App\Models\Order::where('user_id', Auth::user()->id)->where('payment_status_viewed', 0)->get()->count();
                    @endphp
                    <li class="rit-side-nav-item py-2 border-bottom">
                        <a href="{{ route('purchase_history.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['purchase_history.index'])}}">
                            <i class="las la-file-alt rit-side-nav-icon"></i>
                            <span class="rit-side-nav-text">{{ translate('Purchase History') }}</span>
                            @if($delivery_viewed > 0 || $payment_status_viewed > 0)<span class="badge badge-inline badge-success">{{ translate('New') }}</span>@endif
                        </a>
                    </li>

                    <li class="rit-side-nav-item py-2 border-bottom">
                        <a href="{{ route('digital_purchase_history.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['digital_purchase_history.index'])}}">
                            <i class="las la-download rit-side-nav-icon"></i>
                            <span class="rit-side-nav-text">{{ translate('Downloads') }}</span>
                        </a>
                    </li>

                    @if (addon_is_activated('refund_request'))
                        <li class="rit-side-nav-item py-2 border-bottom">
                            <a href="{{ route('customer_refund_request') }}" class="rit-side-nav-link {{ areActiveRoutes(['customer_refund_request'])}}">
                                <i class="las la-backward rit-side-nav-icon"></i>
                                <span class="rit-side-nav-text">{{ translate('Sent Refund Request') }}</span>
                            </a>
                        </li>
                    @endif

                    <li class="rit-side-nav-item py-2 border-bottom">
                        <a href="{{ route('wishlists.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['wishlists.index'])}}">
                            <i class="la la-heart-o rit-side-nav-icon"></i>
                            <span class="rit-side-nav-text">{{ translate('Wishlist') }}</span>
                        </a>
                    </li>

                    <li class="rit-side-nav-item py-2 border-bottom">
                        <a href="{{ route('compare') }}" class="rit-side-nav-link {{ areActiveRoutes(['compare'])}}">
                            <i class="la la-refresh rit-side-nav-icon"></i>
                            <span class="rit-side-nav-text">{{ translate('Compare') }}</span>
                        </a>
                    </li>

                    @if(Auth::user()->user_type == 'seller')
                        <li class="rit-side-nav-item py-2 border-bottom">
                            <a href="{{ route('seller.products') }}" class="rit-side-nav-link {{ areActiveRoutes(['seller.products', 'seller.products.upload', 'seller.products.edit'])}}">
                                <i class="lab la-sketch rit-side-nav-icon"></i>
                                <span class="rit-side-nav-text">{{ translate('Products') }}</span>
                            </a>
                        </li>
                        <li class="rit-side-nav-item py-2 border-bottom">
                            <a href="{{route('product_bulk_upload.index')}}" class="rit-side-nav-link {{ areActiveRoutes(['product_bulk_upload.index'])}}">
                                <i class="las la-upload rit-side-nav-icon"></i>
                                <span class="rit-side-nav-text">{{ translate('Product Bulk Upload') }}</span>
                            </a>
                        </li>
                        <li class="rit-side-nav-item py-2 border-bottom">
                            <a href="{{ route('seller.digitalproducts') }}" class="rit-side-nav-link {{ areActiveRoutes(['seller.digitalproducts', 'seller.digitalproducts.upload', 'seller.digitalproducts.edit'])}}">
                                <i class="lab la-sketch rit-side-nav-icon"></i>
                                <span class="rit-side-nav-text">{{ translate('Digital Products') }}</span>
                            </a>
                        </li>
                        <li class="rit-side-nav-item py-2 border-bottom">
                            <a href="{{ route('my_uploads.all') }}" class="rit-side-nav-link {{ areActiveRoutes(['my_uploads.new'])}}">
                                <i class="las la-folder-open rit-side-nav-icon"></i>
                                <span class="rit-side-nav-text">{{ translate('Uploaded Files') }}</span>
                            </a>
                        </li>
                        <li class="rit-side-nav-item py-2 border-bottom">
                            <a href="{{ route('seller.coupon.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['my_uploads.new'])}}">
                                <i class="las la-bullhorn rit-side-nav-icon"></i>
                                <span class="rit-side-nav-text">{{ translate('Coupon') }}</span>
                            </a>
                        </li>
                    @endif

                    @if(get_setting('classified_product') == 1)
                        <li class="rit-side-nav-item py-2 border-bottom">
                            <a href="{{ route('customer_products.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['customer_products.index', 'customer_products.create', 'customer_products.edit'])}}">
                                <i class="lab la-sketch rit-side-nav-icon"></i>
                                <span class="rit-side-nav-text">{{ translate('Classified Products') }}</span>
                            </a>
                        </li>
                    @endif

                    @if(addon_is_activated('auction'))
                        <li class="rit-side-nav-item py-2 border-bottom">
                            <a href="javascript:void(0);" class="rit-side-nav-link">
                                <i class="las la-gavel rit-side-nav-icon"></i>
                                <span class="rit-side-nav-text">{{ translate('Auction') }}</span>
                                <span class="rit-side-nav-arrow"></span>
                            </a>
                            <ul class="rit-side-nav-list level-2">
                                @if (Auth::user()->user_type == 'seller')
                                    <li class="rit-side-nav-item py-2 border-bottom">
                                        <a href="{{ route('auction_products.seller.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['auction_products.seller.index','auction_products.create','auction_products.edit'])}}">
                                            <span class="rit-side-nav-text">{{ translate('All Auction Products') }}</span>
                                        </a>
                                    </li>
                                    <li class="rit-side-nav-item py-2 border-bottom">
                                        <a href="{{ route('auction_products_orders.seller') }}" class="rit-side-nav-link {{ areActiveRoutes(['auction_products_orders.seller'])}}">
                                            <span class="rit-side-nav-text">{{ translate('Auction Product Orders') }}</span>
                                        </a>
                                    </li>
                                @endif
                                <li class="rit-side-nav-item py-2 border-bottom">
                                    <a href="{{ route('auction_product_bids.index') }}" class="rit-side-nav-link">
                                        <span class="rit-side-nav-text">{{ translate('Bidded Products') }}</span>
                                    </a>
                                </li>
                                <li class="rit-side-nav-item py-2 border-bottom">
                                    <a href="{{ route('auction_product.purchase_history') }}" class="rit-side-nav-link">
                                        <span class="rit-side-nav-text">{{ translate('Purchase History') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if(Auth::user()->user_type == 'seller')
                        @if (addon_is_activated('pos_system'))
                            @if (\App\Models\BusinessSetting::where('type', 'pos_activation_for_seller')->first() != null && get_setting('pos_activation_for_seller') != 0)
                                <li class="rit-side-nav-item py-2 border-bottom">
                                    <a href="{{ route('poin-of-sales.seller_index') }}" class="rit-side-nav-link {{ areActiveRoutes(['poin-of-sales.seller_index'])}}">
                                        <i class="las la-fax rit-side-nav-icon"></i>
                                        <span class="rit-side-nav-text">{{ translate('POS Manager') }}</span>
                                    </a>
                                </li>
                            @endif
                        @endif
                        <li class="rit-side-nav-item py-2 border-bottom">
                            <a href="{{ route('orders.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['orders.index'])}}">
                                <i class="las la-money-bill rit-side-nav-icon"></i>
                                <span class="rit-side-nav-text">{{ translate('Orders') }}</span>
                            </a>
                        </li>

                        @if (addon_is_activated('refund_request'))
                            <li class="rit-side-nav-item py-2 border-bottom">
                                <a href="{{ route('vendor_refund_request') }}" class="rit-side-nav-link {{ areActiveRoutes(['vendor_refund_request','reason_show'])}}">
                                    <i class="las la-backward rit-side-nav-icon"></i>
                                    <span class="rit-side-nav-text">{{ translate('Received Refund Request') }}</span>
                                </a>
                            </li>
                        @endif
                        <li class="rit-side-nav-item py-2 border-bottom">
                            <a href="{{ route('reviews.seller') }}" class="rit-side-nav-link {{ areActiveRoutes(['reviews.seller'])}}">
                                <i class="las la-star-half-alt rit-side-nav-icon"></i>
                                <span class="rit-side-nav-text">{{ translate('Product Reviews') }}</span>
                            </a>
                        </li>

                        <li class="rit-side-nav-item py-2 border-bottom">
                            <a href="{{ route('shops.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['shops.index'])}}">
                                <i class="las la-cog rit-side-nav-icon"></i>
                                <span class="rit-side-nav-text">{{ translate('Shop Setting') }}</span>
                            </a>
                        </li>

                        <li class="rit-side-nav-item py-2 border-bottom">
                            <a href="{{ route('payments.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['payments.index'])}}">
                                <i class="las la-history rit-side-nav-icon"></i>
                                <span class="rit-side-nav-text">{{ translate('Payment History') }}</span>
                            </a>
                        </li>

                        <li class="rit-side-nav-item py-2 border-bottom">
                            <a href="{{ route('withdraw_requests.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['withdraw_requests.index'])}}">
                                <i class="las la-money-bill-wave-alt rit-side-nav-icon"></i>
                                <span class="rit-side-nav-text">{{ translate('Money Withdraw') }}</span>
                            </a>
                        </li>

                        <li class="rit-side-nav-item py-2 border-bottom">
                            <a href="{{ route('commission-log.index') }}" class="rit-side-nav-link">
                                <i class="las la-file-alt rit-side-nav-icon"></i>
                                <span class="rit-side-nav-text">{{ translate('Commission History') }}</span>
                            </a>
                        </li>

                    @endif

                    @if (get_setting('conversation_system') == 1)
                        @php
                            $conversation = \App\Models\Conversation::where('sender_id', Auth::user()->id)->where('sender_viewed', 0)->get();
                        @endphp
                        <li class="rit-side-nav-item py-2 border-bottom">
                            <a href="{{ route('conversations.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['conversations.index', 'conversations.show'])}}">
                                <i class="las la-comment rit-side-nav-icon"></i>
                                <span class="rit-side-nav-text">{{ translate('Conversations') }}</span>
                                @if (count($conversation) > 0)
                                    <span class="badge badge-success">({{ count($conversation) }})</span>
                                @endif
                            </a>
                        </li>
                    @endif


                    @if (get_setting('wallet_system') == 1)
                        <li class="rit-side-nav-item py-2 border-bottom">
                            <a href="{{ route('wallet.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['wallet.index'])}}">
                                <i class="las la-dollar-sign rit-side-nav-icon"></i>
                                <span class="rit-side-nav-text">{{translate('My Wallet')}}</span>
                            </a>
                        </li>
                    @endif

                    @if (addon_is_activated('club_point'))
                        <li class="rit-side-nav-item py-2 border-bottom">
                            <a href="{{ route('earnng_point_for_user') }}" class="rit-side-nav-link {{ areActiveRoutes(['earnng_point_for_user'])}}">
                                <i class="las la-dollar-sign rit-side-nav-icon"></i>
                                <span class="rit-side-nav-text">{{translate('Earning Points')}}</span>
                            </a>
                        </li>
                    @endif

                    @if (addon_is_activated('affiliate_system') && Auth::user()->affiliate_user != null && Auth::user()->affiliate_user->status)
                        <li class="rit-side-nav-item py-2 border-bottom">
                            <a href="javascript:void(0);" class="rit-side-nav-link {{ areActiveRoutes(['affiliate.user.index', 'affiliate.payment_settings'])}}">
                                <i class="las la-dollar-sign rit-side-nav-icon"></i>
                                <span class="rit-side-nav-text">{{ translate('Affiliate') }}</span>
                                <span class="rit-side-nav-arrow"></span>
                            </a>
                            <ul class="rit-side-nav-list level-2">
                                <li class="rit-side-nav-item py-2 border-bottom">
                                    <a href="{{ route('affiliate.user.index') }}" class="rit-side-nav-link">
                                        <span class="rit-side-nav-text">{{ translate('Affiliate System') }}</span>
                                    </a>
                                </li>
                                <li class="rit-side-nav-item py-2 border-bottom">
                                    <a href="{{ route('affiliate.user.payment_history') }}" class="rit-side-nav-link">
                                        <span class="rit-side-nav-text">{{ translate('Payment History') }}</span>
                                    </a>
                                </li>
                                <li class="rit-side-nav-item py-2 border-bottom">
                                    <a href="{{ route('affiliate.user.withdraw_request_history') }}" class="rit-side-nav-link">
                                        <span class="rit-side-nav-text">{{ translate('Withdraw request history') }}</span>
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

                    <li class="rit-side-nav-item py-2 border-bottom">
                        <a href="{{ route('support_ticket.index') }}" class="rit-side-nav-link {{ areActiveRoutes(['support_ticket.index'])}}">
                            <i class="las la-atom rit-side-nav-icon"></i>
                            <span class="rit-side-nav-text">{{translate('Support Ticket')}}</span>
                            @if($support_ticket > 0)<span class="badge badge-inline badge-success">{{ $support_ticket }}</span> @endif
                        </a>
                    </li>
                @endif
                <li class="rit-side-nav-item py-2 border-bottom">
                    <a href="{{ route('profile') }}" class="rit-side-nav-link {{ areActiveRoutes(['profile'])}}">
                        <i class="las la-user rit-side-nav-icon"></i>
                        <span class="rit-side-nav-text">{{translate('Manage Profile')}}</span>
                    </a>
                </li>
				<li class="rit-side-nav-item py-2 border-bottom">
				 <a class="rit-side-nav-link" href="{{ route('logout') }}">
            <i class="las la-sign-out-alt rit-side-nav-icon fs-18 mr-2"></i>
					 <span class="rit-side-nav-text">{{ translate('Logout') }}</span> 
        </a>
</li>
            </ul>
			@if (get_setting('vendor_system_activation') == 1 && Auth::user()->user_type == 'customer')
            <div class="d-lg-none" id="beseller">
                <a href="{{ route('shops.create') }}" class="btn btn-block btn-soft-primary rounded-0 ">
                   {{ translate('Be A Seller') }}
                </a>
            </div>
        @endif
        </div>
        @if (get_setting('vendor_system_activation') == 1 && Auth::user()->user_type == 'customer')
            <div class="d-none d-lg-block" id="beseller">
                <a href="{{ route('shops.create') }}" class="btn btn-block btn-soft-primary rounded-0 ">
                   {{ translate('Be A Seller') }}
                </a>
            </div>
        @endif
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
            <i class="las la-sign-out-alt fs-18 mr-2"></i>
            <span>{{ translate('Logout') }}</span>
        </a>
        <button class="btn btn-sm p-2 " data-toggle="class-toggle" data-backdrop="static" data-target=".rit-mobile-side-nav" data-same=".mobile-side-nav-thumb">
            <i class="las la-times la-2x"></i>
        </button>
    </div>
</div>
								</div>