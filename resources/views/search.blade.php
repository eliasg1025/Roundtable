@extends('layouts.app')

@section('content')
    <modal-login-register
        csrf="{{ csrf_token() }}"
		href_login="{{ route('login') }}"
		href_register="{{ route('register') }}"
		href_reset_password="{{ route('password.request') }}"></modal-login-register>


    <search
		title="Empresas"
		img="/img/accounting-businesswoman-communication-38556%20%281%29.jpg"
		:data="{{ json_encode($data) }}"
    ></search>

    <page-footer></page-footer>
@endsection
