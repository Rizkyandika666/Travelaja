@extends('layouts.master')

@section('content')
		{{-- table --}}
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<h2 class="text-center mt-5">Master Partner</h2>
				<div class="card-body">
					<a href="javascript:void(0)" class="btn btn-icons btn-primary btn-sm mb-3 ml-3 text-center" id="createNewPartner">
						<i class="mdi mdi-plus"></i>
					</a>
					<div class="container">
						<table id="data" class="table table-hover text-center data-table">
							<thead class="thead-dark">
								<tr>
									<th width="10px">No</th>
									<th>Nama</th>
									<th>Image</th>
									<th>Detail</th>
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
		{{-- end of table --}}

		{{-- modal form --}}
		<div class="modal fade" id="ajaxModel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="modelHeading"></h4>
					</div>
					<div class="modal-body">
						<form id="formData" method="POST" name="formData" class="form-horizontal" enctype="multipart/form-data">
							{{ csrf_field() }}
							<input type="hidden" id="_method" name="_method" value="">	
							<input type="hidden" name="id_partner" id="id_partner">
							<div class="form-group">
								<label for="name" class="col-sm-3 control-label">Nama Partner</label>
								<div class="col-sm-12">
									<input type="text" class="form-control" name="nama" id="nama" placeholder="Enter nama partner" value="" maxlength="50" required="">
								</div>
							</div>
							<div class="form-group">
		                        <label class="control-label col-sm-3">File upload</label>
		                        <div class="input-group col-sm-12">
		                        	<input id="image" type="file" name="image" class="form-control file-upload-default">
		                          <input type="text" id="image_name" class="form-control file-upload-info" disabled="false" placeholder="Upload Image">
		                          <span class="input-group-append">
		                            <button class="file-upload-browse btn btn-info" onclick="getImage()" type="button">Upload</button>
		                          </span>
		                          <span id="store_image"></span>
		                        </div>
		                     </div>
		                     <div class="form-group">
		                        <label for="detail" class="col-sm-12 control-label">Detail</label>
		                        <div class="col-sm-12">
		                        	<textarea class="form-control" id="detail" name="detail" rows="2" placeholder="Enter detail"></textarea>		
		                        </div>
		                     </div>
							<div class=" mr-3 text-right"> 
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-primary" id="saveBtn"  value="create">Simpan</button>
								<input type="hidden" name="hidden_image" id="hidden_image">
								<input type="hidden" name="act" id="act">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		{{-- end of form --}}
	@section('script')
		<script type="text/javascript">
			 $(function(){
		        $.ajaxSetup({
		            headers: {
		              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		            }
		          });
	        });

			function getImage(){
				document.getElementById("image").click();
			}

			$('#createNewPartner').click(function(){
				$('#saveBtn').val("create-product");
				$('#id_partner').val('');
				$('#_method').val('POST');
				$('#formData').trigger("reset");
				$('#modelHeading').html("Tambah Partner");
				$('#ajaxModel').modal('show');
			});

			var table = $('.data-table').DataTable({
	              processing: true,
	              serverSide: true,
	              ajax: "{{ route('data_partner.index') }}",
	              columns: [
	                  {
	                  	data: 'DT_RowIndex', 
	                  	name: 'DT_RowIndex'
	                  },
	                  {
	                  	data: 'nama',
	                  	name: 'nama'
	                  },
	                  // {data: 'image', name: 'image'},
	                  {
	                  	data: 'image', 
	                  	name: 'image', 
	                  	render: function(data, type, full, meta){
					     return "<img src={{ URL::to('/') }}/images/" + data + " width='90' class='img-thumbnail' />";
					   },
					    orderable: false},
	                  {
	                  	data: 'detail', 
	                  	name: 'detail'
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
				var id_partner = $(this).data('id');
				var id = $('#id_partner').val();
				var form =  $('#formData')[0];
				var data =  new FormData(form);

				var action = $('#act').val();

				if(action == " "){
					var url = "{{ route('data_partner.store') }}";
					var type = 'POST';
				}else{
					var url = "{{ url('data_partner') }}" +'/' +id;
					// var url = "data_partner/"+ id;
					var type = 'PUT';
				}

				$.ajax({
					// data: $('#FormData').serialize(),
					data: data,
					url: url,
					type: 'POST',
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false,
					success: function(data){
						$('#formData').trigger("reset");
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

			$('body').on('click', '.editPartner', function() {
		      var id_partner = $(this).data('id');
		      $.get("{{ route('data_partner.index') }}" +'/' + id_partner +'/edit', function (data) {
		      	// console.log(data);
		          $('#modelHeading').html("Edit Product");
		          $('#saveBtn').val("edit-user");
		          $('#ajaxModel').modal('show');
		          $('#act').val("Edit");
		          $('#_method').val('PUT');
		          $('#id_partner').val(data.id);
		          $('#nama').val(data.nama);
		          $('#image_name').val(data.image);
		          $('#hidden_image').val(data.image);
		          $('#detail').val(data.detail);
		      })
		   });


			$('body').on('click', '.deletePartner', function(){
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
								url: "{{ route('data_partner.store') }}" +'/'+product_id,
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