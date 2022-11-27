@extends('backend.layouts.app')

@section('content')

<div class="card">
    <form class="" action="" method="GET">
        <div class="card-header row gutters-5">
            <div class="col text-center text-md-left">
                <h5 class="mb-md-0 h6">{{ translate('Seller Orders') }}</h5>
            </div>
            <div class="col-lg-2">
                <div class="form-group mb-0">
                    <input type="text" class="rit-date-range form-control" value="{{ $date }}" name="date" placeholder="{{ translate('Filter by date') }}" data-format="DD-MM-Y" data-separator=" to " data-advanced-range="true" autocomplete="off">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group mb-0">
                    <select class="form-control form-control-sm rit-selectpicker mb-2 mb-md-0" id="seller_id" name="seller_id">
                        <option value="">{{ translate('All Sellers') }}</option>
                        @foreach (App\Models\Seller::all() as $key => $seller)
                            @if ($seller->user != null && $seller->user->shop != null)
                                <option value="{{ $seller->user->id }}" @if ($seller->user->id == $seller_id) selected @endif>
                                    {{ $seller->user->shop->name }} ({{ $seller->user->name }})
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group mb-0">
                    <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type Order code & hit Enter') }}">
                </div>
            </div>
			
			<div class="col-lg-2 ml-auto">
                <select class="form-control rit-selectpicker" name="showall" id="show_all">
                    <option value="">{{translate('Complete or not')}}</option>
                    <option value="showall">Show all</option>
                    <option value="hideall">Hide Completed</option>
                </select>
            </div>
            <div class="col-auto">
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary">{{ translate('Filter') }}</button>
                </div>
            </div>
        </div>
    </form>

    <div class="card-body">
        <table class="table rit-table mb-0">
            <thead>
                <tr>
                    <th data-breakpoints="lg">#</th>
                    <th width="20%">{{translate('Order Code')}}</th>
                    <th data-breakpoints="lg">{{translate('Num. of Products')}}</th>
                    <th data-breakpoints="lg">{{translate('Customer')}}</th>
                    <th>{{translate('Seller')}}</th>
                    <th data-breakpoints="lg">{{translate('Amount')}}</th>
                    <th data-breakpoints="lg">{{translate('Delivery Status')}}</th>
                    <th data-breakpoints="lg">{{translate('Payment Method')}}</th>
                    <th data-breakpoints="lg">{{translate('Payment Status')}}</th>
                    @if (addon_is_activated('refund_request'))
                        <th>{{translate('Refund')}}</th>
                    @endif
                    <th class="text-right" width="15%">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $key => $order)
                    <tr class="@if($order->communication_note!=null OR $order->communication_status!=null)bg-soft-danger
                        @endif">
                        <td>
                            {{ ($key+1) + ($orders->currentPage() - 1)*$orders->perPage() }}
                        </td>
                        <td>
                            {{ $order->code }}@if($order->viewed == 0) <span class="badge badge-inline badge-info">{{translate('New')}}</span>@endif
                        </td>
                        <td>
                            {{ count($order->orderDetails->where('seller_id', '!=', $admin_user_id)) }}
                        </td>
                        <td>
                            @if ($order->user != null)
                                {{ $order->user->name }}
                            @else
                                Guest ({{ $order->guest_id }})
                            @endif
                        </td>
                        <td>
                            @if($order->seller)
                                {{ $order->seller->name }}
                            @endif
                        </td>
                        <td>
                            {{ single_price($order->grand_total) }}
                        </td>
                        <td>
                            @php
                                $status = $order->delivery_status;
                            @endphp
                            {{ translate(ucfirst(str_replace('_', ' ', $status))) }}
                        </td>
                        <td>
                            {{ translate(ucfirst(str_replace('_', ' ', $order->payment_type))) }}
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
                        </td>
                        @if (addon_is_activated('refund_request'))
                            <td>
                                @if (count($order->refund_requests) > 0)
                                    {{ count($order->refund_requests) }} {{ translate('Refund') }}
                                @else
                                    {{ translate('No Refund') }}
                                @endif
                            </td>
                        @endif

                        <td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('seller_orders.show', encrypt($order->id))}}" title="{{ translate('View') }}">
                                <i class="las la-eye"></i>
                            </a>
                            <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="{{ route('invoice.download', $order->id) }}" title="{{ translate('Download Invoice') }}">
                                <i class="las la-download"></i>
                            </a>
                             @if(Auth::user()->user_type == 'admin')
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('orders.destroy', $order->id)}}" title="{{ translate('Delete') }}">
                                <i class="las la-trash"></i>
                            </a>
                            @endif
							<span class="btn btn-soft-success btn-icon btn-circle btn-sm" onclick="notemodal({{$order->id}})"><i class=" las la-notes-medical"></i></span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="rit-pagination">
            {{ $orders->appends(request()->input())->links() }}
        </div>
    </div>
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
        function sort_orders(el){
            $('#sort_orders').submit();
        }
		
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
		
    </script>
@endsection
