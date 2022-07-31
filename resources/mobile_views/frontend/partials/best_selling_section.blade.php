@php
    $best_selling_products = Cache::remember('best_selling_products', 86400, function () {
        return filter_products(\App\Models\Product::where('published', 1)->orderBy('num_of_sale', 'desc'))->limit(5)->get();
    });   
@endphp

@if (get_setting('best_selling') == 1)
    <section class="mb-4">
        <div class="container">
            <div class="py-4 px-md-4 py-md-3 bg-white ">
               
                <div class=" mb-3 ">
                    <h3 class="h5 fw-700 mb-0">
                         <span class=" px-2 py-2 ">{{ translate('Best Selling') }}</span>
                    </h3>
                </div>
                    @foreach ($best_selling_products as $key => $product)
                        <div class="">
                            @include('frontend.partials.product_box_fullwidth',['product' => $product])
                        </div>
                    @endforeach
                
            </div>
        </div>
    </section>
@endif