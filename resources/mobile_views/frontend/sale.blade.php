@extends('frontend.layouts.app')

@section('content')
                           
                <div class="carousel-box">
                    
                        <img
                            class="d-block mw-100 img-cover rounded shadow-sm overflow-hidden h-90px h-md-auto"
                            src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/8OL88IcuCmsbRd0fTwswp4R8Fl3B1S0sDMhtB220.png"
                           
                            alt="{{ env('APP_NAME')}} promo"                        
                            
                            width="100%"
                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';"
                        >
                    
                </div>




<section class="mb-4">
    <div class="container">
        <div class="py-4 px-md-4 py-md-3 bg-white">
            <div class="">
                <div class="mb-3 mb-lg-0">
                    <a href="" class="d-block text-reset mb-3 rounded" >
                        <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/COBE6s0VhPslrXsOOQkU7NvZmEXEDq1r9JTEDJLx.webp" alt="{{ env('APP_NAME') }} promo" class="w-100 rounded h-70px h-md-auto">
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
            <button class="btn btn-sm btn-primary" onclick="hideshow('smartwatch','smartbutton')" >Load More</button>
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
                        <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/F2C1amz88qfjACY5nqZHsMX31tpm939Dq7SOs3Zz.webp" alt="{{ env('APP_NAME') }} promo" class="w-100 rounded h-70px h-md-auto">
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
            <button class="btn btn-sm btn-primary" onclick="hideshow('music','musicbutton')" >Load More</button>
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
                        <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/YjfQsClu6wuYaBYYNOb9xYAIjuZnVbKveVUtoHb9.webp" alt="{{ env('APP_NAME') }} promo" class="w-100 rounded h-70px h-md-auto">
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
            <button class="btn btn-sm btn-primary" onclick="hideshow('sound','soundbutton')" >Load More</button>
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
                        <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/txsZaHltOfO7J6XiIUgHKO5mF6p64VCsuGjzCnqD.webp" alt="{{ env('APP_NAME') }} promo" class="w-100 rounded h-70px h-md-auto">
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
            <button class="btn btn-sm btn-primary" onclick="hideshow('powerbank','powerbankbutton')" >Load More</button>
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
                        <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/n0FnsGaumWeh4K32Eoj1dzS5Ijsxzu5KXdtT2U5I.webp" alt="{{ env('APP_NAME') }} promo" class="w-100 rounded h-70px h-md-auto">
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
            <button class="btn btn-sm btn-primary" onclick="hideshow('smartvs','smartvsbutton')" >Load More</button>
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
                        <img src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/uLfN5lT96ACAAwDGhQ6qJ3v2p5zIGHBWCp7i2pAs.webp" alt="{{ env('APP_NAME') }} promo" class="w-100 rounded h-70px h-md-auto">
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
            <button class="btn btn-sm btn-primary" onclick="hideshow('fragrances','fragrancesbutton')" >Load More</button>
        </div>
    
           
        </div>
    </div>
</section>
<br><br>

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