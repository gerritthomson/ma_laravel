@extends('layouts.app')

@section('content')
    <!-- Create Select Form... -->
	<h2>Update Scene</h2>
	<p>video id{{$scene->video->id}}</p>
	<p>Question id {{$scene->question->id}}</p>
		<form method="post">
			@csrf
			<input type="hidden" name="scene_id" value="{{$scene->id}}">
			Description:<input type="text" name="description" value="{{$scene->description}}"><br>
			Select Video:<select name="video">
				<option>Choose Video</option>
				@foreach($videos as $video)
					<option value="{{$video->id}}"
						@if( $video->id == $scene->video->id)
							selected="selected"
						@endif
					    >{{$video->title}}
					</option>
				@endforeach
			</select><br>
			Select Question Format:<select name="question">
				<option>Choose Question Format</option>
				@foreach($questions as $question)
					<option value="{{$question->id}}"
							@if( $question->id == $scene->question->id)
							selected="selected"
							@endif

					>{{$question->description}}</option>
				@endforeach
			</select>
			<hr>
			<input type="submit" value="Update">

		</form>
	
@endsection