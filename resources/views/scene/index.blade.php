@extends('layouts.app')

@section('content')
    <!-- Create Task Form... -->
	{{$scene->description}}<br>
		Quetion description::{{$scene->question->description}}<br>
		@foreach( $scene->question->sections as $section)
			<h1>{{$section->name}}</h1> :: {{$section->description}}<hr>
			@foreach($section->selects as $select)
			{{$select->name}}<select 'name'='{{$select->name}}'>
				<option 'value'=''>choose</option>
			   @foreach($select->options as $option)
			      <option 'value'='{{$option->value}}'>{{$option->label}}</option>
			   @endforeach
			</select>
			@endforeach
			@foreach($section->children as $child)
			    <h3>{{$child->name}}</h3> {{$child->description}}<br>
				<ul>
				@foreach($child->selects as $select)
				<li>{{$select->name}}<select 'name'='{{$select->name}}'>
					<option>choose</option>
				   @foreach($select->options as $option)
					  <option 'value'='{{$option->value}}'>{{$option->label}}</option>
				   @endforeach
				</select>
				</li>
				@endforeach
				</ul>
			@endforeach
			<hr>
		@endforeach

	@foreach($scene->answers as $answer){
		By {{$answer}}
	@endforeach
@endsection