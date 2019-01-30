<div id="deletePage" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">@lang('Cms::cms.delete_page')</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>@lang('Cms::cms.delete_page_message')</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal" id="save-event">Yes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>

{!! Form::open(['route' =>  ['page.delete'], 'id' => 'delete_page_form']) !!}
  {!! Form::hidden('page_id', '', ['id' => 'page_id']) !!}
{!! Form::close() !!}

<div class="justify-content-center w-100">
    <div class="card">
      <div class="card-header">
          <span class="h3">@lang('Cms::cms.site_structure')</span>
      </div>
      <div class="card-body">
          @if(session()->has('structure_error'))
             <div class="alert alert-danger mb-1">
                @lang(session()->get('structure_error'))
             </div>
          @elseif(session()->has('structure_message'))
            <div class="alert alert-success mb-1">
               @lang(session()->get('structure_message'))
            </div>
          @endif

          <ul class="sitemap border-green">
            <li class="mb-1 p-2">
              <div class="float-right">
                <a href="{{route('pages.create', ['curpage' =>  isset($curpage) ? $curpage : null])}}"><i class="fas fa-plus-circle"></i></a>
                <!-- <a href="{{URL::to(env('CMS_URL', 'panel'))}}/"><i class="fas fa-cog"></i></a> -->
              </div>
              <a href="{!!isset($curpage) && $curpage->id != 1 ? URL::to($makeTree->from($curpage)->get('fullUrl')) : URL::to('/')!!}" class="h5" target="_blank"><i class="fas fa-globe"></i><span>{!!isset($curpage) && $curpage->id != 1 ? URL::to($makeTree->from($curpage)->get('fullUrl')) : URL::to('/')!!}</span></a>
            </li>
          </ul>
          {!!$makeTree->currentUrl(isset($curpage->url) ? $curpage->url : null)->get('structure')!!}
          <div class="d-none" id="serialize_output"></div>
      </div>
    </div>
</div>
