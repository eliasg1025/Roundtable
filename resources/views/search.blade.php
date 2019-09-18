@extends('layouts.app')

@section('content')
    <modal-login-register
        csrf="{{ csrf_token() }}"
		href_login="{{ route('login') }}"
		href_register="{{ route('register') }}"
		href_reset_password="{{ route('password.request') }}"></modal-login-register>


    <search
		title="Empresas"
		img="/img/fondo/fondo_historial.jpg"
		:loged="{{ $loged }}"
    ></search>

    <page-footer></page-footer>
@endsection
