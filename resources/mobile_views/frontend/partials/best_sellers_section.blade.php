@php
    $best_selers = $best_selers->take(5)??null;
//    dd($best_selers);
@endphp

@if (get_setting('vendor_system_activation') == 1)
    <section class="mb-4">
        <div class="container-custom">
            <div class="py-4  py-md-3 ">

                <div class=" mb-3 d-flex justify-content-between ">
                    <div>
                        <h3 class="h5 fw-700 mb-0">
                            <a href="{{ route('sellers') }}">  <span class=" px-2 py-2 c-pointer">Best Sellers</span></a>
                        </h3>
                    </div>
                    <div>
                        <a href="{{ route('sellers') }}" class="text-black">View All</a> 

                    </div>
                   
                </div>

            <div class="row">
                <div class="col-12">

                    <div class="">


                        @foreach ($best_selers as $key => $seller)
                            @if ($seller->user != null)
                                
                                    <div class="row no-gutters  align-items-center product-fullwidth">
                                        <div class="col-3 pr-2">
                                            <a href="{{ route('shop.visit',$seller->sellerData->slug??$seller->user->shop->slug) }}" class="d-block p-2">
                                                <img
                                                    src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/3TnNLBsHYoEfQ5A4rcAzr9CzdDwezNqG1d6WZkQ6.svg"
                                                    data-src="{{ $seller->sellerData->logo??$seller->user->shop->logo??"#"}}"
                                                    alt="{{ $seller->sellerData->shop_name??$seller->user->shop->name }}"
                                                    class="img-fluid lazyload"

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
                                
                            @endif
                        @endforeach
                  

                    </div>
                    

 </div>






</div>

            </div>
        </div>
    </section>
@endif
