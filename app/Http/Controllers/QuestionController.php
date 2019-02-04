<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Select;
use App\Section;

class QuestionController extends Controller
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $question = $this->withSections($id);
        $selects = Select::All();
        foreach ($question->sections as $section) {
            foreach ($section->selects as $question_select) {
                foreach ($selects as $key => $select) {
                    if ($question_select->id != $select->id) {
                        continue;
                    }
                    $selects->forget($key);
                    break;
                }
            }
            foreach ($section->children as $section) {
                foreach ($section->selects as $question_select) {
                    foreach ($selects as $key => $select) {
                        if ($question_select->id != $select->id) {
                            continue;
                        }
                        $selects->forget($key);
                        break;
                    }
                }
            }
        }
        return view('question.edit', ['question' => $question, 'selects' => $selects]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        var_dump($request);
        $destSection = null;
        $selectToUse = null;
        if($request->destSection != null){
            $destSection = Section::find($request->destSection);
        }
        if($request->selectToUse != null){
            $selectToUse = Select::find($request->selectToUse);
        }
        if((!is_null($destSection))&&(!is_null($selectToUse))){
            $destSection->selects()->attach($selectToUse);
        }
        if($request->newSection != null){
            foreach($request->newSection as $parent_id=>$name){
                if( strlen($name) == 0){
                    continue;
                }
                $section = new Section();
                $section->name = $name;
                $section->description = $name;
                if($parent_id == 0){
                    $section->question_id = $id;
                }
                if($parent_id != 0){
                    $section->parent_id = $id;
                }
                $section->save();
            }
        }
        return redirect()->action(
            'QuestionController@edit', ['id' => $id]
        );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function withSections($id)
    {
        return Question::with('sections.children.selects.options', 'sections.selects.options')->find($id);
    }

}
