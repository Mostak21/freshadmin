 {{-- Banner section 1--}}
        @if (get_setting('home_banner1_images') != null)
        <div class="mb-4">
            <div class="container">
     
{{--                    @php $banner_1_imags = json_decode(get_setting('home_banner1_images')); @endphp--}}
                    @php $banner_1_imags = $section_data->banner_image_link; @endphp
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
                     <h3 class="fw-600">{{$section_data->title}}</h3>
                     <div><a class="text-primary" href="{{$section_data->link}}">Shop {{$section_data->title}} <i class="ci-arrow-right fs-xs align-middle ms-1"></i></a></div>
                     <div class="mchild">
     
     
                         <a class="d-none d-md-block mt-auto" href="">
                             <img class="d-block w-100" src="{{$section_data->poster_image_link}}" alt="{{$section_data->title}}">
                         </a>
                     </div>
                 </div>
             </div>
             <div class="col-md-7 pl-lg-4" >
     
     
                 <div class="aiz-carousel dots-inside-bottom" style="overflow: visible;" data-arrows="true" data-dots="false" data-autoplay="true">
                     @foreach ($section_data->products->chunk(6) as $key => $chunk)
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
