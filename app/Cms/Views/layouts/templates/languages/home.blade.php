<div id="deleteLanguage" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">@lang('Cms::cms.delete_language')</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>@lang('Cms::cms.delete_language_message')</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal" id="save-event-lang">Yes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>

{!! Form::open(['route' =>  ['language.delete'], 'id' => 'delete_language_form']) !!}
  {!! Form::hidden('language_id', '', ['id' => 'language_id']) !!}
{!! Form::close() !!}

<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th>#</th>
      <th>@lang('Cms::cms.field_langname')</th>
      <th>@lang('Cms::cms.field_langcode')</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($languages as $language)
    <tr>
      <th scope="row">{{$loop->index+1}}</th>
      <td>{{$language->name}}</td>
      <td>{{$language->code}}</td>
      <td class="text-center" style="width:100px">
        <a href="{{URL::to(env('CMS_URL', 'panel'))}}/languages/{{$language->id}}"><i class="fas fa-edit"></i></a>
        @if($language->id > 1)
          <a href="javascript:deleteLanguageOpen({{$language->id}})"><i class="fas fa-trash ml-2"></i></a>
        @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
<div class="text-center mt-4">
  <a class="btn btn-primary" href="{{URL::to(env('CMS_URL', 'panel'))}}/languages/create">@lang('Cms::cms.lang_create')</a>
</div>
