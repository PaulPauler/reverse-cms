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
                    <div class="col-12">
                        <div class="justify-content-center w-100">
                            @yield('content')
                        </div>
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
