<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Scene;
use App\Option;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $answers = Answer::All();
        return $answers;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($scene_id)
    {
        $scene = $this->fullScene($scene_id);
        return view('answer.create', ['scene' => $scene] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sceneId = $request->input('scene_id');
        $scene = Scene::find($sceneId);
        $optionIds = $request->input('option');
        $optionsToAttach = [];
        foreach($optionIds as $key=>$value){
            if ( intval($value) != 0){
                $optionsToAttach[$key] = ['value'=>$value];
            }
        }
        var_dump($sceneId);
        var_dump($optionIds);
        $answer = new Answer();
        $answer->scene_id = $sceneId;
        $answer->created_by = 'gjt';
        $answer->discussion = $request->discussion;
        $answer->save();
        $answer->scene()->associate($scene);
        $answer->save();
        $answer->options()->attach($optionsToAttach);
        var_dump($answer);
        return redirect()->action(
            'AnswerController@edit', ['id' => $answer->id]
        );
        exit();
        return $this->create($request['scene_id']);
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
        $answer = Answer::with('scene','options')->find($id);
        $optionValues = [];
        foreach($answer->options as $option){
            $optionValues[$option->id] = $option->pivot->value;
        }
        $scene = $this->fullScene($answer->scene->id);
        return view('answer.edit', ['answer'=>$answer, 'scene' => $scene, 'optionValues'=>$optionValues] );
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
        $answer = Answer::find($id);
        $answer->discussion = $request->discussion;
        $answer->save();
        var_dump($request);
        $optionIds = $request->input('option');
        var_dump($optionIds);
        $optionsToAttach = [];
        foreach($optionIds as $key=>$value){
            if ( intval($value) != 0){
                $optionsToAttach[$key] = ['value'=>$value];
            }
        }
        var_dump($optionsToAttach);
//        exit();
        // sync the options of the answers. This removes missing and adds new.
        $answer->options()->sync($optionsToAttach);
        var_dump($answer);
        return redirect()->action(
            'AnswerController@edit', ['id' => $answer->id]
        );
        exit();
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
    public function fullScene($id){
//        $scene = Scene::with('question.sections.children.selects.options', 'question.sections.selects.options')->find($id);
        $scene = Scene::with('question.sections.children.selects.options')->find($id);
        return $scene;
    }

    public function answerWithScene($id){
        $answer = Answer::with('scene','options')->find($id);
        $optionValues = [];
        foreach($answer->options as $option){
            $optionValues[$option->id] = $option->pivot->value;
        }
        $scene = $this->fullScene($answer->scene->id);
        return  ['answer'=>$answer, 'scene' => $scene, 'optionValues'=>$optionValues] ;

    }
    public function viewAnswer($id){
        $answer = Answer::with('scene','options')->find($id);
        $optionValues = [];
        foreach($answer->options as $option){
            $optionValues[$option->id] = $option->pivot->value;
        }
        $scene = $this->fullScene($answer->scene->id);
        return view('answer.index', ['answer'=>$answer, 'scene' => $scene, 'optionValues'=>$optionValues] );
    }

}
