<div class="wrap">
  <a href="{{url('/')}}" class="toplogo">
      <img src="{{ asset('/la-assets/img/logo.png') }}" alt="logo">
  </a>
  <div class="nav-and-baners">
      <div>
          <div id="adaptmenuicon" class="menu__icon">
              <span></span>
              <span></span>
              <span></span>
              <span></span>
          </div>
          @php
	          use App\Models\TopMenu;
	          $menus = TopMenu::where("parent", 0)->orderBy('hierarchy', 'asc')->get();
	        @endphp
	        @if($menus)
	  				<nav id="top-nav" class="top-nav">
              <ul class="main-menu">
            		@foreach($menus as $menu)
		              <li><a class="{{--lastFirstUpper--}}" href="@if(strpos($menu->url, "http") !== false){{$menu->url}}@else{{url($menu->url) }}@endif">{{uclwords($menu->name)}}</a></li>
		            @endforeach
              </ul>
          	</nav>
	        @endif
          @php 
          	use App\Models\Banner;
          	$heroBanner = Banner::where("status", 1)->where("placing", "Hero")->inRandomOrder()->first();
          	if($heroBanner) $heroBanner = $heroBanner->toArray();
          @endphp
          @if($heroBanner)
						<div class="top-baner">
						@if($heroBanner["html"] || $heroBanner["image"])
						<div class="banner">
							@if($heroBanner["link"])
								<a href="{{$heroBanner["link"]}}">
							@endif
							@if(trim($heroBanner["html"]))
								{!!$heroBanner["html"]!!}
							@elseif($heroBanner["image"])
								<img style="max-width: 100%;" src = "{{ url('files') . "/" . $heroBanner["image"]["hash"] . '/' . $heroBanner["image"]["name"] . ""}}" alt = "" class = "">
							@endif
							@if($heroBanner["link"])
								</a>
							@endif
						</div>
						@endif
					</div>
					@endif
      </div>
      <div class="additional">
          <div class="goroskop">
              <a href="#" class="lastFirstUpper">@lang('main.header_goroskop')</a>
          </div>
          <div class="drop-down-top">
              <div class="drop-down-rec">
                  <span class="oil-name">AE-98  -  </span>
                  <span class="oil-val">33.55</span>
              </div>
              <div class="but">
                  <a href="#" class="lastFirstUpper" onclick="show('oil-more')">@lang('main.header_fuel')</a>
              </div>
              <div id="oil-more" class="show-more">
                  <p>Регіон: <a href="#" class="city-list">Київ</a></p>
                  <table>
                      <tr>
                          <td>Пальне</td>
                          <td colspan="2">Ціна на заправках</td>
                      </tr>
                      <tr>
                          <td>А-98</td>
                          <td>33.55</td>
                          <td>UPG</td>
                      </tr>
                      <tr>
                          <td>А-98</td>
                          <td>33.55</td>
                          <td>UPG</td>
                      </tr>
                      <tr>
                          <td>А-98</td>
                          <td>33.55</td>
                          <td>UPG</td>
                      </tr>
                      <tr>
                          <td>А-98</td>
                          <td>33.55</td>
                          <td>UPG</td>
                      </tr>
                      <tr>
                          <td>А-98</td>
                          <td>33.55</td>
                          <td>UPG</td>
                      </tr>
                      <tr>
                          <td>А-98</td>
                          <td>33.55</td>
                          <td>UPG</td>
                      </tr>
                  </table>
              </div>
          </div>
          <div class="drop-down-top">
              <div class="drop-down-rec">
                  <span class="money-val doll">61.39<span class="money-up"></span></span>
                  <span class="money-val euro">75.40<span class="money-down"></span></span>
                  <span class="money-val rubl">0.38<span class="money-down"></span></span>
              </div>
              <div class="but">
                  <a href="#" class="lastFirstUpper" onclick="show('money-more')">@lang('main.header_currency')</a>
              </div>
              <div id="money-more" class="show-more">
                  <table>
                      <tr>
                          <td></td>
                          <td>Купівля</td>
                          <td>Продаж</td>
                          <td>НБУ</td>
                      </tr>
                      <tr>
                          <td>USD</td>
                          <td>25.94</td>
                          <td>25.94</td>
                          <td>25.94</td>
                      </tr>
                      <tr>
                          <td>EUR</td>
                          <td>31.22</td>
                          <td>31.22</td>
                          <td>31.22</td>
                      </tr>
                      <tr>
                          <td>RUB</td>
                          <td>0.379</td>
                          <td>0.379</td>
                          <td>0.379</td>
                      </tr>
                  </table>
              </div>
          </div>
          <div class="drop-down-top">
              <div class="drop-down-rec">
                  <span class="weather-ico">
                      <img src="{{ asset('/la-assets/img/weather/010-rain-3.png') }}" alt="rain">
                  </span>
                  <span class="weather-val">+3 &deg;C</span>
              </div>
              <div class="but">
                  <a href="#" class="lastFirstUpper" onclick="show('weather-more')">@lang('main.header_weather')</a>
              </div>
              <div id="weather-more" class="show-more">
                  <p>Регіон: <a href="#" class="city-list">Київ</a></p>
                  <p>Вологість: 32%</p>
                  <p>Тиск: 736 мм</p>
                  <p>Вітер: 1 м/с</p>
              </div>
          </div>
      </div>
  </div>


</div>