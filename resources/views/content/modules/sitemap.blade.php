@section('content')
  <div class="container py-lg-5 py-2">
    <h1 class="mb-3">{{$curpage->getTranslate()->h1 != null ? $curpage->getTranslate()->h1 : $curpage->getTranslate()->name}}</h1>
    {!!$curpage->getTranslate()->content!!}
    {!!$makeTree->get('sitemap')!!}
  </div>
@endsection
