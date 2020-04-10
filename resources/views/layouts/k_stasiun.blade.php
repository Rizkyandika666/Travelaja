@extends('layouts.master')
@section('content')
	{{-- table	 --}}
	<div class="col-lg-12 grid-margin stretch-card">
		<div class="card">
			<h2 class="text-center mt-5">Data Stasiun</h2>
			<div class="card-body">
				<a href="javascript:void(0)" class="btn btn-icons btn-primary btn-sm mb-3 ml-3" id="createNewData">
					<i class="mdi mdi-plus"></i>
				</a>
				<div class="container">
					<table id="data" class="table table-hover text-center data-table">
						<thead class="thead-dark">
							<tr>
								<th width="5%">No</th>
								<th>Nama Stasiun</th>
								{{-- <th>Kota</th> --}}
								<th>Kode</th>
								<th>Status</th>
								<th width="25%">Action</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
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
				<div class="modal-header">
					<h4 class="modal-title" id="modelHeading"></h4>
				</div>
				<div class="modal-body">
					<form id="FormData" name="FormData" class="form-horizontal">
						<input type="hidden" name="id_stasiun" id="id_stasiun">
						<div class="form-group">
							<label for="nama_stasiun" class="col-sm-5 control-label">Nama Stasiun</label>
							<div class="col-sm-12">
								<input type="text" class="form-control" name="nama_stasiun" id="nama_stasiun" placeholder="Nama bandara" required="true">
							</div>
						</div>
						<div class="form-group">
							<label for="kota" class="col-sm-5 control-label">Kota</label>
							<div class="col-sm-12">
								<select id="town_id" name="town_id" class="form-control">
									<option>Pilih kota</option>
									@foreach($towns as $town)
										<option value="{{ $town->id }}">{{ $town->nama_kota }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="kode" class="col-sm-5 control-label">Kode Stasiun</label>
							<div class="col-sm-12">
								<input type="text" class="form-control" name="kode" id="kode" placeholder="Kode bandara" required="true">
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
				$('#saveBtn').val("create-stasiun");
				$('#ajaxModal').modal('show');
				$('#FormData').trigger("reset");
				$('#modelHeading').html("Tambah Stasiun");
			});

			var table = $('.data-table').DataTable({
				processing: true,
				serverSide: true,
				ajax: "{{ route('data_stasiun.index') }}",
				columns: [
					{
						data: 'DT_RowIndex',
						name: 'DT_RowIndex'
					},
					{
						data: 'nama_stasiun',
						name: 'nama_stasiun'
					},
					{
						data: 'kode',
						name: 'kode'
					},
					{
						data:'status',
						name:'status'
					},
					{
						data:'action',
						name:'action',
						orderable: false,
						searchable: false
					},
				]
			});

			$('#saveBtn').click(function(e){
				e.preventDefault();

				$.ajax({
					data: $('#FormData').serialize(),
					url: "{{ route('data_stasiun.store') }}",
					type: 'POST',
					dataType: 'json',
					success: function(data){
						$('#FormData').trigger('reset');
						$('#ajaxModal').modal('hide');
						table.draw();
						swal({
							tittle: "Data berhasil disimpan",
							icon: "success",
						});	
					},
					error: function(data){
						console.log('Error:',data);
						$('#saveBtn').html('Simpan')
					}
				});
			});

			$('body').on('click', '.editStasiun', function(){
				var id_stasiun = $(this).data('id');
				$.get("{{ route('data_stasiun.index') }}" +'/' + id_stasiun +'/edit',function(data){
					$('#modelHeading').html("Edit Stasiun");
					$('#saveBtn').val("edit-stasiun");
					$('#ajaxModal').modal('show');
					$('#id_stasiun').val(data.id_stasiun);
					$('#nama_stasiun').val(data.nama_stasiun);
					$('#town_id').val(data.town_id);
					$('#kode').val(data.kode);
					$('#status').val(data.status);
				})
			});

			$('body').on('click', '.deleteStasiun', function(){
				var id_stasiun = $(this).data("id");

				swal({
					title: "Anda yakin ?",
					text: "Untuk hapus data",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
				.then((willDelete) => {
						if(willDelete){
							$.ajax({
								type: "DELETE",
								url: "{{ route('data_stasiun.store') }}" +'/'+id_stasiun,
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