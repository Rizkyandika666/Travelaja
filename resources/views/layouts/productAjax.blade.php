<!-- <!DOCTYPE html>
<html>
<head>
	<title>Laravel 6 CRUD ajax</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body> -->
@extends('layouts.master')

@section('content')
	<div class="col-lg-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="container">
					<h1 class="mb-5">Laravel 6 ajax crud using datatables</h1>
					<a href="javascript:void(0)" class="btn btn-success mb-5" id="createNewProduct">Create New Product</a>
					<table  class="table table-bordered data-table">
						<thead class="thead-dark">
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Detail</th>
								<th width="280px">Action</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="ajaxModel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modelHeading"></h4>
				</div>
				<div class="modal-body">
					<form id="productForm" name="productForm" class="form-horizontal">
						<input type="hidden" name="product_id" id="product_id">
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">Name</label>
							<div class="col-sm-12">
								<input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="" maxlength="50" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="detail" class="col-sm-2 control-label">Detail</label>
							<div class="col-sm-12">
								<textarea id="detail" name="detail" required="" placeholder="Enter details" class="form-control"></textarea>
							</div>
						</div>
						<div class="col-sm-offset-2 col-sm-10"> 
							<button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<!-- </body> -->
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
		        ajax: "{{ route('ajaxproducts.index') }}",
		        columns: [
		            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
		            {data: 'name', name: 'name'},
		            {data: 'detail', name: 'detail'},
		            {data: 'action', name: 'action', orderable: false, searchable: false},
		        ]
		    });

			$('#createNewProduct').click(function(){
				$('#saveBtn').val("create-product");
				$('#product_id').val('');
				$('#productForm').trigger("reset");
				$('#modelHeading').html("Create New Products");
				$('#ajaxModel').modal('show');
			});

			$('#saveBtn').click(function(e){
				e.preventDefault();
				// $(this).html('sending...');

				$.ajax({
					data: $('#productForm').serialize(),
					url: "{{ route('ajaxproducts.store') }}",
					type: 'POST',
					dataType: 'json',
					success: function(data){
						$('#productForm').trigger("reset");
						$('#ajaxModel').modal('hide');
						table.draw();
						swal({
							title: "Data Berhasil Disimpan",
							icon: "success",
						});
					},
					error: function(data){
						console.log('Error:' ,data);
						$('#saveBtn').html('Save changes');
					}
			});

			$('body').on('click', '.editProduct', function() {
		      var product_id = $(this).data('id');
		      $.get("{{ route('ajaxproducts.index') }}" +'/' + product_id +'/edit', function (data) {
		          $('#modelHeading').html("Edit Product");
		          $('#saveBtn').val("edit-user");
		          $('#ajaxModel').modal('show');
		          $('#product_id').val(data.id);
		          $('#name').val(data.name);
		          $('#detail').val(data.detail);
		      })
		   });


			$('body').on('click', '.deleteProduct', function(){
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
								url: "{{ route('ajaxproducts.store') }}" +'/'+product_id,
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
			});
		</script>
	@endsection
<!-- </html> -->
@endsection