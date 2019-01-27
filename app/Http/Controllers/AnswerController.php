<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Scene;

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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
    public function fullScene($id){
//        $scene = Scene::with('question.sections.children.selects.options', 'question.sections.selects.options')->find($id);
        $scene = Scene::with('question.sections.children.selects.options')->find($id);
        return $scene;
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
