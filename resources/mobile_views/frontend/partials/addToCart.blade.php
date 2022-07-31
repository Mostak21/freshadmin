<div class="modal-body p-4 c-scrollbar-light">
    <div class="modal-header">
        <h2 class="mb-2 px-2 fs-20 fw-600 modal-title">
            {{  $product->getTranslation('name')  }}
        </h2>
    </div><br>
    <div class="row">
        <div class="col-lg-7">
            <div class="row gutters-10 flex-row-reverse">
                @php
                    $photos = explode(',',$product->photos);
                @endphp
                <div class="col">
                    <div class="aiz-carousel product-gallery" data-nav-for='.product-gallery-thumb' data-fade='true' data-auto-height='true'>
                        @foreach ($photos as $key => $photo)
                            <div class="carousel-box img-zoom rounded">
                                <img
                                    class="img-fluid lazyload"
                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ uploaded_asset($photo) }}"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                >
                            </div>
                        @endforeach
                        @foreach ($product->stocks as $key => $stock)
                            @if ($stock->image != null)
                                <div class="carousel-box img-zoom rounded">
                                    <img
                                        class="img-fluid lazyload"
                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        data-src="{{ uploaded_asset($stock->image) }}"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                    >
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-auto w-90px">
                    <div class="aiz-carousel carousel-thumb product-gallery-thumb" data-items='5' data-nav-for='.product-gallery' data-vertical='true' data-focus-select='true'>
                        @foreach ($photos as $key => $photo)
                            <div class="carousel-box c-pointer border p-1 rounded">
                                <img
                                    class="lazyload mw-100 size-60px mx-auto"
                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ uploaded_asset($photo) }}"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                >
                            </div>
                        @endforeach
                        @foreach ($product->stocks as $key => $stock)
                            @if ($stock->image != null)
                                <div class="carousel-box c-pointer border p-1 rounded" data-variation="{{ $stock->variant }}">
                                    <img
                                        class="lazyload mw-100 size-50px mx-auto"
                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        data-src="{{ uploaded_asset($stock->image) }}"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                    >
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5 pl-3">
            <div class="text-left">
                <div class="row no-gutters">
                    @php
                        $total = 0;
                        $total += $product->reviews->count();
                    @endphp
                    <span class="rating">
                                        {{ renderStarRating($product->rating) }}
                                    </span>
                    <span class="ml-1 ">({{ $total }} {{ translate('reviews')}})</span>
                </div>

                @if(home_price($product) != home_discounted_price($product))
                    <div class="row no-gutters mt-3 pb-3">
						<span class="pr-2">
                        <strong class="h2 fw-600 text-primary">
                                    {{ home_discounted_price($product) }}
                                </strong>
                                @if($product->unit != null)
                                <span class="opacity-90">/{{ $product->getTranslation('unit') }}</span>
                            @endif
							</span>

                        <span class="fs-20 opacity-60">
                                <del>
                                    {{ home_price($product) }}
                                    @if($product->unit != null)
                                        <span>/{{ $product->getTranslation('unit') }}</span>
                                    @endif
                                </del>
                            </span>

                    </div>


                @else
                    <div class="row no-gutters mt-3 mb-3">

                        <div class="col-12">
                            <div class="">
                                <strong class="h2 fw-600 text-primary">
                                    {{ home_discounted_price($product) }}
                                </strong>
                                <span class="opacity-70">/{{ $product->unit }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                @if (addon_is_activated('club_point') && $product->earn_point > 0)
                    <div class="row no-gutters mt-4 pb-2">
                        <div class="col-2">
                            <div class="opacity-50">{{  translate('Club Point') }}:</div>
                        </div>
                        <div class="col-10">
                            <div class="d-inline-block club-point bg-soft-primary px-3 py-1 border">
                                <span class="strong-700">{{ $product->earn_point }}</span>
                            </div>
                        </div>
                    </div>
                @endif



                @php
                    $qty = 0;
                    foreach ($product->stocks as $key => $stock) {
                        $qty += $stock->qty;
                    }
                @endphp

                <form id="option-choice-form">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">

                    <!-- Quantity + Add to cart -->
                    @if($product->digital !=1)
                        @if ($product->choice_options != null)
                            @foreach (json_decode($product->choice_options) as $key => $choice)

                                <div class="row no-gutters">
                                    <div class="col-2">
                                        <div class="opacity-50 mt-2 ">{{ \App\Models\Attribute::find($choice->attribute_id)->name??'' }}:</div>
                                    </div>
                                    <div class="col-10">
                                        <div class="aiz-radio-inline">
                                            @php
                                                $attributecheck =  0;
                                                $key2 = null;
                                                $count = -1;
                                                $attributeLength = count($choice->values);
                                                $selectedColor = null;

                                            @endphp
                                            @foreach ($choice->values as $keys => $value)
                                                @php
                                                    $value2 = str_replace(' ', '', $value);
                                                    $key1=$keys;

                                                    if ($attributecheck === 0){
                                                    $count++;
                                                    }

                                                    foreach($product->stocks as $key => $stock){
                                                        if(str_contains($product->stocks[$key]->variant, $value2) && $product->stocks[$key]->qty !=0 ){

                                                        if ($attributecheck ==  0){

                                                            $valuex = $value;
                                                            $key2 = $key;
                                                            //dd($selectedColor);
                                                            if ($attributeLength > 0 && $selectedColor == null){
                                                            $selectedColor = floor($key2 / $attributeLength);
                                                            $selectedColor = (int) $selectedColor;
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
                                                        <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center py-2 px-3 mb-2">
                                                        {{ $value }}
                                                    </span>
                                                    </label>
                                                @elseif($qty==0)
                                                    <label class="aiz-megabox pl-0 mr-2">
                                                        <input
                                                            type="radio"
                                                            name="attribute_id_{{ $choice->attribute_id }}"
                                                            value="{{ $value }}"
                                                            @if($keys == 0) checked @endif
                                                        >
                                                        <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center py-2 px-3 mb-2 fs-custom">
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

                        @if (count(json_decode($product->colors)) > 0)
                            <div class="row no-gutters">
                                <div class="col-2">
                                    <div class="opacity-50 mt-2">{{ translate('Color')}}:</div>
                                </div>
                                <div class="col-10">
                                    <div class="aiz-radio-inline">
                                        @php
                                            $colorcheck2 =  0;
                                            $colorcheck =  0;
                                        @endphp
                                        @foreach (json_decode($product->colors) as $keys => $color)
                                            @php
                                                $colorcheck =  0;
                                                $color2 = str_replace(' ', '', \App\Models\Color::where('code', $color)->first()->name);
                                                foreach($product->stocks as $key => $stock){
                                                    if(str_contains($product->stocks[$key]->variant, $color2) && $product->stocks[$key]->qty !=0 ){
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
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: {{ $color }};"></span>
                                                    </span>
                                                </label>

                                            @elseif($qty==0)
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

                        <div class="row no-gutters">
                            <div class="col-2">
                                <div class="opacity-50 mt-2">{{ translate('Quantity')}}:</div>
                            </div>
                            <div class="col-10">
                                <div class="product-quantity d-flex align-items-center">
                                    <div class="row no-gutters align-items-center aiz-plus-minus mr-3" style="width: 130px;">
                                        <button class="btn col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="minus" data-field="quantity" disabled="">
                                            <i class="las la-minus"></i>
                                        </button>
                                        <input type="text" name="quantity" class="col border-0 text-center flex-grow-1 fs-16 input-number" placeholder="1" value="{{ $product->min_qty }}" min="{{ $product->min_qty }}" max="10">
                                        <button class="btn  col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="plus" data-field="quantity">
                                            <i class="las la-plus"></i>
                                        </button>
                                    </div>
                                    <div class="avialable-amount opacity-60">
                                        @if($product->stock_visibility_state == 'quantity')
                                            (<span id="available-quantity">{{ $qty }}</span> {{ translate('available')}})
                                        @elseif($product->stock_visibility_state == 'text' && $qty >= 1)
                                            (<span id="available-quantity">{{ translate('In Stock') }}</span>)
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>


                    @endif

                    <div class="row no-gutters pb-3 d-none mt-3" id="chosen_price_div">
                        <div class="col-2">
                            <div class="opacity-50">{{ translate('Total Price')}}:</div>
                        </div>
                        <div class="col-10">
                            <div class="product-price">
                                <strong id="chosen_price" class="h4 fw-600 text-primary">

                                </strong>
                            </div>
                        </div>
                    </div>

                </form>
                <div class="mt-3">
                    @if ($product->digital == 1)
                        <button type="button" class="btn btn-primary buy-now fw-600 add-to-cart" onclick="addToCart()">
                            <i class="la la-shopping-cart"></i>
                            <span class="d-none d-md-inline-block"> {{ translate('Add to cart')}}</span>
                        </button>
                    @elseif($qty > 0)
                        @if ($product->external_link != null)
                            <a type="button" class="btn btn-soft-primary mr-2 add-to-cart fw-600" href="{{ $product->external_link }}">
                                <i class="las la-shopping-bag"></i>
                                <span class="d-none d-md-inline-block"> {{ translate('Add to cart')}}</span>
                            </a>
                        @else
                            <button type="button" class="btn btn-primary buy-now fw-600 add-to-cart" onclick="addToCart()">
                                <i class="la la-shopping-cart"></i>
                                <span class="d-none d-md-inline-block" id="addtocart"> {{ translate('Add to cart')}}</span>
                            </button>
                        @endif
                    @endif
                    <button type="button" class="btn btn-secondary out-of-stock fw-600 d-none" disabled>
                        <i class="la la-cart-arrow-down"></i> {{ translate('Out of Stock')}}
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#option-choice-form input').on('change', function () {
        getVariantPrice();
    });



    $('#addtocart').on('click', function () {
        dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
        dataLayer.push({
            event: "add_to_cart",

            @php
                if(home_price($product) != home_discounted_price($product)){
                $discount=home_discounted_price($product);
                $price=home_price($product);}
                $item_category = category_tree($product->category->id);
            @endphp
            ecommerce: {
                items: [
                    {
                        item_id: "{{$product->id}}",
                        item_name: "{{  $product->getTranslation('name')  }}",
                        affiliation: "",
                        coupon: "",
                        currency: "BDT",
                        discount: {{number_format((float)$product->discount, 2, '.', '')??0.00}},
                        index: 0,
                        item_brand: "{{$product->brand->name??""}}",
                        item_category: "{!! $item_category[0]??"" !!}",
                        item_category2: "{!! $item_category[1]??"" !!}",
                        item_category3: "{!! $item_category[2]??"" !!}",
                        item_category4: "",
                        item_category5: "",
                        item_list_id: "",
                        item_list_name: "",
                        item_variant: "",
                        location_id: "",
                        price: {{number_format((float)$product->unit_price, 2, '.', '')??0.00}},
                        quantity: 1
                    }
                ]
            }
        });


    });


</script>
