@extends('layouts.master')

@section('content')
	{{-- table --}}
	<div class="col-lg-12">
		<div class="card">
			<h2 class="text-center mt-5"> Data Kereta Api</h2>
			<div class="card-body">
				<a href="javascript:void(0)" class="btn btn-icons btn-primary btn-sm mb-3 ml-3" id="createNewData">
					<i class="mdi mdi-plus"></i>
				</a>
				<div class="container">
					<table id="data" class="table table-hover text-center data-table">
						<thead class="thead-dark">
							<tr>
								<th width="5%">No</th>
								<th>Nama Kereta</th>
								<th>Kode</th>
								<th>Harga</th>
								<th>Status</th>
								<th width="20%">Action</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
	{{-- end table --}}

	{{-- modal form --}}
	<div class="modal fade" id="ajaxModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<h4 class="modal-header" id="modalHeading"></h4>
				<div class="modal-body">
					<form id="FormData" name="FormData" class="form-horizontal">
						<input type="hidden" id="id_kereta" name="id_kereta">
						<div class="form-group">
							<label for="nama_kereta" class="col-sm-5">Nama Kereta</label>
							<div class="col-sm-12">
								<input type="text" name="nama_kereta" id="nama_kereta" placeholder="Nama Kereta" class="form-control" required="true">
							</div>
						</div>
						<div class="form-group">
							<label for="Partner" class="col-sm-5 control-label">Partner</label>
							<div class="col-sm-12">
								<input type="text" name="partner" id="partner" value="Kereta Api" class="form-control" required="true" readonly="true">
							</div>
						</div>	
						<div class="form-group">
							<label for="kode_kereta" class="col-sm-5 control-label">Kode Kereta</label>
							<div class="col-sm-12">
								<input type="text" name="kode_kereta" id="kode_kereta" placeholder="Kode Pesawat" class="form-control" required="true">
							</div>
						</div>
						<div class="form-group">
							<label for="harga" class="col-sm-5 control-label">Harga</label>
							<div class="col-sm-12">
								<input type="number" name="harga" id="harga" placeholder="Harga" class="form-control" required="true">
							</div>
						</div>
						<div class="form-group">
							<label for="kursi_ekonomi" class="col-sm-5 control-label">Kursi Ekonomi</label>
							<div class="col-sm-12">
								<input type="number" name="kursi_ekonomi" id="kursi_ekonomi" placeholder="Kursi ekonomi" class="form-control" required="true">
							</div>
						</div>
						<div class="form-group">
							<label for="kursi_bisnis" class="col-sm-5 control-label">Kursi bisnis</label>
							<div class="col-sm-12">
								<input type="number" name="kursi_bisnis" id="kursi_bisnis" placeholder="Kursi bisnis" class="form-control" required="true">
							</div>
						</div>
						<div class="form-group">
							<label for="kursi_vip" class="col-sm-5 control-label">Kursi Vip</label>
							<div class="col-sm-12">
								<input type="number" name="kursi_vip" id="kursi_vip" placeholder="Kursi vip" class="form-control" required="true">
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
				$('#id_town').val('');
				$('#FormData').trigger("reset");
				$('#modalHeading').html("Tambah Kereta");
			});

			var table = $('.data-table').DataTable({
				processing: true,
				serverSide: true,
				ajax: "{{ route('data_kereta.index') }}",
				columns: [
					{
						data: 'DT_RowIndex', 
						name: 'DT_RowIndex'
					},
					{
						data: 'nama_kereta',
						name: 'nama_kereta'
					},
					{
						data: 'kode_kereta', 
						name: 'kode_kereta'
					},
					{
						data: 'harga', 
						name: 'harga',
						render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' )
					},
					{
						data: 'status', 
						name: 'status'
					},
					{
						data: 'action', 
						name: 'action', 
						orderable: false, 
						searchable: false
					},
				]
			});


			$('#saveBtn').click(function(e){
				e.preventDefault();
				// var str = $('#FormData').serialize();
				// console.log(str);

				$.ajax({
					data: $('#FormData').serialize(),
					url: "{{ route('data_kereta.store') }}",
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

			$('body').on('click', '.editKereta', function() {
		      var id_kereta = $(this).data('id');
		      $.get("{{ route('data_kereta.index') }}" +'/' + id_kereta +'/edit', function (data) {
		      	console.log(data);
		          $('#modalHeading').html("Edit kereta");
		          $('#saveBtn').val("edit-user");
		          $('#ajaxModal').modal('show');
		          $('#id_kereta').val(data.id);
		          $('#nama_kereta').val(data.nama_kereta);
		          $('#kode_kereta').val(data.kode_kereta);
		          $('#harga').val(data.harga);
		          $('#kursi_ekonomi').val(data.kursi_ekonomi);
		          $('#kursi_bisnis').val(data.kursi_bisnis);
		          $('#kursi_vip').val(data.kursi_vip);
		          $('#status').val(data.status);
		      })
		   });

			$('body').on('click', '.deleteKereta', function(){
				var id_kereta = $(this).data("id");

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
								url: "{{ route('data_kereta.store') }}" +'/'+id_kereta,
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