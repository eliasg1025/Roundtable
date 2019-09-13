
@extends('layouts.app')

@section('content')
	<page-banner title="Planes" img="/img/fondo/fondo_historial.jpg">
        
    </page-banner>
        
    <planes> </planes>
    <modal-login-register
        csrf="{{ csrf_token() }}"
		href_login="{{ route('login') }}"
		href_register="{{ route('register') }}"
		href_reset_password="{{ route('password.request') }}"></modal-login-register>
    <page-footer></page-footer>
@endsection
