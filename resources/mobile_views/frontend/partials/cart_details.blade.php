<div class="container">
    @if( $carts && count($carts) > 0 )
        <form  action="{{ route('checkout.shipping_info') }}" role="form" method="POST">
        <div class="row">
            <div class="col-xxl-12 col-xl-12 mx-auto">
                <div class="bg-white text-left">
                    <div class="mb-4">
                        @csrf
                        <ul class="list-group list-group-flush">
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($carts as $key => $cartItem)
                                @php
                                    $product = \App\Models\Product::find($cartItem['product_id']);
                                    $product_stock = $product->stocks->where('variant', $cartItem['variation'])->first();
                                    $total = $total + ($cartItem['price'] * $cartItem['quantity']) + $cartItem['tax'];
                                    $product_name_with_choice = $product->getTranslation('name');
                                    if ($cartItem['variation'] != null) {
                                        $product_name_with_choice = $product->getTranslation('name').' - '.$cartItem['variation'];
                                    }
                                    if (isset($product_stock) && $product_stock->qty !=0 && $product_stock->qty != null){
                                        if ($cartItem['quantity']> $product_stock->qty){
                                            $cartItem['quantity'] = $product_stock->qty;
                                            $cartItem->save();
                                        }
                                    }
                                @endphp
                                <li class="list-group-item product-fullwidth rounded-custom px-2">
                                    <div class="row gutters-5">

                                        <div class="col-4">
                                            <div class="control-group">
                                                <label class="control control-checkbox">
                                                    <span class=" ml-0 align-items-center image-cart">
                                                        <div class="img-fit rounded">
                                                            <img
                                                                src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                                class="p-img-round"
                                                                alt="{{ $product->getTranslation('name')  }}"
                                                                @if( isset($product_stock) && $product_stock->qty ==0 || $product_stock == null)
                                                                style="filter: grayscale(100%) blur(0.1px) opacity(0.5) brightness(0.9) contrast(1.3);"
                                                            @endif
                                                            >
                                                          @if( isset($product_stock) && $product_stock->qty ==0 || $product_stock == null)
                                                                <div class="cart-img-overlay ml-0 rounded">
                                                                    Stock Out
                                                                </div>
                                                          @endif
                                                        </div>

                                                    </span>
                                                    <input type="checkbox" checked="checked" name="selectedItem[]" id="cart{{$cartItem['id']}}" onchange="carts{{$cartItem['id']}}()" value="{{$cartItem['id']}}" @if( isset($product_stock) && $product_stock->qty ==0 || $product_stock == null) disabled @endif/>
                                                    <div class="control_indicator my-auto"></div>
                                                </label>
                                            </div>
                                        </div>


                                        <div class="col-8 " @if( isset($product_stock) && $product_stock->qty ==0 || $product_stock == null) style="opacity: 0.6; " @endif>
                                          <div class=" d-flex justify-content-between ">
                                            <div class="fs-16 opacity-90 fw-600 pb-2">
                                            <a class="text-reset" href="{{ route('product', $product->slug) }}">{{ $product_name_with_choice }}</a> 
                                           </div>
                                           <div>
                                            <a href="javascript:void(0)" onclick="removeFromCartView(event, {{ $cartItem['id'] }}); removefromcartlayerv{!! $product->id!!}();addToWishList({{ $product->id }});" class="btn btn-icon btn-sm btn-soft-secondary btn-circle">
                                                    <i class="las fs-16 la-trash"></i>
                                                </a>
                                            </div>
                                            </div>
                                           
                                           
                                           <div class="mt-2" style="">
                                            
                                          <div class="d-flex justify-content-between ">
                                            <div class=" d-flex align-items-center">
                                                <span class=" fw-600 fs-18 text-black @if(isset($product_stock) && $product_stock->qty ==0 || $product_stock == null) text-brand-gray @endif">
                                                {{ single_price(($cartItem['price'] + $cartItem['tax']) * $cartItem['quantity']) }}
                                            </span>
                                            </div>
                                            <div>
                                                <div class="row no-gutters price-range-bg align-items-center aiz-plus-minus px-2 ml-0 " style="max-width: 100px">
                                                @if(isset($product_stock) && $product_stock->qty !=0 && $product_stock->qty != null)
                                                <button class="btn col-auto " type="button" data-type="minus" data-field="quantity[{{ $cartItem['id'] }}]">
                                                    <i class="las la-minus"></i>
                                                </button>

                                                    <input type="number"
                                                       name="quantity[{{ $cartItem['id'] }}]"
                                                       class="col border-0 text-center flex-grow-1 fs-16 price-range-input-bg"
                                                       placeholder="1"
                                                       value="{{ $cartItem['quantity'] }}"
                                                       min="{{ $product->min_qty??0 }}" max="{{ $product_stock->qty??0 }}"
                                                       onchange="updateQuantity({{ $cartItem['id'] }}, this)">

                                                <button class="btn col-auto " type="button" data-type="plus" data-field="quantity[{{ $cartItem['id'] }}]">
                                                    <i class="las la-plus"></i>
                                                </button>
                                                @endif
                                            </div>
                                           

                                            </div>
                                           
                                        </div></div></div>

                                        






                                    </div>
											 <script>
                                function removefromcartlayerv{!! $product->id!!}(){
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
                                </li>
                            @endforeach
                        </ul>
                    </div>

                  
                    <div class=" container-custom py-4 mb-4 d-flex justify-content-between">
                            <span class="opacity-60 fs-15">{{translate('Subtotal')}}</span>
                            <span class="fw-600 fs-17" id="subTotal">{{ single_price($total) }}</span>
                        </div>
                        
                        <div class="row align-items-center"> 
                            <div class="col-12 text-center text-md-right">
                                @if(Auth::check())
{{--                                    <a href="{{ route('checkout.shipping_info') }}" class="btn btn-primary fw-600 btn-mright">--}}
{{--                                        {{ translate('Continue to Shipping')}} <i class="ci-arrow-right fw-600 pl-2"></i>--}}
{{--                                    </a>--}}

                                    <button type="submit" class="btn btn-dark rounded-custom fw-600 btn-mright"><div class="d-flex justify-content-between"><div>{{translate('Continue to Shipping')}}</div><div><img height="24px" src="{{ static_asset('m_asset/arrow-right.png') }}"/></div></div></button>
                                @else
                                   <button type="button" class="btn btn-primary fw-600 btn-mright" onclick="showCheckoutModal()"><div class="d-flex justify-content-between"><div>{{translate('Continue to Shipping')}}</div><div><img height="24px" src="{{ static_asset('m_asset/arrow-right.png') }}"/></div></div></button>
                                @endif
                            </div>
                        </div>
                </div>
            </div>
        </div>
        </form>
    @else
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="shadow-sm bg-white p-4 rounded">
                    <div class="text-center p-3">
                        <i class="las la-frown la-3x opacity-60 mb-3"></i>
                        <h3 class="h4 fw-700">{{translate('Your Cart is empty')}}</h3>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<script type="text/javascript">
    AIZ.extra.plusMinus();

        @if( $carts && count($carts) > 0 )
    var productPriceSubtotal = 0;
    @foreach ($carts as $key => $cartItem)
    @php
        $productPrice =($cartItem['price'] * $cartItem['quantity']) + $cartItem['tax'];
    @endphp

    function carts{{$cartItem['id']}}() {
            {{"var cart".$cartItem['id']." = ".$productPrice.";" }}
        var checkBox = document.getElementById("cart{{$cartItem['id']}}");

        let subTotal = document.getElementById("subTotal").innerHTML;
        subTotal = subTotal.replace(/[৳$,]/gi, '');
        subTotal = parseInt(subTotal);

        if (checkBox.checked == true){
            subTotal = subTotal + {{"cart".$cartItem['id']}};
        } else {
            subTotal = subTotal - {{"cart".$cartItem['id']}};
        }
        subTotal =subTotal.toLocaleString("en-IN");

        document.getElementById("subTotal").innerHTML = "৳"+subTotal;
    }
    @endforeach
    @endif
</script>