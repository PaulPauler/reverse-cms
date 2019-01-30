@extends('Cms::layouts.app')

@section('header')
    @lang('Cms::cms.welcome')
@endsection

@section('content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @lang('Cms::cms.home_page_text')
@endsection
