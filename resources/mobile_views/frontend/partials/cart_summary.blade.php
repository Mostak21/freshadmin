<div class="card border-0 shadow-sm rounded shadow-lg px-2" style="">
   {{-- <div class="card-header">
        <div class="text-center">
        <h3 class="fs-14 fw-600 mb-0">{{translate('Order Summary')}}</h3>
        </div>
        <div class="text-center">
            <span class="badge badge-inline badge-primary"> 
                {{ count($carts) }} 
                {{translate('Items')}}
            </span>
        </div>
    </div>--}}

    <div class="card-body">
        <div class="text-center pb-4">
            <h3 class="fs-16 fw-600 mb-0">{{translate('Order Summary')}}</h3>
        </div>
        {{--
        @if (addon_is_activated('club_point'))
            @php
                $total_point = 0;
            @endphp
            @foreach ($carts as $key => $cartItem)
                @php
                    $product = \App\Models\Product::find($cartItem['product_id']);
                    $total_point += $product->earn_point * $cartItem['quantity'];
                @endphp
            @endforeach
            
            <div class="rounded px-2 mb-2 bg-soft-primary border-soft-primary border">
                {{ translate("Total Club point") }}:
                <span class="fw-700 float-right">{{ $total_point }}</span>
            </div>
        @endif--}}
        @php
                    $subtotal = 0;
                    $tax = 0;
                    $shipping = 0;
                    $product_shipping_cost = 0;
                    $shipping_region = $shipping_info['city'];
                @endphp
                @foreach ($carts as $key => $cartItem)
                    @php
                        $product = \App\Models\Product::find($cartItem['product_id']);
                        $subtotal += $cartItem['price'] * $cartItem['quantity'];
                        $tax += $cartItem['tax'] * $cartItem['quantity'];
                        $product_shipping_cost = $cartItem['shipping_cost'];
                        
                        $shipping += $product_shipping_cost;
                        
                        $product_name_with_choice = $product->getTranslation('name');
                        if ($cartItem['variant'] != null) {
                            $product_name_with_choice = $product->getTranslation('name').' - '.$cartItem['variant'];
                        }
                    @endphp
                    <div class="d-flex align-items-center p-2 border-bottom"><a class="d-block flex-shrink-0" href="">
                      <img src="{{ uploaded_asset($product->thumbnail_img) }}" width="64" alt="{{ $product_name_with_choice }}" class="pr-2"></a>
                        <div class="ps-2">
                          <h6 class="fs-14 fw-600">{{ $product_name_with_choice }} <b>
                              × {{ $cartItem['quantity'] }}
                          </b></h6>
                          <div class=""><span class="text-reset">{{ single_price($cartItem['price']*$cartItem['quantity']) }}</span><span class="text-muted"></span></div>
                        </div>
                      </div>
                @endforeach
                      <div class="fs-14 fw-600 pt-2">
                <ul class="list-unstyled fs-sm pb-2 border-bottom">
                    <li class="d-flex justify-content-between align-items-center pb-2"><span class="me-2">Subtotal:</span><span class="text-end">{{ single_price($subtotal) }}</span></li>
                    <li class="d-flex justify-content-between align-items-center pb-2"><span class="me-2">Shipping:</span><span class="text-end">{{ single_price($shipping) }}</span></li>
                    <li class="d-flex justify-content-between align-items-center pb-2"><span class="me-2">Taxes:</span><span class="text-end">{{ single_price($tax) }}</span></li>
                        @if (Session::has('club_point'))
                        <li class="d-flex justify-content-between align-items-center pb-2"><span class="me-2">{{translate('Redeem point')}}</span><span class="text-end">{{ single_price(Session::get('club_point')) }}</span></li>
                        @endif
                        @if ($carts->sum('discount') > 0) <li class="d-flex justify-content-between align-items-center pb-2">
                            <span class="me-2">Discount:</span><span class="text-end">{{ single_price($carts->sum('discount')) }}</span></li>
                        @endif
                  </ul>
                </div>
                  @php
                  $total = $subtotal+$tax+$shipping;
                  if(Session::has('club_point')) {
                      $total -= Session::get('club_point');
                  }
                  if ($carts->sum('discount') > 0){
                      $total -= $carts->sum('discount');
                  }
              @endphp

    <h3 class="text-center my-4">{{ single_price($total) }}</h3>

        @if (addon_is_activated('club_point'))
            @if (Session::has('club_point'))
                <div class="mt-3">
                    <form class="" action="{{ route('checkout.remove_club_point') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <div class="form-control">{{ Session::get('club_point')}}</div>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">{{translate('Remove Redeem Point')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            @else
                {{--@if(Auth::user()->point_balance > 0)
                    <div class="mt-3">
                        <p>
                            {{translate('Your club point is')}}:
                            @if(isset(Auth::user()->point_balance))
                                {{ Auth::user()->point_balance }}
                            @endif
                        </p>
                        <form class="" action="{{ route('checkout.apply_club_point') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="point" placeholder="{{translate('Enter club point here')}}" required>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">{{translate('Redeem')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif--}}
            @endif
        @endif

        @if (Auth::check() && get_setting('coupon_system') == 1)
            @if ($carts[0]['discount'] > 0)
                <div class="mt-3">
                    <form class="" id="remove-coupon-form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="owner_id" value="{{ $carts[0]['owner_id'] }}">
                        <div class="input-group">
                            <div class="form-control">{{ $carts[0]['coupon_code'] }}</div>
                            
                        </div>
                        <div class="w-100 pt-2">
                            <button type="button" style ="width: 100%" id="coupon-remove" class="btn btn-outline-primary btn-soft-primary fw-600">{{translate('Change Coupon')}}</button>
                        </div>
                    </form>
                </div>
            @else
                <div class="mt-3">
                    <form class="" id="apply-coupon-form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="owner_id" value="{{ $carts[0]['owner_id'] }}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="code" onkeydown="return event.key != 'Enter';" placeholder="{{translate('coupon code')}}" required>
                            
                        </div>
                        <div class="w-100 pt-2">
                            <button type="button" style ="width: 100%" id="coupon-apply" class="btn btn-outline-primary btn-soft-primary fw-600">{{translate('Apply Coupon Code')}}</button>
                        </div>
                    </form>
                </div>
            @endif
        @endif

    </div>
</div>


