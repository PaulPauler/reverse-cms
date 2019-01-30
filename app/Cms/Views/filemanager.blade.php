@extends('Cms::layouts.app')

@section('header')
    @lang('Cms::cms.menu_filemanager')
@endsection

@section('content')
    <iframe src="/{{config('lfm.url_prefix')}}" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
@endsection
