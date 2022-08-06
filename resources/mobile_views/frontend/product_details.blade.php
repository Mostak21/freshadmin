@extends('frontend.layouts.app')

@section('datalayer')
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-W68M279');</script>
    <!-- End Google Tag Manager -->

    <script type = "text/javascript">
        dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
        dataLayer.push({
            event: "view_item",
            @php
                if(home_price($detailedProduct) != home_discounted_price($detailedProduct)){
                $discount=home_discounted_price($detailedProduct);
                $price=home_price($detailedProduct);}
                 $item_category = category_tree($detailedProduct->category->id);

                if (!empty($detailedProduct->stocks)) foreach ($detailedProduct->stocks as $stock) if ($stock->qty>=1) $Product_Stock = "InStock";

            @endphp
            ecommerce: {
                items: [
                    {
                        item_id: "{{ $detailedProduct->id }}",
                        item_name: "{{ $detailedProduct->name }}",
                        affiliation: "",
                        coupon: "",
                        currency: "BDT",
                        discount:{{number_format((float)$detailedProduct->discount, 2, '.', '')??0.00}},
                        index: 0,
                        item_brand: "{{$detailedProduct->brand->name??""}}",
                        item_category: "{!! $item_category[0]??"" !!}",
                        item_category2: "{!! $item_category[1]??"" !!}",
                        item_category3: "{!! $item_category[2]??"" !!}",
                        item_category4: "",
                        item_category5: "",
                        item_list_id: "",
                        item_list_name: "",
                        item_variant: "",
                        location_id: "",
                        price:{{number_format((float)$detailedProduct->unit_price, 2, '.', '')??0.00}},
                        quantity: 1,
                        description: "{!!preg_replace('/[^A-Za-z0-9\+]/', ' ', $detailedProduct->meta_description)!!}",
                        image: "{!! uploaded_asset($detailedProduct->photos)??"" !!}",
                        url: "https://brandhook.com.bd/product/{!!$detailedProduct->slug!!}",
                        availability:  "{!! $Product_Stock??"OutOfStock" !!}",
                        priceValidUntil: "{!! date('d-m-Y H:i:s',$detailedProduct->discount_end_date)??""  !!}",
                        itemCondition: "new",
                        lowPrice: {!! number_format((float)$detailedProduct->unit_price, 2, '.', '')-number_format((float)$detailedProduct->discount, 2, '.', '') !!},
                        ratingValue: "{!!$detailedProduct->rating??0!!}",
                        ratingCount: "{!! $detailedProduct->reviews->count()??0 !!}",
                        name: "",
                        datePublished: "{!! $detailedProduct->created_at??0 !!}"
                    }]

            }
        });


        dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
        dataLayer.push({
            event: "view_item_list",
            ecommerce: {
                items: [
                        @foreach (filter_products(\App\Models\Product::where('category_id', $detailedProduct->category_id)->where('id', '!=', $detailedProduct->id))->limit(10)->get() as $key => $related_product)
                        @php
                            if(home_price($detailedProduct) != home_discounted_price($detailedProduct)){
                            $discount=home_discounted_price($detailedProduct);
                            $price=home_price($detailedProduct);}
                            $item_category = category_tree($related_product->category->id);


                        @endphp
                    {
                        item_id: "{{$related_product->id}}",
                        item_name: "{{$related_product->getTranslation('name') }}",
                        affiliation: "",
                        coupon: "",
                        currency: "BDT",
                        discount: {{number_format((float)$related_product->discount, 2, '.', '')??0.00}},
                        index: 0,
                        item_brand: "{{$related_product->brand->name??""}}",
                        item_category: "{!! $item_category[0]??"" !!}",
                        item_category2: "{!! $item_category[1]??""  !!}",
                        item_category3: "{!! $item_category[2]??"" !!}",
                        item_category4: "",
                        item_category5: "",
                        item_list_id: "",
                        item_list_name: "",
                        item_variant: "",
                        location_id: "",
                        price: {{number_format((float)$related_product->unit_price, 2, '.', '')??0.00}},
                        quantity: 1
                    },
                    @endforeach

                ]
            }
        });
    </script>


    {{--
       @php
             $photos = explode(',', $detailedProduct->photos);
             $total = 0;
             $total += $detailedProduct->reviews->count();

      if(home_price($detailedProduct) != home_discounted_price($detailedProduct)){
        $discount= $detailedProduct->unit_price - $detailedProduct->discount;

    }


                $soldout=1;
                $stock=\App\Models\ProductStock::where('product_id',$detailedProduct->id)->first();
                //return $stock->qty;
                if(empty($stock)){
                    $soldout=0;
                 }
               if(!empty($stock)){

                      if($stock->qty==0){
                        $soldout=0;
                            }
                 }

            @endphp --}}





@endsection

{{-- @section('meta_title'){{ mb_strimwidth($detailedProduct->meta_title, 0, 47, "...").' | BRAND HOOK' }}@stop --}}
@section('meta_title'){{ mb_strimwidth($detailedProduct->meta_title, 0, 60, "") }}@stop

@section('meta_description'){{ mb_strimwidth($detailedProduct->meta_description, 0, 160, "...") }}@stop

