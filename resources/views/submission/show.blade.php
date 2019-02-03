@extends('layouts.app')

@section('content')
    <!-- Create Task Form... -->
	{{$scene->description}}<br>
		Question description::{{$scene->question->description}}<br>
			<h4>Submitted options</h4>
		@foreach($optionIds as $value)
			Value {{$value}}<br>
			@endforeach
			<h4>Answer options with values</h4>
		@foreach($answerOptionValues as $key=>$options)
			AnswerId:{{$key}}<br>
			@foreach($options as $key=>$value)
				Key:: {{$key}} => Value {{$value}}<br>
			@endforeach
		@endforeach
			<h3>Assessment</h3>
		@foreach( $scene->question->sections as $section)
			<h1>{{$section->name}}</h1> :: {{$section->description}}<hr>
			@foreach($section->selects as $select)
			{{$select->name}}
			<ul>
			   @foreach($select->options as $option)
					<li> {{$option->label}} // {{$option->id}} // score::
						{{in_array($option->id, $optionIds)?'Chosen':''}}
						@foreach($answerOptionValues as $key=>$options)
							@foreach($options as $key=>$value)
								@if ($key != $option->id)
									@continue;
								@endif
									Possible Score [{{$value}}] ::
								Score:: {{in_array($option->id, $optionIds)?$value:'0'}}
							@endforeach
						@endforeach

					</li>
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
								<li> 'value'='{{$option->value}}' {{$option->label}}  </li>
							@endforeach
						</ul>
				@endforeach
				</ul>
			@endforeach
			<hr>
		@endforeach

		<h3>Score</h3>
		Submission score for each possible Answer set.
		@foreach( $score as $key=>$value)
			Score for answer set {{$key}} is {{$value}}<br>
	@endforeach
@endsection