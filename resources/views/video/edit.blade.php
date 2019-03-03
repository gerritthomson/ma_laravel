@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a Video</div>

                    <div class="card-body">
                        <div class="content">
                            <!-- Create Select Form... -->
                            <form method="post">
                                @csrf
                                <input type="hidden" name="video_id" value="{{$video->id}}">
                                Description:<input type="text" name="title" value="{{$video->title}}" size="80%"><br>
                                Source URL:<input type="text"
                                                  id="location"
                                                  name="location" value="{{$video->location}}" size="80%"
                                                  >
                                <input type="button" onclick="player.loadVideoByUrl(document.getElementById('location').value);"
                                       value="Peview">
                                <br>
                                <hr>
                                <input type="submit" value="Update">

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- iframe width="720" height="480" src="{{$video->location}}?rel=0" frameborder="0" allow="accelerometer; encrypted-media; gyroscope"></iframe -->
            <div id="player"></div>

        </div>
    </div>
    <script type="application/javascript" src="/js/youtube.js"></script>
@endsection