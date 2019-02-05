<?php

namespace App\Http\Controllers;

use App\Select;
use Illuminate\Http\Request;
use App\Option;
use Ramsey\Uuid\Uuid;

class SelectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Select::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('select.create');
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
        $select = new Select();
        $select->name = $request->name;
        $select->allowsMultiple = $request->allowsMultiple;
        $select->save();
        return redirect()->action(
            'SelectController@editWithOptions', ['id' => $select->id]
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
        $select = Select::find($id);
        return $select;
    }

    /**
     * Display the specified select witho ptions.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function withOptions($id)
    {
        //
        $select = Select::with('options')->find($id);
        return $select;
    }

    public function editWithOptions($id){
        $select = $this->withOptions($id);
        return view('select.edit',['select'=>$select]);
    }

    public function updateWithOptions(Request $request, $id){
        $select = $this->withOptions($id);
//        var_dump($request);
//        exit;
        $optionIds = $request->input('option');
//        var_dump($optionIds);
        $optionsToAttach = [];
        foreach($select->options as $option){
            if ( array_key_exists($option->id, $optionIds)){
                continue;
            }
            $option->delete();
        }
        $newOption = $request->newOption;
        if (strlen(trim($newOption)) != 0) {
            $option = new Option();
            $option->label = $newOption;
            $option->value = Uuid::uuid4('php');
            $option->select_id = $select->id;
            $option->save();
        }
        $select->name=$request->name;
        $select->allowsMultiple = 0;
        if($request->allowsMultiple == '1'){
            $select->allowsMultiple = 1;
        }
        $select->save();
        return redirect()->action(
            'SelectController@editWithOptions', ['id' => $select->id]
        );

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
        $select = Select::find($id);
        return $select;
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
        $select = Select::find($id);
        $select->update($request->all());
        return $select;
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
        Select::findOrFail($id)->delete();

        return redirect('/');
    }
}
