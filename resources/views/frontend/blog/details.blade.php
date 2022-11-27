@extends('frontend.layouts.app')

@section('meta_title'){{ $blog->meta_title }}@stop

@section('meta_description'){{ $blog->meta_description }}@stop

@section('meta_keywords'){{ $blog->meta_keywords }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $blog->meta_title }}">
    <meta itemprop="description" content="{{ $blog->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($blog->banner) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $blog->meta_title }}">
    <meta name="twitter:description" content="{{ $blog->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($blog->banner) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $blog->meta_title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('blog.details', $blog->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($blog->banner) }}" />
    <meta property="og:description" content="{{ $blog->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
@endsection

@section('content')
<div class="productheaderbg py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left">
                <h1 class="fw-600 h4" id="postTitle">
                    {{ $blog->title }}
                </h1>
            </div>
            <div class="col-lg-6 fs-13">
                <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                    <li class="breadcrumb-item ">
                        <i class="ci-home"> </i>   <a class="text-dark" href="{{ route('home') }}">{{ translate('Home')}}</a>
                    </li>
                    <li class="text-dark breadcrumb-item">
                        @if($blog->category != null)
                    <a class="text-reset" href="{{route('blog.category',$blog->category->slug)}}">
                            {{ $blog->category->category_name }}
					</a>
                      @else
							<a class="text-reset" href="/blog">
                          	  Others
							</a>
                        @endif
                    </li>
                    <li class="text-dark breadcrumb-item">
						<a href="/blog/{{$blog->slug}}" class="text-reset" id="blog_link" >  {{ $blog->title }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section class="py-4">

    <div class="container">

        <div class="row">

            <div class="col-xl-12 mx-auto">
                <div class="mb-2">
                    <img
                        src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                        data-src="{{ uploaded_asset($blog->banner) }}"
                        alt="{{ $blog->title }}"
                        id="postThumbnail"
                        class="img-fluid lazyload w-100"
                    >
					<div class="py-3"> Published date:<span  id="published_date" > {{$blog->created_at->format('Y-m-d\TH:i:sP')}}</span></div>
                </div>
                <div class="bg-white rounded shadow-sm p-4">
                    <div class="border-bottom">



                    </div>
                    <div class="mb-4 overflow-hidden">
                        {!! $blog->description !!}
                    </div>
                    <div class="row no-gutters mt-4 d-flex justify-content-end">
                        <div class="pr-2">
                            <div class="opacity-50 my-2">{{ translate('Share')}}:</div>
                        </div>
                        <div class="">
                            <div class="rit-share"></div>
                        </div>
                    </div>
                    @if (get_setting('facebook_comment') == 1)
                    <div>
                        <div class="fb-comments" data-href="{{ route("blog",$blog->slug) }}" data-width="" data-numposts="5"></div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>



@endsection


@section('script')
    @if (get_setting('facebook_comment') == 1)
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0&appId={{ env('FACEBOOK_APP_ID') }}&autoLogAppEvents=1" nonce="ji6tXwgZ"></script>
    @endif
@endsection
