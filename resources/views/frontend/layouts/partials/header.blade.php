<header class="top-header">
  <div class="container">
      <div class="wrap top-wrap">
          <div class="top-logo">
            <h1>{{ LAConfigs::getByKey('sitename') }}</h1>
            <p class="about-brand lastFirstUpper">@lang('main.header_title')</p>
          </div>
          <div class="top-callendar">
              {{date("j")}} @lang('main.date_' . (date("M") == "May" ? "May_full" : date("M"))) {{date("Y")}} @lang('main.header_date_y')
          </div>
          <div class="top-search">
              <form action="{{url('/search/')}}">
								<input name="keyword" type="text" placeholder="@lang('main.header_search')">
							</form>
          </div>
					
					@include('frontend.layouts.partials.swither_language')
					
          <div id="addmenuicon" class="addmenuicon-block">
              <span></span>
              <span></span>
              <span></span>
              <span></span>
          </div>
          <nav id="additional-top-nav" class="add-top-nav">
              <ul class="additonal-items">
                  <li><a href="#" class="add-rd">@lang('main.header_radio')</a></li>
                  <li><a href="#" class="add-tv">@lang('main.header_tv')</a></li>
                  <li><a href="#" class="add-goro">@lang('main.header_goroskop')</a></li>
                  <li><a href="#" class="add-oil">@lang('main.header_fuel')</a></li>
                  <li><a href="#" class="add-money">@lang('main.header_currency')</a></li>
                  <li><a href="#" class="add-weather">@lang('main.header_weather')</a></li>
                  <li><a href="#" class="add-pc-ver">@lang('main.header_full_version')</a>
                      <a href="#" class="add-lang" onclick="show('lang-more-add')">@lang('main.' . Config::get('languages')[App::getLocale()])</a>
										  <div id="lang-more-add" class="show-more lang-more">
										    @foreach (Config::get('languages') as $lang => $language)
										      @if ($lang != App::getLocale())
										        <a href="{{ url('/lang/' . $lang) }}">@lang('main.' . $language)</a>
										      @endif
										    @endforeach
										  </div>
                  </li>
              </ul>
          </nav>
      </div>
  </div>
</header>