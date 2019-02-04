@extends('layouts.app')

@section('content')
    <!-- Create Task Form... -->
	<div id="box">
		<form method="post">
			@csrf
<div style="width:40%;align:right">
		Question description::{{$question->description}}<br>
		New Section:<input type="text" name="newSection[0]"><br>
		@foreach( $question->sections as $section)
			<h1>{{$section->name}}</h1> :: {{$section->description}}<hr>
			@foreach($section->selects as $select)
				<b>remove:<input type="checkbox" name="removeSelect[{{$select->id}}]" value="yes"></b>
				{{$select->name}}
					<select name='{{$select->name}}' <?php echo ($select->allowsMultiple == 1?'multiple="multiple"':'');?> >
						<option value=''>choose</option>
					   @foreach($select->options as $option)
						  <option value='{{$option->value}}'>{{$option->label}}</option>
					   @endforeach
					</select>
				<br>
			@endforeach
			<b><input type="radio" name="destSection" value="{{$section->id}}">Add select to this section</b><br>
			New Section:<input type="text" name="newSection[{{$section->id}}]"><br>
			@foreach($section->children as $child)
			    <h3>{{$child->name}}</h3> {{$child->description}}<br>
					<b><input type="radio" name="destSection" value="{{$child->id}}">Add select to this section</b><br>
				<ul>
				@foreach($child->selects as $select)
					<li>	<b>remove:</b><input type="checkbox" name="removeSelect[{{$select->id}}]" value="yes">
				{{$select->name}}<select name='{{$select->name}}'>
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
</div>
	<div style="width:40%;align:left">
		<ul>
		@foreach($selects as $select)
			<li><input type="radio" name="selectToUse" value="{{$select->id}}">{{$select->name}}</li>
			@endforeach
		</ul>
	</div>
		<input type="submit" value="Save"><br>
		</form>
	</div>
@endsection