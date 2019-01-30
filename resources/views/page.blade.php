@extends('layouts.site')

@section('header_plus')
  <div class="pt-3 header-plus-border"></div>
@endsection

@switch($curpage->module)
  @case(null)
      @include('content.page')
      @break
  @default
      @include('content.modules.'.$curpage->module)
@endswitch
