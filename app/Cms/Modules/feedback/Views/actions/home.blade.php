<div id="deleteFeedback" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="feedback_title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="feedback_body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal" data-formid="" id="save-event-feedback">@lang('Cms::cms.yes')</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('Cms::cms.no')</button>
      </div>
    </div>
  </div>
</div>

{!! Form::open(['route' =>  ['feedback.delete'], 'id' => 'delete_feedback_form']) !!}
  {!! Form::hidden('feedback_id', '', ['id' => 'feedback_id']) !!}
{!! Form::close() !!}

{!! Form::open(['route' =>  ['feedback.truncate'], 'id' => 'truncate_feedback_form']) !!}
<div class="row justify-content-end">
    @if(count($messages->where('answer_status', '!=', null)) > 0)
      <div class="col-4 pb-3">
          {!! Form::submit('Удалить сообщения с ответом', ['name' => 'delete_messages', 'class' => 'btn btn-light border w-100', 'onclick' => 'javascript:truncateFeedbackOpen("with_answers");return false;']) !!}
      </div>
    @endif
    @if(count($messages) > 0)
      <div class="col-3 pb-3">
          {!! Form::submit('Удалить все сообщения', ['name' => 'truncate', 'class' => 'btn btn-light border w-100', 'onclick' => 'javascript:truncateFeedbackOpen("all");return false;']) !!}
      </div>
    @endif
</div>
@if(session()->has('feedback_messages'))
  <div class="alert alert-success mb-2">
     @lang(session()->get('feedback_messages'))
  </div>
@endif
{!! Form::hidden('type', 'error', ['id' => 'delete_type']) !!}
{!! Form::close() !!}

<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th class="text-center " style="width: 5%">#</th>
      <th style="width: 15%">@lang('feedback::feedback.author_name')</th>
      <th class="text-center" style="width: 15%">@lang('feedback::feedback.phone')</th>
      <th class="text-center" style="width: 15%">@lang('feedback::feedback.email')</th>
      <th class="text-center" style="width: 27%">@lang('feedback::feedback.message')</th>
      <!-- <th class="text-center" style="width: 10%">@lang('feedback::feedback.date')</th> -->
      <th class="text-center" style="width: 12%">@lang('feedback::feedback.action')</th>
    </tr>
  </thead>
  <tbody>
    @foreach($messages as $message)
    <tr>
      <td class="text-center" scope="row">{{$loop->index+1}}</td>
      <td>{{$message->name}}</td>
      <td class="text-center">{{$message->phone}}</td>
      <td class="text-center">{{$message->mail}}</td>
      <td class="text-center"><p class="mb-0 feedback-message">{{$message->message}}</p></td>
      <!-- <td class="text-center">DATE</td> -->
      <td class="text-center" style="width:100px">
        <a href="{{URL::to(env('CMS_URL', 'panel'))}}/modules/feedback/answer/{{$message->id}}" class="{{$message->answer_status > 0 ? 'text-success' : 'text-danger'}}"><i class="fas fa-comments ml-2"></i></a>
        <a href="javascript:deleteFeedbackOpen({{$message->id}})"><i class="fas fa-trash ml-2"></i></a>
      </td>
    </tr>
    @endforeach
    @if(count($messages) == null)
      <tr>
        <td colspan="7" class="text-center">@lang('feedback::feedback.no_messages')</td>
      </tr>
    @endif
  </tbody>
</table>

<div class="row">
    <div class="offset-5 col-2 pt-2">
        <a href="{{URL::to(env('CMS_URL', 'panel'))}}/modules/sitemap/{{$curpage->url}}" class="btn btn-light border w-100">@lang('Cms::cms.field_back')</a>
    </div>
</div>
