@extends('layouts.app')

@section('content')
	<page-banner
		title="Restablecer contraseña"
		img="/img/slider/slider2.jpg"
	>
	</page-banner>

	<reset-password
		csrf="{{ csrf_token() }}"
		href_password_email="{{ route('password.email') }}"

	>
	</reset-password>
	
	<!--
	<div class="container" style="padding: 60px 10px;">
		<div class="row justify-content-center">
			<div class="card">
				<div class="card-body">
					@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
					@endif

					<form method="POST" action="{{ route('password.email') }}">
						@csrf
						<div class="row text-center mb-3">
							<div class="col-md-12">
								Ingresa tu correo y en breve estaremos enviando un mail para que restaures tu contraseña.	
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<input
									id="email"
									type="email"
									class="form-control @error('email') is-invalid @enderror"
									name="email"
									value="{{ old('email') }}"
									placeholder="Correo electrónico"
									required autocomplete="email"
									autofocus
								>

								@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="form-group row mb-0">
							<div class="col-md-12 text-center">
								<button 
									type="submit"
									class="btn"
									style="color: #fff; background-color: #88be2e; border-color: #88be2e;"
								>
									{{ __('Enviar Correo') }}
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> -->

	<page-footer></page-footer>
	<modal-login-register
		csrf="{{ csrf_token() }}"
		href_login="{{ route('login') }}"
		href_register="{{ route('register') }}"
		href_reset_password="{{ route('password.request') }}"
	/>
@endsection
