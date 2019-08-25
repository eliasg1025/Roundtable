@extends('layouts.app')

@section('content')
    <Inicio :data="{{ json_encode($data) }}"/>
@endsection
