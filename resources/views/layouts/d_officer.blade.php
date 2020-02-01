@extends('layouts.master')

@section('content')
	<!-- table -->
	 <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
		 	<h2 class="text-center mt-5">Master Petugas</h2>
	          <div class="card-body">
		 	<a href="javascript:void(0)" class="btn btn-icons btn-primary btn-sm mb-3 ml-3 text-center" id="createPetugas">
				<i class="mdi mdi-plus"></i>
			</a>
            <div class="container">
               <table id="data" class="table table-hover text-center data-table">
                <thead class="thead-dark">
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jenis Kelamin</th>
                    <th>Telepon</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                 
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
	<!-- end table -->

	<!-- modal form -->
	<div class="modal fade" id="ajaxModel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modelHeading"></h4>
				</div>
				<div class="modal-body">
					<form id="FormData" name="FormData" class="form-horizontal">
						<input type="hidden" name="id_petugas" id="id_petugas">
						<div class="form-group">
							<label for="name" class="col-sm-5 control-label">Nama Petugas</label>
							<div class="col-sm-12">
								<input type="text" class="form-control" name="nama_petugas" id="nama_petugas" placeholder="Masukkan nama petugas" value="" maxlength="50" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-sm-5 control-label">Email</label>
							<div class="col-sm-12">
								<input type="email" class="form-control" name="email" id="email" placeholder="Masukkan email" value="" maxlength="50" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-sm-5 control-label">Password</label>
							<div class="col-sm-12">
								<input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password" value="" maxlength="50" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-sm-5 control-label">Telepon</label>
							<div class="col-sm-12">
								<input type="number" class="form-control" name="telepon" id="telepon" placeholder="Masukkan telepon" value="" maxlength="50" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-sm-5 control-label">Jenis Kelamin</label>
							<div class="col-sm-12">
								<select id="jenis_kelamin" name="jenis_kelamin" class="form-control">
		            				<option>Pilih jenis kelamin</option>
		            				<option value="L">Laki-Laki</option>
		            				<option value="P">Perempuan</option>
		            			</select>
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-sm-5 control-label">Alamat</label>
							<div class="col-sm-12">
								<textarea name="alamat" id="alamat" class="form-control" id="exampleTextarea1" rows="2" placeholder="Masukkan alamat"></textarea>
							</div>
						</div>
						<div class=" mr-3 text-right"> 
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary" id="saveBtn" value="create">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end modal form -->
	@section('script')
		<script type="text/javascript">
			 $(function(){
		        $.ajaxSetup({
		            headers: {
		              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		            }
		          });
	        });

			var table = $('.data-table').DataTable({
				processing: true,
				serverSide: true,
				ajax: "{{ route('data_petugas.index') }}",
				columns: [
					{data: 'DT_RowIndex', name: 'DT_RowIndex'},
					{data: 'nama_petugas', name: 'nama_petugas'},
					{data: 'email', name: 'email'},
					{data: 'jenis_kelamin', name: 'jenis_kelamin'},
					{data: 'telepon', name: 'telepon'},
					{data: 'action', name: 'action', orderable: false, searchable: false},
	            ]
	        });

			 $('#createPetugas').click(function(){
				$('#saveBtn').val("create-product");
				$('#id_petugas').val('');
				$('#FormData').trigger("reset");
				$('#modelHeading').html("Tambah Petugas");
				$('#ajaxModel').modal('show');
			});

			$('#saveBtn').click(function(e){
				e.preventDefault();

				$.ajax({
					data: $('#FormData').serialize(),
					url: "{{ route('data_petugas.store') }}",
					type: 'POST',
					dataType: 'json',
					success: function(data){
						$('#FormData').trigger("reset");
						$('#ajaxModel').modal('hide');
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

			$('body').on('click', '.editOfficer', function(){
				var id_petugas = $(this).data('id');
				$.get("{{ route('data_petugas.index') }}" +'/' + id_petugas +'/edit', function(data){
					$('#modelHeading').html("Edit Data Petugas");
					$('#saveBtn').val("edit-petugas");
					$('#ajaxModel').modal('show');
					$('#id_petugas').val(data.id_petugas);
					$('#nama_petugas').val(data.nama_petugas);
					$('#email').val(data.email);
					$('#password').val(data.password);
					$('#jenis_kelamin').val(data.jenis_kelamin);
					$('#telepon').val(data.telepon);
					$('#alamat').val(data.alamat);
				});
			});

			$('body').on('click', '.deleteOfficer', function(){
				var id_petugas = $(this).data("id");

				swal({
					title: "Anda yakin ?",
					text: "Untuk menghapus data",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
					.then((willDelete) => {
						if(willDelete){
							$.ajax({
								type: "DELETE",
								url: "{{ route('data_petugas.store') }}" +'/'+id_petugas,
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