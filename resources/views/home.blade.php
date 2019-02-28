@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="content">
                            <div class="title m-b-md">
                                Movement Analysis Practice
                            </div>

                            <div class="links">
                                <table border="1">
                                    <tr><th>Do Scene</th>
                                        @can('manage-answers')
                                          <th>Answers</th>
                                        @endcan
                                        <th>Submission Count</th></tr>
                                    @foreach ($scenes as $scene)
                                        <tr>
                                            <td><a href='/doscene/{{$scene->id}}'>{{$scene->description}}</a></td>
                                            @can('manage-answers')
                                                <td>
                                                    <table>
                                                        @foreach( $scene->answers as $answer)
                                                            <tr><td>
                                                                    <a href="/answers/{{$answer->id}}/edit">{{$answer->created_by}} :: {{$answer->created_at}}</a>
                                                                </td></tr>
                                                        @endforeach
                                                        <tr><td>
                                                                <a href="/createanswer/{{$scene->id}}">New</a>
                                                            </td></tr>
                                                    </table>
                                                </td>
                                            @endcan
                                            <td>{{$scene->submissions->count()}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                         @can('manage-question-formats')
                            <div class="links">
                                <h2>Question formats</h2>
                                <table border="1">
                                    @foreach($questions as $question)
                                        <tr>
                                            <td><a href="/questionedit/{{$question->id}}">{{$question->description}}</a></td>
                                        </tr>
                                    @endforeach
                                        <tr><td><a href="/questioncreate">Create New</a></td></tr>
                                </table>
                            </div>
                          @endcan
                          @can('manage-quantifiable-observables')
                            <div class="links">
                                <h2>Quatifiable Observables</h2>
                                <table border="1">
                                    <tr><th>Name</th><th>Allows multiple</th><th>Update</th></tr>
                                    @foreach($selects as $select)
                                        <tr>
                                            <td>{{$select->name}}</td><td>{{$select->allowsMultiple}}</td><td><a href="/selecteditwithoptions/{{$select->id}}">update</a></td>
                                        </tr>
                                    @endforeach
                                    <tr><td><a href="/createselect">Create New</a></td></tr>
                                </table>
                            </div>
                           @endcan

                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
