{{--@php--}}
{{--    $best_selling_products = Cache::remember('best_selling_products', 86400, function () {--}}
{{--        return filter_products(\App\Models\Product::where('published', 1)->orderBy('num_of_sale', 'desc'))->limit(20)->get();--}}
{{--    });--}}
{{--@endphp--}}

@if (get_setting('best_selling') == 1)
    <section class="mb-4">
        <div class="container">
            <div class="px-2 py-4 px-md-4 py-md-3 bg-white ">
               
                <div class=" mb-3 text-center">
                    <h3 class="h5 fw-700 mb-0">
                         <span class=" px-2 py-2 ">{{ translate('Best Selling') }}</span>
                    </h3>
                </div>
                <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="5" data-xl-items="5" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true' data-infinite='true'>
                    @foreach ($best_selling_products as $key => $product)
                        <div class="carousel-box pb-lg-7">
                            @include('frontend.partials.product_box_home',['product' => $product])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
