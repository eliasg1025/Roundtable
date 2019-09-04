@extends('layouts.app')

@section('content')
	<page-banner
		title="Verificar Correo"
		img="/img/publicidad/banner.jpg"	
	>
	</page-banner>
	<!-- Form -->
	<div class="container" style="padding: 60px 0;">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						@if (session('resent'))
							<div class="alert alert-success" role="alert">
								{{ __('Un nuevo email ha sido enviado a tu dirección.') }}
							</div>
						@endif
	
						{{ __('Antes de seguir, por favor revisa tu bandeja de entrada por el enlace de verificación.') }}
						{{ __('Si no recibiste el email') }},
						<a href="{{ route('verification.resend') }}" style="color: #88be2e;">
							{{ __('haz click aquí reenviar el correo') }}
						</a>.
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
