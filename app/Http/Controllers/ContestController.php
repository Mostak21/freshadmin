<?php


namespace App\Http\Controllers;
use App\Models\Contestlist;
use App\Models\Contestparticipation;
use App\Models\Contestteam;
use Carbon\Carbon;
use Auth;
use Session;
use Illuminate\Http\Request;

class ContestController extends Controller
{
    public function index(Request $request){
        $timenow = Carbon::now();
        $today = Carbon::now();
        $weekStart = $today->startOfWeek(Carbon::SATURDAY);
        $week = $weekStart->week();
//        DD($week);
        $leaderboards = Contestparticipation::distinct()
            ->where('updated_at', '>', $weekStart)
            ->with('participate')
            ->with('participation')
            ->get(['user'])
            ->take(10);

        foreach ($leaderboards as $key=> $leaderboard){
            $wincount=0;
            $loosecount=0;
            foreach ($leaderboard->participation as $key => $game){
                $win = Contestlist::where('winner',$game->team)->where('id',$game->contest)->first();
                $loose = Contestlist::where('id',$game->contest)->whereNotNull('winner')->where('winner','!=',$game->team)->first();
                if ($win !=null)$wincount++;
                if ($loose !=null)$loosecount++;
            }
            $leaderboard->win = $wincount;
            $leaderboard->loose =$loosecount;
//            $leaderboard->loose =$leaderboard->participation->count()- $wincount;
            $leaderboard->points =$wincount*30;
        }

//        $leaderboards = collect($leaderboards) ;
        $leaderboards = $leaderboards->sortBy('points',  SORT_REGULAR,  true);

        $goal = $this->prizegoal();

        $contests =  Contestlist::where('time_start','<',$timenow)
            ->where('time_end','>',$timenow)
            ->get();

        return view("frontend.contest.index",compact('contests','leaderboards','goal','week'));
    }

    public function leaderboard(){
        $today = Carbon::now();
        $weekStart = $today->startOfWeek(Carbon::SATURDAY);
        $week = $weekStart->week();
//        DD($week);
        $leaderboards = Contestparticipation::distinct()

            ->with('participate')
            ->with('participation')
            ->get(['user'])
            ->take(50);

        foreach ($leaderboards as $key=> $leaderboard){
            $wincount=0;
            $loosecount=0;
            foreach ($leaderboard->participation as $key => $game){
                $win = Contestlist::where('winner',$game->team)->where('id',$game->contest)->first();
                $loose = Contestlist::where('id',$game->contest)->whereNotNull('winner')->where('winner','!=',$game->team)->first();
                if ($win !=null)$wincount++;
                if ($loose !=null)$loosecount++;
            }
            $leaderboard->win = $wincount;
            $leaderboard->loose =$loosecount;
//            $leaderboard->loose =$leaderboard->participation->count()- $wincount;
            $leaderboard->points =$wincount*30;
        }

//        $leaderboards = collect($leaderboards) ;
        $leaderboards = $leaderboards->sortBy('points',  SORT_REGULAR,  true);

        $goal = $this->prizegoal();


        return view("frontend.contest.leaderboard",compact('leaderboards','goal'));

    }


    public function prizegoal(){

        $total_participate = Contestparticipation::distinct()->get(['user'])->count();

//        $total_participate = 1000;
        $target1 = 0;
        $target2 = 0;
        $target3 = 0;
        $target4 = 0;

        if ($total_participate){
            if ($total_participate>=0 && $total_participate<=100){
                $target1 = ($total_participate/100)*25;
            }
            elseif ($total_participate>=101 && $total_participate<=1000){
                $target1 = 25;
                $target2 = ($total_participate/1000)*25;
            }
            elseif ($total_participate>=1001 && $total_participate<=10000){
                $target1 = 25;
                $target2 = 25;
                $target3 = ($total_participate/10000)*25;
            }
            elseif ($total_participate>=10001){
                $target1 = 25;
                $target2 = 25;
                $target3 = 25;
                $target4 = ($total_participate/100000)*25;
            }
        }

        $goal = array(
            'target1' => $target1,
            'target2' => $target2,
            'target3' => $target3,
            'target4' => $target4,
            'total' => $total_participate,
        );
//        dd($goal);
        return $goal;
    }

