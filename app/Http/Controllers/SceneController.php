<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Scene;
use App\Section;
use App\Select;
use App\Option;
use App\Video;
use App\Question;

class SceneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $videos = Video::All();
        $questions = Question::All();
        return view('scene.create',['videos'=>$videos, 'questions'=>$questions]);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if ($request->video = ''){
            // invalid
        }
        if($request->question == ''){
            // invalid
        }
        if (strlen($request->description) ==0){
            // invalid
        }
        $scene = new Scene();
        $scene->description = $request->description;
        $scene->video_id = $request->video;
        $scene->question_id = $request->question;
        $scene->save();
        return redirect('\\');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    // check of full set of relationships

    public function fullScene($id){
//        $scene = Scene::with('question.sections.children.selects.options', 'question.sections.selects.options')->find($id);
        $scene = Scene::with('question.sections.children.selects.options', 'answers')->find($id);
        return $scene;
    }
	
	public function viewScene($id){
		$scene = $this->fullScene($id);
		return view('scene.index', ['scene' => $scene] );
	}
}
