{{-- Womens section--}}

 	   {{-- Banner section 1--}}
        @if (get_setting('home_banner1_images') != null)
        <div class="mb-4">
            <div class="container">
     
                    @php $banner_1_imags = json_decode(get_setting('home_banner1_images')); @endphp
                    @foreach ($banner_1_imags as $key => $value)
     
                         <div class="px-3">
                            <div class="mb-3 mb-lg-0">
                                <a href="{{ json_decode(get_setting('home_banner1_links'), true)[$key] }}" class="d-block text-reset" >
                                    <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/btcHvC3sJ4m5K4VYwoNgMcURYE2CeaKrqswFQ7cs.webp" data-src="{{ uploaded_asset($banner_1_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload w-100">
                                </a>
                            </div>
                        </div>
     
                    @endforeach
            </div>
        </div>
        @endif
     
     <div class="container pb-3 px-5">
         <div class="row ">
             <div class="col-md-5 round-2 productheaderbg">
                 <div class="px-3 py-4 mparent" style="height: 100%;">
                     <h3 class="fw-600">Fragrance</h3>
                     <div><a class="text-primary" href="/category/fragrance">Shop fragrance <i class="ci-arrow-right fs-xs align-middle ms-1"></i></a></div>
                     <div class="mchild">
     
     
                         <a class="d-none d-md-block mt-auto" href=""><img class="d-block w-100"
                                                                                            src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/707VCGinE8G9p80x5Bv6xHolGXDuZPoZO3I6kp5p.webp" alt="Fragrance"></a>
                     </div>
                 </div>
             </div>
             <div class="col-md-7 pl-lg-4" >
     
     
                 <div class="aiz-carousel dots-inside-bottom" style="overflow: visible;" data-arrows="true" data-dots="false" data-autoplay="true">
                     @foreach ($perfumeproducts->chunk(6) as $key => $chunk)
                         <div class="carousel-box  px-1">
                             <div class="row gutters-5 row-cols-xxl-3 row-cols-xl-3 row-cols-lg-3 row-cols-md-3 row-cols-2 pb-lg-5">
     
     
                                 @foreach ($chunk as $key => $product)
                                     <div class="col px-1 py-1">
                                         @include('frontend.partials.product_box_home',['product' => $product])
                                     </div>
                                 @endforeach
                             </div>
                         </div>
                     @endforeach
                 </div>
     
     
             </div>
         </div>
     </div><br><br>
     
     
     {{--    WoMens section--}}
     
      {{-- Banner section 2--}}
            @if (get_setting('home_banner2_images') != null)
            <div class="mb-4">
                <div class="container">
     
                        @php $banner_1_imags = json_decode(get_setting('home_banner2_images')); @endphp
                        @foreach ($banner_1_imags as $key => $value)
     
                             <div class="px-3">
                                <div class="mb-3 mb-lg-0">
                                    <a href="{{ json_decode(get_setting('home_banner2_links'), true)[$key] }}" class="d-block text-reset" >
                                        <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/btcHvC3sJ4m5K4VYwoNgMcURYE2CeaKrqswFQ7cs.webp" data-src="{{ uploaded_asset($banner_1_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload w-100">
                                    </a>
                                </div>
                            </div>
     
                        @endforeach
                </div>
            </div>
            @endif
     
         <div class="container pb-3 px-5">
         <div class="row mt-lg-5 mt-3">
     
             <div class=" col-md-7 order-2 order-lg-1 pr-lg-4  prl-sm-0" >
     
     
                 <div class="aiz-carousel dots-inside-bottom" style="overflow: visible;" data-arrows="true" data-dots="false" data-autoplay="true">
                     @foreach ($womensproducts->chunk(6) as $key => $chunk)
                         <div class="carousel-box pb-3 ">
                             <div class="row gutters-5 row-cols-xxl-3 row-cols-xl-3 row-cols-lg-3 row-cols-md-3 row-cols-2 pb-lg-5">
     
     
                                 @foreach ($chunk as $key => $product)
                                     <div class="col">
                                         @include('frontend.partials.product_box_home',['product' => $product])
                                     </div>
                                 @endforeach
                             </div>
                         </div>
                     @endforeach
                 </div>
     
     
             </div>
             <div class="col-md-5 order-1 order-lg-2 round-2 productheaderbg">
                 <div class="px-3 py-4 mparent text-right" style="height: 100%;">
                     <h3 class="fw-600">For Women</h3>
                     <div><a class="text-primary" href="/category/mens-fashion">Shop for Women<i class="ci-arrow-right fs-xs align-middle ms-1"></i></a></div>
                     <div class="mchild">
     
     
                         <a class="d-none d-md-block mt-auto" href=""><img class="d-block w-100"
                                                                                            src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/3HIsQ1ePljkYPv9ZZ0TuQKptmFBarj43AgznjAYX.webp" alt="For Women"></a>
                     </div>
                 </div>
             </div>
         </div><br><br>
     </div>
     
     {{--    Kids section--}}
     {{-- Banner section 3--}}
      @if (get_setting('home_banner3_images') != null)
      <div class="mb-4">
          <div class="container">
     
                  @php $banner_1_imags = json_decode(get_setting('home_banner3_images')); @endphp
                  @foreach ($banner_1_imags as $key => $value)
     
                       <div class="px-3">
                          <div class="mb-3 mb-lg-0">
                              <a href="{{ json_decode(get_setting('home_banner3_links'), true)[$key] }}" class="d-block text-reset" >
                                  <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/btcHvC3sJ4m5K4VYwoNgMcURYE2CeaKrqswFQ7cs.webp" data-src="{{ uploaded_asset($banner_1_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload w-100">
                              </a>
                          </div>
                      </div>
     
                  @endforeach
          </div>
      </div>
      @endif
     
     <div class="container pb-3 px-5">
     
         <div class="row mt-lg-5 mt-3">
             <div class="col-md-5 round-2 productheaderbg">
                 <div class="px-3 py-4 mparent" style="height: 100%;">
                     <h3 class="fw-600">For Skin Care</h3>
                     <div><a class="text-primary" href="/category/skincare-bath-body">Shop for SkinCare <i class="ci-arrow-right fs-xs align-middle ms-1"></i></a></div>
                     <div class="mchild">
     
     
                         <a class="d-none d-md-block mt-auto" href=""><img class="d-block w-100"
                                                                                            src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/xrHmac35BGmvU0uFf90x4bSDymlXV9twIR3BK5ot.webp" alt="For Skin"></a>
                     </div>
                 </div>
             </div>
             <div class="col-md-7 pl-lg-4" >
     
     
                 <div class="aiz-carousel dots-inside-bottom" style="overflow: visible;" data-arrows="true" data-dots="false" data-autoplay="true">
                     @foreach ($kidsproducts->chunk(6) as $key => $chunk)
                         <div class="carousel-box  px-1">
                             <div class="row gutters-5 row-cols-xxl-3 row-cols-xl-3 row-cols-lg-3 row-cols-md-3 row-cols-2 pb-lg-5">
     
     
                                 @foreach ($chunk as $key => $product)
                                     <div class="col px-1 py-1">
                                         @include('frontend.partials.product_box_home',['product' => $product])
                                     </div>
                                 @endforeach
                             </div>
                         </div>
                     @endforeach
                 </div>
             </div>
         </div>
     </div>
     <br><br>
      @if (get_setting('home_banner4_images') != null)
      <div class="mb-4">
          <div class="container">
     
                  @php $banner_4_imags = json_decode(get_setting('home_banner4_images')); @endphp
                  @foreach ($banner_4_imags as $key => $value)
     
                       <div class="px-3">
                          <div class="mb-3 mb-lg-0">
                              <a href="{{ json_decode(get_setting('home_banner4_links'), true)[$key] }}" class="d-block text-reset" >
                                  <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/btcHvC3sJ4m5K4VYwoNgMcURYE2CeaKrqswFQ7cs.webp" data-src="{{ uploaded_asset($banner_4_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload w-100">
                              </a>
                          </div>
                      </div>
                  @endforeach
          </div>
      </div>
      @endif
     
     <div class="container pb-5 px-5">
     
     
         <div class="row mt-lg-5 mt-3">
     
             <div class=" col-md-7 order-2 order-lg-1 pr-lg-4  prl-sm-0" >
     
     
                 <div class="aiz-carousel dots-inside-bottom" style="overflow: visible;" data-arrows="true" data-dots="false" data-autoplay="true">
                     @foreach ($gadgetproducts->chunk(6) as $key => $chunk)
                         <div class="carousel-box pb-3 ">
                             <div class="row gutters-5 row-cols-xxl-3 row-cols-xl-3 row-cols-lg-3 row-cols-md-3 row-cols-2 pb-lg-5">
     
     
                                 @foreach ($chunk as $key => $product)
                                     <div class="col">
                                         @include('frontend.partials.product_box_home',['product' => $product])
                                     </div>
                                 @endforeach
                             </div>
                         </div>
                     @endforeach
                 </div>
     
     
             </div>
             <div class="col-md-5 order-1 order-lg-2 round-2 productheaderbg">
                 <div class="px-3 py-4 mparent text-right" style="height: 100%;">
                     <h3 class="fw-600">Gadgets</h3>
                     <div><a class="text-primary" href="/category/gadgets">Shop Gadgets<i class="ci-arrow-right fs-xs align-middle ms-1"></i></a></div>
                     <div class="mchild">
     
     
                         <a class="d-none d-md-block mt-auto" href="shop-grid-ls.html"><img class="d-block w-100"
                                                                                            src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/Wk2t2DRROfge5DyCLSpz3PWVyvu45iHIIScaNtBq.webp" alt="For Men"></a>
                     </div>
                 </div>
             </div>
         </div><br><br>
     </div>
     