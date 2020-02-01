@extends('layouts.master')

@section('content')
	<!-- <button id="btn_tambah" type="button" class="btn btn-info btn-fw mb-3 ml-3">
		<i class="mdi mdi-plus"></i>Tambah Data
	</button> -->

	

	<!-- form -->
	<!-- <div class="col-12 stretch-card mb-3" id="form_data" style="display: none;">
		<div class="card">
			<div class="card-body">
				<h4>Form Tambah Data</h4>
				<p class="card-description">Data Kota</p>
				<form class="forms-sample">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								<label for="kota" class="col-sm-3 col-form-label">Kota</label>
								<div class="col-sm-9">
									<input class="form-control" type="text" name="kota" id="kota" placeholder="Masukkan kota">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								<label for="status" class="col-sm-3 col-form-label">Status</label>
								<div class="col-sm-9">
			            			<select class="form-control">
			            				<option>Aktif</option>
			            				<option>Non Aktif</option>
			            			</select>
			            		</div>
							</div>
						</div>
					</div>
					<div class="row">
	            		<div class="col-md-12 text-right">
				            <button type="submit" class="btn btn-success mr-2">Submit</button>
				            <button class="btn btn-light" name="cancel" type="cancel">Cancel</button>
	            		</div>
	            	</div>
				</form>
			</div>
		</div>
	</div> -->
	<!-- end form -->

	<!-- table -->
	 <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
	 	<h2 class="text-center mt-5">Master Kota</h2>
          <div class="card-body">
	 	<a href="javascript:void(0)" class="btn btn-icons btn-primary btn-sm mb-3 ml-3 text-center" id="createNewProduct">
			<i class="mdi mdi-plus"></i>
		</a>
            <div class="container">
               <table id="data" class="table table-hover text-center data-table">
                <thead class="thead-dark">
                  <tr>
                    <th>No</th>
                    <th>Nama Kota</th>
                    <th>Status</th>
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
						<input type="hidden" name="id_town" id="id_town">
						<div class="form-group">
							<label for="name" class="col-sm-3 control-label">Nama Kota</label>
							<div class="col-sm-12">
								<input type="text" class="form-control" name="nama_kota" id="nama_kota" placeholder="Enter nama kota" value="" maxlength="50" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="detail" class="col-sm-2 control-label">Status</label>
							<div class="col-sm-12">
								<select id="status" name="status" class="form-control">
		            				<option>Pilih Status</option>
		            				<option value="aktif">aktif</option>
		            				<option value="nonaktif">non aktif</option>
		            			</select>
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
	              ajax: "{{ route('data_kota.index') }}",
	              columns: [
	                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
	                  {data: 'nama_kota', name: 'nama_kota'},
	                  {data: 'status', name: 'status'},
	                  {data: 'action', name: 'action', orderable: false, searchable: false},
	              ]
	          });

	        $('#createNewProduct').click(function(){
				$('#saveBtn').val("create-product");
				$('#id_town').val('');
				$('#FormData').trigger("reset");
				$('#modelHeading').html("Tambah Kota");
				$('#ajaxModel').modal('show');
			});

	       $('#saveBtn').click(function(e){
				e.preventDefault();
				// var str = $('#FormData').serialize();
				// console.log(str);

				$.ajax({
					data: $('#FormData').serialize(),
					url: "{{ route('data_kota.store') }}",
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

			$('body').on('click', '.editTown', function() {
		      var id_town = $(this).data('id');
		      $.get("{{ route('data_kota.index') }}" +'/' + id_town +'/edit', function (data) {
		      	// console.log(data);
		          $('#modelHeading').html("Edit Product");
		          $('#saveBtn').val("edit-user");
		          $('#ajaxModel').modal('show');
		          $('#id_town').val(data.id);
		          $('#nama_kota').val(data.nama_kota);
		          $('#status').val(data.status);
		      })
		   });


			$('body').on('click', '.deleteTown', function(){
				console.log("iki kenek kok");
				var product_id = $(this).data("id");

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
								url: "{{ route('data_kota.store') }}" +'/'+product_id,
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