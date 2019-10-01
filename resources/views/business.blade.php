@extends('layouts.app')

@section('content')
	<business
		:data_user="{{ $user }}"
		:data_media="{{ json_encode($media_data) }}"
		:data_account="{{ json_encode($account_data) }}"
		:data_visit_user="{{ json_encode($visit_user) }}"
		csrf="{{ csrf_token() }}"
		href_login="{{ route('login') }}"
		href_register="{{ route('register') }}"
		href_reset_password="{{ route('password.request') }}"
	>
	</business>
@endsection