@section('meta_keywords'){{ $detailedProduct->tags }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    {{-- <meta itemprop="name" content="{{ mb_strimwidth($detailedProduct->meta_title, 0, 47, "...").' | BRAND HOOK' }}"> --}}
    <meta itemprop="name" content="{{ mb_strimwidth($detailedProduct->meta_title, 0, 60, "") }}">

    <meta itemprop="description" content="{{ mb_strimwidth($detailedProduct->meta_description, 0, 160, "...") }}">
    <meta itemprop="image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    {{-- <meta name="twitter:title" content="{{ mb_strimwidth($detailedProduct->meta_title, 0, 47, "...").' | BRAND HOOK' }}"> --}}
    <meta name="twitter:title" content="{{ mb_strimwidth($detailedProduct->meta_title, 0, 60, "") }}">
    <meta name="twitter:description" content="{{ mb_strimwidth($detailedProduct->meta_description, 0, 160, "...") }}">
    <meta name="twitter:creator" content="@BrandHook">
    <meta name="twitter:url" content="https://brandhook.com.bd/" />
    <meta name="twitter:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($detailedProduct->unit_price) }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    {{-- <meta property="og:title" content="{{ mb_strimwidth($detailedProduct->meta_title, 0, 47, "...").' | BRAND HOOK' }}" /> --}}
    <meta property="og:title" content="{{ mb_strimwidth($detailedProduct->meta_title, 0, 60, "") }}" />
    <meta property="og:type" content="og:product" />
    <meta property="og:url" content="{{ route('product', $detailedProduct->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}" />
    <meta property="og:description" content="{{ mb_strimwidth($detailedProduct->meta_description, 0, 160, "...") }}" />
    <meta property="og:site_name" content="{{ get_setting('meta_title') }}" />
    <meta property="og:price:amount" content="{{ single_price($detailedProduct->unit_price) }}" />
    <meta property="product:price:currency" content="{{ \App\Models\Currency::findOrFail(get_setting('system_default_currency'))->code }}" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
@endsection

@section('content')

   {{-- <div class="productheaderbg py-6 pb-8">
        <div class="container d-lg-center">
            <div class="row ">
                <div class="col-lg-6 text-center text-lg-left">
                    <h1 class="h3 mb-2  fw-600" id="productName">
                        {{ $detailedProduct->getTranslation('name') }}
                    </h1>

                </div>
                @php
                    $item_category = category_bread_tree($detailedProduct->category->id);
                @endphp
            </div>
        </div>
    </div>--}}
    <section class="mb-4 pt-3">
        <div class="">
            <div class="bg-white  p-3">
                <div class="row px-3 py-3">
                    <div class="col-12 mb-4">
                        <div class="sticky-top z-3 row gutters-10">
                            @php
                                $photos = explode(',', $detailedProduct->photos);
                            @endphp
                            <div class="col order-1 order-md-2">
                                <div class="aiz-carousel product-gallery" data-nav-for='.product-gallery-thumb' data-fade='true' data-auto-height='true' data-dots="true"  >
                                    @foreach ($photos as $key => $photo)
                                        <div class="carousel-box img-zoom rounded">
                                            <img
                                                id="product_image"
                                                class="img-fluid lazyload"
                                                src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/QvA2RYQWO25rdXdlABjiqOulRlthFzqzwG5xus5n.png"
                                                data-src="{{ uploaded_asset($photo) }}"
                                                onerror="this.onerror=null;this.src='https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/QvA2RYQWO25rdXdlABjiqOulRlthFzqzwG5xus5n.png';"
                                            >
                                        </div>
                                    @endforeach
                                    @foreach ($detailedProduct->stocks as $key => $stock)
                                        @if ($stock->image != null)
                                            <div class="carousel-box img-zoom rounded" >
                                                <img
                                                    class="img-fluid lazyload"
                                                    src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/QvA2RYQWO25rdXdlABjiqOulRlthFzqzwG5xus5n.png"
                                                    data-src="{{ uploaded_asset($stock->image) }}"
                                                    onerror="this.onerror=null;this.src='https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/QvA2RYQWO25rdXdlABjiqOulRlthFzqzwG5xus5n.png';"
                                                >
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                          <div class="col-12 col-md-auto w-md-100px order-2 order-md-1 mt-3 mt-md-0">
                                <div class="aiz-carousel product-gallery-thumb" data-items='5' data-nav-for='.product-gallery' data-vertical='true' data-vertical-sm='false' data-focus-select='true' data-arrows='true'>
                                    @foreach ($photos as $key => $photo)
                                        <div class="carousel-box c-pointer border p-1 rounded">
                                            <img
                                                class="lazyload mw-100 size-60px mx-auto monir"
                                                src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/QvA2RYQWO25rdXdlABjiqOulRlthFzqzwG5xus5n.png"
                                                data-src="{{ uploaded_asset($photo) }}"
                                                onerror="this.onerror=null;this.src='https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/QvA2RYQWO25rdXdlABjiqOulRlthFzqzwG5xus5n.png';"
                                            >
                                        </div>
                                    @endforeach
                                    @foreach ($detailedProduct->stocks as $key => $stock)
                                        @if ($stock->image != null)
                                            <div class="carousel-box c-pointer border p-1 rounded" data-variation="{{ $stock->variant }}">
                                                <img
                                                    class="lazyload mw-100 size-60px mx-auto monir"
                                                    src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/QvA2RYQWO25rdXdlABjiqOulRlthFzqzwG5xus5n.png"
                                                    data-src="{{ uploaded_asset($stock->image) }}"
                                                    onerror="this.onerror=null;this.src='https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/QvA2RYQWO25rdXdlABjiqOulRlthFzqzwG5xus5n.png';"
                                                >
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            


                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-2">
                                <!-- Add to wishlist button -->
                                <span class="">
                                    <button type="button" class="btn btn-sm btn-icon user-panel-icon-bg" onclick="addToWishList({{ $detailedProduct->id }})" id="wishbtn">
                                        <b><i class="navbar-tool la la-heart-o  "></i></b>
                                    </button>
                                </span>
                                <span class="" >
                                    <button type="button" class="btn btn-sm btn-icon user-panel-icon-bg" onclick="addToCompare({{ $detailedProduct->id }})">
                                        <i class="la la-refresh "></i>
                                    </button>
                                </span>

                            </div>
                
                <div class="row">
                    <div class="col-12 m-0 p-0 bg-white  shadow-lg border-top rounded-footer-top" style="box-shadow: 0px -1px 20px rgb(0 0 0 / 15%)!important; ">
                        <div class="text-left px-3 py-3">
                            <form id="option-choice-form">
                                @csrf
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3 class="fw-600 fs-15">
                                        {{ $detailedProduct->getTranslation('name') }}</h3>
                                    </div>
                                    <div>
                                        <div class="product-quantity ">
                                            <div class="row no-gutters price-range-bg align-items-center aiz-plus-minus px-2 ml-0 " style="width: 100px;">
                                                <button class="btn col-auto " type="button" data-type="minus" data-field="quantity" disabled="">
                                                    <i class="las la-minus"></i>
                                                </button>
                                                <input type="number" name="quantity" class="col border-0 text-center flex-grow-1 fs-16 price-range-input-bg p-0" placeholder="1" value="{{ $detailedProduct->min_qty }}" min="{{ $detailedProduct->min_qty }}" max="10">
                                                <button class="btn  col-auto " type="button" data-type="plus" data-field="quantity">
                                                    <i class="las la-plus"></i>
                                                </button>
                                            </div>
                                            @php
                                                $qty = 0;
                                                foreach ($detailedProduct->stocks as $key => $stock) {
                                                    $qty += $stock->qty;
                                                }
                                            @endphp
                                            <div class="avialable-amount opacity-60">
                                                @if($detailedProduct->stock_visibility_state == 'quantity')
                                                    (<span id="available-quantity">{{ $qty }}</span> {{ translate('available')}})
                                                @elseif($detailedProduct->stock_visibility_state == 'text' && $qty >= 1)
                                                    (<span id="available-quantity">{{ translate('In Stock') }}</span>)
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            
                            <div class="row align-items-center pb-2">
                                <div class="col-12">
                                    @php
                                        $total = 0;
                                        $total += $detailedProduct->reviews->count();
                                    @endphp
                                    <span class="rating">
                                        {{ renderStarRating($detailedProduct->rating) }}
                                    </span>
                                    <span class="d-none" id="productRating">{!! $detailedProduct->rating !!}</span>
                                    <span class="ml-1 " id="productReviewCount">({{ $total }} {{ translate('reviews')}})</span>
                                </div>
                                @if ($detailedProduct->est_shipping_days)
                                    <div class="col-auto ml">
                                        <small class="mr-2">{{ translate('Estimate Shipping Time')}}: </small>{{ $detailedProduct->est_shipping_days }} {{  translate('Days') }}
                                    </div>
                                @endif
                            </div>



                            <div class="d-flex justify-content-between">
                                <div>
                                    <div class="row">
                                    <div class="col">
                                    <small class="mr-2 opacity-50">{{ translate('Sold by')}}: </small><br>
                                    @if ($detailedProduct->added_by == 'seller' && get_setting('vendor_system_activation') == 1)
                                        <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}" class="text-reset">{{ $detailedProduct->user->shop->name }}</a>
                                    @else
                                        {{  translate('Inhouse product') }}
                                    @endif
                                </div>

                                @if ($detailedProduct->brand != null)
                                    <div class="col-auto">
                                        <a href="{{ route('products.brand',$detailedProduct->brand->slug) }}">
                                            <img src="{{ uploaded_asset($detailedProduct->brand->logo) }}" alt="{{ $detailedProduct->brand->getTranslation('name') }}" height="30" id="productBrand">
                                        </a>
                                    </div>
                                @endif
                            </div>
                                </div>
                                <div>
                                    @if (get_setting('conversation_system') == 1)
                                    

                                        {{--  <button class="btn btn-sm btn-soft-primary" onclick="show_chat_modal()">{{ translate('Message Seller')}}</button>--}}


                                        <a href="tel:01750100647"><button class="btn btn-sm btn-soft-secondary" >{{ translate('Call Us')}}</button></a>

                                    
                                @endif
                                </div>
                                
                     

                              
                            </div>



                            @if ($detailedProduct->wholesale_product)
                                <table class="aiz-table mb-0">
                                    <thead>
                                    <tr>
                                        <th>{{ translate('Min Qty') }}</th>
                                        <th>{{ translate('Max Qty') }}</th>
                                        <th>{{ translate('Unit Price') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($detailedProduct->stocks->first()->wholesalePrices as $wholesalePrice)
                                        <tr>
                                            <td>{{ $wholesalePrice->min_qty }}</td>
                                            <td>{{ $wholesalePrice->max_qty }}</td>
                                            <td>{{ single_price($wholesalePrice->price) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                @if(home_price($detailedProduct) != home_discounted_price($detailedProduct))


                                    <div class="py-3 mb-3">
                                        <strong class="h4 fw-500 text-primary">
                                            {{ home_discounted_price($detailedProduct) }}
                                        </strong>
                                        @if($detailedProduct->unit != null)
                                            <span class="opacity-70">/{{ $detailedProduct->getTranslation('unit') }}</span>
                                        @endif


                                        <del>
                                                  <span class="fs-20 opacity-60"> {{ home_price($detailedProduct) }}
                                                      @if($detailedProduct->unit != null)
                                                          <span>/{{ $detailedProduct->getTranslation('unit') }}</span>
                                                      @endif
                                                </span>
                                        </del>
                                    </div>

                                @else
                                    <div class="py-3 mb-3">
                                        <strong class="h4 fw-500 text-primary">
                                            {{ home_discounted_price($detailedProduct) }}
                                        </strong>
                                        @if($detailedProduct->unit != null)
                                            <span class="opacity-70">/{{ $detailedProduct->getTranslation('unit') }}</span>
                                        @endif
                                    </div>
                                @endif
                            @endif




                            
                                <input type="hidden" name="id" value="{{ $detailedProduct->id }}">

                                @if ($detailedProduct->choice_options != null)
                                    @php $selectedColor = 0; @endphp
                                    @foreach (json_decode($detailedProduct->choice_options) as $key => $choice)

                                        <div class="row no-gutters ">
                                            <div class="col-auto">
                                                @if(\App\Models\Attribute::find($choice->attribute_id))
                                                    <div class="fs-15 fw-500  pr-2">{{ \App\Models\Attribute::find($choice->attribute_id)->getTranslation('name') }} :</div>
                                                @endif
                                            </div>
                                            <div class="col-auto">
                                                <div class="aiz-radio-inline  fs-custom">
                                                    @php
                                                        $attributecheck =  0;
                                                        $key2 = null;
                                                        $count = -1;
                                                        $attributeLength = count($choice->values);
                                                    @endphp
                                                    @foreach ($choice->values as $keys => $value)

                                                        @php
                                                            $value2 = str_replace(' ', '', $value);
                                                            $key1=$keys;

                                                            if ($attributecheck === 0){
                                                            $count++;
                                                            }
                                                            foreach($detailedProduct->stocks as $key => $stock){
                                                                if(str_contains($detailedProduct->stocks[$key]->variant, $value2) && $detailedProduct->stocks[$key]->qty !=0 ){
                                                                if ($attributecheck ==  0){
                                                                    $valuex = $value;
                                                                    $key2 = $key;
                                                                    if ($attributeLength > 0 && $selectedColor === 0){
                                                                    $selectedColor = floor($key2 / $attributeLength);
                                                                    }
                                                                    $attributecheck =  1;
                                                                }
                                                                }
                                                            }
                                                        @endphp



                                                        @if($attributecheck)
                                                            <label class="aiz-megabox pl-0 mr-2">
                                                                <input
                                                                    type="radio"
                                                                    name="attribute_id_{{ $choice->attribute_id }}"
                                                                    value="{{ $value }}"
                                                                    @if($valuex === $value ) checked @endif
                                                                >
                                                                <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center px-1 mb-2 fs-custom">
                                                        {{ $value }}
                                                    </span>
                                                            </label>
                                                        @elseif(!isset($Product_Stock))
                                                            <label class="aiz-megabox pl-0 mr-2">
                                                                <input
                                                                    type="radio"
                                                                    name="attribute_id_{{ $choice->attribute_id }}"
                                                                    value="{{ $value }}"
                                                                    @if($keys == 0) checked @endif
                                                                >
                                                                <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center px-1 mb-2 fs-custom">
                                                        {{ $value }}
                                                        </span>
                                                            </label>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                @endif


                                @if (count(json_decode($detailedProduct->colors)) > 0)
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <div class="fs-15 fw-500 pt-1 pr-2">Color Family:</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="aiz-radio-inline">
                                                @php
                                                    $colorcheck2 =  0;
                                                    $colorcheck =  0;
                                                @endphp
                                                @foreach (json_decode($detailedProduct->colors) as $keys => $color)
                                                    @php
                                                        $colorcheck =  0;
                                                        $color2 = str_replace(' ', '', \App\Models\Color::where('code', $color)->first()->name);
                                                        foreach($detailedProduct->stocks as $key => $stock){
                                                            if(str_contains($detailedProduct->stocks[$key]->variant, $color2) && $detailedProduct->stocks[$key]->qty !=0 ){
                                                            $colorcheck =  1;
                                                            }
                                                        }
                                                    @endphp
                                                    @if($colorcheck)
                                                        <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="{{ \App\Models\Color::where('code', $color)->first()->name }}">
                                                            <input
                                                                type="radio"
                                                                name="color"
                                                                value="{{ \App\Models\Color::where('code', $color)->first()->name }}"
                                                                @if($selectedColor == $keys && $colorcheck2 !=2)
                                                                @php $colorcheck2 = 2;@endphp
                                                                checked
                                                                @endif
                                                            >
                                                         
                                                            <span class="aiz-megabox-elem rounded-circle d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-20px d-inline-block  rounded-circle " style="background: {{ $color }};"></span>
                                                    </span>
                                                        </label>

                                                    @elseif(!isset($Product_Stock))
                                                        <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="{{ \App\Models\Color::where('code', $color)->first()->name }}">

                                                            <input
                                                                type="radio"
                                                                name="color"
                                                                value="{{ \App\Models\Color::where('code', $color)->first()->name }}"
                                                                @if($keys == 0) checked @endif
                                                            >
                                                            <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: {{ $color }};"></span>
                                                    </span>
                                                        </label>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                            @endif
                            <!-- Quantity + Add to cart -->
                             

                                <div class="row no-gutters pb-3 d-none" id="chosen_price_div">
                                    <div class="col-sm-3">
                                        <div class="fs-15 fw-500 my-2">{{ translate('Total')}}:</div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="product-price">
                                            <strong id="chosen_price" class="h4 fw-600 text-primary">

                                            </strong>
                                            @if ($detailedProduct->unit_price >= 5000 && ($detailedProduct->unit_price-$detailedProduct->discount)>= 5000)
                                                <div class="" style="display: inline-block">
                                                    <p class="tag" >EMI</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                

                            </form>

                            @if (addon_is_activated('club_point') && $detailedProduct->earn_point > 0)
                                <div class="row no-gutters ">
                                    <span class="">
                                        <div class="opacity-50 my-2 mt-2">{{  translate('Club Point') }}:</div>
                                    </span>
                                    <span class="px-2 ">
                                        <div class="d-inline-block rounded px-2 my-2 mt-2 bg-soft-primary border-soft-primary border">
                                            <span class="strong-700">{{ $detailedProduct->earn_point }}</span>
                                        </div>
                                    </span>
                                </div>
                            @endif
                            <div class="mt-3">
                                @if ($detailedProduct->external_link != null)
                                    <a type="button" class="btn btn-soft-primary mr-2 add-to-cart fw-600" href="{{ $detailedProduct->external_link }}">
                                        <i class="las la-shopping-bag"></i>
                                        <span class="d-none d-md-inline-block"> {{ translate('Add to cart')}}</span>
                                    </a>
                                    <a type="button" class="btn btn-primary buy-now fw-600 text-white" href="{{ $detailedProduct->external_link }}">
                                        <i class="la la-shopping-cart"></i> {{ translate('Buy Now')}}
                                    </a>
                                @else
                                    <div class="row">
                                        <div class="col-6 pb-2">
                                            <button type="button" class="btn btn-soft-primary mr-2 add-to-cart fw-600 bblock"  onclick="addToCart()" id="addtocart">
                                                <i class="las la-shopping-bag"></i>
                                                {{ translate('Add to cart')}}
                                            </button>
                                        </div>
                                        <div class="col-6 pb-2">
                                            <button type="button" class="btn btn-primary buy-now fw-600 bblock text-white" onclick="buyNow()">
                                                <i class="la la-shopping-cart"></i> {{ translate('Buy Now')}}
                                            </button>
                                        </div>

                                    </div>

                                @endif
                                <div class="d-none" id="productAvailability">{{ $Product_Stock??translate('Out of Stock')}}</div>
                                <button type="button" class="btn btn-secondary out-of-stock fw-600 d-none" disabled>
                                    <i class="la la-cart-arrow-down"></i> {{translate('Out of Stock')}}
                                </button>
                            </div>

                       
                            

                            <div class="d-table width-100 mt-3 ">
                                <div class="d-table-cell ">




                                    @if(Auth::check() && addon_is_activated('affiliate_system') && (\App\AffiliateOption::where('type', 'product_sharing')->first()->status || \App\AffiliateOption::where('type', 'category_wise_affiliate')->first()->status) && Auth::user()->affiliate_user != null && Auth::user()->affiliate_user->status)
                                        @php
                                            if(Auth::check()){
                                                if(Auth::user()->referral_code == null){
                                                    Auth::user()->referral_code = substr(Auth::user()->id.Str::random(10), 0, 10);
                                                    Auth::user()->save();
                                                }
                                                $referral_code = Auth::user()->referral_code;
                                                $referral_code_url = URL::to('/product').'/'.$detailedProduct->slug."?product_referral_code=$referral_code";
                                            }
                                        @endphp
                                        <div>
                                            <button type="button" id="ref-cpurl-btn" class="btn btn-sm btn-secondary" data-attrcpy="{{ translate('Copied')}}" onclick="CopyToClipboard(this)" data-url="{{$referral_code_url}}">{{ translate('Copy the Promote Link')}}</button>
                                        </div>
                                    @endif
                                </div>
                            </div>


                            @php
                                $refund_sticker = get_setting('refund_sticker');
                            @endphp
                            @if (addon_is_activated('refund_request'))
                                <div class="row no-gutters mt-3">
                                    <div class="col-2">
                                        <div class="opacity-50 mt-2">{{ translate('Refund')}}:</div>
                                    </div>
                                    <div class="col-10">
                                        <a href="{{ route('returnpolicy') }}" target="_blank">
                                            @if ($refund_sticker != null)
                                                <img src="{{ uploaded_asset($refund_sticker) }}" height="36">
                                            @else
                                                <img src="{{ static_asset('assets/img/refund-sticker.jpg') }}" height="36">
                                            @endif</a>
                                        <a href="{{ route('returnpolicy') }}" class="ml-2" target="_blank">{{ translate('View Policy') }}</a>
                                    </div>
                                </div>
                            @endif
                            <div class="row no-gutters mt-4">
                                <div class="col-sm-2">
                                    <div class="opacity-50 my-2">{{ translate('Share')}}:</div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="aiz-share"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-4">
        <div class="container-custom">
            <div class="row gutters-10">
                {{-- <div class="col-xl-3 order-1 order-xl-0">
                      @if ($detailedProduct->added_by == 'seller' && $detailedProduct->user->seller != null)
                          <div class="bg-white shadow-sm mb-3">
                              <div class="position-relative p-3 text-left">
                                  @if ($detailedProduct->user->seller->verification_status)
                                      <div class="absolute-top-right p-2 bg-white z-1">
                                          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" viewBox="0 0 287.5 442.2" width="22" height="34">
                                              <polygon style="fill:#F8B517;" points="223.4,442.2 143.8,376.7 64.1,442.2 64.1,215.3 223.4,215.3 "/>
                                              <circle style="fill:#FBD303;" cx="143.8" cy="143.8" r="143.8"/>
                                              <circle style="fill:#F8B517;" cx="143.8" cy="143.8" r="93.6"/>
                                              <polygon style="fill:#FCFCFD;" points="143.8,55.9 163.4,116.6 227.5,116.6 175.6,154.3 195.6,215.3 143.8,177.7 91.9,215.3 111.9,154.3
                                              60,116.6 124.1,116.6 "/>
                                          </svg>
                                      </div>
                                  @endif
                                  <div class="opacity-50 fs-12 border-bottom">{{ translate('Sold by')}}</div>
                                  <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}" class="text-reset d-block fw-600">
                                      {{ $detailedProduct->user->shop->name }}
                                      @if ($detailedProduct->user->seller->verification_status == 1)
                                          <span class="ml-2"><i class="fa fa-check-circle" style="color:green"></i></span>
                                      @else
                                          <span class="ml-2"><i class="fa fa-times-circle" style="color:red"></i></span>
                                      @endif
                                  </a>
                                  <div class="location opacity-70">{{ $detailedProduct->user->shop->address }}</div>
                                    @php
                                  $total = 0;
                                  $rating = 0;
                                  foreach ($detailedProduct->user->products as $key => $seller_product) {
                                      $total += $seller_product->reviews->count();
                                      $rating += $seller_product->reviews->sum('rating');
                                  }
                              @endphp
                                  <div class="text-center border rounded p-2 mt-3">
                                      <div class="rating">
                                          @if ($total > 0)
                                              {{ renderStarRating($detailedProduct->user->seller->rating) }}
                                          @else
                                              {{ renderStarRating(0) }}
                                          @endif
                                      </div>
                                      <div class="opacity-60 fs-12">({{ $total }} {{ translate('customer reviews')}})</div>
                                  </div>
                              </div>
                              <div class="row no-gutters align-items-center border-top">
                                  <div class="col">
                                      <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}" class="d-block btn btn-soft-primary rounded-0">{{ translate('Visit Store')}}</a>
                                  </div>
                                  <div class="col">
                                      <ul class="social list-inline mb-0">
                                          <li class="list-inline-item mr-0">
                                              <a href="{{ $detailedProduct->user->shop->facebook }}" class="facebook" target="_blank">
                                                  <i class="lab la-facebook-f opacity-60"></i>
                                              </a>
                                          </li>
                                          <li class="list-inline-item mr-0">
                                              <a href="{{ $detailedProduct->user->shop->google }}" class="google" target="_blank">
                                                  <i class="lab la-google opacity-60"></i>
                                              </a>
                                          </li>
                                          <li class="list-inline-item mr-0">
                                              <a href="{{ $detailedProduct->user->shop->twitter }}" class="twitter" target="_blank">
                                                  <i class="lab la-twitter opacity-60"></i>
                                              </a>
                                          </li>
                                          <li class="list-inline-item">
                                              <a href="{{ $detailedProduct->user->shop->youtube }}" class="youtube" target="_blank">
                                                  <i class="lab la-youtube opacity-60"></i>
                                              </a>
                                          </li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                      @endif
                      <div class="bg-white rounded shadow-sm mb-3">
                          <div class="p-3 border-bottom fs-16 fw-600">
                              {{ translate('Top Selling Products')}}
                          </div>
                          <div class="p-3">
                              <ul class="list-group list-group-flush">
                                  @foreach (filter_products(\App\Models\Product::where('user_id', $detailedProduct->user_id)->orderBy('num_of_sale', 'desc'))->limit(6)->get() as $key => $top_product)
                                  <li class="py-3 px-0 list-group-item border-light">
                                      <div class="row gutters-10 align-items-center">
                                          <div class="col-5">
                                              <a href="{{ route('product', $top_product->slug) }}" class="d-block text-reset">
                                                  <img
                                                      class="img-fit lazyload h-xxl-110px h-xl-80px h-120px"
                                                      src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                      data-src="{{ uploaded_asset($top_product->thumbnail_img) }}"
                                                      alt="{{ $top_product->getTranslation('name') }}"
                                                      onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                  >
                                              </a>
                                          </div>
                                          <div class="col-7 text-left">
                                              <h4 class="fs-13 text-truncate-2">
                                                  <a href="{{ route('product', $top_product->slug) }}" class="d-block text-reset">{{ $top_product->getTranslation('name') }}</a>
                                              </h4>
                                              <div class="rating rating-sm mt-1">
                                                  {{ renderStarRating($top_product->rating) }}
                                              </div>
                                              <div class="mt-2">
                                                  <span class="fs-17 fw-600 text-primary">{{ home_discounted_base_price($top_product) }}</span>
                                              </div>
                                          </div>
                                      </div>
                                  </li>
                                  @endforeach
                              </ul>
                          </div>
                      </div>
                  </div> --}}
                <div class="col-xl-12 order-0 order-xl-1 ">
                    <div class="px-lg-0">
                        <div class="bg-white mb-3 ">
                            <div class="nav aiz-nav-tabs">
                                {{--    <a href="#tab_default_1" data-toggle="tab" class="p-3 fs-16 fw-600 text-reset active show">{{ translate('Description')}}</a>--}}
                                @if($detailedProduct->video_link != null)
                                    <a href="#tab_default_2" data-toggle="tab" class="p-3 fs-16 fw-600 text-reset">{{ translate('Video')}}</a>
                                @endif
                                @if($detailedProduct->pdf != null)
                                    <a href="#tab_default_3" data-toggle="tab" class="p-3 fs-16 fw-600 text-reset">{{ translate('Downloads')}}</a>
                                @endif
                                {{-- <a href="#tab_default_4" data-toggle="tab" class="p-3 fs-16 fw-600 text-reset">{{ translate('Reviews')}}</a>--}}
                            </div>

                            <div class="tab-content pt-0">
                                <div class="tab-pane fade active show" id="tab_default_1">
                                    <div class="p-0">
                                        <div class="mw-100 overflow-hidden text-left aiz-editor-data">
                                            <?php echo $detailedProduct->getTranslation('description'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab_default_2">
                                    <div class="p-4">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            @if ($detailedProduct->video_provider == 'youtube' && isset(explode('=', $detailedProduct->video_link)[1]))
                                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ explode('=', $detailedProduct->video_link)[1] }}"></iframe>
                                            @elseif ($detailedProduct->video_provider == 'dailymotion' && isset(explode('video/', $detailedProduct->video_link)[1]))
                                                <iframe class="embed-responsive-item" src="https://www.dailymotion.com/embed/video/{{ explode('video/', $detailedProduct->video_link)[1] }}"></iframe>
                                            @elseif ($detailedProduct->video_provider == 'vimeo' && isset(explode('vimeo.com/', $detailedProduct->video_link)[1]))
                                                <iframe src="https://player.vimeo.com/video/{{ explode('vimeo.com/', $detailedProduct->video_link)[1] }}" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab_default_3">
                                    <div class="p-4 text-center ">
                                        <a href="{{ uploaded_asset($detailedProduct->pdf) }}" class="btn btn-primary">{{  translate('Download') }}</a>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab_default_4">
                                    <div class="p-4">
                                        <ul class="list-group list-group-flush">
                                            @foreach ($detailedProduct->reviews as $key => $review)
                                                @if($review->user != null)
                                                    <li class="media list-group-item d-flex">
                                                <span class="avatar avatar-md mr-3">
                                                    <img
                                                        class="lazyload"
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                        @if($review->user->avatar_original !=null)
                                                        data-src="{{ uploaded_asset($review->user->avatar_original) }}"
                                                        @else
                                                        data-src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        @endif
                                                    >
                                                </span>
                                                        <div class="media-body text-left">
                                                            <div class="d-flex justify-content-between">
                                                                <h3 class="fs-15 fw-600 mb-0">{{ $review->user->name }}</h3>
                                                                <span class="rating rating-sm">
                                                            @for ($i=0; $i < $review->rating; $i++)
                                                                        <i class="las la-star active"></i>
                                                                    @endfor
                                                                    @for ($i=0; $i < 5-$review->rating; $i++)
                                                                        <i class="las la-star"></i>
                                                                    @endfor
                                                        </span>
                                                            </div>
                                                            <div class="opacity-60 mb-2">{{ date('d-m-Y', strtotime($review->created_at)) }}</div>
                                                            <p class="comment-text">
                                                                {{ $review->comment }}
                                                            </p>
                                                        </div>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>

                                        @if(count($detailedProduct->reviews) <= 0)
                                            <div class="text-center fs-18 opacity-70">
                                                {{  translate('There have been no reviews for this product yet.') }}
                                            </div>
                                        @endif

                                        @if(Auth::check())
                                            @php
                                                $commentable = false;
                                            @endphp
                                            @foreach ($detailedProduct->orderDetails as $key => $orderDetail)
                                                @if($orderDetail->order != null && $orderDetail->order->user_id == Auth::user()->id && $orderDetail->delivery_status == 'delivered' && \App\Models\Review::where('user_id', Auth::user()->id)->where('product_id', $detailedProduct->id)->first() == null)
                                                    @php
                                                        $commentable = true;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if ($commentable)
                                                <div class="pt-4">
                                                    <div class="border-bottom mb-4">
                                                        <h3 class="fs-17 fw-600">
                                                            {{ translate('Write a review')}}
                                                        </h3>
                                                    </div>
                                                    <form class="form-default" role="form" action="{{ route('reviews.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="" class="text-uppercase c-gray-light">{{ translate('Your name')}}</label>
                                                                    <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" disabled required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="" class="text-uppercase c-gray-light">{{ translate('Email')}}</label>
                                                                    <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control" required disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="opacity-60">{{ translate('Rating')}}</label>
                                                            <div class="rating rating-input">
                                                                <label>
                                                                    <input type="radio" name="rating" value="1" required>
                                                                    <i class="las la-star"></i>
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="rating" value="2">
                                                                    <i class="las la-star"></i>
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="rating" value="3">
                                                                    <i class="las la-star"></i>
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="rating" value="4">
                                                                    <i class="las la-star"></i>
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="rating" value="5">
                                                                    <i class="las la-star"></i>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="opacity-60">{{ translate('Comment')}}</label>
                                                            <textarea class="form-control" rows="4" name="comment" placeholder="{{ translate('Your review')}}" required></textarea>
                                                        </div>

                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-primary mt-3">
                                                                {{ translate('Submit review')}}
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="p-4">
                                    <div class="bottom-border"> <h5>Review </h5></div>
                                    <ul class="list-group list-group-flush">
                                        @foreach ($detailedProduct->reviews as $key => $review)
                                            @if($review->user != null)
                                                <li class="media list-group-item d-flex">
                                                <span class="avatar avatar-md mr-3">
                                                    <img
                                                        class="lazyload"
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                        @if($review->user->avatar_original !=null)
                                                        data-src="{{ uploaded_asset($review->user->avatar_original) }}"
                                                        @else
                                                        data-src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        @endif
                                                    >
                                                </span>
                                                    <div class="media-body text-left">
                                                        <div class="d-flex justify-content-between">
                                                            <h3 class="fs-15 fw-600 mb-0">{{ $review->user->name }}</h3>
                                                            <span class="rating rating-sm">
                                                            @for ($i=0; $i < $review->rating; $i++)
                                                                    <i class="las la-star active"></i>
                                                                @endfor
                                                                @for ($i=0; $i < 5-$review->rating; $i++)
                                                                    <i class="las la-star"></i>
                                                                @endfor
                                                        </span>
                                                        </div>
                                                        <div class="opacity-60 mb-2">{{ date('d-m-Y', strtotime($review->created_at)) }}</div>
                                                        <p class="comment-text">
                                                            {{ $review->comment }}
                                                        </p>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>

                                    @if(count($detailedProduct->reviews) <= 0)
                                        <div class="text-center fs-18 opacity-70">
                                            {{  translate('There have been no reviews for this product yet.') }}
                                        </div>
                                    @endif

                                    @if(Auth::check())
                                        @php
                                            $commentable = false;
                                        @endphp
                                        @foreach ($detailedProduct->orderDetails as $key => $orderDetail)
                                            @if($orderDetail->order != null && $orderDetail->order->user_id == Auth::user()->id && $orderDetail->delivery_status == 'delivered' && \App\Models\Review::where('user_id', Auth::user()->id)->where('product_id', $detailedProduct->id)->first() == null)
                                                @php
                                                    $commentable = true;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @if ($commentable)
                                            <div class="pt-4">
                                                <div class="border-bottom mb-4">
                                                    <h3 class="fs-17 fw-600">
                                                        {{ translate('Write a review')}}
                                                    </h3>
                                                </div>
                                                <form class="form-default" role="form" action="{{ route('reviews.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="" class="text-uppercase c-gray-light">{{ translate('Your name')}}</label>
                                                                <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" disabled required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="" class="text-uppercase c-gray-light">{{ translate('Email')}}</label>
                                                                <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control" required disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="opacity-60">{{ translate('Rating')}}</label>
                                                        <div class="rating rating-input">
                                                            <label>
                                                                <input type="radio" name="rating" value="1" required>
                                                                <i class="las la-star"></i>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="rating" value="2">
                                                                <i class="las la-star"></i>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="rating" value="3">
                                                                <i class="las la-star"></i>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="rating" value="4">
                                                                <i class="las la-star"></i>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="rating" value="5">
                                                                <i class="las la-star"></i>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="opacity-60">{{ translate('Comment')}}</label>
                                                        <textarea class="form-control" rows="4" name="comment" placeholder="{{ translate('Your review')}}" required></textarea>
                                                    </div>

                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-primary mt-3">
                                                            {{ translate('Submit review')}}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div></div>

                    <div class="bg-white card shadow-sm my-5 px-3">
                        <div class="mb-3 pt-3 text-center">
                            <p>
                                @php
                                    //$item_category = category_bread_tree($detailedProduct->category->id);
                                    $brand=null;
                                    if(isset($detailedProduct->brand->name))
                                    {
                                        $brand=$detailedProduct->brand->name;
                                    }
                                    $auto_description=autodiscription($detailedProduct->name,$item_category,$brand);

                                @endphp

                                {{$auto_description}}

                            </p>

                        </div>
                    </div>

                    <div class="bg-white ">
                        <div class="mb-3 pt-3 text-center">

                            <h3 class="fs-18 fw-600 mb-0">
                                <span class=" px-2 py-2 bg-white has-transition">{{ translate('Related products')}}</span>
                            </h3>
                        </div>
                        <div class="p-3">
                            <div class="aiz-carousel gutters-5 half-outside-arrow" data-items="5" data-xl-items="3" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true' data-infinite='true'>
                                @foreach (filter_products(\App\Models\Product::where('category_id', $detailedProduct->category_id)->where('id', '!=', $detailedProduct->id))->limit(10)->get() as $key => $related_product)
                                    <div class="carousel-box">
                                        <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                                            <div class="">
                                                <a href="{{ route('product', $related_product->slug) }}" class="d-block">
                                                    <img
                                                        class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                        src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/QvA2RYQWO25rdXdlABjiqOulRlthFzqzwG5xus5n.png"
                                                        data-src="{{ uploaded_asset($related_product->thumbnail_img) }}"
                                                        alt="{{ $related_product->getTranslation('name') }}"
                                                        onerror="this.onerror=null;this.src='https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/QvA2RYQWO25rdXdlABjiqOulRlthFzqzwG5xus5n.png';"
                                                    >
                                                </a>
                                            </div>
                                            <div class="p-md-3 p-2 text-left">
                                                @if(!empty($related_product->brand->name))
                                                    <span class="text-reset ">	<a class="d-block text-reset" style="color: #8c8c8c !important; font-size: smaller;"> {{  $related_product->brand->name }}</a></span>
                                                @endif
                                                <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                    <a href="{{ route('product', $related_product->slug) }}" class="d-block text-reset">{{ $related_product->getTranslation('name') }}</a>
                                                </h3>

                                                <div class="fs-15">

                                                    <span class="fw-700 text-primary">{{ home_discounted_base_price($related_product) }}</span>
                                                    @if(home_base_price($related_product) != home_discounted_base_price($related_product))
                                                        <del class="fw-600 opacity-50 mr-1">{{ home_base_price($related_product) }}</del>
                                                    @endif
                                                    <span class="rating rating-sm mt-1 text-right" style="float:right;">
                                                {{ renderStarRating($related_product->rating) }}
                                            </span>

                                                </div>


                                                {{--  @if (addon_is_activated('club_point'))
                                                      <div class="rounded px-2 mt-2 bg-soft-primary border-soft-primary border">
                                                          {{ translate('Club Point') }}:
                                                          <span class="fw-700 float-right">{{ $related_product->earn_point }}</span>
                                                      </div>
                                                  @endif--}}
                                            </div>


                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('modal')
    <div class="modal fade" id="chat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title fw-600 h5">{{ translate('Any query about this product')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('conversations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="form-group">
                            <input type="text" class="form-control mb-3" name="title" value="{{ $detailedProduct->name }}" placeholder="{{ translate('Product Name') }}" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="8" name="message" required placeholder="{{ translate('Your Question') }}">{{ route('product', $detailedProduct->slug) }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary fw-600" data-dismiss="modal">{{ translate('Cancel')}}</button>
                        <button type="submit" class="btn btn-primary fw-600">{{ translate('Send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fw-600">{{ translate('Login')}}</h6>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="p-3">
                        <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                @if (addon_is_activated('otp_system'))
                                    <input type="text" class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ translate('Email Or Phone')}}" name="email" id="email">
                                @else
                                    <input type="email" class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                @endif
                                @if (addon_is_activated('otp_system'))
                                    <span class="opacity-60">{{  translate('Use country code before number') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <input type="password" name="password" class="form-control h-auto form-control-lg" placeholder="{{ translate('Password')}}">
                            </div>

                            <div class="row mb-2">
                                <div class="col-6">
                                    <label class="aiz-checkbox">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class=opacity-60>{{  translate('Remember Me') }}</span>
                                        <span class="aiz-square-check"></span>
                                    </label>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('password.request') }}" class="text-reset opacity-60 fs-14">{{ translate('Forgot password?')}}</a>
                                </div>
                            </div>

                            <div class="mb-5">
                                <button type="submit" class="btn btn-primary btn-block fw-600">{{  translate('Login') }}</button>
                            </div>
                        </form>

                        <div class="text-center mb-3">
                            <p class="text-muted mb-0">{{ translate('Dont have an account?')}}</p>
                            <a href="{{ route('user.registration') }}">{{ translate('Register Now')}}</a>
                        </div>
                        @if(get_setting('google_login') == 1 ||
                            get_setting('facebook_login') == 1 ||
                            get_setting('twitter_login') == 1)
                            <div class="separator mb-3">
                                <span class="bg-white px-3 opacity-60">{{ translate('Or Login With')}}</span>
                            </div>
                            <ul class="list-inline social colored text-center mb-5">
                                @if (get_setting('facebook_login') == 1)
                                    <li class="list-inline-item">
                                        <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">
                                            <i class="lab la-facebook-f"></i>
                                        </a>
                                    </li>
                                @endif
                                @if(get_setting('google_login') == 1)
                                    <li class="list-inline-item">
                                        <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google">
                                            <i class="lab la-google"></i>
                                        </a>
                                    </li>
                                @endif
                                @if (get_setting('twitter_login') == 1)
                                    <li class="list-inline-item">
                                        <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter">
                                            <i class="lab la-twitter"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            getVariantPrice();
        });

        function CopyToClipboard(e) {
            var url = $(e).data('url');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(url).select();
            try {
                document.execCommand("copy");
                AIZ.plugins.notify('success', '{{ translate('Link copied to clipboard') }}');
            } catch (err) {
                AIZ.plugins.notify('danger', '{{ translate('Oops, unable to copy') }}');
            }
            $temp.remove();
            // if (document.selection) {
            //     var range = document.body.createTextRange();
            //     range.moveToElementText(document.getElementById(containerid));
            //     range.select().createTextRange();
            //     document.execCommand("Copy");

            // } else if (window.getSelection) {
            //     var range = document.createRange();
            //     document.getElementById(containerid).style.display = "block";
            //     range.selectNode(document.getElementById(containerid));
            //     window.getSelection().addRange(range);
            //     document.execCommand("Copy");
            //     document.getElementById(containerid).style.display = "none";

            // }
            // AIZ.plugins.notify('success', 'Copied');
        }
        function show_chat_modal(){
            @if (Auth::check())
            $('#chat_modal').modal('show');
            @else
            $('#login_modal').modal('show');
            @endif
        }


        $('#addtocart').on('click', function () {
            dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
            dataLayer.push({
                event: "add_to_cart",

                @php
                    $item_category = category_tree($detailedProduct->category->id);
                @endphp
                ecommerce: {
                    items: [
                        {
                            item_id: "{{$detailedProduct->id}}",
                            item_name: "{{$detailedProduct->getTranslation('name')  }}",
                            affiliation: "",
                            coupon: "",
                            currency: "BDT",
                            discount: {{number_format((float)$detailedProduct->discount, 2, '.', '')??0.00}},
                            index: 0,
                            item_brand: "{{$detailedProduct->brand->name??""}}",
                            item_category: "{!! $item_category[0]??"" !!}",
                            item_category2: "{!! $item_category[1]??"" !!}",
                            item_category3: "{!! $item_category[2]??"" !!}",
                            item_category4: "",
                            item_category5: "",
                            item_list_id: "",
                            item_list_name: "",
                            item_variant: "",
                            location_id: "",
                            price: {{number_format((float)$detailedProduct->unit_price, 2, '.', '')??0.00}},
                            quantity: 1
                        }
                    ]
                }
            });


        });

        $('#wishbtn').on('click', function () {
            dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
            dataLayer.push({
                event: "add_to_wishlist",

                @php
                    $item_category = category_tree($detailedProduct->category->id);
                @endphp
                ecommerce: {
                    items: [
                        {
                            item_id: "{{$detailedProduct->id}}",
                            item_name: "{{$detailedProduct->getTranslation('name')  }}",
                            affiliation: "",
                            coupon: "",
                            currency: "BDT",
                            discount: {{number_format((float)$detailedProduct->discount, 2, '.', '')??0.00}},
                            index: 0,
                            item_brand: "{{$detailedProduct->brand->name??""}}",
                            item_category: "{!! $item_category[0]??"" !!}",
                            item_category2: "{!! $item_category[1]??"" !!}",
                            item_category3: "{!! $item_category[2]??"" !!}",
                            item_category4: "",
                            item_category5: "",
                            item_list_id: "",
                            item_list_name: "",
                            item_variant: "",
                            location_id: "",
                            price: {{number_format((float)$detailedProduct->unit_price, 2, '.', '')??0.00}},
                            quantity: 1
                        }
                    ]
                }
            });


        });






    </script>
@endsection
