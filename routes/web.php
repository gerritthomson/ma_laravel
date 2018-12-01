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
    $songs = \App\Song::all();

    return view('welcome',['songs'=>$songs]);
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


Route::resources([
    'videos' => 'VideoController',
    'questions' => 'QuestionController',
    'scenes' => 'SceneController',
    'sections' => 'SectionController',
    'options' => 'OptionsController',
    'answers' => 'AnswerController',
    'submissions' => 'SubmissionController',
    'sectionselects' => 'SectionselectController',
    'selects' => 'SelectController',
]);