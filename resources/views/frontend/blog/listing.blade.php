@extends('frontend.layouts.app')

@section('content') 


<div class="productheaderbg py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left">
                <h1 class="fw-600 h4">
                    {{ translate('Blog')}}
                </h1>
            </div>
            <div class="col-lg-6 fs-13">
                <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                    <li class="breadcrumb-item opacity-50">
                       <a class="text-reset" href="{{ route('home') }}">   <i class="ci-home"> </i> {{ translate('Home')}}</a>
                    </li>
                    <li class="text-dark fw-600 breadcrumb-item">
                        <a class="text-reset" href="{{ route('blog') }}">{{ translate('Blog') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="pb-4 pt-4">
    <div class="container">
        <div class="row ">

       
        <div class="col-xl-12 mx-auto">
            @foreach($blogs as $blog)
            
            @if($loop->iteration<4)
            @if($loop->first) <div class="rit-carousel dots-inside-bottom border-bottom" style="overflow: hidden;" data-items="2" data-xl-items="2" data-lg-items="2"  data-md-items="1" data-sm-items="1" data-xs-items="1" data-arrows="true" data-dots="false" data-autoplay="true">
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
                    <h2 class="fs-18 fw-600 mb-1 pt-3">
                        <a href="{{ url("blog").'/'. $blog->slug }}" class="text-reset">
                            {{ $blog->title }}
                        </a>
                    </h2>
                    
                </div>
                @if($blog->category != null)
                        <div class="pt-2 opacity-50">
                            <i>In {{ $blog->category->category_name }}</i>
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
                        <div class="card overflow-hidden mb-4">
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
                                <a href="{{route('blog.category',$blog->category->slug)}}" class="text-reset">
                                <span class="mb-2 opacity-50 border py-5px px-10px hov-bg-soft-secondary rounded">
                                 {{ $blog->category->category_name }}
                                </span> </a>  
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
                </div>
                <div class="col-md-4">
@include('frontend.blog.sidenav')
                </div>
            </div>
         {{--
            <div class="row pb-4 pt-5">
                <div class="col-sm-5">
                    {{$blog->created_at->isoFormat(' Do MMM YY');}}
                    <h2 class="fs-18 fw-600 mb-1">
                        <a href="{{ url("blog").'/'. $blog->slug }}" class="text-reset">
                            {{ $blog->title }}
                        </a>
                    </h2>
                   
                </div>
                <div class="col-sm-7">
                    <div class="overflow-hidden ">
                        <a href="{{ url("blog").'/'. $blog->slug }}" class="text-reset d-block p-2px">
                            <img
                                src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                data-src="{{ uploaded_asset($blog->banner) }}"
                                alt="{{ $blog->title }}"
                                class="img-fluid lazyload rounded"
                            >
                        </a>
                        @if($blog->category != null)
                        <div class="pt-2 opacity-50">
                            <i>In {{ $blog->category->category_name }}</i>
                        </div>
                        @endif
                        <div class="pt-2">
                            
                            <p class="opacity-70">
                                {{ $blog->short_description }}...<a href="{{ url("blog").'/'. $blog->slug }}" class="text-reset fw-500">
                                    [Read More]
                                </a>
                            </p>
                           
                        </div>
                    </div>
                </div>
            </div>
             --}}
            
        </div>
    </div>
    </div>
        <div class="rit-pagination rit-pagination-center mt-4">
            {{ $blogs->links() }}
        </div>
    </div>
</section>
@endsection
