@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">Create a Video</div>

					<div class="card-body">
						<div class="content">
							<!-- Create Select Form... -->
								<form method="post">
									@csrf
									Description:<input type="text" name="title" value="" size="80%"><br>
									Source URL:<input type="text"
													  id="location"
													  name="location" value="" size="80%"
									>
									<input type="button" onclick="player.loadVideoByUrl(document.getElementById('location').value);"
										   value="Peview">
									<hr>
									<input type="submit" value="Create">

								</form>
						</div>
					</div>
				</div>
				<div id="player"></div>

			</div>
		</div>
	</div>
	<script type="application/javascript" src="/js/youtube.js"></script>

@endsection