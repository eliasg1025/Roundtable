@extends('layouts.app')

@section('content')
	<page-banner
		title="{{ $data['user']->name }}"
		img="{{ $data['user']->cover_img }}"
	></page-banner>

    <profile
    	:data="{{ json_encode($data) }}"
    >
    </profile>

	<page-footer></page-footer>
@endsection
