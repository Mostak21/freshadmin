@extends('frontend.layouts.app')

@section('content') 

<div class="container-custom mb-3">
    <div>
        <h3 class="h5 fw-700 mb-0">
            <span class="px-2 py-2 bg-white c-pointer has-transition">Blog</span>
        </h3>
    </div>
    
   
</div>



<section class="pb-4 pt-4">
    <div class="container">
        <div class="row ">

       
        <div class="col-xl-12 mx-auto">
            @foreach($blogs as $blog)
            
            @if($loop->iteration<4)
            @if($loop->first) <div class="rit-carousel dots-inside-bottom card-mobile" style="overflow: hidden;" data-items="2" data-xl-items="2" data-lg-items="2"  data-md-items="1" data-sm-items="1" data-xs-items="1" data-arrows="true" data-dots="false" data-autoplay="true">
                @endif
                

                
                <div class="carousel-box p-lg-3">
                <div class="overflow-hidden ">
                    <a href="{{ url("blog").'/'. $blog->slug }}" class="text-reset d-block">
                        <img
                            src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                            data-src="{{ uploaded_asset($blog->banner) }}"
                            alt="{{ $blog->title }}"
                            class="img-fluid lazyload rounded"
                        >
                    </a>
                    
                </div>
                <div>
                    <h2 class="fs-18 fw-600 mb-1 pt-3  px-2">
                        <a href="{{ url("blog").'/'. $blog->slug }}" class="text-reset">
                            {{ $blog->title }}
                        </a>
                    </h2>
                    
                </div>
                @if($blog->category != null)
                <div class="m-2">
                    <button class="btn btn-sm btn-primary">
                        In {{ $blog->category->category_name }}
                    </button>
                </div>
                        
                        @endif
                    </div>
           @if($loop->iteration==3)
        </div>
            @endif

            
            @endif
            @endforeach

            <div class="row pt-5">
                <div class="col-md-8">
                    <div class="card-columns">
                        @foreach($blogs as $blog)
                        @if($loop->iteration>3)
                        <div class="card  overflow-hidden mb-4">
                            <a href="{{ url("blog").'/'. $blog->slug }}" class="text-reset d-block">
                                <img
                                    src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                    data-src="{{ uploaded_asset($blog->banner) }}"
                                    alt="{{ $blog->title }}"
                                    class="img-fluid lazyload "
                                >
                            </a>
                            <div class="p-4">
                                
                                <h2 class="fs-18 fw-600 mb-1">
                                    <a href="{{ url("blog").'/'. $blog->slug }}" class="text-reset">
                                        {{ $blog->title }}
                                    </a>
                                </h2>
                                
                                
                               
                                <p class="opacity-70 mb-2">
                                    {{ $blog->short_description }}
                                </p>
                                @if($blog->category != null)
                                <a href="{{route('blog.category',$blog->category->slug)}}" class="my-2">
                                    
                                        <button class="btn btn-sm btn-primary">
                                            In {{ $blog->category->category_name }}
                                        </button>
                                     </a>  
                                @endif
                           
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <div class="text-right opacity-70 fs-14">
                                    {{$blog->created_at->isoFormat(' Do MMM YY');}}
                                </div>
                                
                            </div>
                        </div>
                            @endif
                        @endforeach
                        
                    </div>
                    <div class="rit-pagination rit-pagination-center my-4 ">
                        {{ $blogs->links('vendor.cartzilla') }}
                    </div>
                </div>
                <div class="col-md-4 mt-4">
@include('frontend.blog.sidenav')
                </div>
            </div>
        
            
        </div>
    </div>
    </div>
        
    </div>
</section>
@endsection
