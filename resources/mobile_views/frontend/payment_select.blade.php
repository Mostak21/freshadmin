@extends('frontend.layouts.app')
@section('datalayer')

<script type = "text/javascript">

dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
dataLayer.push({
  event: "add_payment_info",
  ecommerce: {
    currency: "BDT",
    value: {{number_format((float)$total, 2, '.', '')}},
    coupon: "",
    payment_type: "Home Delevery",
    items: [ @foreach ($carts as $cartItem)
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
      item_name: "{{$product->getTranslation('name')}}",
      affiliation: "",
      coupon: "",
      currency: "BDT",
      discount: 0,
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
      price: {{number_format((float)$cartItem['price'], 2, '.', '')?? 0}},
      quantity: {{$cartItem['quantity']?? 0}}
    },
    @endforeach  ]
  }
});
	
	</script>

@endsection
@section('content')

<div class="container-custom">
    <h1 class="h3 mb-3 fs-22 fw-600">
        Choose payment Method
    </h1>    
</div>


<div class="productheaderbg pt-lg-5 py-3">
    <div class="container d-lg-center">
        

        <div class="row">
            <div class="col-lg-8">
            <div class="steps steps-light py-3">
                <div class="step-item active current" >
                <div class="step-progress"><span class="step-count">1</span></div>
                <div class="step-label"><i class="las la-shopping-cart fs-24"></i>{{ translate(' My Cart')}}</div></div>

                <div class="step-item active current" >
                <div class="step-progress"><span class="step-count">2</span></div>
                <div class="step-label"><i class="las la-map fs-24"></i>{{ translate(' Shipping info')}}</div></div>

                <div class="step-item active current" >
                <div class="step-progress"><span class="step-count">3</span></div>
                <div class="step-label"><i class="las la-truck fs-24"></i>{{ translate('Delivery info')}}</div></div>

                <div class="step-item active current" >
                <div class="step-progress"><span class="step-count">4</span></div>
                <div class="step-label"><i class="las la-credit-card fs-24"></i>{{ translate(' Payment')}}</div></div>

                <div class="step-item" >
                <div class="step-progress"><span class="step-count">5</span></div>
                <div class="step-label"><i class="las la-check-circle fs-24"></i>{{ translate(' Confirmation')}}</div></div></div>
        </div></div>
    </div>
</div>

