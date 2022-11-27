@extends('backend.layouts.app')

@section('content')

<div class="card">
    <form class="" action="" id="sort_orders" method="GET">
        <div class="card-header row gutters-5">
            <div class="col">
                <h5 class="mb-md-0 h6">{{ translate('All Orders') }}</h5>
            </div>
            
{{--            <div class="dropdown mb-2 mb-md-0">--}}
{{--                <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown">--}}
{{--                    {{translate('Bulk Action')}}--}}
{{--                </button>--}}
{{--                <div class="dropdown-menu dropdown-menu-right">--}}
{{--                    <a class="dropdown-item" href="#" onclick="bulk_delete()"> {{translate('Delete selection')}}</a>--}}
{{--<!--                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal">--}}
{{--                        <i class="las la-sync-alt"></i>--}}
{{--                        {{translate('Change Order Status')}}--}}
{{--                    </a>-->--}}
{{--                </div>--}}
{{--            </div>--}}

            <!-- Change Status Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                {{translate('Choose an order status')}}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <select class="form-control rit-selectpicker" onchange="change_status()" data-minimum-results-for-search="Infinity" id="update_delivery_status">
                                <option value="pending">{{translate('Pending')}}</option>
                                <option value="confirmed">{{translate('Confirmed')}}</option>
                                <option value="picked_up">{{translate('Picked Up')}}</option>
                                <option value="on_the_way">{{translate('On The Way')}}</option>
                                <option value="delivered">{{translate('Delivered')}}</option>
                                <option value="cancelled">{{translate('Cancel')}}</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 ml-auto">
                <select class="form-control rit-selectpicker" name="seller" id="seller">
                    <option value="">{{translate('Seller')}}</option>
                    @php
                        $name=null;
                    @endphp
                    @foreach($sellers as $key => $id)
                        @php
                            $shop=\App\Models\Shop::Select('name')->where('user_id',$id->seller_id)->first(); 
                        @endphp
                      
                        @if($shop!=null)
                        <option value="{{$id->seller_id}}" @if ($selectseller == $id->seller_id) selected @endif >{{$shop->name}}</option>
                        @endif
                    @endforeach
                    
                </select>
            </div>
            <div class="col-lg-2 ml-auto">
                <select class="form-control rit-selectpicker" name="delivery_status" id="delivery_status">
                    <option value="">{{translate('Delivery')}}</option>
                    <option value="pending" @if ($delivery_status == 'pending') selected @endif>{{translate('Pending')}}</option>
                    <option value="Pending" @if ($delivery_status == 'Pending') selected @endif>{{translate('Stock Confirm')}}</option>
                    <option value="confirmed" @if ($delivery_status == 'confirmed') selected @endif>{{translate('Confirmed')}}</option>
                    <option value="picked_up" @if ($delivery_status == 'picked_up') selected @endif>{{translate('Picked Up')}}</option>
                    <option value="on_the_way" @if ($delivery_status == 'on_the_way') selected @endif>{{translate('On The Way')}}</option>
                    <option value="delivered" @if ($delivery_status == 'delivered') selected @endif>{{translate('Delivered')}}</option>
                    <option value="cancelled" @if ($delivery_status == 'cancelled') selected @endif>{{translate('Cancel')}}</option>
                </select>
            </div>
            <div class="col-lg-2 ml-auto">
                <select class="form-control rit-selectpicker" name="shipping_status" id="shipping_status">
                    <option value="">{{translate('Shipping')}}</option>
                    <option value="picked" @if ($shipping_status == 'picked') selected @endif>{{translate('picked')}}</option>
                    <option value="at_hub" @if ($shipping_status == 'at_hub') selected @endif>{{translate('at_hub')}}</option>
                    <option value="on_hold" @if ($shipping_status == 'on_hold') selected @endif>{{translate('on_hold')}}</option>
                    <option value="delivered" @if ($shipping_status == 'delivered') selected @endif>{{translate('delivered')}}</option>
                    <option value="paid" @if ($shipping_status == 'paid') selected @endif>{{translate('paid')}}</option>
                    <option value="return" @if ($shipping_status == 'return') selected @endif>{{translate('return')}}</option>
                </select>
            </div>
            <div class="col-lg-1">
                <div class="form-group mb-0">
                    <input type="text" class="rit-date-range form-control" value="{{ $date }}" name="date" placeholder="{{ translate('Date') }}" data-format="DD-MM-Y" data-separator=" to " data-advanced-range="true" autocomplete="off">
                </div>
            </div>
            <div class="col-lg-1">
                <div class="form-group mb-0">
                    <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type Order code & hit Enter') }}">
                </div>
            </div>
			 <div class="col-lg-2 ml-auto">
                <select class="form-control rit-selectpicker" name="showall" id="show_all">
                    <option value="">{{translate('Complete or not')}}</option>
                    <option value="hideall" >Hide Completed</option>
                    <option value="showall" >Show all</option>

                </select>
            </div>
            <div class="col-auto">
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary">{{ translate('Filter') }}</button>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table rit-table mb-0">
                <thead>
                    <tr>
                        <!--<th>#</th>-->
{{--                        <th>--}}
{{--                            <div class="form-group">--}}
{{--                                <div class="rit-checkbox-inline">--}}
{{--                                    <label class="rit-checkbox">--}}
{{--                                        <input type="checkbox" class="check-all">--}}
{{--                                        <span class="rit-square-check"></span>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </th>--}}
                        <th width="175px">{{ translate('Order Code') }}</th>
                        <th>{{ translate('Seller') }}</th>
                        <th data-breakpoints="md">{{ translate('Customer') }}</th>
                        <th data-breakpoints="md">{{ translate('Amount') }}</th>
                        <th data-breakpoints="md">{{ translate('Delivery Status') }}</th>
                        <th data-breakpoints="md">{{ translate('Payment Status') }}</th>
{{--                        @if (addon_is_activated('refund_request'))--}}
                        <th data-breakpoints="md">{{ translate('Shipping Agent') }}</th>
                        <th>{{ translate('Assigned Staff') }}</th>
{{--                        @endif--}}
                        <th class="text-right" width="15%">{{translate('options')}}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $order)
                    <tr class="@if($order->communication_note!=null OR $order->communication_status!=null)bg-soft-danger
                        @endif">  
    <!--                    <td>
                            {{ ($key+1) + ($orders->currentPage() - 1)*$orders->perPage() }}
                        </td>-->
{{--                        <td>--}}
{{--                            <div class="form-group">--}}
{{--                                <div class="rit-checkbox-inline">--}}
{{--                                    <label class="rit-checkbox">--}}
{{--                                        <input type="checkbox" class="check-one" name="id[]" value="{{$order->id}}">--}}
{{--                                        <span class="rit-square-check"></span>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </td>--}}
                        <td>
                            {{ $order->code }}
                        </td>
                        <td>
{{--                            {{ count($order->orderDetails) }}--}}
                            {{ $order->seller->name??$order->posuser->name??"" }}
                            {{$order->brand??""}}


                        </td>
                        <td>
                            @if ($order->user != null)
                            {{ $order->user->name }}
                            @else
                            Guest ({{ $order->guest_id }})
                            @endif
                        </td>
                        <td>
                            {{ single_price($order->grand_total) }}
                        </td>
                        <td>
                            @php
                                $status = $order->delivery_status;
                                if($order->delivery_status == 'cancelled') {
                                    $status = '<span class="badge badge-inline badge-danger">'.translate('Cancel').'</span>';
                                }
                                if($order->delivery_status == 'Pending') {
                                    $status = 'Stock Confirm';
                                }
                            @endphp
                            {!! $status !!}
                        </td>
                        <td>
                           @if ($order->payment_status == 'paid')
                            <span class="badge badge-inline badge-success">{{translate('Paid')}}</span>
                            @elseif($order->payment_status == 'partial_paid')
                                <span class="badge badge-inline badge-info">{{translate('Partial Paid')}}</span>
                            @elseif($order->payment_status == 'delivery_paid')
                                <span class="badge badge-inline badge-info">{{translate('Delivery Paid')}}</span>
                            @elseif($order->payment_status == 'partial_attempt')
                                <span class="badge badge-inline badge-warning">{{translate('Partial Attempt')}}</span>
                            @elseif($order->payment_status == 'partial')
                                <span class="badge badge-inline badge-warning">{{translate('Partial')}}</span>
                            @elseif($order->payment_status == 'refund')
                                <span class="badge badge-inline badge-danger">{{translate('Refund')}}</span>
                            @else
                            <span class="badge badge-inline badge-secondary">{{translate('Unpaid')}}</span>
                            @endif
                            <br>
                            {{ $order->payment_type=="cash_on_delivery"?"COD":($order->payment_type=="cash"?"CASH":"SSL") }}
                        </td>
                        @if (addon_is_activated('refund_request'))
                        <td>
                            @if($order->shipping_status)<b class="badge badge-inline badge-soft-danger">{{$order->shipping_status}}</b><br>@endif
                            {{$order->orderDetails[0]->shipping_method??""}}
                        </td>
                        <td>
                            {{$order->staff->name??""}}
                        </td>
                        @endif
                        <td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('all_orders.show', encrypt($order->id))}}" title="{{ translate('View') }}">
                                <i class="las la-eye"></i>
                            </a>
{{--                            <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="{{ route('invoice.download', $order->id) }}" title="{{ translate('Download Invoice') }}">--}}
{{--                                <i class="las la-download"></i>--}}
{{--                            </a>--}}
                             @if(Auth::user()->user_type == 'admin')
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('orders.destroy', $order->id)}}" title="{{ translate('Delete') }}">
                                <i class="las la-trash"></i>
                            </a>
                            @endif
                            <span class="btn btn-soft-success btn-icon btn-circle btn-sm" onclick="notemodal({{$order->id}})"><i class=" las la-notes-medical"></i></span>
                        </td>
{{--                        <td> </td>--}}
                    </tr>
                    
                    @endforeach
                </tbody>
            </table>

            <div class="rit-pagination">
                {{ $orders->appends(request()->input())->links() }}
            </div>

        </div>
    </form>
