@extends('frontend.layouts.app')
@section('datalayer')
@php
                                    $total = 0;
                                @endphp
@foreach ($carts as $cartItem)
            @php

                $total = $total + ($cartItem['price'] + $cartItem['tax']) * $cartItem['quantity'];


            @endphp
@endforeach

<script type = "text/javascript">
dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
dataLayer.push({
  event: "add_shipping_info",
  ecommerce: {
    currency: "BDT",
    value: {{number_format((float)$total, 2, '.', '')}},
    coupon: "",
    shipping_tier: "",
    items:
        [@foreach ($carts as $cartItem)
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
      price: {{number_format((float)$cartItem['price'], 2, '.', '')?? 0.00}},
      quantity: {{$cartItem['quantity']?? 0}}
    }
   @endforeach ]
  }
});


</script>

@endsection

@section('content')


<div class="container-custom">
                <h1 class="h3 mb-2 fs-22 fw-600">
                    Shipping Info
                </h1>
 </div>

<div class="productheaderbg  py-3">
    <div class="container d-lg-center">
       

        <div class="row">
            <div class="steps steps-light py-3">
                <div class="step-item active current" >
                <div class="step-progress"><span class="step-count">1</span></div>
                <div class="step-label"><i class="las la-shopping-cart fs-24"></i>{{ translate(' My Cart')}}</div></div>

                <div class="step-item active current" >
                <div class="step-progress"><span class="step-count">2</span></div>
                <div class="step-label"><i class="las la-map fs-24"></i>{{ translate('Shipping info')}}</div></div>

                <div class="step-item">
                <div class="step-progress"><span class="step-count">3</span></div>
                <div class="step-label"><i class="las la-truck fs-24"></i>{{ translate('Delivery info')}}</div></div>

                <div class="step-item">
                <div class="step-progress"><span class="step-count">4</span></div>
                <div class="step-label"><i class="las la-credit-card fs-24"></i>{{ translate(' Payment')}}</div></div>

                <div class="step-item">
                <div class="step-progress"><span class="step-count">5</span></div>
                <div class="step-label"><i class="las la-check-circle fs-24"></i>{{ translate(' Confirmation')}}</div></div></div>
        </div>
    </div>
</div>

<section class="my-3">
    <div class="container-custom">
        <div class="row cols-xs-space cols-sm-space cols-md-space">
            <div class="col-xxl-10 col-xl-12 mx-auto">
                <form class="form-default" data-toggle="validator" action="{{ route('checkout.store_shipping_infostore') }}" role="form" method="POST">
                    @csrf
                    @if(Auth::check())
                        <div class=" bg-white rounded mb-4">
                            <div class="row gutters-5">
                                @foreach (Auth::user()->addresses as $key => $address)
                                    <div class="col-md-12 mb-3 ">
                                        <label class="aiz-megabox d-block card-mobile mb-0">
                                            <input type="radio" name="address_id" value="{{ $address->id }}" @if ($address->set_default)
                                                checked
                                            @endif required>
                                            <span class="d-flex p-3 aiz-megabox-elem shadow-sm hov-shadow-md ">
                                                <span class="aiz-rounded-check flex-shrink-0 mt-1 "></span>
                                           
                                                <div class="row px-2">
                                                    <div class="col-4">
                                                        <div>
                                                            <span class="opacity-90 pr-2">{{ translate('Address') }}:</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-90 pr-2">{{ translate('Postal Code') }}:</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-90 pr-2">{{ translate('Area') }}:</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-90 pr-2">{{ translate('District') }}:</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-90 pr-2">{{ translate('Country') }}:</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-90 pr-2">{{ translate('Phone') }}:</span>
                                                    </div>

                                                    </div>
                                                    <div class="col-8">

                                                    <div>
                                                        <span class="fw-600 ml-2">{{ $address->address }}</span>

                                                    </div>
                                                    <div> <span class="fw-600 ml-2">{{ $address->postal_code }}</span>
                                                    </div>
                                                    <div> <span class="fw-600 ml-2">{{ optional($address->city)->name }}</span>
                                                    </div>
                                                    <div> <span class="fw-600 ml-2">{{ optional($address->state)->name }}</span>
                                                    </div>
                                                    <div> <span class="fw-600 ml-2">{{ optional($address->country)->name }}</span>
                                                    </div>
                                                     <span class="fw-600 ml-2">{{ $address->phone }}</span>
                                                    </div>
                                                </div>
                                            </span>
                                        </label>
                                        <div class="dropdown position-absolute right-0 top-0">
                                            <button class="btn bg-gray px-2" type="button" data-toggle="dropdown">
                                                <i class="fa fa-edit fs-18 pr-1 text-primary"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" onclick="edit_address('{{$address->id}}')">
                                                    {{ translate('Edit') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <input type="hidden" name="checkout_type" value="logged">
                                <div class="col-md-12 mx-auto mb-3" >
                                    <div class="border p-3 rounded mb-3 c-pointer text-center bg-white h-100 d-flex flex-column justify-content-center" onclick="add_new_address()">
                                        <i class="fa fa-plus-square fa-2x mb-3 text-primary"></i>
                                        <div class="alpha-7 fw-600">{{ translate('Add New Address') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row align-items-center  mb-3">
                       {{--<div class="col-md-6 text-center text-md-left order-1 order-md-0">
                            <a href="{{ route('home') }}" class="btn  btn-mleft ">
                                <i class="ci-arrow-left"></i>
                                {{ translate('Return to shop')}}
                            </a>
                        </div>--}} 
                        <div class="col-12 text-center text-md-right">
                            <button type="submit" class="btn btn-block btn-dark rounded-custom fw-600 btn-mright"><div class="d-flex justify-content-between"><div>{{ translate('Continue to Delivery Info')}}</div><div><img height="24px" src="{{ static_asset('m_asset/arrow-right.png') }}"/></div></div></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('modal')
    @include('frontend.partials.address_modal')
@endsection
