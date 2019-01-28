<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;

Route::get('/', function () {
    $scenes = \App\Scene::all();

    return view('welcome',['scenes'=>$scenes]);
});

Route::get('/submit', function(){
    return view('submit');
});

Route::post('/submit', function(Request $request){
   $data = $request->validate([
       'title' => 'requried|max:255',
       'artist' => 'required|max:255',
       'key' => 'required|max:10',
   ]);

   $song = tap(new app\Song($data))->save();
   return redirect('/');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/mavue', 'MaVueController@index')->name('mavue');

Route::resources([
    'videos' => 'VideoController',
    'questions' => 'QuestionController',
    'scenes' => 'SceneController',
    'sections' => 'SectionController',
    'options' => 'OptionController',
    'answers' => 'AnswerController',
    'submissions' => 'SubmissionController',
    'sectionselects' => 'SectionselectController',
    'selects' => 'SelectController',
]);

Route::get('/fullscene/{scene_id}', 'SceneController@fullScene');
Route::get('/viewscene/{scene_id}', 'SceneController@viewScene');
Route::get('/viewanswer/{answer_id}', 'AnswerController@viewAnswer');
Route::get('/createanswer/{scene_id}', 'AnswerController@create');
Route::post('/createanswer/{scene_id}', 'AnswerController@store');
Route::put('/answers/{answer_id}/edit', 'AnswerController@update');


Route::get('/sectionwithselects/{section_id}', 'SectionController@withSelects');
Route::get('/sectionwithselectoptions/{section_id}', 'SectionController@withSelectOptions');
Route::get('/sectionwithsections/{section_id}', 'SectionController@withSections');
Route::get('/questionwithsections/{question_id}', 'QuestionController@withSections');