    public function dd(Request $request){
        return dd($request);
    }

    public function contestlist(){
        $contests = Contestlist::orderBy("time_start","asc")->paginate(15);

//        dd($contests[0]->teamOne);

//        dd($contests);
        return view('backend.contest.index',compact('contests'));
    }

    public function create(){
        $teams = Contestteam::orderBy('name','asc')->get();
        return view('backend.contest.create', compact('teams'));
    }

    public function store( Request $request){
        $contest = new Contestlist;

        $team1 = $request->team1;
        $team2 = $request->team2;
        $winner = $request->winner == "--" ? null : $request->winner;



        if ($request->date_range != null) {
            $date_var               = explode(" to ", $request->date_range);
//            $start_time = strtotime($date_var[0]);
//            $end_time   = strtotime( $date_var[1]);
            $start_time = Carbon::parse($date_var[0]);
            $end_time   =  Carbon::parse($date_var[1]);
        }

        $contest->team1 = $team1;
        $contest->team2  = $team2;
        $contest->winner = $winner ;
        $contest->time_start = $start_time;
        $contest->time_end = $end_time;

//        dd($contest->time_end, $contest->time_start );

        $contest->save();

        return redirect()->route('contest.list');
    }

    public function edit($id){
        $contest = Contestlist::findOrFail($id);
        $teams = Contestteam::orderBy('name','asc')->get();
        return view('backend.contest.edit', compact('teams','contest'));
    }

    public function update( Request $request){
        $contest = Contestlist::findOrFail($request->id);
//        dd($contest);
        $team1 = $request->team1;
        $team2 = $request->team2;
        $winner = $request->winner == "--" ? null : $request->winner;



        if ($request->date_range != null) {
            $date_var               = explode(" to ", $request->date_range);
//            $start_time = strtotime($date_var[0]);
//            $end_time   = strtotime( $date_var[1]);
            $start_time = Carbon::parse($date_var[0]);
            $end_time   =  Carbon::parse($date_var[1]);
        }

        $contest->team1 = $team1;
        $contest->team2  = $team2;
        $contest->winner = $winner ;
        $contest->time_start = $start_time;
        $contest->time_end = $end_time;

//        dd($contest->time_end, $contest->time_start );

        $contest->save();

        return redirect()->route('contest.list');
    }

    public function destroy($id)
    {
        Contestlist::find($id)->delete();

        return redirect()->route('contest.list');
    }

    public function selectTeam(Request $request){

        if (Session::get('contestParticipation')){
            $Participate = Session::get('contestParticipation');
            $Participate[$request->contest] =[
                "contest" => $request->contest,
                "team" => $request->team
            ];
            Session::put('contestParticipation', $Participate);
            Session::save();
        }
        else{
            $Participate = array();
            $Participate[$request->contest] =[
                "contest" => $request->contest,
                "team" => $request->team
            ];

            Session::put('contestParticipation', $Participate);
            Session::save();
        }

        return 1;
    }

    public function contestsubmit(Request $request){
        $contests = Session::get('contestParticipation');
        $user = Auth::user()->id;

        $now = Carbon::now();

        if ($contests != null && $user != null ){
            foreach ($contests as $key=>$contest){
                $participationscheck = Contestparticipation::where('user',$user)->where('contest',$contest['contest'])->first();
                $availavel =Contestlist::where('id',$contest['contest'])->where('time_end', '>', $now)->first();
                if ($participationscheck == null && $availavel != null){
                    $participation = new Contestparticipation();

                    $participation->user = $user;
                    $participation->contest = $contest['contest'];
                    $participation->team = $contest['team'];
                    $participation->save();
                }
            }
            flash('You have submitted your answer!')->success();
        }
        else{
//            dd('ok');
            flash('Please select your team before submit!')->warning();
        }

        return redirect()->route('fifacontest')->withInput();
    }


}
