{!! Form::open(['name' => 'edit-language-form', 'method' => 'PUT']) !!}
<div class="row">
    <div class="col-2 pt-2">@lang('Cms::cms.field_langname'):</div>
    <div class="col-10 pb-2">
        {!! Form::text('name', $curlang->name, ['class' => 'form-control full', 'placeholder' => trans('Cms::cms.field_langname_placeholder')]) !!}
    </div>
</div>
<div class="row">
  <div class="col-2 pt-2">@lang('Cms::cms.field_langcode'):</div>
  <div class="col-10 pb-2">
    {!! Form::text('code', $curlang->code, ['class' => 'form-control full', 'placeholder' => trans('Cms::cms.field_langcode_placeholder')]) !!}
  </div>
</div>
<div class="row">
    <div class="offset-4 col-2 pt-2">
        {!! Form::hidden('id', $curlang->id) !!}
        {!! Form::submit(trans('Cms::cms.field_save'), ['class' => 'btn btn-primary w-100']) !!}
    </div>
    <div class="col-2 pt-2">
        <a href="{{URL::to(env('CMS_URL', 'panel'))}}/languages" class="btn btn-light border w-100">@lang('Cms::cms.field_back')</a>
    </div>
</div>
{!! Form::close() !!}
