{{-- Womens section--}}

 	   {{-- Banner section 1--}}
        @if (get_setting('home_banner1_images') != null)
        <div class="mb-4">
            <div class="container-custom">
     
                    @php $banner_1_imags = json_decode(get_setting('home_banner1_images')); @endphp
                    @foreach ($banner_1_imags as $key => $value)
     
                         <div class="">
                            <div class="mb-3 mb-lg-0">
                                <a href="{{ json_decode(get_setting('home_banner1_links'), true)[$key] }}" class="d-block text-reset" >
                                    <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/btcHvC3sJ4m5K4VYwoNgMcURYE2CeaKrqswFQ7cs.webp" data-src="{{ uploaded_asset($banner_1_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload w-100 rounded-custom">
                                </a>
                            </div>
                        </div>
     
                    @endforeach
            </div>
        </div>
        @endif
     
     <div class="container-custom pb-3">
         <div class="row ">
            
             <div class="col-12" >
     
     
                 <div class="rit-carousel dots-inside-bottom" style="overflow: visible;" data-arrows="true" data-dots="false" data-autoplay="false">
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
     </div>
     
     
     {{--    WoMens section--}}
     
      {{-- Banner section 2--}}
            @if (get_setting('home_banner2_images') != null)
            <div class="mb-4">
                <div class="container-custom">
     
                        @php $banner_1_imags = json_decode(get_setting('home_banner2_images')); @endphp
                        @foreach ($banner_1_imags as $key => $value)
     
                             <div class="">
                                <div class="mb-3 mb-lg-0">
                                    <a href="{{ json_decode(get_setting('home_banner2_links'), true)[$key] }}" class="d-block text-reset" >
                                        <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/btcHvC3sJ4m5K4VYwoNgMcURYE2CeaKrqswFQ7cs.webp" data-src="{{ uploaded_asset($banner_1_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload w-100 rounded-custom">
                                    </a>
                                </div>
                            </div>
     
                        @endforeach
                </div>
            </div>
            @endif
     
         <div class="container-custom pb-3">
         <div class="row mt-3">
     
             <div class=" col-12" >
     
     
                 <div class="rit-carousel dots-inside-bottom" style="overflow: visible;" data-arrows="true" data-dots="false" data-autoplay="false">
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
           
         </div>
     </div>
     
     {{--    Kids section--}}
     {{-- Banner section 3--}}
      @if (get_setting('home_banner3_images') != null)
      <div class="mb-4">
          <div class="container-custom">
     
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
     
     <div class="container-custom pb-3">
     
         <div class="row mt-3">
             
             <div class="col-12">
     
     
                 <div class="rit-carousel dots-inside-bottom" style="overflow: visible;" data-arrows="true" data-dots="false" data-autoplay="false">
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
    
      @if (get_setting('home_banner4_images') != null)
      <div class="mb-4">
          <div class="container-custom">
     
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
     
     <div class="container-custom pb-5">
     
     
         <div class="row mt-lg-5 mt-3">
     
             <div class=" col-12" >
     
     
                 <div class="rit-carousel dots-inside-bottom" style="overflow: visible;" data-arrows="true" data-dots="false" data-autoplay="false">
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

         </div>
     </div>
     