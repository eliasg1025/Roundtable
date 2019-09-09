@extends('layouts.app')

@section('content')
	<business-banner
		:data_user="{{ $user }}"
	>
	</business-banner>

	<business-products

	>
	</business-products>

	<business-videos
		:data_videos="{{ $media_data['videos'] }}"
	>
	</business-videos>

	<business-images
		:data_images="{{ $media_data['images'] }}"
	>
	</business-images>

	<page-footer></page-footer>
	<modal-login-register
		csrf="{{ csrf_token() }}"
		href_login="{{ route('login') }}"
		href_register="{{ route('register') }}"
		href_reset_password="{{ route('password.request') }}"
	/>
@endsection
