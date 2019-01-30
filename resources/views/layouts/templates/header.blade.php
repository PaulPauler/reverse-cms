<header>
  <div class="header-bg pt-4" style="background-image: url({{asset('images/header-bg-large.jpg')}})">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-8 logo">
					<a class="logo h4 mr-1 theme-color" href="{{URL::to('/')}}">{{env('APP_NAME')}}</a>
					<span class="small">Юридические, риэлторские и медиативные услуги</span>
          @include('layouts.templates.navbar')
				</div>
        <div class="col-xs-10 col-md-4 phone text-right">
          <p class="small mb-0">Ежедневно с 2 до 17 по МСК.</p>
          <p class="h2 mb-0 theme-color font-weight-bold">8 800 700 93 75</p>
        </div>
      </div>
    </div>
    @yield('header_plus')
  </div>
</header>
