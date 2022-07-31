@if ($paginator->hasPages())
<nav class="d-flex justify-content-between pt-2" aria-label="Page navigation">
       
        @if ($paginator->onFirstPage())
        <ul class="pagination">
            <li class="page-item"><i class="ci-arrow-left me-2"></i>Prev</li>
        </ul>
        @else
            
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="ci-arrow-left me-2"></i>Prev</a></li>
            </ul>
        @endif


      
        @foreach ($elements as $element)
        <ul class="pagination">
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif


           
            @if (is_array($element))
            {{--<li class="page-item d-sm-none"><span class="page-link page-link-static">1 / 5</span></li>--}}
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                    <li class="page-item active d-none d-sm-block" aria-current="page">
                        <span class="page-link">{{ $page }}</span></li>
                        
                    @else
                        <li class="page-item d-none d-sm-block"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        </ul>
        @endforeach


   <ul class="pagination">  
        @if ($paginator->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next" rel="next">Next<i class="ci-arrow-right ms-2"></i></a></li>
            
        @else
        <li class="page-item disable"><a class="page-link" href="" aria-label="Next" rel="next">Next<i class="ci-arrow-right ms-2"></i></a></li>
        @endif
   </ul>
</nav>
@endif 