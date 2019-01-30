@switch($curpage->url)
  @case('example')
      @include('content.pages.example')
      @break
  @default
      @include('content.pages.common')
@endswitch
