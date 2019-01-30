@extends('Cms::layouts.app')

@section('header')
    @lang('Cms::cms.account_page_header')
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
         @lang(session()->get('message'))
      </div>
    @endif

    {!! Form::open(['name' => 'account-form']) !!}
    <div class="row">
        <div class="col-2 pt-2">@lang('Cms::cms.field_login'):</div>
        <div class="col-10 pb-2">
          {!! Form::email('username', Auth::user()->username, ['class' => 'form-control full', 'disabled']) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-2 pt-2">@lang('Cms::cms.field_email'):</div>
        <div class="col-10 pb-2">
          {!! Form::email('email', Auth::user()->email, ['class' => 'form-control full','placeholder' => trans('Cms::cms.field_email_placeholder')]) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-2 pt-2">@lang('Cms::cms.field_name'):</div>
        <div class="col-10 pb-2">
            {!! Form::text('name', Auth::user()->name, ['class' => 'form-control full','placeholder' => trans('Cms::cms.field_name_placeholder')]) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-2 pt-2">@lang('Cms::cms.field_timezone'):</div>
        <div class="col-10 pb-2">
            {!! Form::select('timezone', $timezonelist, Auth::user()->timezone, ['class' => 'custom-select']) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-2 pt-2">@lang('Cms::cms.field_language'):</div>
        <div class="col-10 pb-2">
            {!! Form::select('lang', config('app.locales',['en' => 'English','ru' => 'Русский']), Auth::user()->lang, ['class' => 'custom-select']) !!}
        </div>
    </div>
    <h5 class="mt-4">@lang('Cms::cms.fields_password_header'):</h5>
    <div class="row">
        <div class="col-2 pt-2">@lang('Cms::cms.field_password'):</div>
        <div class="col-10 pb-2">
            {!! Form::password('password', ['class' => 'form-control full','placeholder' => trans('Cms::cms.field_password_placeholder')]) !!}
      </div>
    </div>
    <div class="row">
        <div class="col-2 pt-2">@lang('Cms::cms.field_retype_password'):</div>
        <div class="col-10 pb-2">
            {!! Form::password('password_confirm', ['class' => 'form-control full','placeholder' => trans('Cms::cms.field_retype_password_placeholder')]) !!}
        </div>
    </div>
    <div class="row">
        <div class="offset-5 col-2 pt-2">
            {!! Form::submit(trans('Cms::cms.field_save'), ['class' => 'btn btn-primary w-100']) !!}
        </div>
    </div>
    {!! Form::close() !!}
@endsection
