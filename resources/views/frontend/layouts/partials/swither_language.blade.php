<div class="lang">
  <a href="#" onclick="show('lang-more')">@lang('main.' . Config::get('languages')[App::getLocale()])</a>
  <div id="lang-more" class="show-more lang-more">
    @foreach (Config::get('languages') as $lang => $language)
      @if ($lang != App::getLocale())
        <a href="{{ url('/lang/' . $lang) }}">@lang('main.' . $language)</a>
      @endif
    @endforeach
  </div>
</div>