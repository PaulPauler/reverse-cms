@extends('Cms::layouts.app')

@section('header')
    @lang('Cms::cms.error') 404
@endsection

@section('content')
    <p>@lang('Cms::cms.page_not_found')</p>
    <div class="row">
        <div class="offset-5 col-2 pt-2">
            <a href="{{URL::previous()}}" class="btn btn-light border w-100">@lang('Cms::cms.field_back')</a>
        </div>
    </div>
@endsection
