<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>{{ config('app.name', 'My Site')}}{{($curpage->getTranslate()->title != null) ? ' - '.$curpage->getTranslate()->title : ''}}</title>

      <link href="{{ asset('cms/css/bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ asset('cms/css/all.css') }}" rel="stylesheet">

      @yield('css')

      <!-- Styles -->
      <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
  </head>
  <body>
      @section('header')
        @include('layouts/templates/header')
      @show

      @yield('content')

      @section('footer')
        @include('layouts/templates/footer')
      @show

      <!-- Scripts -->
      @section('scripts')
        @include('layouts/templates/scripts')
      @show

      @yield('script')
  </body>
</html>