</div>

@endsection

@section('modal')
    @include('modals.delete_modal')

    <div class="modal fade" id="notemodal">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader text-center p-3">
                    <i class="las la-spinner la-spin la-3x"></i>
                </div>
                <button type="button" class="close absolute-top-right btn-icon close z-1" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la-2x">&times;</span>
                </button>
                <div id="note-modal-body">
                        
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
    <script type="text/javascript">
        $(document).on("change", ".check-all", function() {
            if(this.checked) {
                // Iterate each checkbox
                $('.check-one:checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('.check-one:checkbox').each(function() {
                    this.checked = false;
                });
            }

        });

        function notemodal(id){
            if(!$('#modal-size').hasClass('modal-md')){
                $('#modal-size').addClass('modal-md');
            }
            $('#note-modal-body').html(null);
            $('#notemodal').modal();
            $('.c-preloader').show();
            $.get('{{ route('addnote') }}', {_token: RIT.data.csrf, id:id}, function(data){
                $('.c-preloader').hide();
                $('#note-modal-body').html(data);
              
            });
        }



//        function change_status() {
//            var data = new FormData($('#order_form')[0]);
//            $.ajax({
//                headers: {
//                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                },
//                url: "{{route('bulk-order-status')}}",
//                type: 'POST',
//                data: data,
//                cache: false,
//                contentType: false,
//                processData: false,
//                success: function (response) {
//                    if(response == 1) {
//                        location.reload();
//                    }
//                }
//            });
//        }

        function bulk_delete() {
            var data = new FormData($('#sort_orders')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('bulk-order-delete')}}",
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response == 1) {
                        location.reload();
                    }
                }
            });
        }
    </script>
@endsection
