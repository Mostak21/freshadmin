@extends('frontend.layouts.app')
@section('datalayer')

 @foreach ($combined_order->orders as $order)
<script type = "text/javascript">
        dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
        dataLayer.push({
            event    : "purchase",
            ecommerce: {
                transaction_id: "{{ $order->code }}",
                affiliation   : "",
                value         : {{number_format((float)$order->orderDetails->sum('price'), 2, '.', '')}},
                tax           : {{number_format((float)$order->orderDetails->sum('tax'), 2, '.', '')??0}},
                shipping      : {{number_format((float)$order->orderDetails->sum('shipping_cost'), 2, '.', '')}},
                currency      : "BDT",
                coupon        : "",
                items         : [@foreach ($order->orderDetails as $orderDetail){
								 @php
								 	$item_category = category_tree($orderDetail->product->category->id);
								 @endphp
                    
								 
					item_id: "{{$orderDetail->product->id}}",
					item_name: "{!!$orderDetail->product->getTranslation('name')!!}",
					affiliation: "",
					coupon: "",
					currency: "BDT",
					discount: {{number_format((float)$orderDetail->product->discount, 2, '.', '')??0}},
					index: 0,
					item_brand: "{{$orderDetail->product->brand->name??""}}",
					item_category: "{!! $item_category[0]??"" !!}",
					item_category2: "{!! $item_category[1]??"" !!}",
					item_category3: "{!! $item_category[2]??"" !!}",
					item_category4: "",
					item_category5: "",
					item_list_id: "",
					item_list_name: "",
					item_variant: "",
					location_id: "",
					price: {{number_format((float)$orderDetail->product->unit_price, 2, '.', '')}},
					quantity: 1
                },@endforeach] 
            }
        });
    </script>
@endforeach


@endsection
@section('content')
<div class="productheaderbg pt-lg-5 py-3">
    <div class="container d-lg-center">
        <div class="row pb-4">
            <div class="col-lg-6 text-center text-lg-left">
                <h1 class="h3 mb-2  fw-600">
                    Select Payment
                </h1>
              
            </div>
            <div class="col-lg-6 fs-13">
                <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                    <li class="breadcrumb-item ">
                        
                        <a class="text-reset" href="{{ route('home') }}"> <i class="fa fa-home"></i> {{ translate('Home')}}</a>
                    </li>   
                    
                    <li class="text-dark  breadcrumb-item">
                        Payment
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

                <div class="step-item active current" >
                <div class="step-progress"><span class="step-count">4</span></div>
                <div class="step-label"><i class="las la-credit-card fs-24"></i>{{ translate(' Payment')}}</div></div>

                <div class="step-item active current" >
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
                        <div class="col done">
                            <div class="text-center text-success">
                                <i class="la-3x mb-2 las la-truck"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block">{{ translate('3. Delivery info')}}</h3>
                            </div>
                        </div>
                        <div class="col done">
                            <div class="text-center text-success">
                                <i class="la-3x mb-2 las la-credit-card"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block">{{ translate('4. Payment')}}</h3>
                            </div>
                        </div>
                        <div class="col active">
                            <div class="text-center text-primary">
                                <i class="la-3x mb-2 las la-check-circle"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block">{{ translate('5. Confirmation')}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>--}}
    <section class="py-4">
        <div class="container text-left">
            <div class="row border">
                <div class="col-xl-12 mx-auto">
                    @php
                        $first_order = $combined_order->orders->first()
                    @endphp
                    <div class="text-center pt-4">
                        
                        <h3 class="h5 mb-3 fw-600">{{ translate('Thank You for Your Order!')}}</h3>
                    </div>
             

                    
                        <div class="card shadow-sm border-0 rounded">
                            <div class="card-body">
                                
                                <div class="text-center py-4 mb-4">
                                    <div>
                                    Your order has been placed and will be processed as soon as possible.
                                    </div>
                                    <div>
                                        Make sure you make note of your order number, which is @foreach ($combined_order->orders as $order) <span class="fw-700 text-primary">{{ $order->code }},@endforeach</span>.
                                    </div>
                                    <div> You will be receiving an email shortly with confirmation of your order.
                                    </div>
                                </div>
                               
                                  <div class="text-center">
                                      
                                <a class="btn btn-secondary mt-3 me-3" href="/">Go back shopping</a>
                                <a class="btn btn-primary mt-3" href="{{ route('orders.track') }}"><i class="ci-location"></i>&nbsp;Track order</a>  
                            </div></div>  
                        </div>
                    
                </div>
            </div>
        </div>
    </section>
@endsection
