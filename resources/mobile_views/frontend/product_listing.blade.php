@extends('frontend.layouts.app')

@if (isset($category_id))
    @php
        $meta_title = \App\Models\Category::find($category_id)->meta_title;
        $meta_description = \App\Models\Category::find($category_id)->meta_description;
    @endphp
@elseif (isset($brand_id))
    @php
        $meta_title = \App\Models\Brand::find($brand_id)->meta_title;
        $meta_description = \App\Models\Brand::find($brand_id)->meta_description;
    @endphp
@else
    @php
        $meta_title         = get_setting('meta_title');
        $meta_description   = get_setting('meta_description');
    @endphp
@endif

@section('meta_title'){{ $meta_title }}@stop
@section('meta_description'){{ $meta_description }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $meta_title }}">
    <meta itemprop="description" content="{{ $meta_description }}">

    <!-- Twitter Card data -->
    <meta name="twitter:title" content="{{ $meta_title }}">
    <meta name="twitter:description" content="{{ $meta_description }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $meta_title }}" />
    <meta property="og:description" content="{{ $meta_description }}" />
@endsection

@section('content')
<div class="container-custom">
    <h1 class="h3 fs-22 fw-600 text-body">
        @if(isset($category_id))
    
            {{ \App\Models\Category::find($category_id)->name }}
        @elseif(isset($query))
            Search result for
            "{{ $query }}"
    
        @else
            All Products
    
        @endif
    </h1>
