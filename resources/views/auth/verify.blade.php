@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifica tu correo electrónico') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un nuevo email ha sido enviado a tu dirección.') }}
                        </div>
                    @endif

                    {{ __('Antes de seguir, por favor revisa tu bandeja de entrada por el enlace de verificación.') }}
                    {{ __('Si no recibiste el email') }}, <a href="{{ route('verification.resend') }}">{{ __('haz click aquí reenviar el correo') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
