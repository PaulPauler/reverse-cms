@extends('Cms::layouts.app')

@section('css')
  <link href="{{ asset('cms/css/summernote-bs4.css') }}" rel="stylesheet">
@endsection

@section('header')
    @lang('Cms::cms.page_'.$action)
@endsection

@section('content')
    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul class="mb-0 pl-1">
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

    @switch($action)
      @case('edit')
          @include('Cms::layouts.templates.page.edit')
          @break

      @case('create')
          @include('Cms::layouts.templates.page.create')
          @break

      @default
          @include('Cms::layouts.templates.page.home')
    @endswitch

@endsection

@section('script')
  <script src="{{ asset('cms/js/summernote-bs4.js') }}"></script>
  <script>
    $(document).ready(function() {
      // Define function to open filemanager window
      var lfm = function(options, cb) {
          var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
          window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
          window.SetUrl = cb;
      };

      // Define LFM summernote button
      var LFMButton = function(context) {
          var ui = $.summernote.ui;
          var button = ui.button({
              container: 'test',
              contents: '<i class="note-icon-picture"></i> ',
              tooltip: 'Insert image with filemanager',
              click: function() {

                  lfm({type: 'image', prefix: '{{URL::to(config('lfm.url_prefix'))}}'}, function(url, path) {
                      context.invoke('insertImage', url);
                  });

              }
          });
          return button.render();
      };

      // Initialize summernote with LFM button in the popover button group
      // Please note that you can add this button to any other button group you'd like
      $('.summernote').summernote({
          height: 150,
          toolbar: [
            // [groupName, [list of button]]
              ['style', ['bold', 'italic', 'underline', 'clear']],
              ['fontsize', ['fontsize']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['height', ['height']],
              ['insert', ['link', 'lfm', 'video']]
          ],
          buttons: {
              lfm: LFMButton
          }
      })
    });
  </script>
@endsection
