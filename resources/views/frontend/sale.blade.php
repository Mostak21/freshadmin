@extends('frontend.layouts.app')

@section('content')
{{-- slider start--}}
<div id="sliderimages">
    @if (get_setting('home_slider_images') != null)
        <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height" data-dots="true" data-autoplay="true">
            @php
                $slider_images = Cache::get('home_slider_images')??null;
            @endphp
{{--                                @if($slider_images)--}}
                <div class="carousel-box">
                    <a href="{{ json_decode(get_setting('home_slider_links'), true)[0]??"#" }}">
                        <img
                            class="d-block mw-100 img-fit rounded shadow-sm overflow-hidden"
                            src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/rLjrkFn0lPtFMTAwzUqnYJh8jfG74YAr8SYHInoj.png"
                            data-src="{{ $slider_images[0]??"#"}}"
                            alt="{{ env('APP_NAME')}} promo"
                           
                            height="auto"
                           
                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';"
                        >
                    </a>
                </div>
{{--                                    @endif--}}
        </div>
    @endif

</div>
{{-- slider end--}}

<section class="mb-4">
    <div class="container">
        <div class="py-4 px-md-4 py-md-3 bg-white">
            <div class="">
                <div class="mb-3 mb-lg-0">
                    <a href="" class="d-block text-reset mb-3 rounded" >
                        <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/COBE6s0VhPslrXsOOQkU7NvZmEXEDq1r9JTEDJLx.webp" alt="{{ env('APP_NAME') }} promo" class="w-100 rounded img-fluid">
                    </a>
                </div>
            </div>
            
                @foreach ($smartwatchs as $key => $product)
                @if($loop->iteration==1)
                <div class="row row-cols-xxl-7 row-cols-xl-7 row-cols-lg-6 row-cols-md-4 row-cols-2 gutters-300 aaaa">
                @endif
                @if($loop->iteration<13)
                <div class="col">
                    @include('frontend.partials.product_box_home',['product' => $product])
                </div>
                @endif
                @if($loop->iteration==12)
                </div>
                <div class="row row-cols-xxl-7 row-cols-xl-7 row-cols-lg-6 row-cols-md-4 row-cols-2 gutters-300  d-none"  id='smartwatch'>
                @endif
                 @if($loop->iteration>12)
                    <div class="col">
                        @include('frontend.partials.product_box_home',['product' => $product])
                    </div>
                    @endif
                @endforeach
        </div>
        </div>
        <div class="text-center" id="smartbutton">
            <button class="btn btn-md btn-primary" onclick="hideshow('smartwatch','smartbutton')" >Load More</button>
        </div>
    
           
        </div>
    </div>
</section>

{{--Music--}}

<section class="mb-4">
    <div class="container">
        <div class="py-4 px-md-4 py-md-3 bg-white">
            <div class="">
                <div class="mb-3 mb-lg-0">
                    <a href="" class="d-block text-reset mb-3 rounded" >
                        <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/F2C1amz88qfjACY5nqZHsMX31tpm939Dq7SOs3Zz.webp" alt="{{ env('APP_NAME') }} promo" class="w-100 rounded img-fluid">
                    </a>
                </div>
            </div>
            
                @foreach ($musics as $key => $product)
                @if($loop->iteration==1)
                <div class="row row-cols-xxl-7 row-cols-xl-7 row-cols-lg-6 row-cols-md-4 row-cols-2 gutters-300 aaaa">
                @endif
                @if($loop->iteration<13)
                <div class="col">
                    @include('frontend.partials.product_box_home',['product' => $product])
                </div>
                @endif
                @if($loop->iteration==12)
                </div>
                <div class="row row-cols-xxl-7 row-cols-xl-7 row-cols-lg-6 row-cols-md-4 row-cols-2 gutters-300  d-none"  id='music'>
                @endif
                 @if($loop->iteration>12)
                    <div class="col">
                        @include('frontend.partials.product_box_home',['product' => $product])
                    </div>
                    @endif
                @endforeach
        </div>
        </div>
        <div class="text-center" id="musicbutton">
            <button class="btn btn-md btn-primary" onclick="hideshow('music','musicbutton')" >Load More</button>
        </div>
    
           
        </div>
    </div>
</section>
{{--sound--}}

<section class="mb-4">
    <div class="container">
        <div class="py-4 px-md-4 py-md-3 bg-white">
            <div class="">
                <div class="mb-3 mb-lg-0">
                    <a href="" class="d-block text-reset mb-3 rounded" >
                        <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/YjfQsClu6wuYaBYYNOb9xYAIjuZnVbKveVUtoHb9.webp" alt="{{ env('APP_NAME') }} promo" class="w-100 rounded img-fluid">
                    </a>
                </div>
            </div>
            
                @foreach ($sounds as $key => $product)
                @if($loop->iteration==1)
                <div class="row row-cols-xxl-7 row-cols-xl-7 row-cols-lg-6 row-cols-md-4 row-cols-2 gutters-300 aaaa">
                @endif
                @if($loop->iteration<13)
                <div class="col">
                    @include('frontend.partials.product_box_home',['product' => $product])
                </div>
                @endif
                @if($loop->iteration==12)
                </div>
                <div class="row row-cols-xxl-7 row-cols-xl-7 row-cols-lg-6 row-cols-md-4 row-cols-2 gutters-300  d-none"  id='sound'>
                @endif
                 @if($loop->iteration>12)
                    <div class="col">
                        @include('frontend.partials.product_box_home',['product' => $product])
                    </div>
                    @endif
                @endforeach
        </div>
        </div>
        <div class="text-center" id="soundbutton">
            <button class="btn btn-md btn-primary" onclick="hideshow('sound','soundbutton')" >Load More</button>
        </div>
    
           
        </div>
    </div>
