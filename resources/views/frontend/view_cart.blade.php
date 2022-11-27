@extends('frontend.layouts.app')

@section('datalayer')
<script type = "text/javascript">
    dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
    dataLayer.push({
        event    : "view_cart",
        ecommerce: {
            items: [@foreach ($carts as $cartItem)
            @php
                $product = \App\Models\Product::find($cartItem['product_id']);
                $product_stock = $product->stocks->where('variant', $cartItem['variation'])->first();
                if ($cartItem['variation'] != null) {
                    $product_name_with_choice = $product->getTranslation('name').' - '.$cartItem['variation'];
                }
				$item_category = category_tree($product->category->id);
            @endphp
                    {
                item_name     : "{!!$product->getTranslation('name')!!}",
                item_id       : "{{$product->id}}",
                price         : {{number_format((float)$product->unit_price, 2, '.', '')??0}},
                item_brand    : "{{$product->brand->name??""}}",
				item_category: "{!! $item_category[0]??"" !!}",
				item_category2: "{!! $item_category[1]??"" !!}",
				item_category3: "{!! $item_category[2]??"" !!}",
                item_category4: "",
                item_variant  : "{{$cartItem['variation']?? 0}}",
                item_list_name: "",  // If associated with a list selection.
                item_list_id  : "",  // If associated with a list selection.
                index         : 0,  // If associated with a list selection.
                quantity      : {{$cartItem['quantity']?? 0}}
            },

            @endforeach]
        }
    });


	dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
    dataLayer.push({
        event    : "begin_checkout",
        ecommerce: {
            items: [@foreach ($carts as $cartItem)
            @php
                $product = \App\Models\Product::find($cartItem['product_id']);
                $product_stock = $product->stocks->where('variant', $cartItem['variation'])->first();
                if ($cartItem['variation'] != null) {
                    $product_name_with_choice = $product->getTranslation('name').' - '.$cartItem['variation'];
                }

				$item_category = category_tree($product->category->id);
            @endphp
                    {
					  item_id: "{{$product->id}}",
					  item_name: "{!!$product->getTranslation('name')!!}",
					  affiliation: "",
					  coupon: "",
					  currency: "BDT",
					  discount: {{number_format((float)$product->discount, 2, '.', '')??0}},
					  index: 0,
					  item_brand: "{{$product->brand->name??""}}",
					  item_category: "{!! $item_category[0]??"" !!}",
					  item_category2: "{!! $item_category[1]??"" !!}",
					  item_category3: "{!! $item_category[2]??"" !!}",
					  item_category4: "",
					  item_category5: "",
					  item_list_id: "",
					  item_list_name: "",
					  item_variant: "{{$cartItem['variation']?? 0}}",
					  location_id: "",
					  price: {{number_format((float)$product->unit_price, 2, '.', '')??0}},
					  quantity: {{$cartItem['quantity']?? 0}}
            },

            @endforeach]
        }
    });
</script>


@endsection

@section('content')

<div class="productheaderbg pt-lg-5 py-3">
    <div class="container d-lg-center">
        <div class="row pb-4">
            <div class="col-lg-6 text-center text-lg-left">
                <h1 class="h3 mb-2  fw-600">
                    Cart
                </h1>

            </div>
            <div class="col-lg-6 fs-13">
                <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                    <li class="breadcrumb-item ">

                        <a class="text-reset" href="{{ route('home') }}"> <i class="fa fa-home"></i> {{ translate('Home')}}</a>
                    </li>

                    <li class="text-dark  breadcrumb-item">
                        Cart
                    </li>

                </ul>
            </div>
        </div>

        <div class="row">
            <div class="steps steps-light pt-lg-3 pb-3">
                <div class="step-item active current" >
                <div class="step-progress"><span class="step-count">1</span></div>
                <div class="step-label"><i class="las la-shopping-cart fs-24"></i>{{ translate(' My Cart')}}</div></div>

                <div class="step-item" >
                <div class="step-progress"><span class="step-count">2</span></div>
                <div class="step-label"><i class="las la-map fs-24"></i>{{ translate(' Shipping info')}}</div></div>

                <div class="step-item " >
                <div class="step-progress"><span class="step-count">3</span></div>
                <div class="step-label"><i class="las la-truck fs-24"></i>{{ translate('Delivery info')}}</div></div>

                <div class="step-item" >
                <div class="step-progress"><span class="step-count">4</span></div>
                <div class="step-label"><i class="las la-credit-card fs-24"></i>{{ translate(' Payment')}}</div></div>

                <div class="step-item" >
                <div class="step-progress"><span class="step-count">5</span></div>
                <div class="step-label"><i class="las la-check-circle fs-24"></i>{{ translate(' Confirmation')}}</div></div></div>
        </div>
    </div>
