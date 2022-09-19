<a href="{{ route('compare') }}" class="d-flex align-items-center text-reset">
{{--    <i class="la la-refresh la-2x opacity-80" title="Compare"></i>--}}
    <i class="navbar-tool ci-compare fs-22 px-2 opacity-80" title="Compare"></i>
    <span class="flex-grow-1 ml-1">
        @if(Session::has('compare'))
            <span class="badge badge-primary badge-inline badge-pill " style="">{{--{{ count(Session::get('compare'))}}--}}</span>
            <i class="red-dot opacity-80" title="Compare" style=""></i>
{{--        @else--}}
{{--            <span class="badge badge-primary badge-inline badge-pill" style="margin:-20px 0px 0px -10px;">0</span>--}}
        @endif
{{--        <span class="nav-box-text d-none d-xl-block opacity-70">{{translate('Compare')}}</span>--}}
    </span>
</a>
