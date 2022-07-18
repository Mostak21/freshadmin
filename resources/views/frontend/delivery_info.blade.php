@extends('frontend.layouts.app')

@section('content')

    <div class="productheaderbg pt-lg-5 py-3">
        <div class="container d-lg-center">
            <div class="row pb-4">
                <div class="col-lg-6 text-center text-lg-left">
                    <h1 class="h3 mb-2  fw-600">
                        Delivery info
                    </h1>

                </div>
                <div class="col-lg-6 fs-13">
                    <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                        <li class="breadcrumb-item ">

                            <a class="text-reset" href="{{ route('home') }}"> <i class="fa fa-home"></i> {{ translate('Home')}}</a>
                        </li>

                        <li class="text-dark  breadcrumb-item">
                            Delivery info
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
    </div>{{--
<section class="pt-5 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="row aiz-steps arrow-divider">
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
                    <div class="col active">
                        <div class="text-center text-primary">
                            <i class="la-3x mb-2 las la-truck"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block">{{ translate('3. Delivery info')}}</h3>
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

    <section class="py-4 gry-bg">
        <div class="container">
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
                                                    <label class="aiz-megabox d-block bg-white mb-0">
                                                        <input
                                                            type="radio"
                                                            name="shipping_type_{{ \App\Models\User::where('user_type', 'admin')->first()->id }}"
                                                            value="home_delivery"
                                                            onchange="show_pickup_point(this)"
                                                            data-target=".pickup_point_id_admin"
                                                            checked
                                                        >
                                                        <span class="d-flex p-3 aiz-megabox-elem">
                                                    <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                    <span class="flex-grow-1 pl-3 fw-600">{{  translate('Home Delivery') }}</span>
                                                </span>
                                                    </label>
                                                </div>

                                                @if (\App\Models\BusinessSetting::where('type', 'pickup_point')->first()->value == 1)
                                                    <div class="col-6">
                                                        <label class="aiz-megabox d-block bg-white mb-0">
                                                            <input
                                                                type="radio"
                                                                name="shipping_type_{{ \App\Models\User::where('user_type', 'admin')->first()->id }}"
                                                                value="pickup_point"
                                                                onchange="show_pickup_point(this)"
                                                                data-target=".pickup_point_id_admin"
                                                            >
                                                            <span class="d-flex p-3 aiz-megabox-elem">
                                                    <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                    <span class="flex-grow-1 pl-3 fw-600">{{  translate('Local Pickup') }}</span>
                                                </span>
                                                        </label>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="mt-4 pickup_point_id_admin d-none">
                                                <select
                                                    class="form-control aiz-selectpicker"
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
{{--                            @foreach ($seller_products as $key => $seller_product)--}}
{{--                                <div class="card mb-3 shadow-sm border-0 rounded">--}}
{{--                                    <div class="card-header p-3">--}}
{{--                                        <h5 class="fs-18 fw-600 mb-0">Choose shipping method for {{ \App\Models\Shop::where('user_id', $key)->first()->name }} {{ translate('Products') }}</h5>--}}
{{--                                    </div>--}}
{{--                                    <div class="card-body">--}}
{{--                                        <ul class="list-group list-group-flush">--}}
{{--                                            @foreach ($seller_product as $cartItem)--}}
{{--                                                @php--}}
{{--                                                    $product = \App\Models\Product::find($cartItem);--}}
{{--                                                @endphp--}}
{{--                                                <li class="list-group-item">--}}
{{--                                                    <div class="d-flex">--}}
{{--                                                <span class="mr-2">--}}
{{--                                                    <img--}}
{{--                                                        src="{{ uploaded_asset($product->thumbnail_img) }}"--}}
{{--                                                        class="img-fit size-60px rounded"--}}
{{--                                                        alt="{{  $product->getTranslation('name')  }}"--}}
{{--                                                    >--}}
{{--                                                </span>--}}
{{--                                                        <span class="fs-12 opacity-60">{{ $product->getTranslation('name') }}</span>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                            @endforeach--}}
{{--                                        </ul>--}}


{{--                                        <div class="row border-top pt-3">--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <h6 class="fs-15 fw-600">{{ translate('Choose Delivery Type') }}</h6>--}}
{{--                                            </div>--}}


{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="row gutters-5">--}}
{{--                                                    <div class="col-6">--}}

{{--                                                        --}}{{--                                                        <label class="aiz-megabox d-block bg-white mb-0">--}}
{{--                                                        --}}{{--                                                            <input--}}
{{--                                                        --}}{{--                                                                type="radio"--}}
{{--                                                        --}}{{--                                                                name="shipping_type_{{ $key }}"--}}
{{--                                                        --}}{{--                                                                value="pickup_point"--}}
{{--                                                        --}}{{--                                                                onchange="show_pickup_point(this)"--}}
{{--                                                        --}}{{--                                                                data-target=".pickup_point_id_{{ $key }}"--}}
{{--                                                        --}}{{--                                                            >--}}
{{--                                                        --}}{{--                                                            <span class="d-flex p-3 aiz-megabox-elem">--}}
{{--                                                        --}}{{--                                                                <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>--}}
{{--                                                        --}}{{--                                                                <span class="flex-grow-1 pl-3 fw-600">{{  translate('Local Pickup') }}</span>--}}
{{--                                                        --}}{{--                                                            </span>--}}
{{--                                                        --}}{{--                                                        </label>--}}

{{--                                                    </div>--}}
{{--                                                    --}}{{--                                                @if (\App\Models\BusinessSetting::where('type', 'pickup_point')->first()->value == 1)--}}
{{--                                                    --}}{{--                                                    @if (is_array(json_decode(\App\Models\Shop::where('user_id', $key)->first()->pick_up_point_id)))--}}

{{--                                                    --}}{{--                                                    @endif--}}
{{--                                                    --}}{{--                                                @endif--}}
{{--                                                    <div class="col-6">--}}

{{--                                                        <label class="aiz-megabox d-block bg-white mb-0">--}}
{{--                                                            <input--}}
{{--                                                                type="radio"--}}
{{--                                                                name="shipping_type_{{ $key }}"--}}
{{--                                                                value="home_delivery"--}}
{{--                                                                onchange="show_pickup_point(this)"--}}
{{--                                                                data-target=".pickup_point_id_{{ $key }}"--}}
{{--                                                                checked--}}
{{--                                                            >--}}
{{--                                                            <span class="d-flex p-3 aiz-megabox-elem">--}}
{{--                                                       <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>--}}
{{--                                                       <span class="flex-grow-1 pl-3 fw-600">{{  translate('Home Delivery') }}</span>--}}
{{--                                                   </span>--}}
{{--                                                        </label>--}}


{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                @if (\App\Models\BusinessSetting::where('type', 'pickup_point')->first()->value == 1)--}}
{{--                                                    @if (is_array(json_decode(\App\Models\Shop::where('user_id', $key)->first()->pick_up_point_id)))--}}
{{--                                                        <div class="mt-4 pickup_point_id_{{ $key }} d-none">--}}
{{--                                                            <select--}}
{{--                                                                class="form-control aiz-selectpicker"--}}
{{--                                                                name="pickup_point_id_{{ $key }}"--}}
{{--                                                                data-live-search="true"--}}
{{--                                                            >--}}
{{--                                                                <option>{{ translate('Select your nearest pickup point')}}</option>--}}
{{--                                                                @foreach (\App\Models\PickupPoint::where('pick_up_status',1)->get() as $key => $pick_up_point)--}}
{{--                                                                    <option--}}
{{--                                                                        value="{{ $pick_up_point->id }}"--}}
{{--                                                                        data-content="<span class='d-block'>--}}
{{--                                                                                <span class='d-block fs-16 fw-600 mb-2'>{{ $pick_up_point->getTranslation('name') }}</span>--}}
{{--                                                                                <span class='d-block opacity-50 fs-12'><i class='las la-map-marker'></i> {{ $pick_up_point->getTranslation('address') }}</span>--}}
{{--                                                                                <span class='d-block opacity-50 fs-12'><i class='las la-phone'></i>{{ $pick_up_point->phone }}</span>--}}
{{--                                                                            </span>"--}}
{{--                                                                    >--}}
{{--                                                                    </option>--}}
{{--                                                                @endforeach--}}
{{--                                                            </select>--}}
{{--                                                        </div>--}}
{{--                                                    @endif--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}

                            <!-- Shipping methods table-->
                            <div class="card mb-3 shadow-sm border-0 rounded">
                                <h2 class="h5 pb-3 mb-2">Choose shipping method</h2>
                                <div class="table-responsive fs-14">
                                    <table class="table table-hover fs-sm border-top">
                                        <thead>
                                        <tr>
                                            <th class="align-middle"></th>
                                            <th class="align-middle">Shipping method</th>
                                            <th class="align-middle">Delivery time</th>
                                            <th class="align-middle">Handling fee</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @php $checked = 1; $cost_status= 1; @endphp
                                        @foreach($agents as $key=> $agent)
                                            @php
                                                if( !empty($agent_costs)){
                                                    foreach($agent_costs as $key=> $costs){
                                                        if ($costs->delivery_agent_id == $agent->id){
                                                            $cost=$costs;
                                                            if ($cost->status == 0){
                                                                $cost_status= 0;
                                                            }
                                                            if ($cost->status == 1){
                                                                $cost_status= 1;
                                                            }
                                                        }
                                                    }
                                                }
                                            @endphp

                                            {{--                                                    {{var_dump($cost_status)}}--}}

                                            @if($agent->status==1 && $cost_status == 1)

                                                <tr >
                                                    <td>
                                                        <div class="form-check mb-4 ">
                                                            <input class="form-check-input aiz-rounded-check" type="radio" id="{{$agent->id}}" value="{{$agent->id}}" name="shipping_method" @php if($checked==1) echo "checked"; $checked =0; @endphp>

                                                            <label class="form-check-label" for="{{$agent->id}}"></label>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle"><span class="text-dark fw-medium">{{$agent->name}}</span><br><span class="text-muted">{{$agent->info??''}}</span></td>
                                                    <td class="align-middle">{{$cost->time??$agent->time}}</td>
                                                    <td class="align-middle">{{$cost->cost??$agent->cost}}</td>
                                                </tr>
                                            @endif
                                        @endforeach


                                        </tbody>
                                    </table>
                                </div>
                                </div>
                        @endif

                        <div class="pt-4 d-flex justify-content-between align-items-center">
                            <a href="{{ route('home') }}" >
                                <i class="la la-angle-left"></i>
                                {{ translate('Return to shop')}}
                            </a>
                            <button type="submit" class="btn fw-600 btn-primary">{{ translate('Continue to Payment')}}</button>
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
