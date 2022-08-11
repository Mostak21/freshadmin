@php
    $blogs = Cache::remember('bloglist', 86400, function () {
        return \App\models\Blog::where('status',1)->latest()->take(5)->get();
    });   
@endphp
<div class=" mb-3 d-flex justify-content-between ">
    <div>
        <h3 class="h5 fw-700 mb-0">
            <a href="{{  url("blog") }}">  <span class=" px-2 py-2 c-pointer">Brand's Talk</span></a>
        </h3>
    </div>
    <div>
        <a href="{{  url("blog") }}" class="text-black">View All</a> 

    </div>
   
</div>

<div class="">
    @foreach($blogs as $blog)
    <div class="d-flex align-items-center  mb-2 p-2 card-mobile"> <a class="d-block flex-shrink-0 text-reset" href="{{ url("blog").'/'. $blog->slug }}">
        <div class="pr-2 mr-2">

        <img
        class="lazyload rounded p-img-shadow"
        src="{{ static_asset('assets/img/placeholder.jpg') }}"
        data-src="{{ uploaded_asset($blog->banner) }}"
        width="80" height="60"
    > </div>
        {{-- <img src="{{ uploaded_asset($blog->banner) }}" width="80" alt="" class="pr-2"></a> --}}
          <div class="ps-2">
            <h6 class="fs-15 fw-500 ">{{ $blog->title }}</h6>
            <div class=""><span class="text-reset"> 
                @if($blog->category != null)
                    <a href="{{route('blog.category',$blog->category->slug)}}" class="text-light">
                        <span class="mb-2 fs-12  border py-1 px-10px hov-bg-soft-secondary rounded bg-dark">
                        {{ $blog->category->category_name }}
                        </span> 
                    </a>  
                @else
                <a href="/blog" class="text-light">
                    <span class="mb-2 fs-12  border py-1 px-10px hov-bg-soft-secondary rounded bg-dark">
                     Others
                    </span> 
                </a> 
                @endif 
            
            </span>
            </div>
          </div>
        </a>
        </div>
    @endforeach
</div>