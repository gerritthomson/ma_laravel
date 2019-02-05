<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Submission;
use App\Scene;
use App\Option;
use App\Http\Controllers\SceneController;

class SubmissionController extends Controller
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
    public function create($scene_id)
    {
        //
        $sceneController = new SceneController();
        $scene = $sceneController->fullScene($scene_id);
        return view('submission.create',['scene'=>$scene]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        //
        $scene = Scene::find($request->scene_id);
        $user = Auth::user();
        $submission = new Submission();
        $submission->user_id = $user->id;
        $submission->scene_id = $scene->id;
        $submission->save();
        $optionsToAttach = [];
        unset($data['scene_id']);
        unset($data['_token']);
        foreach($data as $key=>$value){
            if ( is_array($value)){
                $optionsToAttach = array_merge($optionsToAttach, $value);
                continue;
            }
            $optionsToAttach[] = $value;
        }
        var_dump($optionsToAttach);
//        exit();
        // sync the options of the answers. This removes missing and adds new.
        $submission->options()->sync($optionsToAttach);
        return redirect()->action(
            'SubmissionController@show', ['id' => $submission->id]
        );

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
        $submission = Submission::with('options','scene')->find($id);
        $optionIds = [];
        foreach($submission->options as $option){
            $optionIds[] = $option->id;
        }
        $sceneController =  new SceneController();
        $scene =  $sceneController->fullScene($submission->scene->id);
        $answers = $scene->answers;
        $answerOptionValues = [];
        $score = [];
        foreach($answers as $answer){
            $options = $answer->options;
            foreach($options as $option){
                $answerOptionValues[$answer->id][$option->id] = $option->pivot->value;
                if (in_array($option->id, $optionIds)){
                    if (! isset($score[$answer->id])){
                        $score[$answer->id] = 0;
                    }
                    $score[$answer->id] += intval($option->pivot->value);
                }
            }
        }
		return view('submission.show', ['submission'=>$submission,'scene' => $scene, 'optionIds'=>$optionIds,'answerOptionValues'=>$answerOptionValues, 'answers'=>$answers, 'score'=>$score] );

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
}
