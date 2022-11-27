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
<div class="productheaderbg pt-lg-5 py-3">
    <div class="container d-lg-center">
        <div class="row pb-4">
            <div class="col-lg-6 text-center text-lg-left">
                <h1 class="h3 mb-2  fw-600">
                    Shipping Info
                </h1>

            </div>
            <div class="col-lg-6 fs-13">
                <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                    <li class="breadcrumb-item ">

                        <a class="text-reset" href="{{ route('home') }}"> <i class="fa fa-home"></i> {{ translate('Home')}}</a>
                    </li>

                    <li class="text-dark  breadcrumb-item">
                        Shipping Info
                    </li>

                </ul>
            </div>
        </div>

        <div class="row">
            <div class="steps steps-light pt-lg-3 pb-3">
                <div class="step-item active current" >
                <div class="step-progress"><span class="step-count">1</span></div>
                <div class="step-label"><i class="las la-shopping-cart fs-24"></i>{{ translate(' My Cart')}}</div></div>

                <div class="step-item active current" >
                <div class="step-progress"><span class="step-count">2</span></div>
                <div class="step-label"><i class="las la-map fs-24"></i>{{ translate('Shipping info')}}</div></div>

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
                    <div class="col done">
                        <div class="text-center text-success">
                            <i class="la-3x mb-2 las la-shopping-cart"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block ">{{ translate('1. My Cart')}}</h3>
                        </div>
                    </div>
                    <div class="col active">
                        <div class="text-center text-primary">
                            <i class="la-3x mb-2 las la-map"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block ">{{ translate('2. Shipping info')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-truck"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 ">{{ translate('3. Delivery info')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-credit-card"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 ">{{ translate('4. Payment')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-check-circle"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 ">{{ translate('5. Confirmation')}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
--}}
<section class="mb-4 gry-bg">
    <div class="container">
        <div class="row cols-xs-space cols-sm-space cols-md-space">
            <div class="col-xxl-10 col-xl-12 mx-auto">
                <form class="form-default" data-toggle="validator" action="{{ route('checkout.store_shipping_infostore') }}" role="form" method="POST">
                    @csrf
                    @if(Auth::check())
                        <div class="shadow-sm bg-white p-4 rounded mb-4">
                            <div class="row gutters-5">
                                @foreach (Auth::user()->addresses as $key => $address)
                                    <div class="col-md-12 mb-3 ">
                                        <label class="rit-megabox d-block bg-white mb-0">
                                            <input type="radio" name="address_id" value="{{ $address->id }}" @if ($address->set_default)
                                                checked
                                            @endif required>
                                            <span class="d-flex p-3 rit-megabox-elem shadow-sm hov-shadow-md ">
                                                <span class="rit-rounded-check flex-shrink-0 mt-1 "></span>
                                            {{--    <span class="flex-grow-1 pl-3 text-left">
                                                    <div>
                                                        <span class="opacity-90 pr-2">{{ translate('Address') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->address }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-90 pr-2">{{ translate('Postal Code') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->postal_code }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-90 pr-2">{{ translate('City') }}:</span>
                                                        <span class="fw-600 ml-2">{{ optional($address->city)->name }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-90 pr-2">{{ translate('State') }}:</span>
                                                        <span class="fw-600 ml-2">{{ optional($address->state)->name }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-90 pr-2">{{ translate('Country') }}:</span>
                                                        <span class="fw-600 ml-2">{{ optional($address->country)->name }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-90 pr-2">{{ translate('Phone') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->phone }}</span>
                                                    </div>
                                                </span>--}}
                                                <div class="row ml-2 px-2">
                                                    <div class="col-6">
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
                                                    <div class="col-6">

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
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center text-md-left order-1 order-md-0">
                            <a href="{{ route('home') }}" class="btn  btn-mleft ">
                                <i class="ci-arrow-left"></i>
                                {{ translate('Return to shop')}}
                            </a>
                        </div>
                        <div class="col-md-6 text-center text-md-right">
                            <button type="submit" class="btn btn-primary fw-600 btn-mright">{{ translate('Continue to Delivery Info')}}<i class="ci-arrow-right fw-600 pl-2"></i></button>
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
