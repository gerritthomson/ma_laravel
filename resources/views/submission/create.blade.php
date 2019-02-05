@extends('layouts.app')

@section('content')
	<form method="post">
		@csrf
		<input type="hidden" name="scene_id" value="{{$scene->id}}">
	View the video:<br>
	<iframe width="720" height="480" src="{{$scene->video->location}}?rel=0&amp;showinfo=0" frameborder="0" allow="accelerometer; encrypted-media; gyroscope" allowfullscreen></iframe>
	<hr>
    <!-- Create Task Form... -->
	{{$scene->description}}<br>
		Quetion description::{{$scene->question->description}}<br>
		@foreach( $scene->question->sections as $section)
			<h1>{{$section->name}}</h1> :: {{$section->description}}<hr>
			@foreach($section->selects as $select)
			{{$select->name}}<select name='{{$select->name}}<?php echo ($select->allowsMultiple == 1?'[]':'');?>' <?php echo ($select->allowsMultiple == 1?'multiple="multiple"':'');?>>
				<option value=''>choose</option>
			   @foreach($select->options as $option)
			      <option value='{{$option->value}}'>{{$option->label}}</option>
			   @endforeach
			</select>
			@endforeach
			@foreach($section->children as $child)
			    <h3>{{$child->name}}</h3> {{$child->description}}<br>
				<ul>
				@foreach($child->selects as $select)
				<li>{{$select->name}}<select name='{{$select->name}}'>
					<option>choose</option>
				   @foreach($select->options as $option)
					  <option value='{{$option->value}}'>{{$option->label}}</option>
				   @endforeach
				</select>
				</li>
				@endforeach
				</ul>
			@endforeach
			<hr>
		@endforeach
		<input type="submit" value="Check Your Answer"><br>
	</form>
@endsection