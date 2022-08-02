
@if(get_setting('home_categories') != null) 
@php $home_categories = json_decode(get_setting('home_categories')); @endphp
@foreach ($home_categories as $key => $value)
    @php $category = \App\Models\Category::find($value); @endphp
    <section class="">
        <div class="container-custom">
            <div class=" py-2 px-md-4 py-md-3 bg-white">
                <div class=" mb-3 d-flex justify-content-between ">
                    <div>
                        <h3 class="h5 fw-700 mb-0">
                            <a class="text-reset" href="{{ route('products.category', $category->slug) }}">  <span class="px-2 py-2 bg-white c-pointer has-transition">{{ $category->getTranslation('name') }}</span></a>
                        </h3>
                    </div>
                    <div>
                        <a href="{{ route('products.category', $category->slug) }}" class="text-black">View All</a> 

                    </div>
                   
                </div>
                <div class="aiz-carousel gutters-5 half-outside-arrow" data-items="5" data-xl-items="5" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='false' data-autoplay="false"> 
                    @foreach (get_cached_products($category->id) as $key => $product)
                        <div class="carousel-box ">
                            @include('frontend.partials.product_box_home',['product' => $product])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endforeach
@endif
