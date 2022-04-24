@extends('errors::personal-layout')

@section('title', __('No tiene permisos'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'No tiene permisos'))
