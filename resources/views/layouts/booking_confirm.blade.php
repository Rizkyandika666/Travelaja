@extends('layouts.app')
@section('content')
	<div class="container p-5">
		<div class="card mx-auto" style="width: 30rem;">
			<div class="card-header">Konfirmasi Pembayaran</div>
			<div class="card-body">
				<div class="form-group">
					<label>Kode Pemesanan</label>
					<input type="text" class="form-control" name="" id="" value="AA123" disabled="true">
				</div>
				<div class="form-group">
					<label>Nama Pemesan</label>
					<input type="text" class="form-control" name="" id="" value="">
				</div>
				<div class="form-group">
					<label>No rekening</label>
					<input type="text" class="form-control" name="" id="">
				</div>
				<div class="form-group">
					<label>Jumlah uang</label>
					<input type="text" class="form-control" name="" id="">
				</div>
				<div class="form-group">
	                <label>Struk Pembayaran</label>
	                <input type="file" name="img[]" class="file-upload-default">
	                <div class="input-group col-xs-12">
	                  <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
	                  <span class="input-group-append">
	                    <button class="file-upload-browse btn btn-info" type="button">Upload</button>
	                  </span>
	                </div>
	                 <small id="emailHelp" class="form-text text-muted">*Hanya menerima extensi PNG dan JPG</small>
	            </div>
	            <button class="btn btn-primary float-right p-2">Konfirmasi</button>
			</div>
		</div>
	</div>
@endsection