</div>


  
                @php
            if(isset($category_id))
                $item_category = category_bread_tree($category_id);

            @endphp
         





    <section class="mb-4 pt-3">
        <div class="container sm-px-0">
            <form class="" id="search-form" action="" method="GET">
                <div class="row" style="">
                    <div class="col-lg-4 pr-5">
                        <div class="pr-4 ">
                        <div class=" bg-white shadow-lg rounded-md rit-filter-sidebar collapse-sidebar-wrap sidebar-xl sidebar-right z-1035 ">
                            <div class="overlay overlay-fixed dark c-pointer" data-toggle="class-toggle" data-target=".rit-filter-sidebar" data-same=".filter-sidebar-thumb"></div>
                            <div class="collapse-sidebar c-scrollbar-light text-left">
                                <div class="d-flex d-xl-none justify-content-between align-items-center pl-3 border-bottom">
                                    <h3 class="h6 mb-0 fw-600">
{{--                                        {{ translate('Filters') }}--}}
                                        Filters
                                    </h3>
                                    <button type="button" class="btn btn-sm p-2 filter-sidebar-thumb" data-toggle="class-toggle" data-target=".rit-filter-sidebar" >
                                        <i class="las la-times la-2x"></i>
                                    </button>
                                </div>
                                <div class="bg-white shadow-sm rounded mb-3">
                                    <div class="fs-18 fw-600 p-3 py-4 ">
{{--                                        {{ translate('Categories')}}--}}
                                        Categories
                                    </div>
                                    <div class="p-3">
                                        <ul class="list-unstyled">
                                            @if (!isset($category_id))
                                                @foreach (\App\Models\Category::where('level', 0)->get() as $category)
                                                    <li class="mb-2 ml-2">
                                                        <a class="text-reset fs-14" href="{{ route('products.category', $category->slug) }}">
{{--                                                            {{ $category->getTranslation('name') }}--}}
                                                            {{ $category->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li class="mb-2">
                                                    <a class="text-reset fs-14 fw-600" href="{{ route('search') }}">
                                                        <i class="las la-angle-left"></i>
                                                        All Categories
{{--                                                        {{ translate('All Categories')}}--}}
                                                    </a>
                                                </li>
                                                @if (\App\Models\Category::find($category_id)->parent_id != 0)
                                                    <li class="mb-2">
                                                        <a class="text-reset fs-14 fw-600" href="{{ route('products.category', \App\Models\Category::find(\App\Models\Category::find($category_id)->parent_id)->slug) }}">
                                                            <i class="las la-angle-left"></i>
{{--                                                            {{ \App\Models\Category::find(\App\Models\Category::find($category_id)->parent_id)->getTranslation('name') }}--}}
                                                            {{ \App\Models\Category::find(\App\Models\Category::find($category_id)->parent_id)->name }}
                                                        </a>
                                                    </li>
                                                @endif
                                                <li class="mb-2">
                                                    <a class="text-reset fs-14 fw-600" href="{{ route('products.category', \App\Models\Category::find($category_id)->slug) }}">
                                                        <i class="las la-angle-left"></i>
{{--                                                        {{ \App\Models\Category::find($category_id)->getTranslation('name') }}--}}
                                                        {{ \App\Models\Category::find($category_id)->name }}
                                                    </a>
                                                </li>
                                                @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($category_id) as $key => $id)
                                                    <li class="ml-4 mb-2">
                                                        <a class="text-reset fs-14" href="{{ route('products.category', \App\Models\Category::find($id)->slug) }}">
{{--                                                            {{ \App\Models\Category::find($id)->getTranslation('name') }}--}}
                                                            {{ \App\Models\Category::find($id)->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
								  @php
                                    $high = $default_filter->max_price??0;
                                    $low = $default_filter->min_price??0;
                                @endphp
                                <div class="bg-white shadow-sm rounded mb-3">
                                    <div class="fs-15 fw-600 p-3 border-bottom">
{{--                                        {{ translate('Price range')}}--}}
                                        Price range
                                    </div>
                                    <div class="p-3">
                                        <div class="rit-range-slider">
                                            <div
                                                id="input-slider-range"
                                                data-range-value-min="@if(\App\Models\Product::count() < 1) 0 @else {{ $low }} @endif"
                                                data-range-value-max="@if(\App\Models\Product::count() < 1) 0 @else {{$high}} @endif"
                                            ></div>

                                            <div class="row mt-2">
                                                <div class="col-6">
                                                    <span class="range-slider-value value-low fs-14 fw-600 opacity-70"
                                                        @if (isset($min_price))
                                                            data-range-value-low="{{ $min_price }}"
{{--                                                        @elseif($products->min('unit_price') > 0)--}}
{{--                                                          data-range-value-low="{{ $products->min('unit_price') }}"--}}
                                                        @elseif($low)
                                                            data-range-value-low="{{ $low }}"
                                                        @else
                                                            data-range-value-low="0"
                                                        @endif
                                                        id="input-slider-range-value-low"
                                                    ></span>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <span class="range-slider-value value-high fs-14 fw-600 opacity-70"
                                                        @if (isset($max_price))
                                                            data-range-value-high="{{ $max_price }}"
                                                        @elseif($high)
                                                          data-range-value-high="{{ $high }}"

{{--                                                        @elseif($products->max('unit_price') > 0)--}}
{{--                                                            data-range-value-high="{{ $products->max('unit_price') }}"--}}
                                                        @else
                                                            data-range-value-high="0"
                                                        @endif
                                                        id="input-slider-range-value-high"
                                                    ></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                               @foreach ($attributes as $key => $attribute)
                                    @if (\App\Attribute::find($attribute['id']) != null)
                                        <div class="bg-white shadow-sm rounded mb-3">
                                            <div class="fs-15 fw-600 p-3 border-bottom">
                                                Filter by
                                                {{ \App\Attribute::find($attribute['id'])->name }}
{{--                                                {{ translate('Filter by') }} --}}
{{--                                                {{ \App\Attribute::find($attribute['id'])->getTranslation('name') }}--}}

                                            </div>
                                            <div class="p-3">
                                                <div class="rit-checkbox-list">
                                                    @if(array_key_exists('values', $attribute))
                                                        @foreach ($attribute['values'] as $key => $value)
                                                            @php
                                                                $flag = false;
                                                                if(isset($selected_attributes)){
                                                                    foreach ($selected_attributes as $key => $selected_attribute) {
                                                                        if($selected_attribute['id'] == $attribute['id']){
                                                                            if(in_array($value, $selected_attribute['values'])){
                                                                                $flag = true;
                                                                                break;
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            @endphp
                                                            <label class="rit-checkbox">
                                                                <input
                                                                    type="checkbox"
                                                                    name="attribute_{{ $attribute['id'] }}[]"
                                                                    value="{{ $value }}" @if ($flag) checked @endif
                                                                    onchange="filter()"
                                                                >
                                                                <span class="rit-square-check"></span>
                                                                <span>{{ $value }}</span>
                                                            </label>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach


                                @if (get_setting('color_filter_activation') && $colors)

                                    <div class="bg-white shadow-sm rounded mb-3">
                                        <div class="fs-15 fw-600 p-3 border-bottom">
                                            Filter by color
{{--                                            {{ translate('Filter by color')}}--}}
                                        </div>
                                         <div class="p-3">
                                            <div class="rit-radio-inline">

                                                @foreach($colors as $key => $color)
                                                <label class="rit-megabox pl-0 mr-2" data-toggle="tooltip" data-title="{{ $color->name }}">
                                                    <input
                                                    type="radio"
                                                    name="color"
                                                    value="{{ $color->code }}"
                                                    onchange="filter()"
                                                    @if(isset($selected_color) && $selected_color == $color->code) checked @endif
                                                >
                                                <span class="rit-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                    <span class="size-30px d-inline-block rounded" style="background: {{ $color->code }};"></span>
                                                </span>
                                                  </label>
                                                @endforeach

                                            </div>
                                        </div> 
                                    </div>
                                @endif
{{--                                 <button type="submit" class="btn btn-styled btn-block btn-base-4">Apply filter</button>--}}
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="col-lg-8">

                        <div class="text-left">
                            <div class="d-flex align-items-center">
                                <div>

                                    <input type="hidden" name="keyword" value="{{ $query }}">
                                </div>

                                <div class="form-group mr-2 w-200px"> <!-- add "ml-auto" to float right-->
                                    <label class="mb-0 opacity-50">
                                        Sort by
{{--                                        {{ translate('Sort by')}}--}}
                                    </label>
                                    <select class="form-control form-control-sm rit-selectpicker" name="sort_by" onchange="filter()">
                                        <option value="newest" @isset($sort_by) @if ($sort_by == 'newest') selected @endif @endisset>Newest {{--{{ translate('Newest')}}--}}</option>
                                        <option value="oldest" @isset($sort_by) @if ($sort_by == 'oldest') selected @endif @endisset>Oldest {{--{{ translate('Oldest')}}--}}</option>
                                        <option value="price-asc" @isset($sort_by) @if ($sort_by == 'price-asc') selected @endif @endisset> Price low to high {{--{{ translate('Price low to high')}}--}}</option>
                                        <option value="price-desc" @isset($sort_by) @if ($sort_by == 'price-desc') selected @endif @endisset>Price high to low {{--{{ translate('Price high to low')}}--}}</option>
                                    </select>
                                </div>

                                <div class="form-group w-150px">
                                    @if (Route::currentRouteName() != 'products.brand')
                                        @if(isset($category_id))
											@if($products->count()>0)
                                            <label class="mb-0 opacity-50">Sorts By Brand {{--{{ translate('Brands by Category')}}--}}</label>
                                            <select class="form-control form-control-sm rit-selectpicker" data-live-search="true" name="brand" onchange="filter()">
                                                <option value="">All Brands {{--{{ translate('All Brands')}}--}}</option>
                                                @php
                                                    if(isset($products)){
                                                        foreach ($products as $key => $product){
                                                            $brand_category[$key]= $product->brand_id;}}
                                                        $brand_category = (array_unique($brand_category));
                                                @endphp
                                                @foreach (\App\Models\Brand::whereIn('id',$brand_category)->get() as $brand)
                                                    <option value="{{ $brand->slug }}" @isset($brand_id) @if ($brand_id == $brand->id) selected @endif @endisset>
                                                        {{ $brand->name }}
{{--                                                        {{ $brand->getTranslation('name') }}--}}
                                                    </option>
                                                @endforeach
                                            </select>
									@endif
                                        @else
                                        <label class="mb-0 opacity-50">Brands {{--{{translate('Brands')}}--}}</label>
                                        <select class="form-control form-control-sm rit-selectpicker" data-live-search="true" name="brand" onchange="filter()">
                                            <option value="">All Brands {{--{{ translate('All Brands')}}--}}</option>
                                            @foreach (\App\Models\Brand::all() as $brand)
                                                <option value="{{ $brand->slug }}" @isset($brand_id) @if ($brand_id == $brand->id) selected @endif @endisset>
                                                    {{ $brand->name }}
{{--                                                    {{ $brand->getTranslation('name') }}--}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @endif
                                    @endif
                                </div>
                                <div class="d-xl-none ml-auto ml-xl-3 mr-0 form-group align-self-end">
                                    <button type="button" class="btn btn-icon p-0" data-toggle="class-toggle" data-target=".rit-filter-sidebar">
                                        <img src="{{ static_asset('m_asset/filter.png') }}" height="32px" alt="">
                                    </button>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <input type="hidden" name="min_price" value="">
                        <input type="hidden" name="max_price" value="">
                        <div class="row gutters-5 row-cols-xxl-3 row-cols-xl-3 row-cols-lg-3 row-cols-md-3 row-cols-2">

                            @foreach ($products as $key => $product)
                                <div class="col">
                                    @include('frontend.partials.product_box_home',['product' => $product])
                                </div>
                            @endforeach
                        </div>
                        <div class="rit-pagination rit-pagination-center container-custom my-4">
                           {{-- $products->appends(request()->input())->links() --}}
							{{ $products->appends(request()->input())->onEachSide(4)->links('vendor.cartzilla') }}
                        </div>
						  @if( Route::currentRouteName()=="products.category")
                        <div class="bg-white shadow-sm card my-5 px-4">
                            <div class="mb-3 pt-3 text-center">
                                <p>
                                    @php
                                if(isset($category_id))
                                //$current_cat= \App\Models\Category::find($category_id)->getTranslation('name');
                                $current_cat= \App\Models\Category::find($category_id)->name;
                                else {
                                    $current_cat = null;
                                }

                                    //$item_category = category_bread_tree($detailedProduct->category->id);
                                    $brand=null;
                                    if(isset($brand_category))
                                    {
                                        $brand=$brand_category;
                                    }
                                    $auto_description=auto_cat_description($item_category,$brand,$current_cat);
                                    @endphp
                                    {{$auto_description}}
                                </p>

                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        function filter(){
            $('#search-form').submit();
        }
        function rangefilter(arg){
            $('input[name=min_price]').val(arg[0]);
            $('input[name=max_price]').val(arg[1]);
            filter();
        }
    </script>
@endsection
