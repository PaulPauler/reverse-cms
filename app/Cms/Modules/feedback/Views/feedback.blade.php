@extends('Cms::layouts.app')

@section('header')
    @lang('feedback::feedback.name')
@endsection

@section('content')
  @if (count($errors) > 0)
     <div class="alert alert-danger mb-2r">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
               <li>{{$error}}</li>
            @endforeach
        </ul>
     </div>
  @elseif(session()->has('message'))
    <div class="alert alert-success mb-2">
       @lang(session()->get('message'))
    </div>
  @endif

  @if(session()->has('feedback_error'))
     <div class="alert alert-danger mb-2">
        @lang(session()->get('feedback_error'))
     </div>
  @elseif(session()->has('feedback_message'))
    <div class="alert alert-success mb-2">
       @lang(session()->get('feedback_message'))
    </div>
  @endif

  @switch($action)
    @case('answer')
        @include('feedback::actions.answer')
        @break
    @default
        @include('feedback::actions.home')
  @endswitch
@endsection

@section('script')
  <script>
    $(document).ready(function() {
      var feedback_id = -1;
      $('#save-event-feedback').on('click',function(evt){
        var formid = $(this).attr('data_formid');
        $('#feedback_id').val(feedback_id);
        $(formid).submit();
      });

      deleteFeedbackOpen = function(fb_id){
        feedback_id = fb_id;
        $("#feedback_title").html('{{trans('feedback::feedback.delete_header')}}');
        $("#feedback_body").html('<p>{{trans('feedback::feedback.delete_message')}}</p>');
        $("#save-event-feedback").attr('data_formid', '#delete_feedback_form');
        $("#deleteFeedback").modal();
      }

      truncateFeedbackOpen = function(action){
        $("#feedback_title").html('{{trans('feedback::feedback.delete_header')}}');
        $("#feedback_body").html('<p>{{trans('feedback::feedback.delete_messages')}}</p>');
        action == "all" ? $("#feedback_body").html('<p>{{trans('feedback::feedback.delete_messages')}}</p>') : $("#feedback_body").html('<p>{{trans('feedback::feedback.delete_messages_wa')}}</p>');
        $("#save-event-feedback").attr('data_formid', '#truncate_feedback_form');
        $("#delete_type").val(action);
        $("#deleteFeedback").modal();
      }

      $('.feedback-message').each(function() {
        if($(this).text().length > 120){
          $(this).text($(this).text().slice(0, 120) + '...');
        }
      });
    });
  </script>
@endsection
