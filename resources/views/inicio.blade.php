@extends('layouts.app')

@section('content')
	<Inicio
		:data="{{ json_encode($data) }}"
		csrf="{{ csrf_token() }}"
		href_login="{{ route('login') }}"
		href_register="{{ route('register') }}"
	/>
@endsection
