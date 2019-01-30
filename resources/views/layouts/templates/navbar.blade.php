<div class="menu mt-2">
  <nav class="navbar navbar-expand-lg navbar-light p-0">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav text-uppercase">
        @foreach($pages as $page)
          @if($page->menu_id == 1)
            <li class="nav-item{{($curpage->id == $page->id) ? ' active' : ''}}">
              <a class="nav-link small p-0 pr-2 mr-2" href="{{URL::to('/')}}/{{$page->id == 1 ? '' : $page->url}}">{{$page->getTranslate()->name}}{!!($curpage->id == $page->id) ? ' <span class="sr-only">(current)</span>' : ''!!}</a>
            </li>
          @endif
        @endforeach
      </ul>
    </div>
  </nav>
</div>
