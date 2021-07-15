@extends('layouts.app')
@section('content')
<div class="signup-form">
    <form action="{{ route('user/login') }}" method="post">
		@csrf
		<h2>Login</h2>

        @if(session()->has('error'))
            <div class="text-danger text-center">
                {{ session()->get('error') }}
            </div>
        @endif

		<p class="hint-text">Login your account. It's free and only takes a minute.</p>
        <div class="form-group">
			<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Enter email">
			@error('email')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
        </div>
		<div class="form-group">
			<label class="form-label">Password</label>
			<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="Enter password">
			@error('password')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
        </div> 
		<div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block">Login</button>
        </div>
    </form>
    <div class="text-center">Already have an account? <a href="{{ route('user/register') }}">Sign up</a></div>
</div>
@endsection