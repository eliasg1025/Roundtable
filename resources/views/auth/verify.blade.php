@extends('layouts.app')

@section('content')
	<page-banner
		title="Verificar Correo"
		img="/img/publicidad/banner.jpg"	
	>
	</page-banner>
	<!-- Form -->
	<div class="container" style="padding: 60px 0;">
		<div class="row">

			<div class="jumbotron jumbotron-fluid" style="width: 100%; border-radius: 15px;">
				<div class="row container">
					<div class="col-md-5 text-center">
						<img src="/img/email.png" alt="" height="200px">
					</div>
					<div class="col-md-7">
						@if (session('resent'))
							<div class="alert alert-success" role="alert">
								{{ __('Un nuevo email ha sido enviado a tu dirección.') }}
							</div>
						@endif

						<h2 class="display-4">Bienvenido!</h2>
						<p class="lead">Antes de seguir, por favor revisa tu bandeja de entrada por el enlace de verificación.</p>
						<p class="lead">
							Si no recibiste el email
							<a href="{{ route('verification.resend') }}" style="color: #88be2e;">
								haz click aquí reenviar el correo
							</a>.
						</p>
						
					</div>
				</div>
			</div>
		
		</div>
	</div>

	<!-- End Form -->
	<page-footer></page-footer>
	<modal-login-register
		:csrf="this.csrf"
		:href_login="this.href_login"
		:href_register="this.href_register"
		:href_reset_password="this.href_reset_password"
	/>
@endsection
