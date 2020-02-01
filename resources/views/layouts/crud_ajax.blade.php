@extends('layouts.master')

@section('content')
  <h1 class="mb-5">Coba crud ajax</h1>
	<div class="container">
    <div class="row">
      <div class="col-md-12">
        <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-user">Add User</a> 
          <a href="https://www.tutsmake.com/jquery-submit-form-ajax-php-laravel-5-7-without-page-load/" class="btn btn-secondary mb-2 float-right">Back to Post</a> 
        <table class="table table-bordered text-center" id="laravel_crud">
          <thead class="thead-dark">
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Email</th>
              <th colspan="2">Action</th>
            </tr>
          </thead>
          <tbody id="users-crud">
            @foreach($users as $data)
            <tr id="user_id_{{ $data->id }}">
              <td>{{ $data->id }}</td>
              <td>{{ $data->name }}</td>
              <td>{{ $data->email }}</td>
              <td>
                <a href="javascript:void(0)" id="edit-user" data-id="{{ $data->id }}" class="btn btn-info">Edit</a>
              </td>
              <td>
                <a href="javascript:void(0)" id="delete-user" data-id="{{ $data->id }}" class="btn btn-danger">Delete</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $users->links() }}
      </div>
    </div>
  </div>

  <div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="userCrudModal"></h4>
          </div>
          <div class="modal-body">
              <form id="userForm" name="userForm" class="form-horizontal">
                 <input type="hidden" name="user_id" id="user_id">
                  <div class="form-group">
                      <label for="name" class="col-sm-2 control-label">Name</label>
                      <div class="col-sm-12">
                          <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                      </div>
                  </div>
   
                  <div class="form-group">
                      <label class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-12">
                          <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="" required="">
                      </div>
                  </div>
              </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-primary" id="btn-save" value="create">Save changes
              </button>
          </div>
      </div>
    </div>
  </div>

  @section('pluginjs')

  @endsection
 <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script>
    $(document).ready(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      /*  When user click add user button */
      $('#create-new-user').click(function () {
          $('#btn-save').val("create-user");
          $('#userForm').trigger("reset");
          $('#userCrudModal').html("Add New User");
          $('#ajax-crud-modal').modal('show');
      });
   
     /* When click edit user */
      $('body').on('click', '#edit-user', function () {
        var user_id = $(this).data('id');
        $.get('ajax_crud/' + user_id +'/edit', function (data) {
           $('#userCrudModal').html("Edit User");
            $('#btn-save').val("edit-user");
            $('#ajax-crud-modal').modal('show');
            $('#user_id').val(data.id);
            $('#name').val(data.name);
            $('#email').val(data.email);
        })
     });
     //delete user login
      $('body').on('click', '#delete-user', function () {
          var user_id = $(this).data("id");
          confirm("Are You sure want to delete !");
   
          $.ajax({
              type: "DELETE",
              url: "{{ url('ajax_crud')}}"+'/'+user_id,
              success: function (data) {
                  $("#user_id_" + user_id).remove();
              },
              error: function (data) {
                  console.log('Error:', data);
              }
          });
      });   
    });

    if ($("#userForm").length > 0) {
          $("#userForm").validate({
     
         submitHandler: function(form) {
     
          var actionType = $('#btn-save').val();
          $('#btn-save').html('Sending..');
          
          $.ajax({
              data: $('#userForm').serialize(),
              url: "http://localhost:8000/ajax_crud",
              type: "POST",
              dataType: 'json',
              success: function (data) {
                  var user = '<tr id="user_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.email + '</td>';
                  user += '<td><a href="javascript:void(0)" id="edit-user" data-id="' + data.id + '" class="btn btn-info">Edit</a></td>';
                  user += '<td><a href="javascript:void(0)" id="delete-user" data-id="' + data.id + '" class="btn btn-danger delete-user">Delete</a></td></tr>';
                   
                  
                  if (actionType == "create-user") {
                      $('#users-crud').prepend(user);
                  } else {
                      $("#user_id_" + data.id).replaceWith(user);
                  }
     
                  $('#userForm').trigger("reset");
                  $('#ajax-crud-modal').modal('hide');
                  $('#btn-save').html('Save Changes');
                  
              },
              error: function (data) {
                  console.log('Error:', data);
                  $('#btn-save').html('Save Changes');
              }
          });
        }
      })
    }
   
  </script>
@endsection