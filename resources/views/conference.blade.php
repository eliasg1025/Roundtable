@extends('layouts.app')

@section('content')
	<page-banner title="Video Conferencia" img="/img/fondo/fondo-pago.jpg"></page-banner>
	<conference :meeting="{{ $meeting }}"></conference>
	<page-footer></page-footer>
@endsection
