@if (get_setting('top10_brands') != null)
    <div class="container">
        <div class="px-2 px-md-4 py-md-3 bg-white ">
            <div class=" mb-3 d-flex justify-content-between ">
                <div>
                    <h3 class="h5 fw-700 mb-0">
                        Top Brands
                    </h3>
                </div>
                <div>
                    <a href="{{ route('brands.all') }}" class="text-black">View All</a>
                </div>
            </div>

            <div class="row row-cols-xxl-7 row-cols-xl-7 row-cols-lg-4 row-cols-md-3 row-cols-2 gutters-300">
{{--                @php $top10_brands = json_decode(get_setting('top10_brands')); @endphp--}}
                @foreach ($top10_brands as $key => $brand)
{{--                    @php $brand = \App\Models\Brand::find($value); @endphp--}}
                    @if ($brand != null)
                        <div class="col text-center ">
                            <a href="{{ route('products.brand', $brand->slug) }}" class="d-block p-4 mb-4 card-mobile">
                                <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/3TnNLBsHYoEfQ5A4rcAzr9CzdDwezNqG1d6WZkQ6.svg"
                                     data-src="{{ $brand->logo_link??uploaded_asset($brand->logo) }}"
                                     class="lazyload mx-auto  h-90px mw-100"
                                     alt="{{ $brand->name }}">
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endif
