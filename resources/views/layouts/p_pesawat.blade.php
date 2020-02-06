@extends('layouts.master')

@section('content')
	{{-- table --}}
	<div class="col-lg-12">
		<div class="card">
			<h2 class="text-center mt-5">Data Pesawat</h2>
			<div class="card-body">
				<a href="javascript:void(0)" class="btn btn-icons btn-primary btn-sm mb-3 ml-3" id="createNewData">
					<i class="mdi mdi-plus"></i>
				</a>
				<div class="container">
					<table id="data" class="table table-hover text-center data-table">
						<thead class="thead-dark">
							<tr>
								<th width="5%">No</th>
								<th>Nama Pesawat</th>
								<th>Kode</th>
								<th>Harga</th>
								<th>Status</th>
								<th width="20%">Action</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	{{-- end of table --}}

	{{-- modal form --}}
	<div class="modal fade" id="ajaxModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modalHeading"></h4>
				</div>
				<div class="modal-body">
					<form id="FormData" name="FormData" class="form-horizontal">
						<input type="hidden" name="id_pesawat" id="id_pesawat">
						<div class="form-group">
							<label for="nama_pesawat" class="col-sm-5 control-label">Nama Pesawat</label>
							<div class="col-sm-12">
								<input type="text" name="nama_pesawat" id="nama_pesawat" placeholder="Nama Pesawat" class="form-control" required="true">
							</div>
						</div>
						<div class="form-group">
							<label for="partner" class="col-sm-5 control-label">Partner</label>
							<div class="col-sm-12">
								<input type="text" name="partner" id="partner" value="Maskapai" class="form-control" required="true" readonly="true">
							</div>
						</div>
						<div class="form-group">
							<label for="kode_pesawat" class="col-sm-5 control-label">Kode Pesawat</label>
							<div class="col-sm-12">
								<input type="text" name="kode_pesawat" id="kode_pesawat" placeholder="Kode Pesawat" class="form-control" required="true">
							</div>
						</div>
						<div class="form-group">
							<label for="harga" class="col-sm-5 control-label">Harga</label>
							<div class="col-sm-12">
								<input type="text" name="harga" id="harga" placeholder="Harga" class="form-control" required="true">
							</div>
						</div>
						<div class="form-group">
							<label for="kursi_ekonomi" class="col-sm-5 control-label">Kursi Ekonomi</label>
							<div class="col-sm-12">
								<input type="text" name="kursi_ekonomi" id="kursi_ekonomi" placeholder="Kursi ekonomi" class="form-control" required="true">
							</div>
						</div>
						<div class="form-group">
							<label for="kursi_bisnis" class="col-sm-5 control-label">Kursi bisnis</label>
							<div class="col-sm-12">
								<input type="text" name="kursi_bisnis" id="kursi_bisnis" placeholder="Kursi bisnis" class="form-control" required="true">
							</div>
						</div>
						<div class="form-group">
							<label for="kursi_vip" class="col-sm-5 control-label">Kursi Vip</label>
							<div class="col-sm-12">
								<input type="text" name="kursi_vip" id="kursi_vip" placeholder="Kursi vip" class="form-control" required="true">
							</div>
						</div>
						<div class="form-group">
							<label for="status" class="col-sm-5 control-label">Status</label>
							<div class="col-sm-12">
								<select id="status" name="status" class="form-control">
									<option>Pilih Status</option>
									<option value="aktif">Aktif</option>
									<option value="nonaktif">Non Aktif</option>
								</select>
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
	{{-- end modal form --}}
	@section('script')
		<script type="text/javascript">
			$(function(){
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
			});


			$('#createNewData').click(function(){
				$('#ajaxModal').modal('show');
				$('#modalHeading').html("Tambah Pesawat");
			});

			var table = $('.data-table').DataTable({
				processing: true,
				serverSide: true,
				ajax: "{{ route('data_pesawat.index') }}",
				columns: [
					{data: 'DT_RowIndex', name: 'DT_RowIndex'},
					{data: 'nama_pesawat', name: 'nama_pesawat'},
					{data: 'kode_pesawat', name: 'kode_pesawat'},
					{
						data: 'harga', 
						name: 'harga',
						render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' )
					},
					{data: 'status', name: 'status'},
					{data: 'action', name: 'action', orderable: false, searchable: false},
				]
			});

			$('#saveBtn').click(function(e){
				e.preventDefault();
				// var str = $('#FormData').serialize();
				// console.log(str);

				$.ajax({
					data: $('#FormData').serialize(),
					url: "{{ route('data_pesawat.store') }}",
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
						console.log('Error:' ,data);
						$('#saveBtn').html('Simpan');
					}
				});
			});

			$('body').on('click', '.editPesawat', function() {
		      var id_pesawat = $(this).data('id');
		      $.get("{{ route('data_pesawat.index') }}" +'/' + id_pesawat +'/edit', function (data) {
		      	// console.log(data);
		          $('#modalHeading').html("Edit Pesawat");
		          $('#saveBtn').val("edit-user");
		          $('#ajaxModal').modal('show');
		          $('#id_pesawat').val(data.id);
		          $('#nama_pesawat').val(data.nama_pesawat);
		          $('#kode_pesawat').val(data.kode_pesawat);
		          $('#harga').val(data.harga);
		          $('#kursi_ekonomi').val(data.kursi_ekonomi);
		          $('#kursi_bisnis').val(data.kursi_bisnis);
		          $('#kursi_vip').val(data.kursi_vip);
		          $('#status').val(data.status);
		      })
		   });

			$('body').on('click', '.deletePesawat', function(){
				var id_bandara = $(this).data("id");

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
								url: "{{ route('data_pesawat.store') }}" +'/'+id_bandara,
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
								icon: "success",
							});
						}
					});

				});
		</script>
	@endsection
@endsection