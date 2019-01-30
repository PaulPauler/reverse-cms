<nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel">
  <div class="container-fluid">
    <div class="col-6 col-md-2 col-ld-2 p-0"><a class="navbar-brand" href="{{ url('/') }}" target="_blank"><!--<img src="{{asset('images/logo_large.png')}}" class="img-fluid mr-4 d-none d-sm-inline" />--><span class="h4 mr-1 d-none d-sm-inline">{{config('app.name', 'My Site')}}</span></a></div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse py-2" id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
      <ul class="navbar-nav mr-auto"></ul>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
          <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
          <!-- <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li> -->
        @else
          <li class="nav-item dropdown text-right text-md-left">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{URL::to(env('CMS_URL', 'panel').'/filemanager')}}">@lang('Cms::cms.menu_filemanager')</a>
                <a class="dropdown-item" href="{{URL::to(env('CMS_URL', 'panel'))}}">@lang('Cms::cms.menu_settings')</a>
                @if(config("cms.multilanguage") == 'on')
                  <a class="dropdown-item" href="{{URL::to(env('CMS_URL', 'panel'))}}/languages">@lang('Cms::cms.languages_page_name')</a>
                @endif
                @role('Admin')
                  <!-- <a class="dropdown-item" href="/settings">Settings</a> -->
                @endrole

                <a class="dropdown-item" href="{{URL::to(env('CMS_URL', 'panel'))}}/account">@lang('Cms::cms.account_page_name')</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
<div id="alert-success" class="p-3" style="width:400px;position:fixed; right:0; z-index:111"></div>
