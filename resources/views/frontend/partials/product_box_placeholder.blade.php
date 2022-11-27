<div class="mcard product-card ">
    <div class="position-relative xcard">

        <a href="#" class="d-block">

            <img
                class="img-fit lazyload mx-auto h-140px h-md-210px"
                src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/3TnNLBsHYoEfQ5A4rcAzr9CzdDwezNqG1d6WZkQ6.svg"
                data-src=""
                alt=""
                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
            >
        </a>
{{--        @if ($product->wholesale_product)--}}
{{--        <span class="absolute-bottom-left fs-11 text-white fw-600 px-2 lh-1-8" style="background-color: #455a64">--}}
{{--                {{ translate('Wholesale') }}--}}
{{--            </span>--}}
{{--        @endif--}}
        <div class="absolute-top-right rit-p-hov-icon">
            <a href="javascript:void(0)" onclick="" data-toggle="tooltip" data-title="{{ translate('Add to wishlist') }}" data-placement="left">
                <i class="la la-heart-o"></i>
            </a>
            <a href="javascript:void(0)" onclick="" data-toggle="tooltip" data-title="{{ translate('Add to compare') }}" data-placement="left">
                <i class="las la-sync"></i>
            </a>
            <a class="d-lg-none" href="javascript:void(0)" onclick="" data-toggle="tooltip" data-title="{{ translate('Add to cart') }}" data-placement="left">
                <i class="las la-shopping-cart"></i>
            </a>
        </div>
    </div>
    <div class="p-md-3 p-2 text-left">

        <span class="text-reset ">	<a class="d-block text-reset" style="color: #8c8c8c !important; ">
                <small class="fw-300" style="background: rgba(183,183,183,0.18)"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </small>
            </a>
        </span>

        <h3 class="fw-500 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
            <a href="" class="d-block text-reset" style="background: rgba(183,183,183,0.18)">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </a>
            <small class="fw-300" style="background: rgba(183,183,183,0.18)">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </small>
        </h3>

        <div class="fs-15">
{{--            <span class="fw-400 text-primary"> <a href="{{ route('product', $product->slug) }}">{{ home_discounted_base_price($product) }}</a></span>--}}
{{--            @if(home_base_price($product) != home_discounted_base_price($product))--}}
{{--            <del class="fw-400 mr-1 fs-12">{{ home_base_price($product) }}</del>--}}
{{--            @endif--}}
{{--            <span class="rating rating-sm" style="float:right;">--}}
{{--                {{ renderStarRating($product->rating) }}--}}
{{--            </span>--}}
        </div>
    </div>
    <div class="mcard-body card-body-hidden">
        <a href="javascript:void(0)" onclick="">
            <button class="btn btn-secondary btn-sm d-block w-100 mb-2 text-white" type="button"><i class="la la-shopping-cart opacity-100 fs-18"></i>Add to Cart</button>
        </a>
    </div>
</div>
