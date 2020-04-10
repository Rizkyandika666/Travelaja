@extends('layouts.app')
@section('content')
	<div class="container p-5">
		<div class="row mb-5">
			<div class="col-md-4">
				<div class="card">
					{{-- <h5 class="card-header"></h5> --}}
					<div class="card-body">
						<h4 class="mb-4">Boeing 700</h4>
						<h5 class="card-title">Jakarta - Surabaya</h5>
						<p class="card-text">30-12-2020</p>
						<p class="card-text text-muted mb-3">Bandara Soekarno Hatta - Bandara Djuanda</p>
						<div class="row">
							<div class="col-md-7">
								<h4 class="text-success">Rp. 1.500.000</h4>
							</div>
							<div class="col-md-5">
								<a href="{{ url('/booking') }}" class="btn btn-primary float-right">
									<i class="fas fa-ticket-alt mr-1"></i> Pesan 
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection