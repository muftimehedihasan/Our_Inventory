@extends('layout.sidenav-layout')
@section('content')
    @include('components.cutomer.customer-list')
    @include('components.cutomer.customer-delete')
    @include('components.cutomer.customer-create')
    @include('components.cutomer.customer-update')

@endsection
