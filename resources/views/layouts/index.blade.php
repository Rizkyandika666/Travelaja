@extends('layouts.app')

@section('content')
	<div  id="landing" class="container-fluid">
		<div class="container ml-5 position-absolute">
			<div id="card_search" class="card ">
			  <div class="card-body">
			    <h4 class="mb-5">Cari Tiketmu disini</h4>
			    <ul class="nav nav-tabs text-dark" id="myTab" role="tablist">
			    	<li class="nav-item">
			    		<a href="#pesawat" class="nav-link active" id="home-tab" data-toggle="tab" aria-controls="home" aria-selected="true" >
			    			<i class="fas fa-plane"></i> Pesawat
			    		</a>
			    	</li>
			    	<li class="nav-item">
			    		<a href="#kereta" class="nav-link text-dark" id="home-tab" data-toggle="tab" aria-controls="home" aria-selected="false" >
			    			<i class="fas fa-train"></i> Kereta Api
			    		</a>
			    	</li>
			    </ul>
			    <div class="tab-content" id="myTabContent">
			    	<div class="tab-pane fade show active" id="pesawat" role="tab-panel" aria-labelledby="pesawat-tab">
			    		<form>
					    	<div class="container p-2">
					    		<div class="row mt-4 mb-3 justify-content-center">
						    		<div class="col-md-3">
						    			<div class="form-group">
								    		<label>
								    			<i class="fas fa-map-marker-alt mr-2"></i>Asal
								    		</label>
								    		<select class="form-control form-control-sm">
											  <option>Pilih Kota</option>
											</select>
								    	</div>	
						    		</div>	
						    		<div class="col-md-3">
						    			<div class="form-group">
								    		<label>
								    			<i class="fas fa-map-marker-alt mr-2"></i>Tujuan
								    		</label>
								    		<select class="form-control form-control-sm">
											  <option>Pilih Kota</option>
											</select>
								    	</div>	
						    		</div>	
						    		<div class="col-md-3">
						    			<div class="form-group">
								    		<label>
								    			<i class="fas fa-star mr-2"></i>Kelas
								    		</label>
								    		<select class="form-control form-control-sm">
											  <option>Ekonomi</option>
											</select>
								    	</div>	
						    		</div>	
						    	</div>
						    	<div class="row justify-content-center">
						    		<div class="col-md-3">
						    			<div class="form-group">
								    		<label>
								    			<i class="fas fa-calendar-alt mr-2"></i>Pegi
								    		</label>
								    		<input type="date" name="pergi" id="pergi" class="form-control form-control-sm">
								    	</div>	
						    		</div>	
						    		<div class="col-md-3">
						    			<div class="form-group">
								    		<label>
								    			<i class="fas fa-calendar-alt mr-2"></i>Pulang
								    		</label>
								    		<input type="date" name="pulang" id="pulang" class="form-control form-control-sm">
								    	</div>	
						    		</div>	
						    		<div class="col-md-3">
						    			<div class="row">
						    				<div class="col-md-4">
								    			<div class="form-group">
										    		<label>Dewasa</label>
										    		<select class="form-control form-control-sm">
													  <option>1</option>
													</select>
										    	</div>	
						    				</div>
						    				<div class="col-md-4">
								    			<div class="form-group">
										    		<label>Anak</label>
										    		<select class="form-control form-control-sm">
													  <option>1</option>
													</select>
										    	</div>	
						    				</div>
						    				<div class="col-md-4">
								    			<div class="form-group">
										    		<label>Bayi</label>
										    		<select class="form-control form-control-sm">
													  <option>1</option>
													</select>
										    	</div>	
						    				</div>
						    			</div>
						    		</div>	
						    	</div>
					    	<a href="{{ url('/find_rute') }}" id="my_btn" class="btn btn-primary mt-3 float-right">
					    		Cari Tiket <i class="fa fa-search ml-1"></i>
					    	</a>
					    	</div>
					    </form>
			    	</div>
			    	<div class="tab-pane fade" id="kereta" role="tab-panel" aria-labelledby="kereta-tab">
			    		<form>
					    	<div class="container p-2">
					    		<div class="row mt-4 mb-3 justify-content-center">
						    		<div class="col-md-3">
						    			<div class="form-group">
								    		<label>
								    			<i class="fas fa-map-marker-alt mr-2"></i>Asal
								    		</label>
								    		<select class="form-control form-control-sm">
											  <option>Pilih Kota</option>
											</select>
								    	</div>	
						    		</div>	
						    		<div class="col-md-3">
						    			<div class="form-group">
								    		<label>
								    			<i class="fas fa-map-marker-alt mr-2"></i>Tujuan
								    		</label>
								    		<select class="form-control form-control-sm">
											  <option>Pilih Kota</option>
											</select>
								    	</div>	
						    		</div>	
						    		<div class="col-md-3">
						    			<div class="form-group">
								    		<label>
								    			<i class="fas fa-star mr-2"></i>Kelas
								    		</label>
								    		<select class="form-control form-control-sm">
											  <option>Ekonomi</option>
											</select>
								    	</div>	
						    		</div>	
						    	</div>
						    	<div class="row justify-content-center">
						    		<div class="col-md-3">
						    			<div class="form-group">
								    		<label>
								    			<i class="fas fa-calendar-alt mr-2"></i>Pegi
								    		</label>
								    		<input type="date" name="pergi" id="pergi" class="form-control form-control-sm">
								    	</div>	
						    		</div>	
						    		<div class="col-md-3">
						    			<div class="form-group">
								    		<label>
								    			<i class="fas fa-calendar-alt mr-2"></i>Pulang
								    		</label>
								    		<input type="date" name="pulang" id="pulang" class="form-control form-control-sm">
								    	</div>	
						    		</div>	
						    		<div class="col-md-3">
						    			<div class="row">
						    				<div class="col-md-4">
								    			<div class="form-group">
										    		<label>Dewasa</label>
										    		<select class="form-control form-control-sm">
													  <option>1</option>
													</select>
										    	</div>	
						    				</div>
						    				<div class="col-md-4">
								    			<div class="form-group">
										    		<label>Anak</label>
										    		<select class="form-control form-control-sm">
													  <option>1</option>
													</select>
										    	</div>	
						    				</div>
						    				<div class="col-md-4">
								    			<div class="form-group">
										    		<label>Bayi</label>
										    		<select class="form-control form-control-sm">
													  <option>1</option>
													</select>
										    	</div>	
						    				</div>
						    			</div>
						    		</div>	
						    	</div>
					    	<button id="btn_search" class="btn btn-primary mt-3 float-right">
					    		Cari Tiket <i class="fa fa-search ml-1"></i>
					    	</button>
					    	</div>
					    </form>
			    	</div>
			    </div>
			  </div>
			</div>
		</div>
	</div>
	<div id="fitur" class="container mt-5 p-5 text-center justify-content-center">
		<h3>Kemudahan TravelAja</h3>
		<div class="row mt-5 pt-5">
			<div class="col-md-4">
				<img class="mb-5" src="{{ URL::to('/assets/images/icon_order.png') }}" width="200">
				<h4 class="font-weight-bold">Mudah Pemesanan</h4>
				<p class="text-muted p-3">
					Dengan TravelAja proses pemesanan tiket pesawat maupun kereta api bisa lebih mudah dan efesien waktu
				</p>
			</div>
			<div class="col-md-4">
				<img class="mb-5" src="{{ URL::to('/assets/images/icon_mail.png') }}" width="150">
				<h4 class="font-weight-bold">Cepat</h4>
				<p class="text-muted p-3">
					Dengan TravelAja cepat dalam memproses tiket pesanan anda sehingga waktu lebih efektif dan tinggal menunggu tiket di kirim ke email anda
				</p>
			</div>
			<div class="col-md-4">
				<img class="mb-5" src="{{ URL::to('/assets/images/icon_choice.png') }}" width="200">
				<h4 class="font-weight-bold">Banyak Pilihan</h4>
				<p class="text-muted p-3">
					TravelAja menyediakan berbagai macam pilihan tiket mulai harga terendah hingga tertinggi sesuai dengan kategori yang dipilih
				</p>
			</div>
		</div>
	</div>
	<div class="container-fluid" id="partner">
		<div class="container p-5 mt-5">
			<div class="row">
				<div class="col-md-6">
					<h3 class="mb-5">Partner TravelAja</h3>
					<p class="text-muted mb-4">
						TravelAja berkerja sama dengan berbagai penyedia jasa transportasi dan penyedia pembayaran via bank atau transfer sehingga liburanmu selalu nyaman dan menyenangkan
					</p>
					<button class="btn btn-primary p-2">Selengkapnya</button>
				</div>
				<div class="col-md-6 text-center">
					<img src="{{ URL::to('assets/images/icon_partner.png') }}" width="300">
				</div>
			</div>
		</div>
	</div>
	<div class="container text-center mt-5 mb-5 p-5">
		<h3>Destinasi Terlaris</h3>
		<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex</p>
		<div class="row mt-5">
			<div class="col-md-4">
				<div class="card" style="width: 253px">
					<img src="{{ URL::to('assets/images/bali.jpg') }}" alt="..." class=" float-left" style="width: 250px; height: 250px;">
					<div class="card-img-overlay  bg-card text-sm-left">
						<p class="text-white text-bottom align-bottom">Kota Bali</p>
						<p class="text-white">lorem lorem lorem</p>    
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card" style="width: 253px">
					<img src="{{ URL::to('assets/images/bali.jpg') }}" alt="..." class=" float-left" style="width: 250px; height: 250px;">
					<div class="card-img-overlay  bg-card text-sm-left">
						<p class="text-white text-bottom align-bottom">Kota Bali</p>
						<p class="text-white">lorem lorem lorem</p>    
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card" style="width: 253px">
					<img src="{{ URL::to('assets/images/bali.jpg') }}" alt="..." class=" float-left" style="width: 250px; height: 250px;">
					<div class="card-img-overlay  bg-card text-sm-left">
						<p class="text-white text-bottom align-bottom">Kota Bali</p>
						<p class="text-white">lorem lorem lorem</p>    
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col-md-4">
				<div class="card" style="width: 253px">
					<img src="{{ URL::to('assets/images/bali.jpg') }}" alt="..." class=" float-left" style="width: 250px; height: 250px;">
					<div class="card-img-overlay  bg-card text-sm-left">
						<p class="text-white text-bottom align-bottom">Kota Bali</p>
						<p class="text-white">lorem lorem lorem</p>    
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card" style="width: 253px">
					<img src="{{ URL::to('assets/images/bali.jpg') }}" alt="..." class=" float-left" style="width: 250px; height: 250px;">
					<div class="card-img-overlay  bg-card text-sm-left">
						<p class="text-white text-bottom align-bottom">Kota Bali</p>
						<p class="text-white">lorem lorem lorem</p>    
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card" style="width: 253px">
					<img src="{{ URL::to('assets/images/bali.jpg') }}" alt="..." class=" float-left" style="width: 250px; height: 250px;">
					<div class="card-img-overlay  bg-card text-sm-left">
						<p class="text-white text-bottom align-bottom">Kota Bali</p>
						<p class="text-white">lorem lorem lorem</p>    
					</div>
				</div>
			</div>
		</div>
	</div>
	{{-- <div id="footer" class="container-fluid bg-primary text-white p-5">
		<div class="container">
			<div class="row">
				<div class="col-md-5">
					<h3>TravelAja</h3>
					<p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit ess</p>
				</div>
				<div class="col-md-7">
					<div class="container">
						<div class="row">
							<div class="col-md-2">
								<h4>Travel</h4>
								<p class="text-white">lorem lorem</p>
								<p class="text-white">lorem lorem</p>
							</div>
							<div class="col-md-6">
								<h4>Travel</h4>
								<p class="text-white">lorem lorem</p>
								<p class="text-white">lorem lorem</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<p class="text-center text-white mt-5">Copyright @2020 by Rizky Andika XII-RPL</p>
		</div>
	</div> --}}
@endsection