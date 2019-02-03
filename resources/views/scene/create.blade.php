@extends('layouts.app')

@section('content')
    <!-- Create Select Form... -->
		Create a Scene
		<form method="post">
			@csrf
			Description:<input type="text" name="description" value=""><br>
			Select Video:<select name="video">
				<option>Choose Video</option>
				@foreach($videos as $video)
					<option value="{{$video->id}}">{{$video->title}}</option>
				@endforeach
			</select><br>
			Select Question Format:<select name="question">
				<option>Choose Question Format</option>
				@foreach($questions as $question)
					<option value="{{$question->id}}">{{$question->description}}</option>
				@endforeach
			</select>
			<hr>
			<input type="submit" value="Create">

		</form>
	
@endsection