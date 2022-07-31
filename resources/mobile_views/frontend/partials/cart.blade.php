@php
if(auth()->user() != null) {
    $user_id = Auth::user()->id;
    $cart = \App\Models\Cart::where('user_id', $user_id)->orderBy('id', 'DESC')->get();
} else {
    $temp_user_id = Session()->get('temp_user_id');
    if($temp_user_id) {
        $cart = \App\Models\Cart::where('temp_user_id', $temp_user_id)->orderBy('id', 'DESC')->get();
    }
}
if (isset($cart) && count($cart) > 0){
  updateCurrentPrice($cart);
}
$total = 0;
@endphp

@if(isset($cart) && count($cart) > 0)
    @foreach($cart as $key => $cartItem)
                @php
                    $total = $total + $cartItem['price'] * $cartItem['quantity'];
                @endphp
	@endforeach
@endif

<a href="javascript:void(0)" class="d-flex text-reset h-100" data-toggle="dropdown" data-display="static">
    <i class="la la-shopping-cart fs-24 navbar-tool-icon-box" style="z-index: -1; position:relative;"></i>
    <span class="">
        @if(isset($cart) && count($cart) > 0)
            <span class="badge badge-primary  badge-pill cart-count" style="margin:-20px 0px 0px -10px;">
                {{ count($cart)}}
            </span>
        @else
            <span class="badge badge-primary badge-pill" style="margin:-20px 0px 0px -10px;">0</span>
        @endif
    </span>
    <span class="flex-grow-1 ml-1">
    <span class="nav-box-text d-none d-xl-block "><small>{{translate('Cart')}}</small></span>
    <span class="nav-box-text d-none d-xl-block fs-14">{{single_price($total) ??0}} <i class="fa fa-caret-down pl-1"></i></span>
</span>
</a>
<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg p-0 stop-propagation">

    @if(isset($cart) && count($cart) > 0)
        <div class="p-3 fs-15 fw-600 p-3 border-bottom">
            {{translate('Cart Items')}}
        </div>
        <ul class="h-250px overflow-auto c-scrollbar-light list-group list-group-flush">
            @php
                $total = 0;
            @endphp
            @foreach($cart as $key => $cartItem)
                @php
                    $product = \App\Models\Product::find($cartItem['product_id']);
                    $total = $total + $cartItem['price'] * $cartItem['quantity'];
                @endphp
                @if ($product != null)
                    <li class="list-group-item">
                        <span class="d-flex align-items-center">
                            <a href="{{ route('product', $product->slug) }}" class="text-reset d-flex align-items-center flex-grow-1">
                                <img
                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                    class="img-fit lazyload size-60px rounded"
                                    alt="{{  $product->getTranslation('name')  }}"
                                >
                                <span class="minw-0 pl-2 flex-grow-1">
                                    <span class="fw-600 mb-1 text-truncate-2">
                                            {{  $product->getTranslation('name')  }}
                                    </span>
                                    <span class="">{{ $cartItem['quantity'] }}x</span>
                                    <span class="">{{ single_price($cartItem['price']) }}</span>
                                </span>
								@php

								$cat=$product->category->getTranslation('name');
								if($product->brand){
								$brand=$product->brand->getTranslation('name');}
								else
								$brand=null;
								@endphp
                            </a>
                            <span class="">
                                <button onclick="removeFromCart({{ $cartItem['id'] }});
												 removefromcartlayer{!! $product->id!!}();addToWishList({{ $product->id }});" class="btn btn-sm btn-icon stop-propagation">
                                    <i class="la la-close"></i>
                                </button>

                                <script>
                                function removefromcartlayer{!! $product->id!!}(){
                                    dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
                                    dataLayer.push({
                                        event: "remove_from_cart",
										    @php
												$item_category = category_tree($product->category->id);
											@endphp
                                        ecommerce: {
                                            items: [
                                                {
                                                    item_id:{!! $product->id!!},
                                                    item_name: "{!! $product->name!!}",
                                                    affiliation: "",
                                                    coupon: "",
                                                    currency: "BDT",
                                                    discount: {{number_format((float)$product->discount, 2, '.', '')??0.00}},
                                                    index: 0,
                                                    item_brand: "{{$product->brand->name??""}}",
													item_category: "{!! $item_category[0]??"" !!}",
													item_category2: "{!! $item_category[1]??"" !!}",
													item_category3: "{!! $item_category[2]??"" !!}",
                                                    item_category4: "",
                                                    item_category5: "",
                                                    item_list_id: "",
                                                    item_list_name: "",
                                                    item_variant: "",
                                                    location_id: "",
                                                    price: {{number_format((float)$product->unit_price, 2, '.', '')??0.00}},
                                                    quantity: 1
                                                }
                                            ]
                                        }
                                    });
                                }
                                </script>

                            </span>
                        </span>
                    </li>
                @endif
            @endforeach
        </ul>
        <div class="px-3 py-2 fs-15 border-top d-flex justify-content-between align-items-center">
           <div class=""><span class="opacity-60">{{translate('Subtotal')}}</span>
            <span class="fw-600">{{ single_price($total) }}</span></div>
            <div>
                <a href="{{ route('cart') }}" class="btn border btn-soft-secondary btn-sm">
                    {{translate('View cart')}} <i class="ci-arrow-right"></i>
                </a>
            </div>
        </div>
        <div class="px-3 py-2 text-center border-top">
            <ul class="list-inline mb-0">

                @if (Auth::check())
                <li class="list-inline">
                    <a href="{{ route('checkout.shipping_info') }}" class="btn btn-primary btn-sm fs-16 w-100 w100 bblock">
                        <i class="ci-card"> {{translate('Checkout')}}</i>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    @else
        <div class="text-center p-3">
            <i class="las la-frown la-3x opacity-60 mb-3"></i>
            <h3 class="h6 fw-700">{{translate('Your Cart is empty')}}</h3>
        </div>
    @endif

</div>
