@if (get_setting('top10_brands') != null)
    <div class="container">
        <div class="px-2 px-md-4 py-md-3 bg-white ">
            <div class=" mb-4 text-center">
                <h3 class="h5 fw-700 mb-0 text-center">
                    Top Brands
                </h3>
            </div>


            <div class="row row-cols-xxl-7 row-cols-xl-7 row-cols-lg-4 row-cols-md-3 row-cols-2 gutters-300">
                @php $top10_brands = json_decode(get_setting('top10_brands')); @endphp
                @foreach ($top10_brands as $key => $value)
                    @php $brand = \App\Models\Brand::find($value); @endphp
                    @if ($brand != null)
                        <div class="col text-center card-mobile">
                            <a href="{{ route('products.brand', $brand->slug) }}" class="d-block p-4 mb-4 border border-light rounded-custom shadow-md-custom">
                                <img src="{{ uploaded_asset($brand->logo) }}" class="lazyload mx-auto h-90px mw-100" alt="{{ $brand->getTranslation('name') }}">
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endif
