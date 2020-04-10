@extends('layouts.app')
@section('content')
	<div class="container mt-5 mb-5">
		<div class="card text-center mx-auto p-3"  style="width: 50rem;">
			<h4 class="text-danger">Waktu Expire 9 jam 10 menit</h4>
			<img src="{{ URL::to('/assets/images/bank_bri.png') }}" width="150" class="mx-auto">
			<p>No rekenening : 83912312391</p>
			<p>Total yang harus dibayar : </p>
			<h3>Rp.600.000</h3>
			<hr>
			<h4>Kode Pemesanan : ASD43</h4>	
			<hr>
			<p>Atas nama :</p>
			<h4>TravelAja</h4>
		</div>
	</div>
@endsection