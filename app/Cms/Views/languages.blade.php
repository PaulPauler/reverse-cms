@extends('Cms::layouts.app')

@section('header')
    @lang('Cms::cms.lang_'.$action)
@endsection

@section('content')
    @if (count($errors) > 0)
       <div class="alert alert-danger mb-2r">
          <ul class="mb-0">
              @foreach ($errors->all() as $error)
                 <li>{{$error}}</li>
              @endforeach
          </ul>
       </div>
    @elseif(session()->has('message'))
      <div class="alert alert-success mb-2">
         @lang(session()->get('message'))
      </div>
    @endif

    @if(session()->has('language_error'))
       <div class="alert alert-danger mb-2">
          @lang(session()->get('language_error'))
       </div>
    @elseif(session()->has('language_message'))
      <div class="alert alert-success mb-2">
         @lang(session()->get('language_message'))
      </div>
    @endif

    @switch($action)
      @case('edit')
          @include('Cms::layouts.templates.languages.edit')
          @break

      @case('create')
          @include('Cms::layouts.templates.languages.create')
          @break

      @default
          @include('Cms::layouts.templates.languages.home')
    @endswitch
@endsection

@section('script')
  <script>
    $(document).ready(function() {
      var lang_id = -1;
      $('#save-event-lang').on('click',function(evt){
        $('#language_id').val(lang_id);
        $('#delete_language_form').submit();
      });

      deleteLanguageOpen = function(language_id){
        lang_id = language_id;
        $("#deleteLanguage").modal();
      }
    });
  </script>
@endsection
