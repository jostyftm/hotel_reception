@extends('layouts.app')

@section('content')
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-transparent">Dashboard</div>

				<div class="card-body">
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif

					You are logged in!
				</div>
			</div>
		</div>
	</div>
@endsection
