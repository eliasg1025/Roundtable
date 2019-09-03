@extends('layouts.app')

@section('content')
	<page-banner
		title="{{Auth::user()->name}}"
		img="{{Auth::user()->cover_img}}"
	></page-banner>

    <profile
    	:user_data="{{ Auth::user() }}"
    >
    </profile>

	<page-footer></page-footer>
@endsection
