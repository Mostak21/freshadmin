<div class="container">
    @if( $carts && count($carts) > 0 )
        <form  action="{{ route('checkout.shipping_info') }}" role="form" method="POST">
        <div class="row">
            <div class="col-xxl-12 col-xl-12 mx-auto">
                <div class="shadow-sm bg-white p-3 p-lg-4 rounded text-left">
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
                                    if( isset($product_stock) && $product_stock->qty !=0){
                                            $total = $total + ($cartItem['price'] + $cartItem['tax']) * $cartItem['quantity'];
                                        }
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
                                <li class="list-group-item px-0 px-lg-3">
                                    <div class="row gutters-5">

                                        <div class="col-6 col-sm-3 col-md-3 col-lg-2">
                                            <div class="control-group">
                                                <label class="control control-checkbox">
                                                    <span class="mr-2 ml-0 align-items-center image-cart">
                                                    <img
                                                        src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                        class="img-fit size-sm-80px size-md-100px rounded"
                                                        alt="{{ $product->getTranslation('name')  }}"
                                                        @if(isset($product_stock) && $product_stock->qty ==0 || $product_stock == null)
                                                        style="filter: grayscale(100%) blur(0.1px) opacity(0.5) brightness(0.9) contrast(1.3);"
                                                        @endif
                                                    >
                                                    @if(isset($product_stock) && $product_stock->qty ==0 || $product_stock == null)
                                                        <div class="cart-img-overlay ml-0 rounded">
                                                                Stock Out
                                                        </div>
                                                    @endif
                                                </span>
                                                    <input type="checkbox"
                                                           @if( isset($product_stock) && $product_stock->qty !=0)
                                                           checked="checked"
                                                           @endif
                                                           name="selectedItem[]"
                                                           id="cart{{$cartItem['id']}}"
                                                           onchange="carts{{$cartItem['id']}}()"
                                                           value="{{$cartItem['id']}}"
                                                           @if( isset($product_stock) && $product_stock->qty ==0 || $product_stock == null) disabled @endif
                                                    />
                                                    <div class="control_indicator my-auto"></div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6 col-lg-7"@if(isset($product_stock) && $product_stock->qty ==0 || $product_stock == null) style="opacity: 0.6; " @endif>
                                          <div class="fs-16 opacity-90 fw-600 pb-2">{{ $product_name_with_choice }}</div>

                                          <div class="opacity-90">
                                          <span class="fs-14 py-2">Unit Price:</span>
                                          <span class="fw-600 fs-14">{{ single_price($cartItem['price']) }}</span>
                                        </div>
                                        <div class="opacity-90"> <span class="fs-14 py-2">Tax:</span>
                                          <span class="fw-600 fs-14">{{ single_price($cartItem['tax']) }}</span>
                                        </div>

                                        <div class="fs-22">
                                            <span class="fs-16 py-2">{{ translate('Total')}}:</span>
                                            <span class="fw-600 fs-20 text-primary @if( isset($product_stock) && $product_stock->qty ==0 || $product_stock == null) text-brand-gray @endif ">
                                                {{ single_price(($cartItem['price'] + $cartItem['tax']) * $cartItem['quantity']) }}
                                            </span>
                                        </div>
                                        </div>
                                        <div class="col-12 col-sm-3 col-md-3 d-flex justify-content-md-end justify-content-center">
											<div class="row">
                                            <div class="row no-gutters align-items-center aiz-plus-minus mr-2 ml-0" style="max-width: 100px">

                                                @if(isset($product_stock) && $product_stock->qty !=0 && $product_stock->qty != null)
                                                <button class="btn col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="minus" data-field="quantity[{{ $cartItem['id'] }}]">
                                                    <i class="las la-minus"></i>
                                                </button>
                                                <input type="number"
                                                       name="quantity[{{ $cartItem['id'] }}]"
                                                       class="col border-0 text-center flex-grow-1 fs-16 input-number"
                                                       placeholder="1"
                                                       value="{{ $cartItem['quantity'] }}"
                                                       min="{{ $product->min_qty }}" max="{{ $product_stock->qty }}"
                                                       onchange="updateQuantity({{ $cartItem['id'] }}, this)">
                                                <button class="btn col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="plus" data-field="quantity[{{ $cartItem['id'] }}]">
                                                    <i class="las la-plus"></i>
                                                </button>
                                                @endif

                                            </div>
                                            <div class="row d-flex justify-content-end align-items-center">
                                                <div class="px-3 mr-2 py-2">
                                                <a href="javascript:void(0)" onclick="removeFromCartView(event, {{ $cartItem['id'] }}); removefromcartlayerv{!! $product->id!!}();addToWishList({{ $product->id }});" class="btn btn-icon btn-sm btn-soft-primary btn-circle">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </div>
                                            </div>
											</div>
                                        </div>
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

                    <div class="px-3 py-2 mb-4 border-top d-flex justify-content-between">
                        <span class="opacity-60 fs-15">{{translate('Subtotal')}}</span>
                        <span class="fw-600 fs-17" id="subTotal">{{ single_price($total) }}</span>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center text-md-left order-1 order-md-0 ">
                            <a href="{{ route('home') }}" class="btn  btn-mleft">
                                <i class="ci-arrow-left mt-sm-0 ms-1"></i>
                                {{ translate('Return to shop')}}
                            </a>
                        </div>
                        <div class="col-md-6 text-center text-md-right">
                            @if(Auth::check())
                                {{-- <a href="{{ route('checkout.shipping_info') }}" class="btn btn-primary fw-600 btn-mright">
                                    {{ translate('Continue to Shipping')}}<i class="ci-arrow-right mt-sm-0 ms-1"></i>
                                </a> --}}
                                <button type="submit" class="btn btn-primary fw-600 btn-mright">{{ translate('Continue to Shipping')}}<i class="ci-arrow-right fw-600 pl-2"></i></button>

                            @else
                                <button type="button" class="btn btn-primary fw-600 btn-mright" onclick="showCheckoutModal()">{{ translate('Continue to Shipping')}}<i class="ci-arrow-right pl-1 fw-600"></i></button>
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
