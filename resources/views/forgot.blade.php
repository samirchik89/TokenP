@extends('layout.app')

@section('content')


<main class="content-wrapper">

<section class="login-section">
			<div class="container">
				<div class="login-box col-md-6">
					<form action="" method="post">
					<h2 class="text-center">Investor</h2>
					<label>Email</label>
					<div class="input-group">
						<input type="email" name="email" class="form-control" placeholder="Example@mail.com" required="" autocomplete="off">
					</div>
					<label>Recovery seed</label>
					<div class="input-group">
						<input type="text" name="text" class="form-control" placeholder="*******" required="" autocomplete="off">
					</div>
					<label>New Password</label>
					<div class="input-group">
						<input type="password" name="password" class="form-control" placeholder="*******" required="" autocomplete="off">
					</div>
					<label>Confirm New Password</label>
					<div class="input-group">
						<input type="password" name="password" class="form-control" placeholder="*******" required="" autocomplete="off">
					</div>
					<div>
						<a href="#" class="btn btn-theme-dark w-100">Save New Password</a>
					</div>
					<div class="forgot-link">
						<a href="{{url('/login')}}">Back to Login</a>
					</div>
				</form>
				</div>
			</div>
		</section>

</main>
@endsection

