<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ContestController extends Controller
{
    public function index(Request $request){
        return view("frontend.contest.index");
    }

}
