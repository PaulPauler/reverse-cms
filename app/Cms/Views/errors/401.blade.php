@extends('Cms::layouts.app')

@section('header')
    @lang('Cms::cms.error') 401
@endsection

@section('content')
    <p>@lang('error_'.$exception->getMessage())</p>
@endsection
