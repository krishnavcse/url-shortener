@extends('layouts.master')
@include('navbar.header')
@section('content')
@include('sidebar.dashboard')
<main class="col bg-faded py-3 flex-grow-1">
	<div class="row container">
		<div class="col-9">
	    	<h3>Users Report</h3>
	    </div>
	</div>
    <br>
	

	{{-- <table> --}}
	<div class="container">
        {{-- success --}}
        @if(\Session::has('insert'))
        <div id="insert" class=" alert alert-success">
            {!! \Session::get('insert') !!}
        </div>
        @endif

        {{-- error --}}
        @if(\Session::has('error'))
            <div id="error" class=" alert alert-danger">
                {!! \Session::get('error') !!}
            </div>
        @endif

		{{-- search --}}

		
		<div class="container-fluid">
			<table id="user-data-table" class="table table-striped table-bordered nowrap" style="width:100%">
				<thead>
					
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Email</th>
						<th>Role</th>
						<th>URL Limit</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data as $value)
					<tr>
						<td class="id">{{ $value->id }}</td>
						<td class="name">{{ $value->name }}</td>
						<td class="email">{{ $value->email }}</td>
						<td class="role">{{ $value->role }}</td>
						<td class="url_limit">{{ $value->url_limit }}</td>
						<td class=" text-center">
							<a class="m-r-15 text-muted update" data-toggle="modal" data-id="'.$value->id.'" data-target="#update">
								<i class="fa fa-edit" style="color: #2196f3; cursor: pointer;"></i>
							</a>
						@if(($loggedInUser->role == 'admin') && ($userCount > 1))
							<a id="delete_user" dataid="{{ $value->id }}" data-method="delete" href="#" onclick="deleteUser('{{ $value->id }}')">
								<i class="fa fa-trash" style="color: red;"></i>
							</a>
						@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	{{-- </table> --}}

	<!-- Modal Update-->
	<div class="modal fade" id="update" tabindex="-1" aria-labelledby="update" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="user-list-model" id="update">Update</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="update" action="{{ route('user/update') }}" method = "post"><!-- form add -->
					{{ csrf_field() }}
					<div class="modal-body">
						<input type="hidden" class="form-control" id="e_id" name="id" value=""/>
						<div class="modal-body">
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Name</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="name" name="name" required="" value=""/>
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Email</label>
								<div class="col-sm-9">
									<input type="email" class="form-control" id="email" name="email" required="" value=""/>
								</div>
							</div>
							@if(($loggedInUser->role == 'admin') && ($userCount > 1))
								<div class="form-group row">
									<label for="" class="col-sm-3 col-form-label">Role</label>
									<div class="col-sm-9">
										<select name="role" id="role" class="form-control" required="">
					                    	<option value="client"> client </option>
					                    	<option value="admin"> admin </option>
					               		</select>
									</div>
								</div>
							@endif
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">URL Limit</label>
								<div class="col-sm-9">
									<select name="url_limit" id="url_limit" class="form-control" required="">
				                    	<option value=10> 10 </option>
				                    	<option value=1000> 1000 </option>
				                    	<option value='unlimited'> unlimited </option>
				               		</select>
								</div>
							</div>
						</div>
						<!-- form add end -->
					</div>
					<div class="modal-footer">
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icofont icofont-eye-alt"></i>Close</button>
							<button type="submit" id=""name="" class="btn btn-success  waves-light"><i class="icofont icofont-check-circled"></i>Update</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- End Modal Update-->

	{{-- script update --}}
	
	<script>
		$(document).on('click','.update',function()
		{
			var _this = $(this).parents('tr');
			$('#e_id').val(_this.find('.id').text());
			$('#name').val(_this.find('.name').text());
			$('#email').val(_this.find('.email').text());
			$('#role').val(_this.find('.role').text()).change();
			$('#url_limit').val(_this.find('.url_limit').text()).change();
		});

		$(document).ready(function()
        {
            $('#user-data-table').DataTable({
            	"scrollX": true
            });
        } );

        function deleteUser(id) {
        	confirm('Are you sure to want to delete it?');
		    $.ajax(
		        {
					url: "{{ url('user/delete') }}" + '/' + id,
					type: 'DELETE',
					data: {
						_token: "{{ csrf_token() }}",
		        	},
		        success: function (response){
		        	alert(response.message);
			        window.location.href = "{{ url('users') }}";
		        }
		    });
		}
		
	</script>
	
    {{-- hide message js --}}
    <script>
        $('#insert').show();
        setTimeout(function()
        {
            $('#insert').hide();
        },5000);

		$('#error').show();
        setTimeout(function()
        {
            $('#error').hide();
        },5000);
        
    </script>        
</main>
@endsection