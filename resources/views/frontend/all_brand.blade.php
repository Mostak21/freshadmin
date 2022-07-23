@extends('frontend.layouts.app')

@section('content')

<section class="pt-4 mb-4">
    <div class="productheaderbg py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left">
                <h1 class="fw-600 h4">{{ translate('All Brands') }}</h1>
            </div>
            <div class="col-lg-6 fs-13">
                <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                    <li class="breadcrumb-item opacity-50">
                        <a class="text-dark" href="{{ route('home') }}">{{ translate('Home')}}</a>
                    </li>
                    <li class="text-dark breadcrumb-item">
                        <a class="text-reset" href="{{ route('brands.all') }}">{{ translate('All Brands') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div></div>
</section>

@php
    $cat=array("fashion","fragnance","Beauty_&_Skincare","electronics","others");
    $banner=array("https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/h9VubfVG8WiehSfx3qNNrmGkZu6JZIy0wjDbca5P.webp",
    "https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/xIUrz1Wwm85IdaSJZVOloTRO3Mw83qR9plAYCXuY.webp",
    "https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/vTRqo2qgQG9BokUnlDBo77hIpdqHeLKNLPuOoKLi.webp",
    "https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/BlxXhAmXRRC5a88oZSC3x5RTJZrAhY39lYan4oNI.webp",
    "https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/aw7El8PQHpfacaTiliJRT63VvHDOvMcxgRfHf45i.webp");
@endphp
<section class="mb-4">
    <div class="container py-4">
        <div class="bg-white pt-3">
@foreach($cat as $key => $category)
			<div class="mb-5">
{{--<h5 class="pb-3 text-capitalize text-center">{{str_replace("_"," ",$category)}}</h5>--}}
<img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/btcHvC3sJ4m5K4VYwoNgMcURYE2CeaKrqswFQ7cs.webp" data-src="{{$banner[$key]}}" alt="{{str_replace("_"," ",$category)}}" class="img-fluid lazyload w-100 mb-5">

<div class="row row-cols-xxl-7 row-cols-xl-7 row-cols-lg-4 row-cols-md-3 row-cols-2 gutters-300">
    @foreach(\App\Models\Brand::where('published',1)->orderBy('name', 'ASC')->get() as $brand)
     @php
            $hi=array_search($category,explode(",",$brand->cat))
        @endphp

        @if(array_search($category,explode(",",$brand->cat))!==false)
        <div class="col text-center">
            <a href="{{ route('products.brand', $brand->slug) }}" class="d-block p-3 mb-3 border border-light rounded hov-shadow-md">
                <img src="{{ uploaded_asset($brand->logo) }}" class="lazyload mx-auto h-90px mw-100" alt="{{ $brand->getTranslation('name') }}">
            </a>
    </div>
        @endif
     
    @endforeach    
				</div></div>
@endforeach
		</div></div>
</section>

{{--
<section class="mb-4">
    <div class="container">
        <div class="bg-white  rounded px-3 pt-3">
            <div class="row row-cols-xxl-4 row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-2 gutters-10">
                @foreach (\App\Models\Brand::orderBy('name', 'ASC')->get() as $brand)
                    <div class="col text-center">
                        <a href="{{ route('products.brand', $brand->slug) }}" class="d-block p-3 mb-3 border border-light rounded hov-shadow-lg shadow-md">
							<img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/5ABazMntewtJzb87ssoHZmo5utCeJqwxdmLMgWva.png"
                                            data-src="{{ uploaded_asset($brand->logo) }}"
                                            onerror="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/5ABazMntewtJzb87ssoHZmo5utCeJqwxdmLMgWva.png';" class="lazyload mx-auto h-100px mw-100" alt="{{ $brand->getTranslation('name') }}">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>--}}

@endsection
