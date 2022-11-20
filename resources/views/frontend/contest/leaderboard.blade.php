<section class="text-center mx-auto my-5" style="max-width: 720px">
    <div class="fs-24 py-4"><span class="fw-800">WEEKLY LEADER BOARD </span><span class="fw-100">(TOP 10 | Week-{{$week??""}})</span></div>
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
