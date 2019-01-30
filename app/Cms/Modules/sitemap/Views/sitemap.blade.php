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

    <p>@lang('sitemap::sitemap.info')</p>
    <p>
      @lang('sitemap::sitemap.link1') <a href="{{URL::to('/'.$curpage->url)}}" target="_blank">{{URL::to('/'.$curpage->url)}}</a>
      <br />
      @lang('sitemap::sitemap.link2') <a href="{{URL::to('/sitemap')}}.xml" target="_blank">{{URL::to('/sitemap.xml')}}</a>
    </p>
    <div class="row">
      <div class="col-2 offset-5 pt-3">
          <a href="{{URL::to(env('CMS_URL', 'panel'))}}/modules/sitemap/{{$curpage->url}}" class="btn btn-light border w-100">@lang('Cms::cms.field_back')</a>
      </div>
    </div>
@endsection
