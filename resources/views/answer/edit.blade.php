@extends('layouts.app')

@section('content')
    <!-- Create Task Form... -->
	{{$scene->description}}<br>
		<form method="post">
			@method('PUT')
			@csrf
		Quetion description::{{$scene->question->description}}<br>
		@foreach($optionValues as $key=>$value)
			Key {{$key}} => Value {{$value}}<br>
			@endforeach
		@foreach( $scene->question->sections as $section)
			<h1>{{$section->name}}</h1> :: {{$section->description}}<hr>
			@foreach($section->selects as $select)
			{{$select->name}}
			<ul>
			   @foreach($select->options as $option)
					<li> {{$option->label}} // {{$option->id}} // score::
						<input type="text" name="option[{{$option->id}}]" value="{{array_key_exists($option->id,$optionValues)?$optionValues[$option->id]:''}}"></li>
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
									<input type="text" name="option[{{$option->id}}]" value="{{array_key_exists($option->id,$optionValues)?$optionValues[$option->id]:''}}"></li>
							@endforeach
						</ul>
				@endforeach
				</ul>
			@endforeach
			<hr>
		@endforeach
			<textarea name="discussion">{{$answer->discussion}}</textarea>

			<input type="submit" value="Update">

		</form>
	
@endsection