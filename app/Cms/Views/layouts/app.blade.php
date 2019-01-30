<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>Reverse Systems CMS</title>

      <link href="{{ asset('cms/css/bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ asset('cms/css/all.css') }}" rel="stylesheet">

      @yield('css')

      <!-- Styles -->
      <link href="{{ asset('cms/css/cms.css') }}" rel="stylesheet">
  </head>
  <body>
      @section('navigation')
        @include('Cms::layouts.templates.navigation')
      @show

      <div class="container-fluid">
        <div class="row">
          @role(['Admin','Content_manager'])
            <nav id="sidebar" class="sidebar pt-2">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column py-1">
                        @include('Cms::layouts.templates.panel')
                    </ul>
                </div>
            </nav>
          @endrole
          <div class="col p-0">
            <main class="main p-4 w-100">
                <div class="row">
                    <div class="col-8">
                        <div class="cssload-container d-flex flex-wrap align-content-center">
                          <div class="cssload-double-torus"></div>
                        </div>
                        <div class="justify-content-center w-100 preload">
                            <div class="card">
                              <div class="card-header">
                                  @if(config("cms.multilanguage") == 'on')
                                    <div class="float-right">
                                      {!! Form::open(['route' => 'language.change']) !!}
                                        {!! Form::label('lang_id', trans('Cms::cms.content_language').':') !!}
                                        {!! Form::select('lang_id', $languages_enabled_array, Session::get('content_lang_id', 1), ['class' => 'd-inline-block custom-select ml-2 pl-2', 'style' => 'width: auto', 'onchange' => 'this.form.submit()']) !!}
                                      {!! Form::close() !!}
                                    </div>
                                  @endif
                                  <span class="h3">@yield('header')</span>
                              </div>
                              <div class="card-body">
                                  @yield('content')
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        @include('Cms::layouts.templates.structure')
                    </div>
                </div>
            </main>
          </div>
        </div>
      </div>

      @section('footer')
        @include('Cms::layouts.templates.footer')
      @show

      <!-- Scripts -->
      @section('scripts')
        @include('Cms::layouts.templates.scripts')
      @show

      @yield('script')
  </body>
</html>
