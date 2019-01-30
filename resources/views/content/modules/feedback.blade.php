@section('css')
  <link rel="stylesheet" href="{{ asset('cms/css/jquery.fancybox.min.css') }}" />
@endsection

@section('content')
  <div class="container py-lg-5 py-2">
    <div class="row">
      <div class="col-5">
        <h1 class="mb-3">{{$curpage->getTranslate()->h1 != null ? $curpage->getTranslate()->h1 : $curpage->getTranslate()->name}}</h1>
        <div class="mb-4">
          {!!$curpage->getTranslate()->content!!}
        </div>
      </div>
      <div class="offset-1 col-6">
        {{ Form::open(['url' => '#','id' => 'contactsform','class' => 'col-md-12 go-right validateform']) }}
          <p class="h1">Обратная связь</p>
            <p>Пожалуйста, заполните поля ниже, чтобы отправить сообщение.</p>
          <!-- Name -->
          <!-- <div id="sendmessage">
            Отправлено!
          </div> -->
          <div id="senderror"></div>
          <div class="form-group">
            {{ Form::text('name', '', ['class' => 'form-control', 'onkeyup' => 'checkParams()','id' => 'name','placeholder' => 'Ваше имя','required']) }}
            <!-- {{ Form::label('name', 'Your Name') }} -->
          </div>
          <!-- Phone -->
          <div class="form-group">
            {{ Form::tel('phone', '', ['class' => 'form-control', 'onkeyup' => 'checkParams()', 'onblur' => 'checkParams()','id' => 'phone','placeholder' => 'Контактный телефон','required']) }}
            <!-- {{ Form::label('phone', 'Primary Phone') }} -->
          </div>
          <!-- Email -->
          <div class="form-group">
            {{ Form::email('mail', '', ['class' => 'form-control', 'onkeyup' => 'checkParams()','id' => 'mail','placeholder' => 'Ваш Email','required']) }}
            {!! $errors->first('mail','<small class="form-control-feedback">Example help text that remains unchanged.</small>') !!}
            <!-- {{ Form::label('mail', 'Email') }} -->

          </div>
          <!-- Message -->
          <div class="form-group">
            {{ Form::textarea('message', '', ['class' => 'form-control form-textarea', 'onkeyup' => 'checkParams()','id' => 'message','placeholder' => 'Текст письма','required']) }}
            <!-- {{ Form::label('message', 'Message') }} -->
          </div>
          <!-- Capcha -->
          <!-- <div class="g-recaptcha" data-sitekey="6LduamQUAAAAAAysqJ7qrfVSGH5Gr9zJQ_CQo7JZ"></div> -->
          <!-- Submit button -->
          <div class="text-left">
              {{ Form::submit('Отправить', ['class' => 'btn btn-default mt-2 text-white float-right w-25 theme-bg', 'id' => 'submit', 'disabled']) }}
          </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
  <div style="display: none;max-width:600px;" id="modal_ok">
    <h2 data-selectable="true">@lang('feedback::feedback.success')</h2>
    <p data-selectable="true">@lang('feedback::feedback.success_message')</p>
  </div>
  <div style="display: none;max-width:600px;" id="modal_err">
    <h2 data-selectable="true">@lang('feedback::feedback.error')</h2>
    <p data-selectable="true">@lang('feedback::feedback.success_message')</p>
  </div>
  <div style="display: none;max-width:600px;" id="modal_re">
    <h2 data-selectable="true">@lang('feedback::feedback.repeat')</h2>
    <p data-selectable="true">@lang('feedback::feedback.repeat_message')</p>
  </div>
@endsection

@section('script')
  <script src="{{ asset('cms/js/jquery.fancybox.min.js') }}"></script>
  <script src="{{ asset('js/jquery.maskedinput.js') }}"></script>
  <script src="{{ asset('js/feedback.js') }}"></script>
@endsection
