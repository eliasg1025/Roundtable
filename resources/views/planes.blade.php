
@extends('layouts.app')

@section('content')
	<page-banner title="Planes" img="/img/fondo/fondo-pago.jpg">
    </page-banner>
    <modal-login-register
        csrf="{{ csrf_token() }}"
		href_login="{{ route('login') }}"
		href_register="{{ route('register') }}"
		href_reset_password="{{ route('password.request') }}"></modal-login-register>
	<planes
		:data="{{ json_encode($data) }}"


	>
	</planes>

	<puntos :pack_data="{{ json_encode($data['packs']) }}">
	</puntos>
	<page-footer></page-footer>
@endsection
