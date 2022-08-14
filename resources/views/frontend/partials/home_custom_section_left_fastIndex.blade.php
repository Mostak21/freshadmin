<div id="custom_section1">
{{--Section banner start--}}
    <div class="mb-4">
        <div class="container">
            <div class="px-3">
                <div class="mb-3 mb-lg-0 rounded">
                    <a href="{{ json_decode(get_setting('home_banner1_links'), true)[0] }}"
                       class="d-block text-reset" >
                        <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/3fitI85JmDtaFNTObXGjV4fKuqvseqovkzg2CNNg.svg"
                             {{--                                         data-src="{{ uploaded_asset($banner_1_imags[$key]) }}"--}}
                             data-src="{{$section_data->banner_image_link??"" }}"
                             alt="{{ env('APP_NAME') }} promo"
                             class="img-fluid lazyload w-100">
                    </a>
                </div>
            </div>
        </div>
    </div>
{{--Section banner end--}}
    <div class="container pb-3 px-5">
        <div class="row ">

{{--                    section poster start --}}
            <div class="col-md-5 round-2 productheaderbg">
                <div class="px-3 py-4 mparent" style="height: 100%;">
                    @if($section_data)
                        <h3 class="fw-600">{{$section_data->title??""}}</h3>
                    @else
                        <h3 class="fw-600">
                            <a style="background: rgba(183,183,183,0.18)">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </a>
                        </h3> @endif
                    <div><a class="text-primary" href="{{getBaseURL()}}category/{{$section_data->link??""}}">{{$section_data->title??""}} <i class="ci-arrow-right fs-xs align-middle ms-1"></i></a></div>

                        <div class="mchild">
                            <a class="d-none d-md-block mt-auto" href="">
                                <img class="d-block w-100"
                                     src="{{$section_data->poster_image_link??"#"}}"
                                     alt="{{$section_data->title??""}}">
                            </a>
                        </div>
                </div>
            </div>
{{--                    section poster end --}}
{{--            product section 1 start--}}
            <div class="col-md-7 pl-lg-4">
                <div class="aiz-carousel dots-inside-bottom slick-initialized slick-slider" style="overflow: visible;" data-arrows="true" data-dots="false" data-autoplay="true">
                    @if($section_data)
                                    <div class="carousel-box  px-1">
                                        <div class="row gutters-5 row-cols-xxl-3 row-cols-xl-3 row-cols-lg-3 row-cols-md-3 row-cols-2 pb-lg-5">

                                            <div class="col px-1 py-1">
                                                <div class="mcard product-card ">
                                                    <div class="position-relative xcard">
                                                        @php
                                                            $Product_Stock = 0 ;
                                                            if($section_data->products[0]->productData != null)
                                                            $Product_Stock = $section_data->products[0]->productData->stock;
                                                            else
                                                            if (!empty($section_data->products[0]->stocks)) foreach ($section_data->products[0]->stocks as $stock) if ($stock->qty>=1) $Product_Stock = 1;
                                                        @endphp

                                                        @if ($section_data->products[0]->unit_price > 5000 && ($section_data->products[0]->unit_price-$section_data->products[0]->discount)>= 5000)
                                                            <div class="ribbon ribbon-top-right"><span>EMI</span></div>
                                                        @endif

                                                        @if (!$Product_Stock)
                                                            <div class="ribbon ribbon-top-right"><span style="background-color: black;"><small>Sold Out</small></span></div>
                                                        @endif
                                                        <a href="{{ route('product', $section_data->products[0]->slug) }}" class="d-block">
                                                            @if ($section_data->products[0]->shipping_type == "free") <span class="tag-text">Free Delivery</span> @endif
                                                            <img
                                                                class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                                src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/n5CaJ3EwblTB9K4aaVJIBRj35kW3I67DlyO8vzyc.webp"
                                                                data-src="{{$section_data->products[0]->productData->thumbnail?? uploaded_asset($section_data->products[0]->thumbnail_img) }}"
                                                                alt="{{ $section_data->products[0]->name }}"
                                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                            >
                                                        </a>
                                                        @if ($section_data->products[0]->wholesale_product)
                                                            <span class="absolute-bottom-left fs-11 text-white fw-600 px-2 lh-1-8" style="background-color: #455a64">
                Wholesale
            </span>
                                                        @endif
                                                        <div class="absolute-top-right aiz-p-hov-icon">
                                                            <a href="javascript:void(0)" onclick="addToWishList({{ $section_data->products[0]->id }});" data-toggle="tooltip" data-title="Add to wishlist" data-placement="left">
                                                                <i class="la la-heart-o"></i>
                                                            </a>
                                                            <a href="javascript:void(0)" onclick="addToCompare({{ $section_data->products[0]->id }})" data-toggle="tooltip" data-title="Add to compare" data-placement="left">
                                                                <i class="las la-sync"></i>
                                                            </a>
                                                            <a class="d-lg-none" href="javascript:void(0)" onclick="showAddToCartModal({{ $section_data->products[0]->id }})" data-toggle="tooltip" data-title="Add to cart" data-placement="left">
                                                                <i class="las la-shopping-cart"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="p-md-3 p-2 text-left">

        <span class="text-reset ">
          <a class="d-block text-reset" style="color: #8c8c8c !important; ">
            <small class="fw-300"> {{  $section_data->products[0]->productData->brand??$section_data->products[0]->brand->name??"" }}</small>
          </a>
        </span>


                                                        <h3 class="fw-500 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                            <a href="{{ route('product', $section_data->products[0]->slug) }}" class="d-block text-reset">{{  $section_data->products[0]->name }}</a>
                                                        </h3>

                                                        <div class="fs-15">
                                                            <span class="fw-400 text-primary"> <a href="{{ route('product', $section_data->products[0]->slug) }}">{{ home_discounted_base_price($section_data->products[0]) }}</a></span>
                                                            @if(home_base_price($section_data->products[0]) != home_discounted_base_price($section_data->products[0]))
                                                                <del class="fw-400 mr-1 fs-12">{{ home_base_price($section_data->products[0]) }}</del>
                                                            @endif
                                                            <span class="rating rating-sm" style="float:right;">
                {{ renderStarRating($section_data->products[0]->rating) }}
            </span>
                                                        </div>
                                                    </div>
                                                    <div class="mcard-body card-body-hidden">
                                                        <a href="javascript:void(0)" onclick="showAddToCartModal({{ $section_data->products[0]->id }})">
                                                            <button class="btn btn-primary btn-sm d-block w-100 mb-2 text-white" type="button"><i class="la la-shopping-cart opacity-100 fs-18"></i>Add to Cart</button>
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col px-1 py-1">
                                                <div class="mcard product-card ">
                                                    <div class="position-relative xcard">
                                                        @php
                                                            $Product_Stock = 0 ;
                                                            if($section_data->products[1]->productData != null)
                                                            $Product_Stock = $section_data->products[1]->productData->stock;
                                                            else
                                                            if (!empty($section_data->products[1]->stocks)) foreach ($section_data->products[1]->stocks as $stock) if ($stock->qty>=1) $Product_Stock = 1;
                                                        @endphp

                                                        @if ($section_data->products[1]->unit_price > 5000 && ($section_data->products[1]->unit_price-$section_data->products[1]->discount)>= 5000)
                                                            <div class="ribbon ribbon-top-right"><span>EMI</span></div>
                                                        @endif

                                                        @if (!$Product_Stock)
                                                            <div class="ribbon ribbon-top-right"><span style="background-color: black;"><small>Sold Out</small></span></div>
                                                        @endif
                                                        <a href="{{ route('product', $section_data->products[1]->slug) }}" class="d-block">
                                                            @if ($section_data->products[1]->shipping_type == "free") <span class="tag-text">Free Delivery</span> @endif
                                                            <img
                                                                class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                                src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/n5CaJ3EwblTB9K4aaVJIBRj35kW3I67DlyO8vzyc.webp"
                                                                data-src="{{$section_data->products[1]->productData->thumbnail?? uploaded_asset($section_data->products[1]->thumbnail_img) }}"
                                                                alt="{{ $section_data->products[1]->name }}"
                                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                            >
                                                        </a>
                                                        @if ($section_data->products[1]->wholesale_product)
                                                            <span class="absolute-bottom-left fs-11 text-white fw-600 px-2 lh-1-8" style="background-color: #455a64">
                Wholesale
            </span>
                                                        @endif
                                                        <div class="absolute-top-right aiz-p-hov-icon">
                                                            <a href="javascript:void(0)" onclick="addToWishList({{ $section_data->products[1]->id }});" data-toggle="tooltip" data-title="Add to wishlist" data-placement="left">
                                                                <i class="la la-heart-o"></i>
                                                            </a>
                                                            <a href="javascript:void(0)" onclick="addToCompare({{ $section_data->products[1]->id }})" data-toggle="tooltip" data-title="Add to compare" data-placement="left">
                                                                <i class="las la-sync"></i>
                                                            </a>
                                                            <a class="d-lg-none" href="javascript:void(0)" onclick="showAddToCartModal({{ $section_data->products[1]->id }})" data-toggle="tooltip" data-title="Add to cart" data-placement="left">
                                                                <i class="las la-shopping-cart"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="p-md-3 p-2 text-left">

        <span class="text-reset ">
          <a class="d-block text-reset" style="color: #8c8c8c !important; ">
            <small class="fw-300"> {{  $section_data->products[1]->productData->brand??$section_data->products[1]->brand->name??"" }}</small>
          </a>
        </span>


                                                        <h3 class="fw-500 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                            <a href="{{ route('product', $section_data->products[1]->slug) }}" class="d-block text-reset">{{  $section_data->products[1]->name }}</a>
                                                        </h3>

                                                        <div class="fs-15">
                                                            <span class="fw-400 text-primary"> <a href="{{ route('product', $section_data->products[1]->slug) }}">{{ home_discounted_base_price($section_data->products[1]) }}</a></span>
                                                            @if(home_base_price($section_data->products[1]) != home_discounted_base_price($section_data->products[1]))
                                                                <del class="fw-400 mr-1 fs-12">{{ home_base_price($section_data->products[1]) }}</del>
                                                            @endif
                                                            <span class="rating rating-sm" style="float:right;">
                {{ renderStarRating($section_data->products[1]->rating) }}
            </span>
                                                        </div>
                                                    </div>
                                                    <div class="mcard-body card-body-hidden">
                                                        <a href="javascript:void(0)" onclick="showAddToCartModal({{ $section_data->products[1]->id }})">
                                                            <button class="btn btn-primary btn-sm d-block w-100 mb-2 text-white" type="button"><i class="la la-shopping-cart opacity-100 fs-18"></i>Add to Cart</button>
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col px-1 py-1">
                                                <div class="mcard product-card ">
                                                    <div class="position-relative xcard">
                                                        @php
                                                            $Product_Stock = 0 ;
                                                            if($section_data->products[2]->productData != null)
                                                            $Product_Stock = $section_data->products[2]->productData->stock;
                                                            else
                                                            if (!empty($section_data->products[2]->stocks)) foreach ($section_data->products[2]->stocks as $stock) if ($stock->qty>=1) $Product_Stock = 1;
                                                        @endphp

                                                        @if ($section_data->products[2]->unit_price > 5000 && ($section_data->products[2]->unit_price-$section_data->products[2]->discount)>= 5000)
                                                            <div class="ribbon ribbon-top-right"><span>EMI</span></div>
                                                        @endif

                                                        @if (!$Product_Stock)
                                                            <div class="ribbon ribbon-top-right"><span style="background-color: black;"><small>Sold Out</small></span></div>
                                                        @endif
                                                        <a href="{{ route('product', $section_data->products[2]->slug) }}" class="d-block">
                                                            @if ($section_data->products[2]->shipping_type == "free") <span class="tag-text">Free Delivery</span> @endif
                                                            <img
                                                                class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                                src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/n5CaJ3EwblTB9K4aaVJIBRj35kW3I67DlyO8vzyc.webp"
                                                                data-src="{{$section_data->products[2]->productData->thumbnail?? uploaded_asset($section_data->products[2]->thumbnail_img) }}"
                                                                alt="{{ $section_data->products[2]->name }}"
                                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                            >
                                                        </a>
                                                        @if ($section_data->products[2]->wholesale_product)
                                                            <span class="absolute-bottom-left fs-11 text-white fw-600 px-2 lh-1-8" style="background-color: #455a64">
                Wholesale
            </span>
                                                        @endif
                                                        <div class="absolute-top-right aiz-p-hov-icon">
                                                            <a href="javascript:void(0)" onclick="addToWishList({{ $section_data->products[2]->id }});" data-toggle="tooltip" data-title="Add to wishlist" data-placement="left">
                                                                <i class="la la-heart-o"></i>
                                                            </a>
                                                            <a href="javascript:void(0)" onclick="addToCompare({{ $section_data->products[2]->id }})" data-toggle="tooltip" data-title="Add to compare" data-placement="left">
                                                                <i class="las la-sync"></i>
                                                            </a>
                                                            <a class="d-lg-none" href="javascript:void(0)" onclick="showAddToCartModal({{ $section_data->products[2]->id }})" data-toggle="tooltip" data-title="Add to cart" data-placement="left">
                                                                <i class="las la-shopping-cart"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="p-md-3 p-2 text-left">

        <span class="text-reset ">
          <a class="d-block text-reset" style="color: #8c8c8c !important; ">
            <small class="fw-300"> {{  $section_data->products[2]->productData->brand??$section_data->products[2]->brand->name??"" }}</small>
          </a>
        </span>


                                                        <h3 class="fw-500 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                            <a href="{{ route('product', $section_data->products[2]->slug) }}" class="d-block text-reset">{{  $section_data->products[2]->name }}</a>
                                                        </h3>

                                                        <div class="fs-15">
                                                            <span class="fw-400 text-primary"> <a href="{{ route('product', $section_data->products[2]->slug) }}">{{ home_discounted_base_price($section_data->products[2]) }}</a></span>
                                                            @if(home_base_price($section_data->products[2]) != home_discounted_base_price($section_data->products[2]))
                                                                <del class="fw-400 mr-1 fs-12">{{ home_base_price($section_data->products[2]) }}</del>
                                                            @endif
                                                            <span class="rating rating-sm" style="float:right;">
                {{ renderStarRating($section_data->products[2]->rating) }}
            </span>
                                                        </div>
                                                    </div>
                                                    <div class="mcard-body card-body-hidden">
                                                        <a href="javascript:void(0)" onclick="showAddToCartModal({{ $section_data->products[2]->id }})">
                                                            <button class="btn btn-primary btn-sm d-block w-100 mb-2 text-white" type="button"><i class="la la-shopping-cart opacity-100 fs-18"></i>Add to Cart</button>
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col px-1 py-1">
                                                <div class="mcard product-card ">
                                                    <div class="position-relative xcard">
                                                        @php
                                                            $Product_Stock = 0 ;
                                                            if($section_data->products[3]->productData != null)
                                                            $Product_Stock = $section_data->products[3]->productData->stock;
                                                            else
                                                            if (!empty($section_data->products[3]->stocks)) foreach ($section_data->products[3]->stocks as $stock) if ($stock->qty>=1) $Product_Stock = 1;
                                                        @endphp

                                                        @if ($section_data->products[3]->unit_price > 5000 && ($section_data->products[3]->unit_price-$section_data->products[3]->discount)>= 5000)
                                                            <div class="ribbon ribbon-top-right"><span>EMI</span></div>
                                                        @endif

                                                        @if (!$Product_Stock)
                                                            <div class="ribbon ribbon-top-right"><span style="background-color: black;"><small>Sold Out</small></span></div>
                                                        @endif
                                                        <a href="{{ route('product', $section_data->products[3]->slug) }}" class="d-block">
                                                            @if ($section_data->products[3]->shipping_type == "free") <span class="tag-text">Free Delivery</span> @endif
                                                            <img
                                                                class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                                src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/n5CaJ3EwblTB9K4aaVJIBRj35kW3I67DlyO8vzyc.webp"
                                                                data-src="{{$section_data->products[3]->productData->thumbnail?? uploaded_asset($section_data->products[3]->thumbnail_img) }}"
                                                                alt="{{ $section_data->products[3]->name }}"
                                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                            >
                                                        </a>
                                                        @if ($section_data->products[3]->wholesale_product)
                                                            <span class="absolute-bottom-left fs-11 text-white fw-600 px-2 lh-1-8" style="background-color: #455a64">
                Wholesale
            </span>
                                                        @endif
                                                        <div class="absolute-top-right aiz-p-hov-icon">
                                                            <a href="javascript:void(0)" onclick="addToWishList({{ $section_data->products[3]->id }});" data-toggle="tooltip" data-title="Add to wishlist" data-placement="left">
                                                                <i class="la la-heart-o"></i>
                                                            </a>
                                                            <a href="javascript:void(0)" onclick="addToCompare({{ $section_data->products[3]->id }})" data-toggle="tooltip" data-title="Add to compare" data-placement="left">
                                                                <i class="las la-sync"></i>
                                                            </a>
                                                            <a class="d-lg-none" href="javascript:void(0)" onclick="showAddToCartModal({{ $section_data->products[3]->id }})" data-toggle="tooltip" data-title="Add to cart" data-placement="left">
                                                                <i class="las la-shopping-cart"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="p-md-3 p-2 text-left">

        <span class="text-reset ">
          <a class="d-block text-reset" style="color: #8c8c8c !important; ">
            <small class="fw-300"> {{  $section_data->products[3]->productData->brand??$section_data->products[3]->brand->name??"" }}</small>
          </a>
        </span>


                                                        <h3 class="fw-500 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                            <a href="{{ route('product', $section_data->products[3]->slug) }}" class="d-block text-reset">{{  $section_data->products[3]->name }}</a>
                                                        </h3>

                                                        <div class="fs-15">
                                                            <span class="fw-400 text-primary"> <a href="{{ route('product', $section_data->products[3]->slug) }}">{{ home_discounted_base_price($section_data->products[3]) }}</a></span>
                                                            @if(home_base_price($section_data->products[3]) != home_discounted_base_price($section_data->products[3]))
                                                                <del class="fw-400 mr-1 fs-12">{{ home_base_price($section_data->products[3]) }}</del>
                                                            @endif
                                                            <span class="rating rating-sm" style="float:right;">
                {{ renderStarRating($section_data->products[3]->rating) }}
            </span>
                                                        </div>
                                                    </div>
                                                    <div class="mcard-body card-body-hidden">
                                                        <a href="javascript:void(0)" onclick="showAddToCartModal({{ $section_data->products[3]->id }})">
                                                            <button class="btn btn-primary btn-sm d-block w-100 mb-2 text-white" type="button"><i class="la la-shopping-cart opacity-100 fs-18"></i>Add to Cart</button>
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col px-1 py-1">
                                                <div class="mcard product-card ">
                                                    <div class="position-relative xcard">
                                                        @php
                                                            $Product_Stock = 0 ;
                                                            if($section_data->products[4]->productData != null)
                                                            $Product_Stock = $section_data->products[4]->productData->stock;
                                                            else
                                                            if (!empty($section_data->products[4]->stocks)) foreach ($section_data->products[4]->stocks as $stock) if ($stock->qty>=1) $Product_Stock = 1;
                                                        @endphp

                                                        @if ($section_data->products[4]->unit_price > 5000 && ($section_data->products[4]->unit_price-$section_data->products[4]->discount)>= 5000)
                                                            <div class="ribbon ribbon-top-right"><span>EMI</span></div>
                                                        @endif

                                                        @if (!$Product_Stock)
                                                            <div class="ribbon ribbon-top-right"><span style="background-color: black;"><small>Sold Out</small></span></div>
                                                        @endif
                                                        <a href="{{ route('product', $section_data->products[4]->slug) }}" class="d-block">
                                                            @if ($section_data->products[4]->shipping_type == "free") <span class="tag-text">Free Delivery</span> @endif
                                                            <img
                                                                class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                                src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/n5CaJ3EwblTB9K4aaVJIBRj35kW3I67DlyO8vzyc.webp"
                                                                data-src="{{$section_data->products[4]->productData->thumbnail?? uploaded_asset($section_data->products[4]->thumbnail_img) }}"
                                                                alt="{{ $section_data->products[4]->name }}"
                                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                            >
                                                        </a>
                                                        @if ($section_data->products[4]->wholesale_product)
                                                            <span class="absolute-bottom-left fs-11 text-white fw-600 px-2 lh-1-8" style="background-color: #455a64">
                Wholesale
            </span>
                                                        @endif
                                                        <div class="absolute-top-right aiz-p-hov-icon">
                                                            <a href="javascript:void(0)" onclick="addToWishList({{ $section_data->products[4]->id }});" data-toggle="tooltip" data-title="Add to wishlist" data-placement="left">
                                                                <i class="la la-heart-o"></i>
                                                            </a>
                                                            <a href="javascript:void(0)" onclick="addToCompare({{ $section_data->products[4]->id }})" data-toggle="tooltip" data-title="Add to compare" data-placement="left">
                                                                <i class="las la-sync"></i>
                                                            </a>
                                                            <a class="d-lg-none" href="javascript:void(0)" onclick="showAddToCartModal({{ $section_data->products[4]->id }})" data-toggle="tooltip" data-title="Add to cart" data-placement="left">
                                                                <i class="las la-shopping-cart"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="p-md-3 p-2 text-left">

        <span class="text-reset ">
          <a class="d-block text-reset" style="color: #8c8c8c !important; ">
            <small class="fw-300"> {{  $section_data->products[4]->productData->brand??$section_data->products[4]->brand->name??"" }}</small>
          </a>
        </span>


                                                        <h3 class="fw-500 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                            <a href="{{ route('product', $section_data->products[4]->slug) }}" class="d-block text-reset">{{  $section_data->products[4]->name }}</a>
                                                        </h3>

                                                        <div class="fs-15">
                                                            <span class="fw-400 text-primary"> <a href="{{ route('product', $section_data->products[4]->slug) }}">{{ home_discounted_base_price($section_data->products[4]) }}</a></span>
                                                            @if(home_base_price($section_data->products[4]) != home_discounted_base_price($section_data->products[4]))
                                                                <del class="fw-400 mr-1 fs-12">{{ home_base_price($section_data->products[4]) }}</del>
                                                            @endif
                                                            <span class="rating rating-sm" style="float:right;">
                {{ renderStarRating($section_data->products[4]->rating) }}
            </span>
                                                        </div>
                                                    </div>
                                                    <div class="mcard-body card-body-hidden">
                                                        <a href="javascript:void(0)" onclick="showAddToCartModal({{ $section_data->products[4]->id }})">
                                                            <button class="btn btn-primary btn-sm d-block w-100 mb-2 text-white" type="button"><i class="la la-shopping-cart opacity-100 fs-18"></i>Add to Cart</button>
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col px-1 py-1">
                                                <div class="mcard product-card ">
                                                    <div class="position-relative xcard">
                                                        @php
                                                            $Product_Stock = 0 ;
                                                            if($section_data->products[5]->productData != null)
                                                            $Product_Stock = $section_data->products[5]->productData->stock;
                                                            else
                                                            if (!empty($section_data->products[5]->stocks)) foreach ($section_data->products[5]->stocks as $stock) if ($stock->qty>=1) $Product_Stock = 1;
                                                        @endphp

                                                        @if ($section_data->products[5]->unit_price > 5000 && ($section_data->products[5]->unit_price-$section_data->products[5]->discount)>= 5000)
                                                            <div class="ribbon ribbon-top-right"><span>EMI</span></div>
                                                        @endif

                                                        @if (!$Product_Stock)
                                                            <div class="ribbon ribbon-top-right"><span style="background-color: black;"><small>Sold Out</small></span></div>
                                                        @endif
                                                        <a href="{{ route('product', $section_data->products[5]->slug) }}" class="d-block">
                                                            @if ($section_data->products[5]->shipping_type == "free") <span class="tag-text">Free Delivery</span> @endif
                                                            <img
                                                                class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                                src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/n5CaJ3EwblTB9K4aaVJIBRj35kW3I67DlyO8vzyc.webp"
                                                                data-src="{{$section_data->products[5]->productData->thumbnail?? uploaded_asset($section_data->products[5]->thumbnail_img) }}"
                                                                alt="{{ $section_data->products[5]->name }}"
                                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                            >
                                                        </a>
                                                        @if ($section_data->products[5]->wholesale_product)
                                                            <span class="absolute-bottom-left fs-11 text-white fw-600 px-2 lh-1-8" style="background-color: #455a64">
                Wholesale
            </span>
                                                        @endif
                                                        <div class="absolute-top-right aiz-p-hov-icon">
                                                            <a href="javascript:void(0)" onclick="addToWishList({{ $section_data->products[5]->id }});" data-toggle="tooltip" data-title="Add to wishlist" data-placement="left">
                                                                <i class="la la-heart-o"></i>
                                                            </a>
                                                            <a href="javascript:void(0)" onclick="addToCompare({{ $section_data->products[5]->id }})" data-toggle="tooltip" data-title="Add to compare" data-placement="left">
                                                                <i class="las la-sync"></i>
                                                            </a>
                                                            <a class="d-lg-none" href="javascript:void(0)" onclick="showAddToCartModal({{ $section_data->products[5]->id }})" data-toggle="tooltip" data-title="Add to cart" data-placement="left">
                                                                <i class="las la-shopping-cart"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="p-md-3 p-2 text-left">

        <span class="text-reset ">
          <a class="d-block text-reset" style="color: #8c8c8c !important; ">
            <small class="fw-300"> {{  $section_data->products[5]->productData->brand??$section_data->products[5]->brand->name??"" }}</small>
          </a>
        </span>


                                                        <h3 class="fw-500 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                            <a href="{{ route('product', $section_data->products[5]->slug) }}" class="d-block text-reset">{{  $section_data->products[5]->name }}</a>
                                                        </h3>

                                                        <div class="fs-15">
                                                            <span class="fw-400 text-primary"> <a href="{{ route('product', $section_data->products[5]->slug) }}">{{ home_discounted_base_price($section_data->products[5]) }}</a></span>
                                                            @if(home_base_price($section_data->products[5]) != home_discounted_base_price($section_data->products[5]))
                                                                <del class="fw-400 mr-1 fs-12">{{ home_base_price($section_data->products[5]) }}</del>
                                                            @endif
                                                            <span class="rating rating-sm" style="float:right;">
                {{ renderStarRating($section_data->products[5]->rating) }}
            </span>
                                                        </div>
                                                    </div>
                                                    <div class="mcard-body card-body-hidden">
                                                        <a href="javascript:void(0)" onclick="showAddToCartModal({{ $section_data->products[5]->id }})">
                                                            <button class="btn btn-primary btn-sm d-block w-100 mb-2 text-white" type="button"><i class="la la-shopping-cart opacity-100 fs-18"></i>Add to Cart</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-box  px-1" >
                                        <div class="row gutters-5 row-cols-xxl-3 row-cols-xl-3 row-cols-lg-3 row-cols-md-3 row-cols-2 pb-lg-5">
                                            <div class="col px-1 py-1">
                                                <div class="mcard product-card ">
                                                    <div class="position-relative xcard">
                                                        @php
                                                            $Product_Stock = 0 ;
                                                            if($section_data->products[6]->productData != null)
                                                            $Product_Stock = $section_data->products[6]->productData->stock;
                                                            else
                                                            if (!empty($section_data->products[6]->stocks)) foreach ($section_data->products[6]->stocks as $stock) if ($stock->qty>=1) $Product_Stock = 1;
                                                        @endphp

                                                        @if ($section_data->products[6]->unit_price > 5000 && ($section_data->products[6]->unit_price-$section_data->products[6]->discount)>= 5000)
                                                            <div class="ribbon ribbon-top-right"><span>EMI</span></div>
                                                        @endif

                                                        @if (!$Product_Stock)
                                                            <div class="ribbon ribbon-top-right"><span style="background-color: black;"><small>Sold Out</small></span></div>
                                                        @endif
                                                        <a href="{{ route('product', $section_data->products[6]->slug) }}" class="d-block">
                                                            @if ($section_data->products[6]->shipping_type == "free") <span class="tag-text">Free Delivery</span> @endif
                                                            <img
                                                                class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                                src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/n5CaJ3EwblTB9K4aaVJIBRj35kW3I67DlyO8vzyc.webp"
                                                                data-src="{{$section_data->products[6]->productData->thumbnail?? uploaded_asset($section_data->products[6]->thumbnail_img) }}"
                                                                alt="{{ $section_data->products[6]->name }}"
                                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                            >
                                                        </a>
                                                        @if ($section_data->products[6]->wholesale_product)
                                                            <span class="absolute-bottom-left fs-11 text-white fw-600 px-2 lh-1-8" style="background-color: #455a64">
                  Wholesale
              </span>
                                                        @endif
                                                        <div class="absolute-top-right aiz-p-hov-icon">
                                                            <a href="javascript:void(0)" onclick="addToWishList({{ $section_data->products[6]->id }});" data-toggle="tooltip" data-title="Add to wishlist" data-placement="left">
                                                                <i class="la la-heart-o"></i>
                                                            </a>
                                                            <a href="javascript:void(0)" onclick="addToCompare({{ $section_data->products[6]->id }})" data-toggle="tooltip" data-title="Add to compare" data-placement="left">
                                                                <i class="las la-sync"></i>
                                                            </a>
                                                            <a class="d-lg-none" href="javascript:void(0)" onclick="showAddToCartModal({{ $section_data->products[6]->id }})" data-toggle="tooltip" data-title="Add to cart" data-placement="left">
                                                                <i class="las la-shopping-cart"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="p-md-3 p-2 text-left">

          <span class="text-reset ">
            <a class="d-block text-reset" style="color: #8c8c8c !important; ">
              <small class="fw-300"> {{  $section_data->products[6]->productData->brand??$section_data->products[6]->brand->name??"" }}</small>
            </a>
          </span>


                                                        <h3 class="fw-500 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                            <a href="{{ route('product', $section_data->products[6]->slug) }}" class="d-block text-reset">{{  $section_data->products[6]->name }}</a>
                                                        </h3>

                                                        <div class="fs-15">
                                                            <span class="fw-400 text-primary"> <a href="{{ route('product', $section_data->products[6]->slug) }}">{{ home_discounted_base_price($section_data->products[6]) }}</a></span>
                                                            @if(home_base_price($section_data->products[6]) != home_discounted_base_price($section_data->products[6]))
                                                                <del class="fw-400 mr-1 fs-12">{{ home_base_price($section_data->products[6]) }}</del>
                                                            @endif
                                                            <span class="rating rating-sm" style="float:right;">
                  {{ renderStarRating($section_data->products[6]->rating) }}
              </span>
                                                        </div>
                                                    </div>
                                                    <div class="mcard-body card-body-hidden">
                                                        <a href="javascript:void(0)" onclick="showAddToCartModal({{ $section_data->products[6]->id }})">
                                                            <button class="btn btn-primary btn-sm d-block w-100 mb-2 text-white" type="button"><i class="la la-shopping-cart opacity-100 fs-18"></i>Add to Cart</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col px-1 py-1">
                                                <div class="mcard product-card ">
                                                    <div class="position-relative xcard">
                                                        @php
                                                            $Product_Stock = 0 ;
                                                            if($section_data->products[7]->productData != null)
                                                            $Product_Stock = $section_data->products[7]->productData->stock;
                                                            else
                                                            if (!empty($section_data->products[7]->stocks)) foreach ($section_data->products[7]->stocks as $stock) if ($stock->qty>=1) $Product_Stock = 1;
                                                        @endphp

                                                        @if ($section_data->products[7]->unit_price > 5000 && ($section_data->products[7]->unit_price-$section_data->products[7]->discount)>= 5000)
                                                            <div class="ribbon ribbon-top-right"><span>EMI</span></div>
                                                        @endif

                                                        @if (!$Product_Stock)
                                                            <div class="ribbon ribbon-top-right"><span style="background-color: black;"><small>Sold Out</small></span></div>
                                                        @endif
                                                        <a href="{{ route('product', $section_data->products[7]->slug) }}" class="d-block">
                                                            @if ($section_data->products[7]->shipping_type == "free") <span class="tag-text">Free Delivery</span> @endif
                                                            <img
                                                                class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                                src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/n5CaJ3EwblTB9K4aaVJIBRj35kW3I67DlyO8vzyc.webp"
                                                                data-src="{{$section_data->products[7]->productData->thumbnail?? uploaded_asset($section_data->products[7]->thumbnail_img) }}"
                                                                alt="{{ $section_data->products[7]->name }}"
                                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                            >
                                                        </a>
                                                        @if ($section_data->products[7]->wholesale_product)
                                                            <span class="absolute-bottom-left fs-11 text-white fw-600 px-2 lh-1-8" style="background-color: #455a64">
                  Wholesale
              </span>
                                                        @endif
                                                        <div class="absolute-top-right aiz-p-hov-icon">
                                                            <a href="javascript:void(0)" onclick="addToWishList({{ $section_data->products[7]->id }});" data-toggle="tooltip" data-title="Add to wishlist" data-placement="left">
                                                                <i class="la la-heart-o"></i>
                                                            </a>
                                                            <a href="javascript:void(0)" onclick="addToCompare({{ $section_data->products[7]->id }})" data-toggle="tooltip" data-title="Add to compare" data-placement="left">
                                                                <i class="las la-sync"></i>
                                                            </a>
                                                            <a class="d-lg-none" href="javascript:void(0)" onclick="showAddToCartModal({{ $section_data->products[7]->id }})" data-toggle="tooltip" data-title="Add to cart" data-placement="left">
                                                                <i class="las la-shopping-cart"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="p-md-3 p-2 text-left">

          <span class="text-reset ">
            <a class="d-block text-reset" style="color: #8c8c8c !important; ">
              <small class="fw-300"> {{  $section_data->products[7]->productData->brand??$section_data->products[7]->brand->name??"" }}</small>
            </a>
          </span>


                                                        <h3 class="fw-500 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                            <a href="{{ route('product', $section_data->products[7]->slug) }}" class="d-block text-reset">{{  $section_data->products[7]->name }}</a>
                                                        </h3>

                                                        <div class="fs-15">
                                                            <span class="fw-400 text-primary"> <a href="{{ route('product', $section_data->products[7]->slug) }}">{{ home_discounted_base_price($section_data->products[7]) }}</a></span>
                                                            @if(home_base_price($section_data->products[7]) != home_discounted_base_price($section_data->products[7]))
                                                                <del class="fw-400 mr-1 fs-12">{{ home_base_price($section_data->products[7]) }}</del>
                                                            @endif
                                                            <span class="rating rating-sm" style="float:right;">
                  {{ renderStarRating($section_data->products[7]->rating) }}
              </span>
                                                        </div>
                                                    </div>
                                                    <div class="mcard-body card-body-hidden">
                                                        <a href="javascript:void(0)" onclick="showAddToCartModal({{ $section_data->products[7]->id }})">
                                                            <button class="btn btn-primary btn-sm d-block w-100 mb-2 text-white" type="button"><i class="la la-shopping-cart opacity-100 fs-18"></i>Add to Cart</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col px-1 py-1">
                                                <div class="mcard product-card ">
                                                    <div class="position-relative xcard">
                                                        @php
                                                            $Product_Stock = 0 ;
                                                            if($section_data->products[8]->productData != null)
                                                            $Product_Stock = $section_data->products[8]->productData->stock;
                                                            else
                                                            if (!empty($section_data->products[8]->stocks)) foreach ($section_data->products[8]->stocks as $stock) if ($stock->qty>=1) $Product_Stock = 1;
                                                        @endphp

                                                        @if ($section_data->products[8]->unit_price > 5000 && ($section_data->products[8]->unit_price-$section_data->products[8]->discount)>= 5000)
                                                            <div class="ribbon ribbon-top-right"><span>EMI</span></div>
                                                        @endif

                                                        @if (!$Product_Stock)
                                                            <div class="ribbon ribbon-top-right"><span style="background-color: black;"><small>Sold Out</small></span></div>
                                                        @endif
                                                        <a href="{{ route('product', $section_data->products[8]->slug) }}" class="d-block">
                                                            @if ($section_data->products[8]->shipping_type == "free") <span class="tag-text">Free Delivery</span> @endif
                                                            <img
                                                                class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                                src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/n5CaJ3EwblTB9K4aaVJIBRj35kW3I67DlyO8vzyc.webp"
                                                                data-src="{{$section_data->products[8]->productData->thumbnail?? uploaded_asset($section_data->products[8]->thumbnail_img) }}"
                                                                alt="{{ $section_data->products[8]->name }}"
                                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                            >
                                                        </a>
                                                        @if ($section_data->products[8]->wholesale_product)
                                                            <span class="absolute-bottom-left fs-11 text-white fw-600 px-2 lh-1-8" style="background-color: #455a64">
                  Wholesale
              </span>
                                                        @endif
                                                        <div class="absolute-top-right aiz-p-hov-icon">
                                                            <a href="javascript:void(0)" onclick="addToWishList({{ $section_data->products[8]->id }});" data-toggle="tooltip" data-title="Add to wishlist" data-placement="left">
                                                                <i class="la la-heart-o"></i>
                                                            </a>
                                                            <a href="javascript:void(0)" onclick="addToCompare({{ $section_data->products[8]->id }})" data-toggle="tooltip" data-title="Add to compare" data-placement="left">
                                                                <i class="las la-sync"></i>
                                                            </a>
                                                            <a class="d-lg-none" href="javascript:void(0)" onclick="showAddToCartModal({{ $section_data->products[8]->id }})" data-toggle="tooltip" data-title="Add to cart" data-placement="left">
                                                                <i class="las la-shopping-cart"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="p-md-3 p-2 text-left">

          <span class="text-reset ">
            <a class="d-block text-reset" style="color: #8c8c8c !important; ">
              <small class="fw-300"> {{  $section_data->products[8]->productData->brand??$section_data->products[8]->brand->name??"" }}</small>
            </a>
          </span>


                                                        <h3 class="fw-500 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                            <a href="{{ route('product', $section_data->products[8]->slug) }}" class="d-block text-reset">{{  $section_data->products[8]->name }}</a>
                                                        </h3>

                                                        <div class="fs-15">
                                                            <span class="fw-400 text-primary"> <a href="{{ route('product', $section_data->products[8]->slug) }}">{{ home_discounted_base_price($section_data->products[8]) }}</a></span>
                                                            @if(home_base_price($section_data->products[8]) != home_discounted_base_price($section_data->products[8]))
                                                                <del class="fw-400 mr-1 fs-12">{{ home_base_price($section_data->products[8]) }}</del>
                                                            @endif
                                                            <span class="rating rating-sm" style="float:right;">
                  {{ renderStarRating($section_data->products[8]->rating) }}
              </span>
                                                        </div>
                                                    </div>
                                                    <div class="mcard-body card-body-hidden">
                                                        <a href="javascript:void(0)" onclick="showAddToCartModal({{ $section_data->products[8]->id }})">
                                                            <button class="btn btn-primary btn-sm d-block w-100 mb-2 text-white" type="button"><i class="la la-shopping-cart opacity-100 fs-18"></i>Add to Cart</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col px-1 py-1">
                                                <div class="mcard product-card ">
                                                    <div class="position-relative xcard">
                                                        @php
                                                            $Product_Stock = 0 ;
                                                            if($section_data->products[9]->productData != null)
                                                            $Product_Stock = $section_data->products[9]->productData->stock;
                                                            else
                                                            if (!empty($section_data->products[9]->stocks)) foreach ($section_data->products[9]->stocks as $stock) if ($stock->qty>=1) $Product_Stock = 1;
                                                        @endphp

                                                        @if ($section_data->products[9]->unit_price > 5000 && ($section_data->products[9]->unit_price-$section_data->products[9]->discount)>= 5000)
                                                            <div class="ribbon ribbon-top-right"><span>EMI</span></div>
                                                        @endif

                                                        @if (!$Product_Stock)
                                                            <div class="ribbon ribbon-top-right"><span style="background-color: black;"><small>Sold Out</small></span></div>
                                                        @endif
                                                        <a href="{{ route('product', $section_data->products[9]->slug) }}" class="d-block">
                                                            @if ($section_data->products[9]->shipping_type == "free") <span class="tag-text">Free Delivery</span> @endif
                                                            <img
                                                                class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                                src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/n5CaJ3EwblTB9K4aaVJIBRj35kW3I67DlyO8vzyc.webp"
                                                                data-src="{{$section_data->products[9]->productData->thumbnail?? uploaded_asset($section_data->products[9]->thumbnail_img) }}"
                                                                alt="{{ $section_data->products[9]->name }}"
                                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                            >
                                                        </a>
                                                        @if ($section_data->products[9]->wholesale_product)
                                                            <span class="absolute-bottom-left fs-11 text-white fw-600 px-2 lh-1-8" style="background-color: #455a64">
                  Wholesale
              </span>
                                                        @endif
                                                        <div class="absolute-top-right aiz-p-hov-icon">
                                                            <a href="javascript:void(0)" onclick="addToWishList({{ $section_data->products[9]->id }});" data-toggle="tooltip" data-title="Add to wishlist" data-placement="left">
                                                                <i class="la la-heart-o"></i>
                                                            </a>
                                                            <a href="javascript:void(0)" onclick="addToCompare({{ $section_data->products[9]->id }})" data-toggle="tooltip" data-title="Add to compare" data-placement="left">
                                                                <i class="las la-sync"></i>
                                                            </a>
                                                            <a class="d-lg-none" href="javascript:void(0)" onclick="showAddToCartModal({{ $section_data->products[9]->id }})" data-toggle="tooltip" data-title="Add to cart" data-placement="left">
                                                                <i class="las la-shopping-cart"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="p-md-3 p-2 text-left">

          <span class="text-reset ">
            <a class="d-block text-reset" style="color: #8c8c8c !important; ">
              <small class="fw-300"> {{  $section_data->products[9]->productData->brand??$section_data->products[9]->brand->name??"" }}</small>
            </a>
          </span>


                                                        <h3 class="fw-500 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                            <a href="{{ route('product', $section_data->products[9]->slug) }}" class="d-block text-reset">{{  $section_data->products[9]->name }}</a>
                                                        </h3>

                                                        <div class="fs-15">
                                                            <span class="fw-400 text-primary"> <a href="{{ route('product', $section_data->products[9]->slug) }}">{{ home_discounted_base_price($section_data->products[9]) }}</a></span>
                                                            @if(home_base_price($section_data->products[9]) != home_discounted_base_price($section_data->products[9]))
                                                                <del class="fw-400 mr-1 fs-12">{{ home_base_price($section_data->products[9]) }}</del>
                                                            @endif
                                                            <span class="rating rating-sm" style="float:right;">
                  {{ renderStarRating($section_data->products[9]->rating) }}
              </span>
                                                        </div>
                                                    </div>
                                                    <div class="mcard-body card-body-hidden">
                                                        <a href="javascript:void(0)" onclick="showAddToCartModal({{ $section_data->products[9]->id }})">
                                                            <button class="btn btn-primary btn-sm d-block w-100 mb-2 text-white" type="button"><i class="la la-shopping-cart opacity-100 fs-18"></i>Add to Cart</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col px-1 py-1">
                                                <div class="mcard product-card ">
                                                    <div class="position-relative xcard">
                                                        @php
                                                            $Product_Stock = 0 ;
                                                            if($section_data->products[10]->productData != null)
                                                            $Product_Stock = $section_data->products[10]->productData->stock;
                                                            else
                                                            if (!empty($section_data->products[10]->stocks)) foreach ($section_data->products[10]->stocks as $stock) if ($stock->qty>=1) $Product_Stock = 1;
                                                        @endphp

                                                        @if ($section_data->products[10]->unit_price > 5000 && ($section_data->products[10]->unit_price-$section_data->products[10]->discount)>= 5000)
                                                            <div class="ribbon ribbon-top-right"><span>EMI</span></div>
                                                        @endif

                                                        @if (!$Product_Stock)
                                                            <div class="ribbon ribbon-top-right"><span style="background-color: black;"><small>Sold Out</small></span></div>
                                                        @endif
                                                        <a href="{{ route('product', $section_data->products[10]->slug) }}" class="d-block">
                                                            @if ($section_data->products[10]->shipping_type == "free") <span class="tag-text">Free Delivery</span> @endif
                                                            <img
                                                                class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                                src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/n5CaJ3EwblTB9K4aaVJIBRj35kW3I67DlyO8vzyc.webp"
                                                                data-src="{{$section_data->products[10]->productData->thumbnail?? uploaded_asset($section_data->products[10]->thumbnail_img) }}"
                                                                alt="{{ $section_data->products[10]->name }}"
                                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                            >
                                                        </a>
                                                        @if ($section_data->products[10]->wholesale_product)
                                                            <span class="absolute-bottom-left fs-11 text-white fw-600 px-2 lh-1-8" style="background-color: #455a64">
                  Wholesale
              </span>
                                                        @endif
                                                        <div class="absolute-top-right aiz-p-hov-icon">
                                                            <a href="javascript:void(0)" onclick="addToWishList({{ $section_data->products[10]->id }});" data-toggle="tooltip" data-title="Add to wishlist" data-placement="left">
                                                                <i class="la la-heart-o"></i>
                                                            </a>
                                                            <a href="javascript:void(0)" onclick="addToCompare({{ $section_data->products[10]->id }})" data-toggle="tooltip" data-title="Add to compare" data-placement="left">
                                                                <i class="las la-sync"></i>
                                                            </a>
                                                            <a class="d-lg-none" href="javascript:void(0)" onclick="showAddToCartModal({{ $section_data->products[10]->id }})" data-toggle="tooltip" data-title="Add to cart" data-placement="left">
                                                                <i class="las la-shopping-cart"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="p-md-3 p-2 text-left">

          <span class="text-reset ">
            <a class="d-block text-reset" style="color: #8c8c8c !important; ">
              <small class="fw-300"> {{  $section_data->products[10]->productData->brand??$section_data->products[10]->brand->name??"" }}</small>
            </a>
          </span>


                                                        <h3 class="fw-500 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                            <a href="{{ route('product', $section_data->products[10]->slug) }}" class="d-block text-reset">{{  $section_data->products[10]->name }}</a>
                                                        </h3>

                                                        <div class="fs-15">
                                                            <span class="fw-400 text-primary"> <a href="{{ route('product', $section_data->products[10]->slug) }}">{{ home_discounted_base_price($section_data->products[10]) }}</a></span>
                                                            @if(home_base_price($section_data->products[10]) != home_discounted_base_price($section_data->products[10]))
                                                                <del class="fw-400 mr-1 fs-12">{{ home_base_price($section_data->products[10]) }}</del>
                                                            @endif
                                                            <span class="rating rating-sm" style="float:right;">
                  {{ renderStarRating($section_data->products[10]->rating) }}
              </span>
                                                        </div>
                                                    </div>
                                                    <div class="mcard-body card-body-hidden">
                                                        <a href="javascript:void(0)" onclick="showAddToCartModal({{ $section_data->products[10]->id }})">
                                                            <button class="btn btn-primary btn-sm d-block w-100 mb-2 text-white" type="button"><i class="la la-shopping-cart opacity-100 fs-18"></i>Add to Cart</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col px-1 py-1">
                                                <div class="mcard product-card ">
                                                    <div class="position-relative xcard">
                                                        @php
                                                            $Product_Stock = 0 ;
                                                            if($section_data->products[11]->productData != null)
                                                            $Product_Stock = $section_data->products[11]->productData->stock;
                                                            else
                                                            if (!empty($section_data->products[11]->stocks)) foreach ($section_data->products[11]->stocks as $stock) if ($stock->qty>=1) $Product_Stock = 1;
                                                        @endphp

                                                        @if ($section_data->products[11]->unit_price > 5000 && ($section_data->products[11]->unit_price-$section_data->products[11]->discount)>= 5000)
                                                            <div class="ribbon ribbon-top-right"><span>EMI</span></div>
                                                        @endif

                                                        @if (!$Product_Stock)
                                                            <div class="ribbon ribbon-top-right"><span style="background-color: black;"><small>Sold Out</small></span></div>
                                                        @endif
                                                        <a href="{{ route('product', $section_data->products[11]->slug) }}" class="d-block">
                                                            @if ($section_data->products[11]->shipping_type == "free") <span class="tag-text">Free Delivery</span> @endif
                                                            <img
                                                                class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                                src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/n5CaJ3EwblTB9K4aaVJIBRj35kW3I67DlyO8vzyc.webp"
                                                                data-src="{{$section_data->products[11]->productData->thumbnail?? uploaded_asset($section_data->products[11]->thumbnail_img) }}"
                                                                alt="{{ $section_data->products[11]->name }}"
                                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                            >
                                                        </a>
                                                        @if ($section_data->products[11]->wholesale_product)
                                                            <span class="absolute-bottom-left fs-11 text-white fw-600 px-2 lh-1-8" style="background-color: #455a64">
                  Wholesale
              </span>
                                                        @endif
                                                        <div class="absolute-top-right aiz-p-hov-icon">
                                                            <a href="javascript:void(0)" onclick="addToWishList({{ $section_data->products[11]->id }});" data-toggle="tooltip" data-title="Add to wishlist" data-placement="left">
                                                                <i class="la la-heart-o"></i>
                                                            </a>
                                                            <a href="javascript:void(0)" onclick="addToCompare({{ $section_data->products[11]->id }})" data-toggle="tooltip" data-title="Add to compare" data-placement="left">
                                                                <i class="las la-sync"></i>
                                                            </a>
                                                            <a class="d-lg-none" href="javascript:void(0)" onclick="showAddToCartModal({{ $section_data->products[11]->id }})" data-toggle="tooltip" data-title="Add to cart" data-placement="left">
                                                                <i class="las la-shopping-cart"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="p-md-3 p-2 text-left">

          <span class="text-reset ">
            <a class="d-block text-reset" style="color: #8c8c8c !important; ">
              <small class="fw-300"> {{  $section_data->products[11]->productData->brand??$section_data->products[11]->brand->name??"" }}</small>
            </a>
          </span>


                                                        <h3 class="fw-500 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                            <a href="{{ route('product', $section_data->products[11]->slug) }}" class="d-block text-reset">{{  $section_data->products[11]->name }}</a>
                                                        </h3>

                                                        <div class="fs-15">
                                                            <span class="fw-400 text-primary"> <a href="{{ route('product', $section_data->products[11]->slug) }}">{{ home_discounted_base_price($section_data->products[11]) }}</a></span>
                                                            @if(home_base_price($section_data->products[11]) != home_discounted_base_price($section_data->products[11]))
                                                                <del class="fw-400 mr-1 fs-12">{{ home_base_price($section_data->products[11]) }}</del>
                                                            @endif
                                                            <span class="rating rating-sm" style="float:right;">
                  {{ renderStarRating($section_data->products[11]->rating) }}
              </span>
                                                        </div>
                                                    </div>
                                                    <div class="mcard-body card-body-hidden">
                                                        <a href="javascript:void(0)" onclick="showAddToCartModal({{ $section_data->products[11]->id }})">
                                                            <button class="btn btn-primary btn-sm d-block w-100 mb-2 text-white" type="button"><i class="la la-shopping-cart opacity-100 fs-18"></i>Add to Cart</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                    @endif

                </div>
            </div>
        </div>
    </div>
    <br><br>
</div>
