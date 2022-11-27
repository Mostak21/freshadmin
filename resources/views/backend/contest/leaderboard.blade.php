@extends('backend.layouts.app')

@section('content')

<div class="rit-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">{{translate('Leaderboards')}}</h1>
        </div>

    </div>
</div>
<br>

<div class="card">

        <div class="card-body">

            <section class="text-center mx-auto my-5" style="max-width: 720px">
                <div class="fs-24 py-4"><span class="fw-800">PAST WEEK LEADERBOARD </span><span class="fw-100">(TOP 10 | Week-{{$week??""}})</span></div>
                <div class="row bg-primary rounded shadow-md">
                    <div class="col-4">Name</div>
                    <div class="col-2">Participate</div>
                    <div class="col-2">Win</div>
                    <div class="col-2">Lose</div>
                    <div class="col-2">Points</div>
                </div>

                @foreach($leaderboards as $key => $leaderboard)
                    @if($leaderboard->participate)
                        <div class="row border-1 rounded shadow-md my-1 fs-16 bg-white">
                            <div class="col-4 text-truncate">{{$leaderboard->participate->name??"Guest(".$leaderboard->participate->id.")"}}</div>
                            <div class="col-2">{{$leaderboard->participation->count()??"null"}}</div>
                            <div class="col-2">{{$leaderboard->win}}</div>
                            <div class="col-2">{{$leaderboard->loose}}</div>
                            <div class="col-2">
                                {{($leaderboard->points - $leaderboard->sharePoints)}}@if($leaderboard->sharePoints >0)<span class="fs-11" style="color: #0f9000">+{{$leaderboard->sharePoints}}</span> @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </section>
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
        {{--            RIT.plugins.notify('success', '{{ translate('Change blog status successfully') }}');--}}
        {{--        }--}}
        {{--        else{--}}
        {{--            RIT.plugins.notify('danger', '{{ translate('Something went wrong') }}');--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}
    </script>

@endsection
