@extends('frontend.layouts.app')

@section('content')
<section class="productheaderbg py-5">
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left">
                <h1 class="fw-600 h4">{{ translate('Track Order') }}:   @isset($order) {{ $order->code }} @endisset</h1>
            </div>
            <div class="col-lg-6">
                <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                    <li class="breadcrumb-item opacity-50">
                        <a class="text-reset" href="{{ route('home') }}"><i class="fa fa-home"></i> {{ translate('Home') }}</a>
                    </li>
                    <li class="text-dark fw-600 breadcrumb-item">
                        <a class="text-reset" href="{{ route('orders.track') }}">{{ translate('Track Order') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="mb-5">
    <div class="container text-left">
        <div class="row">
            <div class="col-xxl-5 col-xl-6 col-lg-8 mx-auto">
                <form class="" action="{{ route('orders.track') }}" method="GET" enctype="multipart/form-data">
                    <div class="bg-white ">
                        <div class="fs-15 fw-600 p-3 text-center">
                            {{ translate('Check Your Order Status')}}
                        </div> 
                        <div class="form-box-content p-3">
                            <div class="form-group">
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('Order Code')}}" name="order_code" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">{{ translate('Track Order')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        

        @isset($order)

        <div class="row my-4">
            <div class="col-lg-4">
                <div class=" bg-soft-secondary p-4 mr-lg-2 mb-2 rounded">
                   <span class="fw-500 pr-2">
                    Payment method:
                   </span>
                   <span>
                    {{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}
                   </span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class=" bg-soft-secondary p-4 mb-2 rounded">
                    <span class="fw-500 pr-2">
                        Delivery Status:
                       </span>
                       <span>
                        {{ ucfirst(str_replace('_', ' ', $order->delivery_status)) }}
                       </span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class=" bg-soft-secondary p-4 mb-2 ml-lg-2 rounded">
                    <span class="fw-500 pr-2">
                        {{ translate('Order date')}}:
                       </span>
                       <span>
                        {{ date('d-m-Y H:i A', $order->date) }}
                       </span>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-lg">
            <div class="card-body">
            <div class="d-flex flex-column-custom justify-content-lg-between">
                  <div class="d-flex align-items-center @if($order->delivery_status=="pending") text-active @endif">
                    <div class="media-tab-media "><i class="ci-bag @if($order->delivery_status=="pending") track-order-icon-box-active @else track-order-icon-box @endif"></i></div>
                    <div class="pl-3">
                      <div class="media-tab-subtitle  fs-11 mb-1">First step</div>
                      <h6 class="media-tab-title text-nowrap mb-0">Order placed</h6>
                    </div>
                  </div> 
                  <div class="d-flex align-items-center @if($order->delivery_status=="confirmed") text-active @endif">
                    <div class="media-tab-media "><i class="ci-check @if($order->delivery_status=="confirmed") track-order-icon-box-active @else track-order-icon-box @endif"></i></div>
                    <div class="pl-3">
                      <div class="media-tab-subtitle  fs-11 mb-1">Second step</div>
                      <h6 class="media-tab-title text-nowrap mb-0">Confirmed</h6>
                    </div>
                  </div>  
                  <div class="d-flex align-items-center @if($order->delivery_status=="picked_up") text-active @endif">
                    <div class="media-tab-media "><i class="ci-package @if($order->delivery_status=="picked_up") track-order-icon-box-active @else track-order-icon-box @endif"></i></div>
                    <div class="pl-3">
                      <div class="media-tab-subtitle  fs-11 mb-1">Third step</div>
                      <h6 class="media-tab-title text-nowrap mb-0">Picked Up</h6>
                    </div>
                  </div>  
                  <div class="d-flex align-items-center @if($order->delivery_status=="on_the_way") text-active @endif">
                    <div class="media-tab-media "><i class="ci-truck @if($order->delivery_status=="on_the_way") track-order-icon-box-active @else track-order-icon-box @endif"></i></div>
                    <div class="pl-3">
                      <div class="media-tab-subtitle  fs-11 mb-1">Fourth Step</div>
                      <h6 class="media-tab-title text-nowrap mb-0">On The way</h6>
                    </div>
                  </div>  
                  <div class="d-flex align-items-center @if($order->delivery_status=="delivered") text-active @endif">
                    <div class="media-tab-media "><i class="ci-check-circle @if($order->delivery_status=="delivered") track-order-icon-box-active @else track-order-icon-box @endif"></i></div>
                    <div class="pl-3">
                      <div class="media-tab-subtitle  fs-11 mb-1">Fifth step</div>
                      <h6 class="media-tab-title text-nowrap mb-0">Delivered</h6>
                    </div>
                  </div>                
            </div>





            </div>
        </div>
        <div class="text-right pt-2">
            <button class="btn btn-primary btn-sm" onclick="showorderModalm()">Order Details</button>
        </div>



        <div class="modal fade " id="orderdetails">
            <div class="modal-dialog modal-lg modal-xl modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
                <div class="modal-content h-auto position-relative mb-lg-4">
        
                    <div class="modal-header">
                        <h4 class="modal-title fw-600"> {{ translate('Order Code')}}: {{ $order->code }} </h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @foreach ($order->orderDetails as $key => $orderDetail)
                        @if($orderDetail->product != null)
                        <div class="row p-3 border-bottom">
                            <div class="col-md-2 text-center">
                                <img
                                class="img-fluid lazyload mx-auto h-100px h-md-100px p-2"
                                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                data-src="{{ uploaded_asset($orderDetail->product->thumbnail_img) }}"
                                alt="{{  $orderDetail->product->getTranslation('name')  }}"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                            >
                            </div>
                            <div class="col-md-5">
                                
                                <div class="d-none d-lg-block">
                                    <div class="fw-500">
                                        {{ $orderDetail->product->getTranslation('name') }}
                                        </div> 
                                        <div>
                                            {{ $orderDetail->variation }} 
                                        </div>
                                </div>
                                <div class="d-lg-none text-center">
                                    <div class="fw-500">
                                        {{ $orderDetail->product->getTranslation('name') }}
                                        </div> 
                                        <div>
                                            {{ $orderDetail->variation }} 
                                        </div>
                                </div>
                                
                                   
                                    
                            </div>
                            <div class="col-md-2 text-center">
                                <div>
                                    Quantity:
                                </div>
                                <div>
                                    {{ $orderDetail->quantity }}
                                </div>
                               
                            </div>
                            <div class="col-md-3 text-center">
                                <div>
                                    Sub-Total:
                                </div>
                                <div>
                                    {{ $orderDetail->price }}
                                </div>
                                
                            </div>
        
                        </div>
                        @endif
                        @endforeach
                    </div>
                    
        
                    <div class="modal-footer bg-soft-secondary">
                       <div class="row w-100 w100 ">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-6">
                                 Sub-total:   {{ single_price($order->orderDetails->sum('price'))}}
                                </div>
                                <div class="col-6">
                                 Shipping: {{single_price($order->orderDetails->sum('shipping_cost'))}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-6">
                                   Tax: {{ single_price($order->orderDetails->sum('tax')) }}
                                </div>
                                <div class="col-6">
                                    Total: {{single_price($order->grand_total)}}
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    </div>
                </div>
            </div>
        </div>









           {{-- <div class="bg-white rounded shadow-sm mt-5">
                <div class="fs-15 fw-600 p-3 border-bottom">
                    {{ translate('Order Summary')}}
                </div>
                <div class="p-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Order Code')}}:</td>
                                    <td>{{ $order->code }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Customer')}}:</td>
                                    <td>{{ json_decode($order->shipping_address)->name }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Email')}}:</td>
                                    @if ($order->user_id != null)
                                        <td>{{ $order->user->email }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Shipping address')}}:</td>
                                    <td>{{ json_decode($order->shipping_address)->address }}, {{ json_decode($order->shipping_address)->city }}, {{ json_decode($order->shipping_address)->country }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Order date')}}:</td>
                                    <td>{{ date('d-m-Y H:i A', $order->date) }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Total order amount')}}:</td>
                                    <td>{{ single_price($order->orderDetails->sum('price') + $order->orderDetails->sum('tax')) }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Shipping method')}}:</td>
                                    <td>{{ translate('Flat shipping rate')}}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Payment method')}}:</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Delivery Status')}}:</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $order->delivery_status)) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            

            @foreach ($order->orderDetails as $key => $orderDetail)
                @php
                    $status = $order->delivery_status;
                @endphp
                <div class="bg-white rounded shadow-sm mt-4">
                    
                    @if($orderDetail->product != null)
                    <div class="p-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ translate('Product Name')}}</th>
                                    <th>{{ translate('Quantity')}}</th>
                                    <th>{{ translate('Shipped By')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>{{ $orderDetail->product->getTranslation('name') }} ({{ $orderDetail->variation }})</td>
                                    <td>{{ $orderDetail->quantity }}</td>
                                    <td>{{ $orderDetail->product->user->name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            @endforeach
--}}
        @endisset
    </div>
</section>




@endsection




@section('script')
<script>
     function showorderModalm(){
            $('#orderdetails').modal();
        }

</script>
@endsection
