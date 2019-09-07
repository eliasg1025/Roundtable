@extends('layouts.app')

@section('content')
	<business-banner
		:data_user="{{ $user }}"
	>
	</business-banner>

	<business-videos

	>
	</business-videos>

	<business-images

	>
	</business-images>

	<business-products

	>
	</business-products>

	<page-footer></page-footer>
	<modal-login-register
		csrf="{{ csrf_token() }}"
		href_login="{{ route('login') }}"
		href_register="{{ route('register') }}"
		href_reset_password="{{ route('password.request') }}"
	/>
@endsection
