<div class="border-left p-3 pl-lg-4" style="height: 100%;">
    <div class="fs-20 mb-2 fw-500"> Blog Category </div>
    <div class="mb-3 pb-3 border-bottom">
        @foreach(\App\models\blogcategory::all() as $cat)
        
            <div class="py-2 fs-15">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <a href="{{route('blog.category',$cat->slug)}}" class="text-reset hov-text-primary">{{$cat->category_name}}</a>
                    </div>
                    <div>
                        {{(\App\Models\blog::where('category_id',$cat->id)->where('status',1)->count())}}
                    </div>
                </div>
            </div>
         @endforeach
    
    </div>
    
    <div class="fs-20 mb-4 mt-4 fw-500"> Latest Posts </div>
    <div class="">
        @foreach(\App\models\Blog::where('status',1)->latest()->take(5)->get() as $blog)
        <div class="d-flex align-items-center  mb-2"> <a class="d-block flex-shrink-0 text-reset" href="{{ url("blog").'/'. $blog->slug }}">
            <div class="pr-2">

           
            <img
            class="lazyload rounded"
            src="{{ static_asset('assets/img/placeholder.jpg') }}"
            data-src="{{ uploaded_asset($blog->banner) }}"
            width="80" height="60"
        > </div>
            {{-- <img src="{{ uploaded_asset($blog->banner) }}" width="80" alt="" class="pr-2"></a> --}}
              <div class="ps-2">
                <h6 class="fs-14 fw-500 ">{{ $blog->title }}</h6>
                <div class=""><span class="text-reset"> 
                    @if($blog->category != null)
                        <a href="{{route('blog.category',$blog->category->slug)}}" class="text-reset">
                            <span class="mb-2 fs-12 opacity-50 border py-1 px-10px hov-bg-soft-secondary rounded">
                            {{ $blog->category->category_name }}
                            </span> 
                        </a>  
                    @else
                    <a href="/blog" class="text-reset">
                        <span class="mb-2 fs-12 opacity-50 border py-1 px-10px hov-bg-soft-secondary rounded">
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
  
</div>