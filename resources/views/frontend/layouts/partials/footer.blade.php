<footer>
  <div class="container">
      <div class="wrap footer-wrap">
          <div class="footer-logo">
              <h2 class="footer-header">{{ LAConfigs::getByKey('sitename') }}</h2>
              <p class="footer-preheader">@lang('main.header_title')</p>
          </div>
          @php
	          use App\Models\FooterMenu;
	          $menus = FooterMenu::where("parent", 0)->orderBy('hierarchy', 'asc')->get();
	        @endphp
	        @if($menus)
        		@foreach($menus as $menu)
        			<a href="href="@if(strpos($menu->url, "http") !== false){{$menu->url}}@else{{url($menu->url) }}@endif" class="footer-link">{{$menu->name}}</a>
            @endforeach
	        @endif
      </div>
  </div>
</footer>