</div>


{{--

<section class="pt-5 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="row rit-steps arrow-divider">
                    <div class="col active">
                        <div class="text-center text-primary">
                            <i class="la-3x mb-2 las la-shopping-cart"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block">{{ translate('1. My Cart')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-map"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50">{{ translate('2. Shipping info')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-truck"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50">{{ translate('3. Delivery info')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-credit-card"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50">{{ translate('4. Payment')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-check-circle"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50">{{ translate('5. Confirmation')}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>--}}

<section class="mb-4" id="cart-summary">
    <div class="container">
        @if( $carts && count($carts) > 0 )
            <form  action="{{ route('checkout.shipping_info') }}" role="form" method="POST">
                @csrf
            <div class="row">
                <div class="col-xxl-12 col-xl-12 mx-auto">
                    <div class="shadow-sm bg-white p-3 p-lg-4 rounded text-left">
                        <div class="mb-4">
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
                                                            <div class="img-fit size-sm-80px size-md-100px rounded">
                                                                <img
                                                                    src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                                    class="img-fit size-md-100px rounded"
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


                                            <div class="col-6 col-md-6 col-lg-7" @if( isset($product_stock) && $product_stock->qty ==0 || $product_stock == null) style="opacity: 0.6; " @endif>
                                              <div class="fs-16 opacity-90 fw-600 pb-2"><a class="text-reset" href="{{ route('product', $product->slug) }}">{{ $product_name_with_choice }}</a> </div>

                                              <div class="opacity-90">
                                              <span class="fs-14 py-2">Unit Price:</span>
                                              <span class="fw-600 fs-14">{{ single_price($cartItem['price']) }}</span>
                                            </div>
                                            <div class="opacity-90"> <span class="fs-14 py-2">Tax:</span>
                                              <span class="fw-600 fs-14">{{ single_price($cartItem['tax']) }}</span>
                                            </div>

                                            <div class="fs-22">
                                                <span class="fs-16 py-2">{{ translate('Total')}}:</span>
                                                <span class="fw-600 fs-20 text-primary @if(isset($product_stock) && $product_stock->qty ==0 || $product_stock == null) text-brand-gray @endif">
                                                    {{ single_price(($cartItem['price'] + $cartItem['tax']) * $cartItem['quantity']) }}
                                                </span>
                                            </div>
                                            </div>
                                            <div class="col-12 col-sm-3 col-md-3 d-flex justify-content-md-end justify-content-center">
												<div class="row">
                                                <div class="row no-gutters  align-items-center rit-plus-minus mr-2 ml-0 " style="max-width: 100px">
                                                    @if(isset($product_stock) && $product_stock->qty !=0 && $product_stock->qty != null)
                                                    <button class="btn col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="minus" data-field="quantity[{{ $cartItem['id'] }}]">
                                                        <i class="las la-minus"></i>
                                                    </button>

                                                        <input type="number"
                                                           name="quantity[{{ $cartItem['id'] }}]"
                                                           class="col border-0 text-center flex-grow-1 fs-16 input-number"
                                                           placeholder="1"
                                                           value="{{ $cartItem['quantity'] }}"
                                                           min="{{ $product->min_qty??0 }}" max="{{ $product_stock->qty??0 }}"
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

{{--
                                            <div class="col-lg-3">
                                                <span class="mr-2 ml-0">
                                                    <img
                                                        src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                        class="img-fit size-60px rounded"
                                                        alt="{{ $product->getTranslation('name')  }}"
                                                    >
                                                </span>
                                                <span class="fs-14 opacity-60">{{ $product_name_with_choice }}</span><br>

                                                <div class="opacity-60 fs-12 d-block d-lg-none">{{ translate('Price')}}</div>
                                                <div  class="fw-600 fs-16">{{ single_price($cartItem['price']) }}</div>
                                            </div>

                                            <div class="col-lg col-4 order-1 order-lg-0 my-3 my-lg-0">
                                                <span class="opacity-60 fs-12 d-block d-lg-none">{{ translate('Price')}}</span>
                                                <span class="fw-600 fs-16">{{ single_price($cartItem['price']) }}</span>
                                            </div>
                                            <div class="col-lg col-4 order-2 order-lg-0 my-3 my-lg-0">
                                                <span class="opacity-60 fs-12 d-block d-lg-none">{{ translate('Tax')}}</span>
                                                <span class="fw-600 fs-16">{{ single_price($cartItem['tax']) }}</span>
                                            </div>

                                            <div class="col-lg col-6 order-4 order-lg-0">
                                                @if($cartItem['digital'] != 1 && $product->auction_product == 0)
                                                    <div class="row no-gutters align-items-center rit-plus-minus mr-2 ml-0">
                                                        <button class="btn col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="minus" data-field="quantity[{{ $cartItem['id'] }}]">
                                                            <i class="las la-minus"></i>
                                                        </button>
                                                        <input type="number" name="quantity[{{ $cartItem['id'] }}]" class="col border-0 text-center flex-grow-1 fs-16 input-number" placeholder="1" value="{{ $cartItem['quantity'] }}" min="{{ $product->min_qty }}" max="{{ $product_stock->qty }}" onchange="updateQuantity({{ $cartItem['id'] }}, this)">
                                                        <button class="btn col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="plus" data-field="quantity[{{ $cartItem['id'] }}]">
                                                            <i class="las la-plus"></i>
                                                        </button>
                                                    </div>
                                                @elseif($product->auction_product == 1)
                                                    <span class="fw-600 fs-16">1</span>
                                                @endif
                                            </div>
                                            <div class="col-lg col-4 order-3 order-lg-0 my-3 my-lg-0">
                                                <span class="opacity-60 fs-12 d-block d-lg-none">{{ translate('Total')}}</span>
                                                <span class="fw-600 fs-16 text-primary">{{ single_price(($cartItem['price'] + $cartItem['tax']) * $cartItem['quantity']) }}</span>
                                            </div>
                                            <div class="col-lg-auto col-6 order-5 order-lg-0 text-right">
                                                <a href="javascript:void(0)" onclick="removeFromCartView(event, {{ $cartItem['id'] }});  " class="btn btn-icon btn-sm btn-soft-primary btn-circle">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </div>--}}


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
                            <div class="col-md-6 text-center text-md-left order-1 order-md-0">
                                <a href="{{ route('home') }}" class="btn btn-mleft">

                                  <i class="ci-arrow-left fw-600"></i>  {{ translate('Return to shop')}}
                                </a>
                            </div>
                            <div class="col-md-6 text-center text-md-right">
                                @if(Auth::check())
{{--                                    <a href="{{ route('checkout.shipping_info') }}" class="btn btn-primary fw-600 btn-mright">--}}
{{--                                        {{ translate('Continue to Shipping')}} <i class="ci-arrow-right fw-600 pl-2"></i>--}}
{{--                                    </a>--}}

                                        <button type="submit" class="btn btn-primary fw-600 btn-mright">{{ translate('Continue to Shipping')}}<i class="ci-arrow-right fw-600 pl-2"></i></button>

                                @else
                                    <button type="button" class="btn btn-primary fw-600 btn-mright" onclick="showCheckoutModal()">{{ translate('Continue to Shipping')}} <i class="ci-arrow-right fw-600 pl-2"></i></button>
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
</section>

@endsection

@section('modal')
    <div class="modal fade" id="login-modal">
        <div class="modal-dialog modal-dialog-zoom">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fw-600">{{ translate('Login')}}</h6>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <section id="cart-login-guest">
                    <div class="p-3">
                        <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                            @csrf
                            <p>Enter phone number or email to continue</p>

{{--                            @if (addon_is_activated('otp_system') && env("DEMO_MODE") != "On")--}}
{{--                                <div class="form-group phone-form-group mb-1">--}}
{{--                                    <input type="tel" id="phone-code" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" placeholder="" name="phone" autocomplete="off">--}}
{{--                                </div>--}}

{{--                                <input type="hidden" name="country_code" value="">--}}

{{--                                <div class="form-group email-form-group mb-1 d-none">--}}
{{--                                    <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email" id="email" autocomplete="off">--}}
{{--                                    @if ($errors->has('email'))--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $errors->first('email') }}</strong>--}}
{{--                                        </span>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

{{--                                <div class="form-group text-right">--}}
{{--                                    <button class="btn btn-link p-0 opacity-50 text-reset" type="button" onclick="toggleEmailPhone(this)">{{ translate('Use Email Instead') }}</button>--}}
{{--                                </div>--}}
{{--                            @else--}}
{{--                                <div class="form-group">--}}
{{--                                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email" id="email" autocomplete="off">--}}
{{--                                    @if ($errors->has('email'))--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $errors->first('email') }}</strong>--}}
{{--                                        </span>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            @endif--}}


                            <div class="form-group">
                                <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email or phone') }}" name="email" id="email" autocomplete="off">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>


{{--                            <div class="form-group input-group">--}}
{{--                                <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ translate('Password')}}" name="password" id="password" value="{{ old('password') }}">--}}
{{--                                <div class="input-group-append">--}}
{{--                                    <button class="btn form-control" type="button" onclick="showPassword()"><i class="ci-eye-off text-secondary"  id="npass"></i></button>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row mb-2">--}}
{{--                                <div class="col-6">--}}
{{--                                    <label class="rit-checkbox">--}}
{{--                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>--}}
{{--                                        <span class=opacity-60>{{  translate('Remember Me') }}</span>--}}
{{--                                        <span class="rit-square-check"></span>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-6 text-right">--}}
{{--                                    <a href="{{ route('password.request') }}" class="text-reset opacity-60 fs-14">{{ translate('Forgot password?')}}</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="mb-5">
{{--                                <input type="submit" class="btn btn-primary fw-600" value="{{  translate('Login') }}">--}}
                                <button type="button" id="guestbutton" class="btn btn-primary fw-600 btn-mright" onclick="guestLogin()" style="width: 100%!important;">{{ translate('Next')}} <i class="ci-arrow-right fw-600 pl-2"></i></button>
                            </div>
                        </form>

                    </div>
                    </section>
                    <div class="text-center mb-3">
                        <p class="text-muted mb-0">{{ translate('Dont have an account?')}}</p>
                        <a href="{{ route('user.registration') }}">{{ translate('Register Now')}}</a>
                    </div>
                    @if(get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1)
                        <div class="separator mb-3">
                            <span class="bg-white px-3 opacity-60">{{ translate('Or Login With')}}</span>
                        </div>
                        <ul class="list-inline social colored text-center mb-3">
                            @if (get_setting('facebook_login') == 1)
                                <li class="list-inline-item">
                                    <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">
                                        <i class="lab la-facebook-f"></i>
                                    </a>
                                </li>
                            @endif
                            @if(get_setting('google_login') == 1)
                                <li class="list-inline-item">
                                    <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google">
                                        <i class="lab la-google"></i>
                                    </a>
                                </li>
                            @endif
                            @if (get_setting('twitter_login') == 1)
                                <li class="list-inline-item">
                                    <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter">
                                        <i class="lab la-twitter"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function showPassword() {
            var x = document.getElementById("password");
            var ico = document.getElementById("npass");
            if (x.type === "password") {
                x.type = "text";
                ico.classList.remove("ci-eye-off");
                ico.classList.add("ci-eye");

            } else {
                x.type = "password";
                ico.classList.remove("ci-eye");
                ico.classList.add("ci-eye-off");
            }
        }
        function removeFromCartView(e, key){
            e.preventDefault();
            removeFromCart(key);
        }

        function guestLogin(){
            $.post('{{ route('cart.login.guest') }}', {
                _token   :  RIT.data.csrf,
                // id       :  key,
                email :  document.getElementById("email").value
            }, function(data){

                // updateNavCart(data.nav_cart_view,data.cart_count);
                $('#cart-login-guest').html(data);
                console.log(data);
            });
        }


        {{--$(document).ready(function() {--}}
        {{--    $("#guestbutton").click(function(e){--}}
        {{--        e.preventDefault();--}}

        {{--        var _token = $("input[name='_token']").val();--}}
        {{--        var email = $("input[name='email']").val();--}}

        {{--        $.ajax({--}}
        {{--            url: "{{ route('cart.login.guest') }}",--}}
        {{--            type:'POST',--}}
        {{--            data: {_token:_token, email:email},--}}
        {{--            success: function(data) {--}}
        {{--                if($.isEmptyObject(data.error)){--}}
        {{--                    alert(data.success);--}}
        {{--                    console.log(data.success);--}}
        {{--                }else{--}}
        {{--                    printErrorMsg(data.error);--}}
        {{--                    console.log(data.error);--}}
        {{--                }--}}
        {{--            }--}}
        {{--        });--}}

        {{--    });--}}


        {{--    function printErrorMsg (msg) {--}}
        {{--        $(".print-error-msg").find("ul").html('');--}}

        {{--        $(".print-error-msg").css('display','block');--}}
        {{--        $.each( msg, function( key, value ) {--}}
        {{--            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');--}}
        {{--        });--}}
        {{--    }--}}
        {{--});--}}


        function updateQuantity(key, element){
            $.post('{{ route('cart.updateQuantity') }}', {
                _token   :  RIT.data.csrf,
                id       :  key,
                quantity :  element.value
            }, function(data){
                updateNavCart(data.nav_cart_view,data.cart_count);
                $('#cart-summary').html(data.cart_view);
                // console.log(data);
            });
        }


        $( document ).ready(function() {
            let subTotal = document.getElementById("subTotal").innerHTML;
            subTotal = subTotal.replace(/[৳`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
            subTotal = parseInt(subTotal);
            // console.log( Number.isInteger(cart2130) );

        });

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

        function showCheckoutModal(){
            $('#login-modal').modal();
        }

        // Country Code
        var isPhoneShown = true,
            countryData = window.intlTelInputGlobals.getCountryData(),
            input = document.querySelector("#phone-code");

        for (var i = 0; i < countryData.length; i++) {
            var country = countryData[i];
            if(country.iso2 == 'bd'){
                country.dialCode = '88';
            }
        }

        var iti = intlTelInput(input, {
            separateDialCode: true,
            utilsScript: "{{ static_asset('assets/js/intlTelutils.js') }}?1590403638580",
            onlyCountries: @php echo json_encode(\App\Models\Country::where('status', 1)->pluck('code')->toArray()) @endphp,
            customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                if(selectedCountryData.iso2 == 'bd'){
                    return "01xxxxxxxxx";
                }
                return selectedCountryPlaceholder;
            }
        });

        var country = iti.getSelectedCountryData();
        $('input[name=country_code]').val(country.dialCode);

        input.addEventListener("countrychange", function(e) {
            // var currentMask = e.currentTarget.placeholder;

            var country = iti.getSelectedCountryData();
            $('input[name=country_code]').val(country.dialCode);

        });

        function toggleEmailPhone(el){
            if(isPhoneShown){
                $('.phone-form-group').addClass('d-none');
                $('.email-form-group').removeClass('d-none');
                $('input[name=phone]').val(null);
                isPhoneShown = false;
                $(el).html('{{ translate('Use Phone Instead') }}');
            }
            else{
                $('.phone-form-group').removeClass('d-none');
                $('.email-form-group').addClass('d-none');
                $('input[name=email]').val(null);
                isPhoneShown = true;
                $(el).html('{{ translate('Use Email Instead') }}');
            }
        }
    </script>
@endsection
