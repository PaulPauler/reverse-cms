<li class="nav-item @if(isset($parent) && $parent=='filemanager') nav-active @endif">
    <a class="nav-link" href="{{URL::to(env('CMS_URL', 'panel').'/filemanager')}}"><div class="d-inline-block text-center panel-item"><i class="fas fa-copy mr-2"></i></div>@lang('Cms::cms.menu_filemanager')</a>
</li>
<li class="nav-item @if(isset($parent) && $parent=='settings') nav-active @endif">
    <a class="nav-link" href="{{URL::to(env('CMS_URL', 'panel'))}}/"><div class="d-inline-block text-center panel-item"><i class="fas fa-cog mr-2"></i></div>@lang('Cms::cms.menu_settings')</a>
</li>
@if(config("cms.multilanguage") == 'on')
  <li class="nav-item @if(isset($parent) && $parent=='languages') nav-active @endif">
      <a class="nav-link" href="{{ URL::to(env('CMS_URL', 'panel').'/languages') }}"><div class="d-inline-block text-center panel-item"><i class="fas fa-language mr-2"></i></div>@lang('Cms::cms.languages_page_name')</a>
  </li>
@endif
<li class="nav-item @if(isset($parent) && $parent=='account') nav-active @endif">
    <a class="nav-link" href="{{ URL::to(env('CMS_URL', 'panel').'/account') }}"><div class="d-inline-block text-center panel-item"><i class="fas fa-user-circle mr-2"></i></div>@lang('Cms::cms.account_page_name')</a>
</li>
@role('Admin')
  <!-- <li class="nav-item @if(isset($parent) && $parent=='settings') nav-active @endif">
      <a class="nav-link" href="{{ URL::to('/settings') }}"><span class="fas fa-folder-open"></span>Cms settings</a>
  </li> -->
@endrole