{{--
<section class="pt-5 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="row rit-steps arrow-divider">
                    <div class="col done">
                        <div class="text-center text-success">
                            <i class="la-3x mb-2 las la-shopping-cart"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block">{{ translate('1. My Cart')}}</h3>
                        </div>
                    </div>
                    <div class="col done">
                        <div class="text-center text-success">
                            <i class="la-3x mb-2 las la-map"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block">{{ translate('2. Shipping info')}}</h3>
                        </div>
                    </div>
                    <div class="col done">
                        <div class="text-center text-success">
                            <i class="la-3x mb-2 las la-truck"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block">{{ translate('3. Delivery info')}}</h3>
                        </div>
                    </div>
                    <div class="col active">
                        <div class="text-center text-primary">
                            <i class="la-3x mb-2 las la-credit-card"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block">{{ translate('4. Payment')}}</h3>
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
<section class="mb-4">
    <div class="container text-left">
        <div class="row">
            <div class="col-12  mb-6">
                <form action="{{ route('payment.checkout') }}" class="form-default" role="form" method="POST" id="checkout-form">
                    @csrf
                    <input type="hidden" name="owner_id" value="{{ $carts[0]['owner_id'] }}">

                    <div class="card my-3">
                        @if( $carts[0]->address->city_id !=7291)
                            <span class="badge badge-inline badge-warning">{{translate('For outside Dhaka city delivery charge must be paid in advance.')}}</span>
                        @endif
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-xxl-10 col-xl-12 mx-auto">
                                    <div class="row gutters-10">
                                        @if(get_setting('paypal_payment') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="rit-megabox d-block mb-3">
                                                    <input value="paypal" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 rit-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/paypal.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('Paypal')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('stripe_payment') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="rit-megabox d-block mb-3">
                                                    <input value="stripe" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 rit-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/stripe.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('Stripe')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('sslcommerz_payment') == 1)
                                            <div class="col-6  col-md-6">
                                                <label class="rit-megabox card-mobile d-block mb-3">
                                                    <input value="sslcommerz" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 rit-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/sslcommerz.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-13">{{ translate('sslcommerz')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('instamojo_payment') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="rit-megabox d-block mb-3">
                                                    <input value="instamojo" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 rit-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/instamojo.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('Instamojo')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('razorpay') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="rit-megabox d-block mb-3">
                                                    <input value="razorpay" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 rit-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/rozarpay.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('Razorpay')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('paystack') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="rit-megabox d-block mb-3">
                                                    <input value="paystack" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 rit-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/paystack.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('Paystack')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('voguepay') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="rit-megabox d-block mb-3">
                                                    <input value="voguepay" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 rit-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/vogue.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('VoguePay')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('payhere') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="rit-megabox d-block mb-3">
                                                    <input value="payhere" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 rit-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/payhere.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('payhere')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('ngenius') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="rit-megabox d-block mb-3">
                                                    <input value="ngenius" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 rit-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/ngenius.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('ngenius')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('iyzico') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="rit-megabox d-block mb-3">
                                                    <input value="iyzico" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 rit-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/iyzico.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('Iyzico')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('nagad') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="rit-megabox d-block mb-3">
                                                    <input value="nagad" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 rit-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/nagad.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('Nagad')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('bkash') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="rit-megabox d-block mb-3">
                                                    <input value="bkash" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 rit-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/bkash.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('Bkash')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('aamarpay') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="rit-megabox d-block mb-3">
                                                    <input value="aamarpay" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 rit-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/aamarpay.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('Aamarpay')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('proxypay') == 1)
                                            <div class="col-6 col-md-4">
                                                <label class="rit-megabox d-block mb-3">
                                                    <input value="proxypay" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 rit-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/proxypay.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('ProxyPay')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(\App\Addon::where('unique_identifier', 'african_pg')->first() != null && \App\Addon::where('unique_identifier', 'african_pg')->first()->activated)
                                            @if(get_setting('mpesa') == 1)
                                                <div class="col-6 col-md-4">
                                                    <label class="rit-megabox d-block mb-3">
                                                        <input value="mpesa" class="online_payment" type="radio" name="payment_option" checked>
                                                        <span class="d-block p-3 rit-megabox-elem">
                                                            <img src="{{ static_asset('assets/img/cards/mpesa.png')}}" class="img-fluid mb-2">
                                                            <span class="d-block text-center">
                                                                <span class="d-block fw-600 fs-15">{{ translate('mpesa')}}</span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            @endif
                                            @if(get_setting('flutterwave') == 1)
                                                <div class="col-6 col-md-4">
                                                    <label class="rit-megabox d-block mb-3">
                                                        <input value="flutterwave" class="online_payment" type="radio" name="payment_option" checked>
                                                        <span class="d-block p-3 rit-megabox-elem">
                                                            <img src="{{ static_asset('assets/img/cards/flutterwave.png')}}" class="img-fluid mb-2">
                                                            <span class="d-block text-center">
                                                                <span class="d-block fw-600 fs-15">{{ translate('flutterwave')}}</span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            @endif
                                            @if(get_setting('payfast') == 1)
                                                <div class="col-6 col-md-4">
                                                    <label class="rit-megabox d-block mb-3">
                                                        <input value="payfast" class="online_payment" type="radio" name="payment_option" checked>
                                                        <span class="d-block p-3 rit-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/payfast.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('payfast')}}</span>
                                                        </span>
                                                    </span>
                                                    </label>
                                                </div>
                                            @endif
                                        @endif
                                        @if(\App\Addon::where('unique_identifier', 'paytm')->first() != null && \App\Addon::where('unique_identifier', 'paytm')->first()->activated)
                                            <div class="col-6 col-md-4">
                                                <label class="rit-megabox d-block mb-3">
                                                    <input value="paytm" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 rit-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/paytm.jpg')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block fw-600 fs-15">{{ translate('Paytm')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(get_setting('cash_payment') == 1)
                                            @php
                                                $digital = 0;
                                                $cod_on = 1;
                                                foreach($carts as $cartItem){
                                                    $product = \App\Product::find($cartItem['product_id']);
                                                    if($product['digital'] == 1){
                                                        $digital = 1;
                                                    }
                                                    if($product['cash_on_delivery'] == 0){
                                                        $cod_on = 0;
                                                    }
													if($total>10000 && $cod_status!=1){
															$cod_on= 0;
														}
													if($total>20000 && $cod_status==1){
															$cod_on= 0;
														}
                                                }
                                            @endphp
                                            @if($digital != 1 && $cod_on == 1)
                                                <div class="col-6 col-md-6">
                                                    <label class="rit-megabox card-mobile d-block mb-3">
                                                        <input value="cash_on_delivery" class="online_payment pls" type="radio" name="payment_option" checked>
                                                        <span class="d-block p-3 rit-megabox-elem">
                                                            <img src="{{ static_asset('assets/img/cards/cod.png')}}" class="img-fluid mb-2">
                                                            <span class="d-block text-center">
                                                                <span class="d-block fw-600 fs-13">{{ translate('Cash on Delivery')}}</span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                </div> 
                                            @endif
                                        @endif
                                        @if (Auth::check())
                                            @if (\App\Addon::where('unique_identifier', 'offline_payment')->first() != null && \App\Addon::where('unique_identifier', 'offline_payment')->first()->activated)
                                                @foreach(\App\ManualPaymentMethod::all() as $method)
                                                    <div class="col-6 col-md-4">
                                                        <label class="rit-megabox d-block mb-3">
                                                            <input value="{{ $method->heading }}" type="radio" name="payment_option" onchange="toggleManualPaymentData({{ $method->id }})" data-id="{{ $method->id }}" checked>
                                                            <span class="d-block p-3 rit-megabox-elem">
                                                                <img src="{{ uploaded_asset($method->photo) }}" class="img-fluid mb-2">
                                                                <span class="d-block text-center">
                                                                    <span class="d-block fw-600 fs-15">{{ $method->heading }}</span>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endforeach

                                                @foreach(\App\ManualPaymentMethod::all() as $method)
                                                    <div id="manual_payment_info_{{ $method->id }}" class="d-none">
                                                        @php echo $method->description @endphp
                                                        @if ($method->bank_info != null)
                                                            <ul>
                                                                @foreach (json_decode($method->bank_info) as $key => $info)
                                                                    <li>{{ translate('Bank Name') }} - {{ $info->bank_name }}, {{ translate('Account Name') }} - {{ $info->account_name }}, {{ translate('Account Number') }} - {{ $info->account_number}}, {{ translate('Routing Number') }} - {{ $info->routing_number }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
							

{{--                            partial payment start--}}
                            <div id="parp" style="display: none;">
                            <div class="separator mb-3 mt-5">
                                    <span class="bg-white px-3">
                                        <span class=" fs-18"><b>{{ translate('Select Payment Option')}}</b></span>
                                    </span>
                            </div> <!-- #ch11 option for 100% payment-->
                            <div class="row">
                            <div class="col-6 col-md-4" style="display: inline-block;">
                                <label class="rit-megabox d-block mb-3 card-mobile">
                                    <input value="null" class="online_payment" type="radio" name="partial_pay" id="pam" >
                                    <span class="d-block p-3 rit-megabox-elem">
                                        <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/bCARNJGeMglSjo4HQC8wPLrHQ6BkQMhNDP81sYyy.webp" class="img-fluid mb-2">
                                        <span class="d-block text-center">
                                            <span class="d-block fw-600 fs-13">Total Amount: {{single_price($total)}}</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
								<!-- #ch11 end option for 100% payment-->
								  <div class="col-6 col-md-4" style="display: inline-block;">
                                <label class="rit-megabox card-mobile d-block mb-3">
                                    <input value="partial" class="online_payment" type="radio" name="partial_pay" id="pam" >
                                    <span class="d-block p-3 rit-megabox-elem">
                                        <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/rEdbnVmfqVUfKmxkopvCEaQ2IQtEbU2ytivpd5NL.webp" class="img-fluid mb-2">
                                        <span class="d-block text-center">
                                            <span class="d-block fw-600 fs-13">Partial Amount: {{single_price($partial_payment)}}</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                            <div class="form-group rit-checkbox-inline">
{{--                                <input type="checkbox" class="form rit-checkbox" name="partial_pay_amount" value="partial" required="" id="pam" min="10" disabled="disabled" style="width: 20px; height: 20px;">--}}
{{--                                <label for="pam" style="font-size:20px;"><span><h3>Pay Partial Amount: {{$partial_payment}} </h3></span></label>--}}
                                 <small id="emailHelp" style="font-size:13px;" class="form-text text-muted mt-3"><b>Note* :</b> For partial payment (10% payment) pay 10% in advance & pay rest after receive the product.</small>
                        {{--             <small id="emailHelp" style="font-size:14px;" class="form-text text-muted">Pay 50% of your current amount.</small> --}}
                            </div>
							 
                            </div>
{{--                            partial payment end--}}

                  {{--   #ch12 hide clubpoint balance --       @if (\App\Addon::where('unique_identifier', 'offline_payment')->first() != null && \App\Addon::where('unique_identifier', 'offline_payment')->first()->activated)
                                <div class="bg-white border mb-3 p-3 rounded text-left d-none">
                                    <div id="manual_payment_description">

                                    </div>
                                </div>
                            @endif
                            @if (Auth::check() && get_setting('wallet_system') == 1)
                                <div class="separator mb-3">
                                    <span class="bg-white px-3">
                                        <span class="opacity-60">{{ translate('Or')}}</span>
                                    </span>
                                </div>
                                <div class="text-center py-4">
                                    <div class="h6 mb-3">
                                        <span class="opacity-80">{{ translate('Your wallet balance :')}}</span>
                                        <span class="fw-600">{{ single_price(Auth::user()->balance) }}</span>
                                    </div>
                                    @if(Auth::user()->balance < $total)
                                        <button type="button" class="btn btn-secondary" disabled>
                                            {{ translate('Insufficient balance')}}
                                        </button>
                                    @else
                                        <button  type="button" onclick="use_wallet()" class="btn btn-primary fw-600">
                                            {{ translate('Pay with wallet')}}
                                        </button>
                                    @endif
                                </div>
                            @endif
--}}
                        </div>
                    </div>
                   
                    <div class="col-12 p-0 mt-4" id="cart_summary">
                        @include('frontend.partials.cart_summary')
                    </div>
                
                    <div class="p-2 py-3">
                        <b>
                        <label class="rit-checkbox">
                            <input type="checkbox" required id="agree_checkbox">
                            <span class="rit-square-check" style="border-color: red"></span>
                            <span>{{ translate('I agree to the')}}</span>
                        </label>
                        <a href="{{ route('terms') }}">{{ translate('terms and conditions')}}</a>,
                        <a href="{{ route('returnpolicy') }}">{{ translate('return policy')}}</a> &
                        <a href="{{ route('privacypolicy') }}">{{ translate('privacy policy')}}</a>
                        </b>
                    </div>

                

                    <div class="row align-items-center pt-3">
                       {{--<div class="col-6">
                            <a href="{{ route('home') }}" class="text-reset">
                                <button type="button" class="btn btn-mleft">
                                <i class="ci-arrow-left"></i>
                                {{ translate('Return to shop')}}</button>
                            </a>
                        </div>--}} 
                        <div class="col-12 text-right">
                            <button type="button" onclick="submitOrder(this)" class="btn btn-block btn-dark rounded-custom fw-600"><div class="d-flex justify-content-between"><div>{{ translate('Complete Order')}}</div><div><img height="24px" src="{{ static_asset('m_asset/arrow-right.png') }}"/></div></div></button>
                        </div>
                    </div>
                </form>
            </div>


            

        </div>
    </div>
</section>
@endsection

@section('script')
    <script type="text/javascript">

        if( $('.cods:checked').val()){
            $('#pam').attr("disabled","disabled");

        }else{

            $('#pam').removeAttr("disabled");
        }
        if( $('.pls:checked').val()){
			$('#parp').attr("style","display:none;");
            $('#pam').attr("disabled","disabled");
        }else{
			$('#parp').attr("style","display:block;");
            $('#pam').removeAttr("disabled");
        }

        $(document).ready(function(){
            $(".online_payment").click(function(){
                $('#manual_payment_description').parent().addClass('d-none');
            });
            toggleManualPaymentData($('input[name=payment_option]:checked').data('id'));
        });

        $('.online_payment').on('change', function() {

            if( $('.cods:checked').val()){
                $('#pam').attr("disabled","disabled");

            }else{
                $('#pam').removeAttr("disabled");
            }
            if( $('.pls:checked').val()){
				$('#parp').attr("style","display:none;");
                $('#pam').attr("disabled","disabled");
            }else{
				$('#parp').attr("style","display:block;");
                $('#pam').removeAttr("disabled");
            }
        });

        function use_wallet(){
            $('input[name=payment_option]').val('wallet');
            if($('#agree_checkbox').is(":checked")){
                $('#checkout-form').submit();
            }else{
                RIT.plugins.notify('danger','{{ translate('You need to agree with our policies') }}');
            }
        }
        function submitOrder(el){
            $(el).prop('disabled', true);
            if($('#agree_checkbox').is(":checked")){
                $('#checkout-form').submit();
            }else{
                RIT.plugins.notify('danger','{{ translate('You need to agree with our policies') }}');
                $(el).prop('disabled', false);
            }
        }

        function toggleManualPaymentData(id){
            if(typeof id != 'undefined'){
                $('#manual_payment_description').parent().removeClass('d-none');
                $('#manual_payment_description').html($('#manual_payment_info_'+id).html());
            }
        }

        $(document).on("click", "#coupon-apply",function() {
            var data = new FormData($('#apply-coupon-form')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{route('checkout.apply_coupon_code')}}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data, textStatus, jqXHR) {
                    RIT.plugins.notify(data.response_message.response, data.response_message.message);
//                    console.log(data.response_message);
                    $("#cart_summary").html(data.html);
                }
            })
        });

        $(document).on("click", "#coupon-remove",function() {
            var data = new FormData($('#remove-coupon-form')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{route('checkout.remove_coupon_code')}}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data, textStatus, jqXHR) {
                    $("#cart_summary").html(data);
                }
            })
        })
    </script>
@endsection
