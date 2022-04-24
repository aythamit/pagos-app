@extends('errors::personal-layout')

@section('title', __('No tiene permiso'))
@section('code', '405')
@section('message', __($exception->getMessage() ?: 'no tiene acceso al difunto'))
