@extends('layouts.app')
@section('content')
    <page-banner
    title="Pagos"
    img="/img/fondo/fondo-pago.jpg">
    </page-banner>

    <pago
        :data="{{json_encode($data)}}"
    ></pago>
    <page-footer></page-footer>
@endsection