</section>
{{-- powerbanks --}}
<section class="mb-4">
    <div class="container">
        <div class="py-4 px-md-4 py-md-3 bg-white">
            <div class="">
                <div class="mb-3 mb-lg-0">
                    <a href="" class="d-block text-reset mb-3 rounded" >
                        <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/txsZaHltOfO7J6XiIUgHKO5mF6p64VCsuGjzCnqD.webp" alt="{{ env('APP_NAME') }} promo" class="w-100 rounded img-fluid">
                    </a>
                </div>
            </div>
            
                @foreach ($powerbanks as $key => $product)
                @if($loop->iteration==1)
                <div class="row row-cols-xxl-7 row-cols-xl-7 row-cols-lg-6 row-cols-md-4 row-cols-2 gutters-300 aaaa">
                @endif
                @if($loop->iteration<13)
                <div class="col">
                    @include('frontend.partials.product_box_home',['product' => $product])
                </div>
                @endif
                @if($loop->iteration==12)
                </div>
                <div class="row row-cols-xxl-7 row-cols-xl-7 row-cols-lg-6 row-cols-md-4 row-cols-2 gutters-300  d-none"  id='powerbank'>
                @endif
                 @if($loop->iteration>12)
                    <div class="col">
                        @include('frontend.partials.product_box_home',['product' => $product])
                    </div>
                    @endif
                @endforeach
        </div>
        </div>
        <div class="text-center" id="powerbankbutton">
            <button class="btn btn-md btn-primary" onclick="hideshow('powerbank','powerbankbutton')" >Load More</button>
        </div>
    
           
        </div>
    </div>
</section>



{{-- tv --}}
<section class="mb-4">
    <div class="container">
        <div class="py-4 px-md-4 py-md-3 bg-white">
            <div class="">
                <div class="mb-3 mb-lg-0">
                    <a href="" class="d-block text-reset mb-3 rounded" >
                        <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/n0FnsGaumWeh4K32Eoj1dzS5Ijsxzu5KXdtT2U5I.webp" alt="{{ env('APP_NAME') }} promo" class="w-100 rounded img-fluid">
                    </a>
                </div>
            </div>
            
                @foreach ($smartvs as $key => $product)
                @if($loop->iteration==1)
                <div class="row row-cols-xxl-7 row-cols-xl-7 row-cols-lg-6 row-cols-md-4 row-cols-2 gutters-300 aaaa">
                @endif
                @if($loop->iteration<13)
                <div class="col">
                    @include('frontend.partials.product_box_home',['product' => $product])
                </div>
                @endif
                @if($loop->iteration==12)
                </div>
                <div class="row row-cols-xxl-7 row-cols-xl-7 row-cols-lg-6 row-cols-md-4 row-cols-2 gutters-300  d-none"  id='smartvs'>
                @endif
                 @if($loop->iteration>12)
                    <div class="col">
                        @include('frontend.partials.product_box_home',['product' => $product])
                    </div>
                    @endif
                @endforeach
        </div>
        </div>
        <div class="text-center" id="smartvsbutton">
            <button class="btn btn-md btn-primary" onclick="hideshow('smartvs','smartvsbutton')" >Load More</button>
        </div>
    
           
        </div>
    </div>
</section>



{{-- fragrances --}}


<section class="mb-4">
    <div class="container">
        <div class="py-4 px-md-4 py-md-3 bg-white">
            <div class="">
                <div class="mb-3 mb-lg-0">
                    <a href="" class="d-block text-reset mb-3 rounded" >
                        <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/uLfN5lT96ACAAwDGhQ6qJ3v2p5zIGHBWCp7i2pAs.webp" alt="{{ env('APP_NAME') }} promo" class="w-100 rounded img-fluid">
                    </a>
                </div>
            </div>
            
                @foreach ($fragrances as $key => $product)
                @if($loop->iteration==1)
                <div class="row row-cols-xxl-7 row-cols-xl-7 row-cols-lg-6 row-cols-md-4 row-cols-2 gutters-300 aaaa">
                @endif
                @if($loop->iteration<13)
                <div class="col">
                    @include('frontend.partials.product_box_home',['product' => $product])
                </div>
                @endif
                @if($loop->iteration==12)
                </div>
                <div class="row row-cols-xxl-7 row-cols-xl-7 row-cols-lg-6 row-cols-md-4 row-cols-2 gutters-300  d-none"  id='fragrances'>
                @endif
                 @if($loop->iteration>12)
                    <div class="col">
                        @include('frontend.partials.product_box_home',['product' => $product])
                    </div>
                    @endif
                @endforeach
        </div>
        </div>
        <div class="text-center" id="fragrancesbutton">
            <button class="btn btn-md btn-primary" onclick="hideshow('fragrances','fragrancesbutton')" >Load More</button>
        </div>
    
           
        </div>
    </div>
</section>

@section('script')
    <script type="text/javascript">

        function hideshow(id,button)
        {
            

            if(!$('#'+id).hasClass('d-none')){
                $('#'+id).addClass('d-none');
            }
            if($('#'+id).hasClass('d-none')){
                $('#'+id).removeClass('d-none');
                $('#'+button).addClass('d-none');

            }

        }
    </script>
@endsection

@endsection