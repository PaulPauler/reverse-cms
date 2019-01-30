{!! Form::open(['route' => ['pages.update', '_method'], 'name' => 'edit-page-form', 'method' => 'PUT']) !!}
<div class="row">
    <div class="col-2 pt-2">@lang('Cms::cms.field_rootpagename'):</div>
    <div class="col-10 pb-2">
        {!! Form::select('parent_id', $makeTree->get('select'), $curpage->parent_id, ['class' => 'custom-select','placeholder' => trans('Cms::cms.field_rootpagename_now_placeholder')]) !!}
    </div>
</div>
<div class="row">
    <div class="col-2 pt-2">@lang('Cms::cms.field_pagename'):</div>
    <div class="col-10 pb-2">
        {!! Form::text('name', $curpage->getTranslate()->name, ['class' => 'form-control full','placeholder' => trans('Cms::cms.field_pagename_placeholder')]) !!}
    </div>
</div>
<div class="row">
  <div class="col-2 pt-2">URL:</div>
  <div class="col-10 pb-2">
    @if($curpage->id == 1)
      {!! Form::text('url', $curpage->url, ['class' => 'form-control full', 'disabled']) !!}
    @else
      {!! Form::text('url', $curpage->url, ['class' => 'form-control full','placeholder' => trans('Cms::cms.field_pageurl_placeholder')]) !!}
    @endif
  </div>
</div>
<div class="row">
  <div class="col-2 pt-2">@lang('Cms::cms.field_showmenu'):</div>
  <div class="col-10 pb-2">
    <input name="menu_id" {{$curpage->menu_id == 1 ? 'checked' : ''}} data-toggle="toggle" data-on="{{trans('Cms::cms.yes')}}" data-off="{{trans('Cms::cms.no')}}" data-onstyle="success" data-offstyle="danger" type="checkbox" />
  </div>
</div>
<div class="row">
  <div class="col-2 pt-2">@lang('Cms::cms.field_pagemodule'):</div>
  <div class="col-5 pb-2">
    {!! Form::select('module', config("cms.modules", null), $curpage->module, ['class' => 'custom-select','placeholder' => trans('Cms::cms.field_pagemodule_placeholder')]) !!}
  </div>
  @if($curpage->module != null)
      <div class="col-5 pb-2">
        <a href="{{URL::to(env('CMS_URL', 'panel'))}}/modules/{{$curpage->module}}" class="btn btn-primary border w-100">@lang('Cms::cms.button_module_edit')</a>
      </div>
  @endif
</div>
<div class="row">
  <div class="col-2 pt-2">@lang('Cms::cms.field_pageh1'):</div>
  <div class="col-10 pb-2">
    {!! Form::text('h1', $curpage->getTranslate()->h1, ['class' => 'form-control full','placeholder' => trans('Cms::cms.field_pageh1_placeholder')]) !!}
  </div>
</div>
<div class="row">
  <div class="col-2 pt-2">@lang('Cms::cms.field_pagecontent'):</div>
  <div class="col-10 pb-2">
    {!! Form::textarea('content', $curpage->getTranslate()->content, ['class' => 'form-control full summernote']) !!}
  </div>
</div>
<div class="row">
  <div class="col-2 pt-2">@lang('Cms::cms.field_pagetitle'):</div>
  <div class="col-10 pb-2">
    {!! Form::text('title', $curpage->getTranslate()->title, ['class' => 'form-control full','placeholder' => trans('Cms::cms.field_pagetitle_placeholder')]) !!}
  </div>
</div>
<div class="row">
    <div class="offset-5 col-2 pt-2">
        {!! Form::hidden('page_id', $curpage->id) !!}
        {!! Form::submit(trans('Cms::cms.field_save'), ['class' => 'btn btn-primary w-100']) !!}
    </div>
</div>
{!! Form::close() !!}
