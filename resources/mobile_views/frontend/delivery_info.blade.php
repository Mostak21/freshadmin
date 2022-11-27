@extends('frontend.layouts.app')

@section('content')

<div class="container-custom">
    <h1 class="h3 mb-3 fs-22 fw-600">
       Shipping Method
    </h1>
</div>
    <div class="productheaderbg pt-lg-5 py-3">
        <div class="container d-lg-center">
           

            <div class="row">
                <div class="steps steps-light pt-3 pb-3">
                    <div class="step-item active current" >
                        <div class="step-progress"><span class="step-count">1</span></div>
                        <div class="step-label"><i class="las la-shopping-cart fs-24"></i>{{ translate(' My Cart')}}</div></div>

                    <div class="step-item active current" >
                        <div class="step-progress"><span class="step-count">2</span></div>
                        <div class="step-label"><i class="las la-map fs-24"></i>{{ translate(' Shipping info')}}</div></div>

                    <div class="step-item active current" >
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

    <section class="py-4 gry-bg">
        <div class="container-custom">
            <div class="row">
                <div class="col-xxl-10 col-xl-12 mx-auto">
                    <form class="form-default" action="{{ route('checkout.store_delivery_info') }}" role="form" method="POST" id="deleveryskip">
                        @csrf
                        @php
                            $admin_products = array();
                            $seller_products = array();
                            foreach ($carts as $key => $cartItem){
                                $product = \App\Models\Product::find($cartItem['product_id']);

                                if($product->added_by == 'admin'){
                                    array_push($admin_products, $cartItem['product_id']);
                                }
                                else{
                                    $product_ids = array();
                                    if(isset($seller_products[$product->user_id])){
                                        $product_ids = $seller_products[$product->user_id];
                                    }
                                    array_push($product_ids, $cartItem['product_id']);
                                    $seller_products[$product->user_id] = $product_ids;
                                }
                            }
                        @endphp

                        @if (!empty($admin_products))
                            <div class="card mb-3 shadow-sm border-0 rounded">
                                <div class="card-header p-3">
                                    <h5 class="fs-16 fw-600 mb-0">{{ get_setting('site_name') }} {{ translate('Products') }}</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        @foreach ($admin_products as $key => $cartItem)
                                            @php
                                                $product = \App\Models\Product::find($cartItem);
                                            @endphp
                                            <li class="list-group-item">
                                                <div class="d-flex">
                                        <span class="mr-2">
                                            <img
                                                src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                class="img-fit size-60px rounded"
                                                alt="{{  $product->getTranslation('name')  }}"
                                            >
                                        </span>
                                                    <span class="fs-14 opacity-60">{{ $product->getTranslation('name') }}</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <div class="row border-top pt-3">
                                        <div class="col-md-6">
                                            <h6 class="fs-15 fw-600">{{ translate('Choose Delivery Type') }}</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row gutters-5">
                                                <div class="col-6">
                                                    <label class="rit-megabox d-block bg-white mb-0">
                                                        <input
                                                            type="radio"
                                                            name="shipping_type_{{ \App\Models\User::where('user_type', 'admin')->first()->id }}"
                                                            value="home_delivery"
                                                            onchange="show_pickup_point(this)"
                                                            data-target=".pickup_point_id_admin"
                                                            checked
                                                        >
                                                        <span class="d-flex p-3 rit-megabox-elem">
                                                    <span class="rit-rounded-check flex-shrink-0 mt-1"></span>
                                                    <span class="flex-grow-1 pl-3 fw-600">{{  translate('Home Delivery') }}</span>
                                                </span>
                                                    </label>
                                                </div>

                                                @if (\App\Models\BusinessSetting::where('type', 'pickup_point')->first()->value == 1)
                                                    <div class="col-6">
                                                        <label class="rit-megabox d-block bg-white mb-0">
                                                            <input
                                                                type="radio"
                                                                name="shipping_type_{{ \App\Models\User::where('user_type', 'admin')->first()->id }}"
                                                                value="pickup_point"
                                                                onchange="show_pickup_point(this)"
                                                                data-target=".pickup_point_id_admin"
                                                            >
                                                            <span class="d-flex p-3 rit-megabox-elem">
                                                    <span class="rit-rounded-check flex-shrink-0 mt-1"></span>
                                                    <span class="flex-grow-1 pl-3 fw-600">{{  translate('Local Pickup') }}</span>
                                                </span>
                                                        </label>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="mt-4 pickup_point_id_admin d-none">
                                                <select
                                                    class="form-control rit-selectpicker"
                                                    name="pickup_point_id_{{ \App\Models\User::where('user_type', 'admin')->first()->id }}"
                                                    data-live-search="true"
                                                >
                                                    <option>{{ translate('Select your nearest pickup point')}}</option>
                                                    @foreach (\App\Models\PickupPoint::where('pick_up_status',1)->get() as $key => $pick_up_point)
                                                        <option
                                                            value="{{ $pick_up_point->id }}"
                                                            data-content="<span class='d-block'>
                                                                    <span class='d-block fs-16 fw-600 mb-2'>{{ $pick_up_point->getTranslation('name') }}</span>
                                                                    <span class='d-block opacity-50 fs-12'><i class='las la-map-marker'></i> {{ $pick_up_point->getTranslation('address') }}</span>
                                                                    <span class='d-block opacity-50 fs-12'><i class='las la-phone'></i>{{ $pick_up_point->phone }}</span>
                                                                </span>"
                                                        >
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endif
                        @if (!empty($seller_products))

                            <!-- Shipping methods table-->
                            <div class="mb-5">
                                
                                <div class=" fs-14">
                                    <table class="table fs-sm"style="border-collapse:separate; 
                                    border-spacing: 0 1em;">
                                        <thead>
                                        <tr class="bg-soft-secondary">
                                            <th class="align-middle"></th>
                                            <th class="align-middle">Shipping method</th>
                                            <th class="align-middle">Delivery time</th>
                                            <th class="align-middle">Handling fee</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($agents as $key=> $agent)
                                                <tr class="card-mobile rounded-custom">
                                                    <td>
                                                        <div class="form-check mb-4 ">
                                                            <input class="form-check-input rit-rounded-check" type="radio"
                                                                   id="{{$agent->id}}"
                                                                   value="{{$agent->id}}"
                                                                   name="shipping_method"
                                                                   @if($key==0) checked @endif >

                                                            <label class="form-check-label" for="{{$agent->id}}"></label>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle"><span class="text-dark fw-medium">{{$agent->name??''}}</span><br><span class="text-muted">{{$agent->info??''}}</span></td>
                                                    <td class="align-middle">{{$agent->time??''}}</td>
                                                    <td class="align-middle">{{$agent->cost??''}}</td>
                                                </tr>
                                        @endforeach


                                        </tbody>
                                    </table>
                                </div>
                                </div>
                        @endif

                        <div class=" my-3 d-flex justify-content-between align-items-center">
                            {{-- <a href="{{ route('home') }}" >
                                <i class="la la-angle-left"></i>
                                {{ translate('Return to shop')}}
                            </a> --}}
                            <button type="submit" class="btn btn-block btn-dark rounded-custom fw-600"><div class="d-flex justify-content-between"><div>{{ translate('Continue to Payment')}}</div><div><img height="24px" src="{{ static_asset('m_asset/arrow-right.png') }}"/></div></div></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        function display_option(key){

        }
        function show_pickup_point(el) {
            var value = $(el).val();
            var target = $(el).data('target');

            // console.log(value);

            if(value == 'home_delivery'){
                if(!$(target).hasClass('d-none')){
                    $(target).addClass('d-none');
                }
            }else{
                $(target).removeClass('d-none');
            }
        }
    </script>
@endsection
