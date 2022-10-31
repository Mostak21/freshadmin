<?php


namespace App\Http\Controllers;
use App\Models\Contestlist;
use App\Models\Contestteam;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContestController extends Controller
{
    public function index(Request $request){
        $today = Carbon::now();

        $contests =  Contestlist::where('time_start','<',$today)
            ->where('time_end','>',$today)
            ->get();

//        ddd($contests);

        return view("frontend.contest.index",compact('contests'));
    }

    public function dd(Request $request){
        return dd($request);
    }

    public function contestlist(){
        $contests = Contestlist::orderBy("time_start","asc")->paginate(3);

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

    public function destroy($id)
    {
        Contestlist::find($id)->delete();

        return redirect()->route('contest.list');
    }

    public function commingsoon()
    {
        return view("frontend.contest.footer");
    }


}
