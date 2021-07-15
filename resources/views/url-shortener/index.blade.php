@extends('layouts.master')
@include('navbar.header')
@section('content')
@include('sidebar.dashboard')
<main class="col bg-faded py-3 flex-grow-1">
	<div class="row container">
		<div class="col-9">
	    	<h3>URL Detail Report</h3>
	    </div>
	   @if(($urlLimit > $urlCount) || ($urlLimit == 'unlimited'))
		    <div class="col-3" style="text-align: right;">
		    	<a href="{{ url('url/create') }}" class="btn btn-primary">Create</a>
		    </div>
	    @endif
	</div>
    <br>

	{{-- <table> --}}
	<div class="container">
        {{-- success --}}
        @if(\Session::has('insert'))
        <div id="insert" class="alert alert-success">
            {!! \Session::get('insert') !!}
        </div>
        @endif

        {{-- error --}}
        @if(\Session::has('error'))
            <div id="error" class="alert alert-danger">
                {!! \Session::get('error') !!}
            </div>
        @endif

		{{-- search --}}

		
		<div class="container-fluid">
			<table id="url-data-table" class="table table-striped table-bordered" style="width:100%">
				<thead>
					
					<tr>
						<th>ID</th>
						<th>URL</th>
						<th>Short URL</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data as $value)
					<tr>
						<td class="id">{{ $value->id }}</td>
						<td class="url">{{ $value->url }}</td>
						<td class="short_url"> <a href="{{ $value->tiny_url }}"> {{ $value->tiny_url }} </a> </td>
						<td class="is_active">{{ $value->is_active }} </td>
						<td class=" text-center">
							<a class="m-r-15 text-muted update" data-toggle="modal" data-id="'.$value->id.'" data-target="#update">
								<i class="fa fa-edit" style="color: #2196f3; cursor: pointer;"></i>
							</a>
							<a class="delete_url" dataid="{{ $value->id }}" href="#" onclick="return confirm('Are you sure to want to delete it?')">
								<i class="fa fa-trash" style="color: red;"></i>
							</a>
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
					<h5 class="url-list-model" id="header-update"> Update </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="update" action="{{ route('url/create-update') }}" method = "post">
					{{ csrf_field() }}

					<div class="modal-body">
						<input type="hidden" class="form-control" id="e_id" name="id" value=""/>
						<div class="modal-body">
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Full URL</label>
								<div class="col-sm-9">
									<input id="url" type="url" name="url" required="" class="form-control">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Status</label>
								<div class="col-sm-9">
									<select name="is_active" id="is_active" class="form-control" required="">
				                    	<option value="active"> active </option>
				                    	<option value="deactive"> deactive </option>
				               		</select>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icofont icofont-eye-alt"></i>Close</button>
							<button type="submit" id="" name="" class="btn btn-success  waves-light"><i class="icofont icofont-check-circled"></i>Update</button>
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
			currentId = _this.find('.id').text();
			$('#e_id').val(_this.find('.id').text());
			$('#url').val(_this.find('.url').text());
			$('#short_url').val(_this.find('.short_url').text());
			$("#is_active option[value=" + _this.find('.is_active').text() + "]").attr('selected', 'selected');
		});

		$(document).ready(function()
        {
            $('#url-data-table').DataTable({
            	"scrollX": true
            });

            $('.delete_url').click(function(e) {
			    e.preventDefault();
			    let id = $(this).attr('dataid');
			    $.ajax(
			        {
						url: "{{ url('url/delete') }}" + '/' + id,
						type: 'DELETE',
						data: {
							_token: "{{ csrf_token() }}",
			        	},
			        success: function (response){
			        	alert(response.message);
			        	window.location.href = "{{ url('short-urls') }}";
			        }
			    });
			});

        });
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


<!-- $(document).ready(function () {

 $("body").on("click","#deleteCompany",function(e){

    if(!confirm("Do you really want to do this?")) {
       return false;
     }

    e.preventDefault();
    var id = $(this).data("id");
    // var id = $(this).attr('data-id');
    var token = $("meta[name='csrf-token']").attr("content");
    var url = e.target;

    $.ajax(
        {
          url: url.href, //or you can use url: "company/"+id,
          type: 'DELETE',
          data: {
            _token: token,
                id: id
        },
        success: function (response){

            $("#success").html(response.message)

            Swal.fire(
              'Remind!',
              'Company deleted successfully!',
              'success'
            )
        }
     });
      return false;
   });
    

}); -->