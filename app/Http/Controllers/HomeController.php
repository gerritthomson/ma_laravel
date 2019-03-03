<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scenes = \App\Scene::all();
        $sceneIds = [];
        foreach($scenes as $scene){
            $sceneIds[] = $scene->id;
        }
//    var_dump($sceneIds);
        $scenes = \App\Scene::with('answers','submissions')->find($sceneIds);
//    var_dump($scenes);
        //exit;
        $questions = \App\Question::all();
        $selects = \App\Select::All();
        $videos = \App\Video::All();
        return view('home',['scenes'=>$scenes,'questions'=>$questions,'selects'=>$selects,'videos'=>$videos]);

//        return view('home');
    }
}
