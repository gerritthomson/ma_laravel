@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">Create a Question Format</div>

					<div class="card-body">
						<div class="content">
							<!-- Create Select Form... -->
								<form method="post">
									@csrf
									Description:<input type="text" name="description" value=""><br>
									<hr>
									<input type="submit" value="Create">

								</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
@endsection