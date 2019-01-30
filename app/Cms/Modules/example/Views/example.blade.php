@extends('Cms::layouts.app')

@section('header')
    @lang('sitemap::sitemap.name')
@endsection

@section('content')
    @if (count($errors) > 0)
       <div class="alert alert-danger">
          <ul class="mb-0">
              @foreach ($errors->all() as $error)
                 <li>{{$error}}</li>
              @endforeach
          </ul>
       </div>
    @elseif(session()->has('message'))
      <div class="alert alert-success">
         {{ session()->get('message') }}
      </div>
    @endif

    Данная страница является корневой страницей модуля example. Этот модуль создан для примера. На основе него вы можете создать свой модуль для системы.
    <div class="row">
      <div class="col-2 offset-5 pt-3">
          <a href="{{URL::to(env('CMS_URL', 'panel'))}}/modules/feedback/{{$curpage->url}}" class="btn btn-light border w-100">@lang('Cms::cms.field_back')</a>
      </div>
    </div>
@endsection
