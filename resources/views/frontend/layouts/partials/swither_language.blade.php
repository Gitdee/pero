<div class="text-right"> 
  <span class="dropdown lang">
    <a href="#" class="dropdown-toggle lang-active" data-toggle="dropdown">
        @lang('main.' . Config::get('languages')[App::getLocale()])<b class="caret"></b>
    </a>
    <ul class="dropdown-menu">
        @foreach (Config::get('languages') as $lang => $language)
            @if ($lang != App::getLocale())
                <li>
                    <a href="{{ url('/lang/' . $lang) }}">@lang('main.' . $language)</a>
                </li>
            @endif
        @endforeach
    </ul>
  </span>
</div>