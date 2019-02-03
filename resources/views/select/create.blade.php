@extends('layouts.app')

@section('content')
    <!-- Create Select Form... -->

		<form method="post">
			@csrf
			Name:<input type="text" name="name" value=""><br>
			<input type="hidden" name="allowsMultiple" value="0">
			Allow Multiple ? <input type="checkbox" name="allowsMultiple" value="1"><br>
			<hr>
			<input type="submit" value="Create">

		</form>
	
@endsection