@extends('layouts.master')
@include('navbar.header')
@section('content')
@include('sidebar.dashboard')
<main class="col bg-faded py-3 flex-grow-1">
    <h3>Create</h3>
    <br>
	<div class="signup-form">
		<form action="{{ route('url/create-update') }}" method="post" class="form-horizontal">
			{{ csrf_field() }}
			<div class="row">
				<div class="col-8 offset-4">
					<h2>URL</h2>
				</div>
			</div>	
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


			<div class="form-group row">
				<label class="col-form-label col-4">Full URL</label>
				<div class="col-8">
					<input id="url" class="form-control @error('url') is-invalid @enderror" name="url" required="">
					@error('url')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>        	
			</div>

			<div class="form-group row">
				<label class="col-form-label col-4">Status</label>
				<div class="col-8">
					<select name="is_active" id="is_active" class="form-control @error('is_active') is-invalid @enderror" required="">
                    	<option value='active'> active </option>
                    	<option value='deactive'> deactive </option>
               		</select>
               		@error('is_active')
               		<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<div class="col-8 offset-4">
					<button type="submit" class="btn btn-primary btn-lg">Save</button>
				</div>  
			</div>		      
		</form>
	</div>
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