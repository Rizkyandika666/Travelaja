@extends('layouts.master')

@section('content')
	
	{{-- table --}}
	<div class="col-lg-12">
		<div class="card">
			<h2 class="text-center mt-5">Jadwal Rute</h2>
			<div class="card-body">
				<a href="javascript:void(0)" class="btn btn-icons btn-primary btn-sm mb-3 ml-3 text-center" id="createNewData">
					<i class="mdi mdi-plus"></i>
				</a>
				<div class="container">
					<table id="data" class="table table-hover text-center data-table">
						<thead class="thead-dark">
							<tr>
								<th width="5%">No</th>
								<th>Transportasi</th>
								<th>Rute Awal</th>
								<th>Rute Akhir</th>
								<th>Berangkat</th>
								<th>Pulang</th>
								<th width="20%">Action</th>
							</tr>
						</thead>
						<tbody>
							{{-- {{ $towns }} --}}
							{{-- {{ $partners }} --}}
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	{{-- table --}}

	{{-- modal form --}}
	<div class="modal fade" id="ajaxModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modaHeading"></h4>
				</div>
				<div class="modal-body">

					@if ($errors->any())
					    <div class="alert alert-danger">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif
					<form id="FormData" name="FormData" class="form-horizontal">
						<input type="hidden" name="id_rute" id="id_rute">
						<div class="form-group">
							<label for="transportasi" class="col-sm-5 control-label">Transportasi</label>
							<div class="col-sm-12">
								<select id="transportasi" name="transportasi" class="form-control">
									<option>Pilih Transportasi</option>
									@foreach($partners as $partner)
										<option value="{{ $partner->nama }}" >{{ $partner->nama }}</option>
									@endforeach
								</select>
								<p class="text-danger" id="transportasiError"></p>
							</div>
						</div>
						<div class="form-group">
							<label for="asal" class="col-sm-5 control-label">Asal</label>
							<div class="col-sm-12">
								<select id="asal" name="asal" class="form-control">
									<option>Pilih Bandara</option>
									@foreach($airports as $airport)
										<option value="{{ $airport->nama_bandara }}" >{{ $airport->nama_bandara }}</option>
									@endforeach
								</select>
								<p class="text-danger" id="asalError"></p>
							</div>
						</div>
						<div class="form-group">
							<label for="tujuan" class="col-sm-5 control-label">Tujuan</label>
							<div class="col-sm-12">
								<select id="tujuan" name="tujuan" class="form-control">
									<option value="" >Pilih Bandara</option>
									@foreach($airports as $airport)
										<option value="{{ $airport->nama_bandara }}" >{{ $airport->nama_bandara }}</option>
									@endforeach
								</select>
								<p class="text-danger" id="tujuanError"></p>
							</div>
						</div>
						<div class="form-group">
							<label for="jalur" class="col-sm-5 control-label">Jalur</label>
							<div class="col-sm-12">
								<select id="jalur" name="jalur" class="form-control" onchange="pulang()">
									<option value="one way" id="one_way">One Way</option>
									<option value="two way" id="two_way"  >Two Way</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="berangkat" class="col-sm-5 control-label">Berangkat</label>
							<label for="pulang" class="col-sm-5 control-label label-pulang" style="display: none;">Pulang</label>
							<div class="row ml-1" class="form-control" id="tes">
								<div class="col-sm-5">
									<input type="date" name="berangkat" id="berangkat" class="form-control" placeholder="Berangkat" required="true">
									<p class="text-danger" id="berangkatError"></p>
								</div>
								<div class="col-sm-5" id="inpPulang">
									{{-- <input type="date" name="pulang" id="pulang" class="form-control" placeholder="Berangkat" required="true"> --}}
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="durasi" class="col-sm-5 control-label">Durasi</label>
							<div class="col-sm-12">
								<input type="text" name="durasi" id="durasi" class="form-control" placeholder="exm 2h 30m" required="true">
								<p class="text-danger" id="durasiError"></p>
							</div>
						</div>
						<div class="mr-3 text-right">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary" id="saveBtn" value="create">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	{{-- modal form --}}

	@section('script')
		<script type="text/javascript">

			$('#transportasiError').addClass("d-none");
			$('#asalError').addClass("d-none");
			$('#tujuanError').addClass("d-none");
			$('#durasiError').addClass("d-none");
			$('#berangkatError').addClass("d-none");
			$('#tujuanError').addClass("d-none");

				$(function(){
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
				});
			
			$('#createNewData').click(function(){
				$('#ajaxModal').modal('show');
				$('#modaHeading').html('Tambah Jadwal');
				$('#FormData')[0].reset();
			});

			var table = $('.data-table').DataTable({
				processing: true,
				serverSide: true,
				ajax: "{{ route('rute_pesawat.index') }}",
				columns: [
					{data: 'DT_RowIndex', name: 'DT_RowIndex'},
					{data: 'transportasi', name: 'transportasi'},
					{data: 'asal', name: 'asal'},
					{data: 'tujuan', name: 'tujuan'},
					{data: 'berangkat', name: 'berangkat'},
					{data: 'pulang', name: 'pulang'},
					{data: 'action', name: 'action', orderable: false, searchable: false},
				]
			});

			$('#saveBtn').click(function(e){
				e.preventDefault();
				// var str = $('#FormData').serialize();
				// console.log(str);

				$.ajax({
					data: $('#FormData').serialize(),
					url: "{{ route('rute_pesawat.store') }}",
					type: 'POST',
					dataType: 'json',
					success: function(data){
						$('#FormData').trigger("reset");
						$('#ajaxModal').modal('hide');
						table.draw();
						swal({
							title: "Data Berhasil Disimpan",
							icon: "success",
						});
					},
					error: function(data){
						// console.log('Error:' ,data);
						var errors = data.responseJSON;
						console.log(errors);
						if($.isEmptyObject(errors) == false){
							$.each(errors.errors, function(key, value){
								var errorId = '#' + key + 'Error';
								$(errorId).removeClass("d-none");
								$(errorId).text(value);
							})
						}
					}
				});
			});

			$('body').on('click', '.editRute', function(){
				var id_rute = $(this).data('id');
				$.get("{{ route('rute_pesawat.index') }}" +'/' + id_rute +'/edit', function(data){
					console.log(data);
					$('#modaHeading').html("Edit Rute");
					$('#saveBtn').val("edit-rute");
					$('#ajaxModal').modal('show');
					$('#id_rute').val(data.id);
					$('#transportasi').val(data.transportasi);
					$('#asal').val(data.asal);
					$('#tujuan').val(data.tujuan);
					$('#jalur').val(data.jalur);
					$('#berangkat').val(data.berangkat);
					$('#pulang').val(data.pulang);
					$('#durasi').val(data.durasi);
				});
			});

			$('body').on('click', '.deleteRute', function(){
				var id_rute = $(this).data("id");

				swal({
					title: "Anda Yakin ?",
					text: "Untuk hapus data",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
					.then((willDelete) => {
						if(willDelete){
							$.ajax({
								type: "DELETE",
								url: "{{ route('rute_pesawat.store') }}" +'/'+id_rute,
								success:function(data){
									table.draw();
								},
								error: function(data){
									console.log('Error:', data);
								}
							});
							swal("Data berhasil dihapus", {
								icon: "success",
							});
						}else{
							swal("Data Gagal dihapus", {
								icon: "error",
							});
						}
					});

				});

			function pulang(){
				var oneWay = $('#one_way').val();
				var TwoWay = $('#two_way').val();

				if(TwoWay){
					var html = 	'<input type="date" name="pulang" id="pulang" class="form-control" placeholder="Pulang" required="true">';
					$('#inpPulang').append(html);
					$('.label-pulang').css('display', '');
				}else{
					var html = 	$('#berangkat').remove();
					// $('#inpPulang').remove(html);
					$('.label-pulang').css('display', 'none');
				}

			}

			// $('#jalur').change(function(){
			// 		var html = 	'<input type="date" name="berangkat" id="berangkat" class="form-control" placeholder="Berangkat" required="true">';
			// 	$('#inpPulang').append(html);
			// 	$('.label-pulang').css('display', '');
			// });
		</script>
	@endsection
@endsection