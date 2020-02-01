@extends('layouts.master')

@section('content')
	<button type="button" id="btn_tambah" class="btn btn-info btn-fw mb-3 ml-3">
		<i class="mdi mdi-plus"></i>Tambah Data</button>
	<div class="col-12 stretch-card mb-3" id="form_data" style="display: none;">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Form Tambah Data</h4>
            <p class="card-description">Data User</p>
            <form class="forms-sample">
            	<div class="row">
            		<div class="col-md-6">
		            	<div class="form-group row">
		            		<label for="nama" class="col-sm-3 col-form-label">Nama</label>
		            		<div class="col-sm-9">
		            			<input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan nama">
		            		</div>
		            	</div>
            		</div>
            		<div class="col-md-6">
			            <div class="form-group row">
			                <label for="email" class="col-sm-3 col-form-label">Email</label>
			                <div class="col-sm-9">
			                  <input type="email" class="form-control" id="email" placeholder="Masukkan email">
			                </div>
			            </div>
            		</div>
            	</div>
            	<div class="row">
            		<div class="col-md-6">
			            <div class="form-group row">
			                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password</label>
			                <div class="col-sm-9">
			                  <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
			                </div>
			            </div>
            		</div>
            		<div class="col-md-6">
			            <div class="form-group row">
		            		<label for="telepon" class="col-sm-3 col-form-label">Telepon</label>
		            		<div class="col-sm-9">
		            			<input type="text" class="form-control" name="telepon" id="telepon" placeholder="Masukkan telepon">
		            		</div>
		            	</div>
            		</div>
            	</div>
            	<div class="row">
            		<div class="col-md-6">
		            	<div class="form-group row">
		            		<label for="no_ktp" class="col-sm-3 col-form-label">Nomor Ktp</label>
		            		<div class="col-sm-9">
		            			<input type="text" class="form-control" name="no_ktp" id="no_ktp" placeholder="Masukkan no ktp">
		            		</div>
		            	</div>
            		</div>
            		<div class="col-md-6">
		            	<div class="form-group row">
		            		<label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
		            		<div class="col-sm-9">
		            			<input type="text" class="form-control" name="alamat" id="alamat" placeholder="Masukkan alamat">
		            		</div>
		            	</div>
            		</div>
            	</div>
            	<div class="row">
            		<div class="col-md-6">
		            	<div class="form-group row">
		            		<label for="alamat" class="col-sm-3 col-form-label">Jenis Kelamin</label>
		            		<div class="col-sm-9">
		            			<select class="form-control">
		            				<option>Laki-laki</option>
		            				<option>Perempuan</option>
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
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="container">
               <table class="table table-hover text-center data-table">
                <thead class="thead-dark">
                  <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>No Telepon</th>
                    <th>Alamat</th>
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

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    @section('script')
    <script>
    	$(document).ready(function(){
    		$("#btn_tambah").click(function(){
    			if($('#form_data').css('display') == "none"){
    				$('#form_data').slideDown();
    			}else{
    				$('#form_data').slideUp();
    			}
    		});

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
              ajax: "{{ route('data_user.index') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'name', name: 'name'},
                  {data: 'name', name: 'name'},
                  {data: 'name', name: 'name'},
                  {data: 'detail', name: 'detail'},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
          });

    	});
    </script>
    @endsection
@endsection