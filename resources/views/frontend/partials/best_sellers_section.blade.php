{{--@php--}}
{{--    $best_selers = Cache::remember('best_selers', 86400, function () {--}}
{{--        return \App\Models\Seller::where('verification_status', 1)->orderBy('num_of_sale', 'desc')->take(20)->get();--}}
{{--    });--}}
{{--@endphp--}}

@if (get_setting('vendor_system_activation') == 1)
    <section class="mb-4">
        <div class="container">
            <div class="px-2 py-4 px-md-4 py-md-3 bg-white ">

                <div class=" mb-3 ">
                    <h3 class="h5 fw-700 mb-0">
                        <a href="{{ route('sellers') }}">  <span class=" px-2 py-2 bg-white c-pointer">{{ translate('Best Sellers')}}</span></a>
                    </h3>
                </div>

<div class="row">
                <div class="col-md-8">

{{--                    <div class="d-lg-none">--}}


{{--                    <div class="rit-carousel gutters-10 half-outside-arrow" data-items="2" data-lg-items="2"  data-md-items="1" data-sm-items="1" data-xs-items="1" data-rows="8">--}}
{{--                        @foreach ($best_selers as $key => $seller)--}}
{{--                            @if ($seller->user != null)--}}
{{--                                <div class="carousel-box">--}}
{{--                                    <div class="row no-gutters box-3 align-items-center border-bottom border-light rounded  ">--}}
{{--                                        <div class="col-3 pr-2">--}}
{{--                                            <a href="{{ route('shop.visit', $seller->sellerData->slug??$seller->user->shop->slug) }}" class="d-block p-2">--}}
{{--                                                <img--}}
{{--                                                    src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/3TnNLBsHYoEfQ5A4rcAzr9CzdDwezNqG1d6WZkQ6.svg"--}}
{{--                                                    data-src="{{ $seller->sellerData->logo??$seller->user->shop->logo??"#"}}"--}}
{{--                                                    alt="{{ $seller->sellerData->shop_name??$seller->user->shop->name }}"--}}
{{--                                                    class="img-fluid img lazyload h-40"--}}

{{--                                                >--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-9 ">--}}
{{--                                            <div class="p-2 text-left">--}}
{{--                                                <div class="fs-14 fw-500 text-truncate">--}}
{{--                                                    <a href="{{ route('shop.visit', $seller->user->shop->slug) }}" --}}
{{--                                                       class="text-reset">{{ $seller->user->shop->name }}</a>--}}
{{--                                            </div>--}}
{{--                                                <div class="rating rating-sm mb-2">--}}
{{--                                                    {{ renderStarRating($seller->rating) }}--}}
{{--                                                </div>--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        @endforeach--}}
{{--                    </div>--}}

{{--                    </div>--}}
                    <div class="d-none d-lg-block">


                    <div class="rit-carousel gutters-10 half-outside-arrow" data-items="2" data-lg-items="2"  data-md-items="2" data-sm-items="2" data-xs-items="1" data-lg-rows="5" data-xs-rows="10" data-rows="5">
                        @foreach ($best_selers as $key => $seller)
                            @if ($seller->user != null)
                                <div class="carousel-box py-2">
                                    <div class="row no-gutters box-3 align-items-center border-bottom border-light">
                                        <div class="col-3">
                                            <a href="{{ route('shop.visit', $seller->sellerData->slug??$seller->user->shop->slug) }}" class="d-block p-2">
                                                <img
                                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    data-src="{{ $seller->sellerData->logo??$seller->user->shop->logo??"#"}}"
                                                    alt="{{ $seller->sellerData->shop_name??$seller->user->shop->name }}"
                                                    class="h-40px lazyload"
                                                >
                                            </a>
                                        </div>
                                        <div class="col-9 ">
                                            <div class="p-2 text-left">
                                                <div class="fs-14 fw-500 text-truncate">
                                                    <a href="{{ route('shop.visit', $seller->sellerData->slug??$seller->user->shop->slug) }}"
                                                       class="text-reset">{{ $seller->sellerData->shop_name??$seller->user->shop->name }}</a>
                                            </div>
                                                <div class="rating rating-sm mb-2">
                                                    {{ renderStarRating($seller->rating) }}
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                </div>

                <div class="col-md-4">
                    <div class="d-none d-lg-block">
                        <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/ko9ltvzQQPLX4uwy79cQaansCVAH9UuX134I9c7F.webp" class="d-block"/>
                    </div>
                </div>

 </div>








            </div>
        </div>
    </section>
@endif
