@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">{{translate('All Contest')}}</h1>
        </div>
        <div class="col text-right">
            <a href="{{ route('contest.create') }}" class="btn btn-circle btn-info">
                <span>{{translate('Add New Contest')}}</span>
            </a>
        </div>
    </div>
</div>
<br>

<div class="card">
{{--    <form class="" id="sort_blogs" action="" method="GET">--}}
{{--        <div class="card-header row gutters-5">--}}
{{--            <div class="col text-center text-md-left">--}}
{{--                <h5 class="mb-md-0 h6">{{ translate('All blog posts') }}</h5>--}}
{{--            </div>--}}
{{--            --}}
{{--            <div class="col-md-2">--}}
{{--                <div class="form-group mb-0">--}}
{{--                    <input type="text" class="form-control form-control-sm" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type & Enter') }}">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </form>--}}

        <div class="card-body">
            <table class="table mb-0 aiz-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th data-breakpoints="lg">Teams</th>
                        <th data-breakpoints="lg">Starts</th>
                        <th data-breakpoints="lg">Ends</th>
                        <th class="text-right">Winner</th>
                        <th class="text-right">Option</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contests as $key => $contest)
                    <tr >
                        <td class="align-middle">
                            {{ ($key+1) + ($contests->currentPage() - 1) * $contests->perPage() }}
                        </td>
                        <td class="align-middle">
                            {{ date('Y-m-d',strtotime($contest->time_start)) }}
{{--                            date('Y-m-d', time())--}}
                        </td>
                        <td>
                            <span class="fs-24 align-middle">{{$contest->teamOne->image}}</span> {{$contest->teamOne->name}}
                            <span class="text-primary">vs</span>
                            <span class="fs-24 align-middle">{{$contest->teamTwo->image}}</span> {{$contest->teamTwo->name}}
                        </td>
                        <td>
                            {{ $contest->time_start }}
                        </td>
                        <td>
                            {{ $contest->time_end }}
                        </td>
                        <td class="text-right">
                            {{$contest->teamWinner->image??""}}</span> {{$contest->teamWinner->name??""}}
                        </td>
                        <td class="text-right">
                            <a href="{{route('contest.edit', $contest->id)}}" class="btn btn-soft-warning btn-icon btn-circle btn-sm" title="edit">
                                <i class="las la-edit"></i>
                            </a>
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('contest.destroy', $contest->id)}}" title="Delete}}">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination">
                {{ $contests->links() }}
            </div>
        </div>
</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')

    <script type="text/javascript">
        {{--function change_status(el){--}}
        {{--    var status = 0;--}}
        {{--    if(el.checked){--}}
        {{--        var status = 1;--}}
        {{--    }--}}
        {{--    $.post('{{ route('blog.change-status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){--}}
        {{--        if(data == 1){--}}
        {{--            AIZ.plugins.notify('success', '{{ translate('Change blog status successfully') }}');--}}
        {{--        }--}}
        {{--        else{--}}
        {{--            AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}
    </script>

@endsection
