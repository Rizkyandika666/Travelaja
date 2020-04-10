@extends('layouts.app')
@section('content')
	<div class="container p-5">
		<div class="row">
			<div class="col-md-4">
				<div class="card">
					<div class="card-header bg-primary text-white">
						Kode Pemesanan : AA312
					</div>
					<div class="card-body">
						<ul class="list-group">
							<li class="list-group-item">
								Pemesan : Rizky andika
							</li>
							<li class="list-group-item">
								Tgl pesan : 20-20-2020
							</li>
							<li class="list-group-item">
								Waktu Expire : 09 jam 30 menit
							</li>
							<li class="list-group-item">
								Dari : Bandara soekarno hatta
							</li>
							<li class="list-group-item">
								Ke : Bandara Djuanda
							</li>
							<li class="list-group-item">
								Total : Rp.600.000
							</li>
						</ul>
					</div>
					<div class="card-footer text-muted">
					   	<a href="{{ url('/booking/confirm') }}" class="btn btn-primary float-right ml-2">
					   		<i class="fas fa-money-bill mr-2"></i> Bayar
					   	</a>
					   	<button class="btn btn-danger float-right">
							<i class="fas fa-times mr-2"></i> Cancel
					   	</button>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection