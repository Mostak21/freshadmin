@extends('frontend.layouts.app')

@section('content') 


<div class="productheaderbg py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left">
                <h1 class="fw-600 h4">
                    {{ $category->category_name}}
                </h1>
            </div>
            <div class="col-lg-6 fs-13">
                <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                    <li class="breadcrumb-item opacity-50">
                       <a class="text-dark" href="{{ route('home') }}">   <i class="ci-home"> </i> {{ translate('Home')}}</a>
                    </li>
                    <li class="text-dark breadcrumb-item">
                        <a class="text-reset" href="{{ route('blog') }}">{{ translate('Blog') }}</a>
                    </li>
                    <li class="text-dark breadcrumb-item">
                        {{ $category->category_name}}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<section class="pb-4 pt-5">
    <div class="container">
        <div class="row">

       
        <div class="col-xl-12 mx-auto">
            
            
            <div class="row pt-4">
                <div class="col-md-8">
                    @if($blogs->count()>0)
                    <div class="card-columns">
                        @foreach($blogs as $blog)
                        
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
                            
                        @endforeach
                        
                    </div>
                    @else
                    <div class="card v-align-center text-center p-5 fs-20 fw-500">
                    Not yet published !
                    </div>

                    @endif
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
        <div class="aiz-pagination aiz-pagination-center mt-4">
            {{ $blogs->links() }}
        </div>
    </div>
</section>
@endsection
