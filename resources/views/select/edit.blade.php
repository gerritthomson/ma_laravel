@extends('layouts.app')

@section('content')
    <!-- Create Task Form... -->
	{{$select->name}}<br>

		<form method="post">
			@method('PUT')
			@csrf
			Name:<input type="text" name="name" value="{{$select->name}}"><br>
			<input type="hidden" name="allowsMultiple" value="0">
			Allow Multiple [{{$select->allowsMultiple}}]? <input type="checkbox" name="allowsMultiple" value="1" <?php echo ($select->allowsMultiple == 1?'checked="checked"':'');?> ><br>
			<ul>
			   @foreach($select->options as $option)
					<li> {{$option->label}} // {{$option->id}} // {{$option->value}} :: keep::
						<input type="checkbox" name="option[{{$option->id}}]" checked="checked"></li>
				@endforeach
			</ul>
			New :: <input type="text" name="newOption"><br>
			<hr>
			<input type="submit" value="Update">

		</form>
	
@endsection