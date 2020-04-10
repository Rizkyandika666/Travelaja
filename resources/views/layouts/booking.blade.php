@extends('layouts.app')
@section('content')
	<div class="container p-5">
		<div class="row mb-5">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header text-center">
						Data Rute
					</div>
					<div class="card-body">
						<ul class="list-group">
							<li class="list-group-item">
						 		 Rute Awal : Ancol - Jakarta 
							</li>
							<li class="list-group-item">
								Rute Akhir : Surabaya
							</li>
							<li class="list-group-item">
								Gerbang : 1
							</li>
							<li class="list-group-item">
								Berangkat : 20-20-2020
							</li>
							<li class="list-group-item">
								Pulang : -
							</li>
							<li class="list-group-item">
								Jumlah Orang : 2 ( Dewasa : 2 Anak : 0 Bayi : 0 )
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header text-center">
						Data Transportasi
					</div>
					<div class="card-body">
						<ul class="list-group">
							<li class="list-group-item">
								<img src="{{ URL::to('/images/105280070.png') }}" width="100"> 
							</li>
							<li class="list-group-item">
								Nama : Boeing 777
							</li>
							<li class="list-group-item">
								Kode : AG667
							</li>
							<li class="list-group-item">
								Deskripsi : Lorem lorem lorem
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						Total Harga
					</div>
					<div class="card-body">
						<ul class="list-group">
							<li class="list-group-item">
								Ekonomi : Rp. 500.000
							</li>
							<li class="list-group-item">
								Rute : Rp.100.000
							</li>
							<li class="list-group-item">
								Total : Rp.600.000
							</li>
						</ul>
					</div>
					<div class="card-body">
						<ul class="list-group">
							<div class="accordion" id="accordionExample">
								<li class="list-group-item">
									<h2 class="mb-0">
						        		<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						          		Bank BRI
						        		</button>
						      		</h2>
						      		<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
							      		<div class="card-body">
							       			<img class="mb-3" src="{{ URL::to('/assets/images/bank_bri.png') }}" width="100">
							       			<div class="form-radio">
				                            	<label class="form-check-label">
				                            		<input type="radio" name="" id="" class="form-check-input">
				                            		BRI
				                            		<i class="input-helper"></i>
				                            	</label>
				                            </div>
				                            <p>Atas Nama : Rizky andika</p>
				                            <p>No rekenening : 83912312391</p>
							      		</div>
							    	</div>
								</li>
								<li class="list-group-item">
									<h2 class="mb-0">
										<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
											Bank BCA
										</button>
									</h2>
									<div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
										<div class="card-body">
											<img class="mb-3" src="{{ URL::to('/assets/images/bank_bca.png') }}" width="100">
											<div class="form-radio">
												<label class="form-check-label">
													<input type="radio" name="" id="" class="form-check-input">
													BCA
													<i class="input-helper"></i>
												</label>
											</div>
											<p>Atas Nama : Rizky andika</p>
				                            <p>No rekenening : 83912312391</p>
										</div>
									</div>	
								</li>
								<li class="list-group-item">
									<h2 class="mb-0">
										<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
											Bank Mandiri
										</button>
									</h2>
									<div id="collapseThree" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
										<div class="card-body">
											<img class="mb-3" src="{{ URL::to('/assets/images/bank_mandiri.png') }}" width="100">
											<div class="form-radio">
												<label class="form-check-label">
													<input type="radio" name="" id="" class="form-check-input">
													Mandiri
													<i class="input-helper"></i>
												</label>
											</div>
											<p>Atas Nama : Rizky andika</p>
				                            <p>No rekenening : 83912312391</p>
										</div>
									</div>	
								</li>
								<li class="list-group-item">
									<h2 class="mb-0">
										<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
											Bank Paypal
										</button>
									</h2>
									<div id="collapseFour" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
										<div class="card-body">
											<img class="mb-3" src="{{ URL::to('/assets/images/paypal.svg') }}" width="100">
											<div class="form-radio">
												<label class="form-check-label">
													<input type="radio" name="" id="" class="form-check-input">
													Paypal
													<i class="input-helper"></i>
												</label>
											</div>
											<p>Atas Nama : Rizky andika</p>
				                            <p>No rekenening : 83912312391</p>
										</div>
									</div>	
								</li>
							</div>
						</ul>
						<a href="{{ url('/booking/isFixed') }}" class="btn btn-primary float-right mt-3">
							<i class="fas fa-ticket-alt mr-1"></i>Pesan
						</a>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						Data Penumpang
					</div>
					<div class="card-body">
						<form>
							<div class="form-group">
							    <label for="Penumpang 1">Penumpang 1</label>
							    <input type="text" class="form-control" id="penumpang">
							</div>
							<div class="form-group">
							    <label for="Penumpang 1">Penumpang 1</label>
							    <input type="text" class="form-control" id="penumpang">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
