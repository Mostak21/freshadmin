@php
    include './views/backend/invoices/purchaseorder.blade.php';
@endphp

{{--<html>--}}
{{--<head>--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <title>{{  translate('INVOICE') }}</title>--}}
{{--    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>--}}
{{--    <meta charset="UTF-8">--}}
{{--	<style media="all">--}}
{{--        @page {--}}
{{--			margin: 0;--}}
{{--			padding:0;--}}
{{--		}--}}
{{--		body{--}}
{{--			font-size: 0.875rem;--}}
{{--            font-family: '<?php echo  $font_family ?>';--}}
{{--            font-weight: normal;--}}
{{--            direction: <?php echo  $direction ?>;--}}
{{--            text-align: <?php echo  $text_align ?>;--}}
{{--			padding:50px;--}}
{{--			margin:50px;--}}
{{--		}--}}
{{--		.gry-color *,--}}
{{--		.gry-color{--}}
{{--			color:#000;--}}
{{--		}--}}
{{--		table{--}}
{{--			width: 100%;--}}
{{--		}--}}
{{--		table th{--}}
{{--			font-weight: normal;--}}
{{--		}--}}
{{--		table.padding th{--}}
{{--			padding: .25rem .7rem;--}}
{{--		}--}}
{{--		table.padding td{--}}
{{--			padding: .25rem .7rem;--}}
{{--		}--}}
{{--		table.sm-padding td{--}}
{{--			padding: .1rem .7rem;--}}
{{--		}--}}
{{--		.border-bottom td,--}}
{{--		.border-bottom th{--}}
{{--			border-bottom:1px solid #eceff4;--}}
{{--		}--}}
{{--		.text-left{--}}
{{--			text-align:<?php echo  $text_align ?>;--}}
{{--		}--}}
{{--		.text-right{--}}
{{--			text-align:<?php echo  $not_text_align ?>;--}}
{{--		}--}}
{{--	</style>--}}
{{--</head>--}}
{{--<body>--}}
{{--	<div style="margin: 50px;">--}}

{{--		@php--}}
{{--			$logo = get_setting('header_logo');--}}
{{--		@endphp--}}

{{--		<div style="padding: 1rem;">--}}
{{--			<table style="margin-top: 20px;">--}}
{{--				<tr>--}}
{{--					<td>--}}
{{--						@if($logo != null)--}}
{{--							<img src="{{ public_path('assets/img/logo.png') }}" height="30" style="display:inline-block;">--}}
{{--						@else--}}
{{--							<img src="{{ public_path('assets/img/logo.png') }}" height="30" style="display:inline-block;">--}}
{{--						@endif--}}
{{--					</td>--}}
{{--					<td class="text-right strong"><span style="font-size: 2rem;">Purchase Order</span> <br> <span class="fs-16 fw-600">{{ $order->code }} </span> </td>--}}
{{--				</tr>--}}
{{--			</table>--}}
{{--            <div style="margin-top: 50px; margin-bottom: 15px;">--}}
{{--				<div class="pl-2 fw-500">Vendor Address</div>--}}
{{--				<div class="pl-2 ">{{$order->seller->pickup_address}}</div>--}}
{{--            </div>--}}

{{--			<table>--}}

{{--				<tr>--}}
{{--					<td style="font-size: 1rem;" class="strong">{{ get_setting('site_name') }}</td>--}}
{{--					<td class="text-right"></td>--}}
{{--				</tr>--}}
{{--				<tr>--}}
{{--					<td class="gry-color small">{{ get_setting('contact_address') }}</td>--}}
{{--					<td class="text-right"></td>--}}
{{--				</tr>--}}
{{--				<tr>--}}
{{--					<td class="gry-color small">{{  translate('Email') }}: {{ get_setting('contact_email') }}</td>--}}
{{--					<td class="text-right small"><span class="gry-color small">Date:</span> <span class="strong">{{ date('d-m-Y', $order->date) }}</span></td>--}}
{{--				</tr>--}}
{{--				<tr>--}}
{{--					<td class="gry-color small">{{  translate('Phone') }}: {{ get_setting('contact_phone') }}</td>--}}
{{--					<td class="text-right small"><span class="gry-color small">Delivery Date:</span> <span class=" strong">{{ date('d-m-Y') }}</span></td>--}}
{{--				</tr>--}}
{{--			</table>--}}

{{--		</div>--}}


{{--	    <div style="padding: 1rem;">--}}
{{--			<table class="padding text-left small border-bottom">--}}
{{--				<thead>--}}
{{--	                <tr class="gry-color" style="background: #eceff4;">--}}
{{--	                    <th width="20%" class="text-left ">{{ translate('Product Name') }}</th>--}}
{{--	                    <th width="10%" class="text-left ">{{ translate('Qty') }}</th>--}}
{{--	                    <th width="15%" class="text-left ">{{ translate('Unit Price') }}</th>--}}
{{--	                    <th width="15%" class="text-right">{{ translate('Total') }}</th>--}}
{{--	                </tr>--}}
{{--				</thead>--}}
{{--				<tbody class="strong">--}}
{{--					@php--}}
{{--					$subtotal=0;--}}
{{--					@endphp--}}
{{--	                @foreach ($order->orderDetails as $key => $orderDetail)--}}
{{--		                @if ($orderDetail->product != null)--}}
{{--							<tr class="">--}}
{{--								<td>{{ $orderDetail->product->name }} @if($orderDetail->variation != null) ({{ $orderDetail->variation }}) @endif</td>--}}
{{--								<td class="">{{ $orderDetail->quantity }}</td>--}}
{{--								<td class="currency">{{ single_price($orderDetail->product->distributor_price) }}</td>--}}
{{--			                    <td class="text-right currency">{{ single_price($orderDetail->product->distributor_price*$orderDetail->quantity) }}</td>--}}
{{--							</tr>--}}
{{--							@php--}}
{{--								$subtotal+= $orderDetail->product->distributor_price*$orderDetail->quantity;--}}
{{--							@endphp--}}
{{--		                @endif--}}
{{--					@endforeach--}}
{{--	            </tbody>--}}
{{--			</table>--}}
{{--		</div>--}}

{{--	    <div style="padding:0 1.5rem;">--}}
{{--	        <table class="text-right sm-padding small strong">--}}
{{--	        	<thead>--}}
{{--	        		<tr>--}}
{{--	        			<th width="60%"></th>--}}
{{--	        			<th width="40%"></th>--}}
{{--	        		</tr>--}}
{{--	        	</thead>--}}
{{--		        <tbody>--}}
{{--			        <tr>--}}
{{--			            <td>--}}
{{--			            </td>--}}
{{--			            <td>--}}
{{--					        <table class="text-right sm-padding small strong">--}}
{{--						        <tbody>--}}
{{--							        <tr>--}}
{{--							            <th class="gry-color text-left">{{ translate('Sub Total') }}</th>--}}
{{--							            <td class="currency">{{ single_price($subtotal) }}</td>--}}
{{--							        </tr>--}}

{{--							        <tr>--}}
{{--							            <th class="text-left strong">{{ translate('Grand Total') }}</th>--}}
{{--							            <td class="currency">{{ single_price($subtotal) }}</td>--}}
{{--							        </tr>--}}

{{--						        </tbody>--}}
{{--						    </table>--}}
{{--			            </td>--}}
{{--			        </tr>--}}
{{--		        </tbody>--}}
{{--		    </table>--}}
{{--	    </div>--}}

{{--	</div>--}}
{{--</body>--}}
{{--</html>--}}
