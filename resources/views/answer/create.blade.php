@extends('layouts.app')

@section('content')
	<h2>Sceneid:{{$scene->id}}</h2>
    <!-- Create Task Form... -->
	Create an Answer data set for this scene.
	{{$scene->description}}<br>
		<form method="post">
			@csrf
			<input type="hidden" name="scene_id" value="{{$scene->id}}">
		Question description::{{$scene->question->description}}<br>
		@foreach( $scene->question->sections as $section)
			<h1>{{$section->name}}</h1> :: {{$section->description}}<hr>
			@foreach($section->selects as $select)
			{{$select->name}}
			<ul>
			   @foreach($select->options as $option)
					<li> {{$option->label}} // {{$option->id}} // score::
						<input type="text" name="option[{{$option->id}}]"></li>
				@endforeach
			</ul>
			@endforeach
			@foreach($section->children as $child)
			    <h3>{{$child->name}}</h3> {{$child->description}}<br>
				<ul>
				@foreach($child->selects as $select)
						{{$select->name}}
						<ul>
							@foreach($select->options as $option)
								<li> {{$option->label}} // {{$option->id}} // score::
									<input type="text" name="option[{{$option->id}}]"></li>
							@endforeach
						</ul>
				@endforeach
				</ul>
			@endforeach
			<hr>
		@endforeach
			<textarea name="discussion"></textarea>
			<input type="submit" value="Create new">
		</form>
	
@endsection