{!! Form::open(['route' => ['feedback.answer']]) !!}
    <div class="row">
      <div class="col-7 pt-2">
        <blockquote class="blockquote rounded p-3" style="background-color: #ececec; border: 1px solid #b5b5b5">
          <p class="h5 mb-0">{{$curmessage->name}}:</p><small>{{$curmessage->phone}}</small>, <small>{{$curmessage->mail}}</small>
          <hr />
          <p class="blockquote-footer">{{$curmessage->message}}</p>
        </blockquote>
      </div>
    </div>
    @if($curmessage->answer_status == null)
      <div class="row">
        <div class="offset-5 col-7 pt-2">
          <p class="h5">@lang('feedback::feedback.your_answer'):</p>
          {!! Form::textarea('answer', '', ['class' => 'form-control w-100']) !!}
        </div>
      </div>
      {!! Form::hidden('message_id', $curmessage->id, ['id' => 'feedback_id']) !!}
      <div class="row">
        <div class="offset-9 col-3 pt-4">
          {!! Form::submit(trans('feedback::feedback.send'), ['class' => 'btn btn-primary w-100']) !!}
        </div>
      </div>
    @else
      <div class="row">
        <div class="offset-5 col-7 pt-2">
          <blockquote class="blockquote rounded p-3" style="background-color: #ececec; border: 1px solid #b5b5b5">
            <p class="h5 mb-0">@lang('feedback::feedback.your_answer'):</p><small>@lang('feedback::feedback.answer_author'): {{$curmessage->answer_author}}</small>
            <hr />
            <p class="blockquote-footer">{{$curmessage->answer}}</p>
          </blockquote>
        </div>
      </div>
    @endif
    <div class="row">
      <div class="offset-10 col-2 pt-4">
          <a href="{{URL::to(env('CMS_URL', 'panel'))}}/modules/feedback" class="btn btn-light border w-100">@lang('Cms::cms.field_back')</a>
      </div>
    </div>
{!! Form::close() !!}
