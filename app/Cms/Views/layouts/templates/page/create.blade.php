{!! Form::open(['route' =>  ['pages.save', $curpage], 'name' => 'create-page-form']) !!}
<div class="row">
    <div class="col-2 pt-2">@lang('Cms::cms.field_rootpagename'):</div>
    <div class="col-10 pb-2">
        {!! Form::select('parent_id', $makeTree->get('select'), $curpage != null ? $curpage->id : '', ['class' => 'custom-select','placeholder' => trans('Cms::cms.field_rootpagename_placeholder')]) !!}
    </div>
</div>
<div class="row">
    <div class="col-2 pt-2">@lang('Cms::cms.field_pagename'):</div>
    <div class="col-10 pb-2">
        {!! Form::text('name', '', ['class' => 'form-control full','placeholder' => trans('Cms::cms.field_pagename_placeholder')]) !!}
    </div>
</div>
<div class="row">
  <div class="col-2 pt-2">URL:</div>
  <div class="col-10 pb-2">
    {!! Form::text('url', '', ['class' => 'form-control full','placeholder' => trans('Cms::cms.field_pageurl_placeholder')]) !!}
  </div>
</div>
<div class="row">
  <div class="col-2 pt-2">@lang('Cms::cms.field_showmenu'):</div>
  <div class="col-10 pb-2">
    <input name="menu_id" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" type="checkbox" />
  </div>
</div>
<div class="row">
  <div class="col-2 pt-2">@lang('Cms::cms.field_pagemodule'):</div>
  <div class="col-10 pb-2">
    {!! Form::select('module', config("cms.modules", null), '', ['class' => 'custom-select','placeholder' => trans('Cms::cms.field_pagemodule_placeholder')]) !!}
  </div>
</div>
<div class="row">
  <div class="col-2 pt-2">@lang('Cms::cms.field_pageh1'):</div>
  <div class="col-10 pb-2">
    {!! Form::text('h1', '', ['class' => 'form-control full','placeholder' => trans('Cms::cms.field_pageh1_placeholder')]) !!}
  </div>
</div>
<div class="row">
  <div class="col-2 pt-2">@lang('Cms::cms.field_pagetitle'):</div>
  <div class="col-10 pb-2">
    {!! Form::text('title', '', ['class' => 'form-control full','placeholder' => trans('Cms::cms.field_pagetitle_placeholder')]) !!}
  </div>
</div>
<div class="row">
    <div class="offset-5 col-2 pt-2">
        {!! Form::hidden('new_page', 1) !!}
        {!! Form::submit(trans('Cms::cms.field_create'), ['class' => 'btn btn-primary w-100']) !!}
    </div>
</div>
{!! Form::close() !!}
