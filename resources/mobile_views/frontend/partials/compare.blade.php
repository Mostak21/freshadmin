<a href="{{ route('compare') }}" class="d-flex align-items-center text-reset">
    <b><i class="navbar-tool ci-compare fs-22  la-2x" title="Compare"></i></b>
{{--    <i class="la la-refresh la-2x opacity-80"></i>--}}
    <span class="flex-grow-1 ml-1">
        @if(Session::has('compare'))
{{--            <span class="badge badge-primary badge-inline badge-pill">{{ count(Session::get('compare'))}}</span>--}}
{{--        @else--}}
{{--            <span class="badge badge-primary badge-inline badge-pill">0</span>--}}
            <i class="red-dot opacity-80" ></i>
        @endif
    </span>
</a>
