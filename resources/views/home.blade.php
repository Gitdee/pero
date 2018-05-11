@extends("frontend.layouts.app")

@section("htmlheader_title")
  {{--LAConfigs::getByKey('homepage_meta_title')--}}
  News
@endsection

@section("main-content")
{{--@include('frontend.layouts.partials.newsletter')--}}
<div class="container">
	<div class="row">
		@if($runningLineNews)
		<marquee direction="left" style="background: #1080cf;color: #fff;height: 40px;line-height: 40px;">
	    @foreach($runningLineNews as $new)
	    	{{$new["title"]}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    @endforeach
	  </marquee>
	  @endif
	</div>
  <div class="row">
    <div class="col-lg-3 left_side">
    	<div class="row">
				<iframe src="https://player.twitch.tv/?channel=tokismen" frameborder="0" allowfullscreen="true" scrolling="no" height="278" width="300"></iframe><a href="https://www.twitch.tv/tokismen?tt_content=text_link&tt_medium=live_embed" style="padding:2px 0px 4px; display:block; width:345px; font-weight:normal; font-size:10px; text-decoration:underline;">Смотрите прямую трансляцию tokismen на www.twitch.tv</a>
				<br />
				chat
				<br />
				<iframe src="https://www.twitch.tv/embed/tokismen/chat" frameborder="0" scrolling="no" height="200" width="300"></iframe>				
			</div>
    	<div class="row">
    		<div class="col-lg-12">TV Program
    			@if($tvProgram)
    				<div style="height: 200px;overflow-y: scroll;overflow-x:hidden;">
	    				@foreach($tvProgram as $dayIfno)
	    					<div>@lang("main.date_" . $dayIfno["title"])({{$dayIfno["date"]}})</div>
	    					@if($dayIfno["items"])
									@foreach($dayIfno["items"] as $item)			
										<div class="row">
			                <div class="col-lg-2">
			                	{{date("H:i", strtotime($item["datetime"]))}}
			                </div>
			                <div class="col-lg-10">
			                	{!!$item["title"]!!}
			                </div>
			              </div>
			            @endforeach
		            @endif
	    				@endforeach
	    			</div>
    			@endif
        </div>
    	</div>
    	<br />
      <div class="row">
        <div class="col-lg-6">TV
        </div>
        <div class="col-lg-6">Radio
        </div>        
      </div>
      <div class="row">
        @if($tvs)        
          <div class="col-lg-6">
            @foreach($tvs as $tv)
              <a href="{{$tv["link"]}}">
              @if($tv["logo"])
                <img src = "{{ url('files') . "/" . $tv["logo"]["hash"] . '/' . $tv["logo"]["name"] . "?s=20"}}" alt = "{{$tv["title"]}}" class = "">
              @endif
              {{$tv["title"]}}
              </a><br />
            @endforeach
          </div>
        @endif
        @if($radios)        
          <div class="col-lg-6">
            @foreach($radios as $radio)
              <a href="{{$radio["link"]}}">
              @if($radio["logo"])
                <img src = "{{ url('files') . "/" . $radio["logo"]["hash"] . '/' . $radio["logo"]["name"] . "?s=20"}}" alt = "{{$radio["title"]}}" class = "">
              @endif
              {{$radio["title"]}}
              </a><br />
            @endforeach
          </div>
        @endif
      </div>
      <br />
      Links
      @if($leftLinks)
        @foreach($leftLinks as $leftLinkHeadline)
          <div>
            <h4>{{$leftLinkHeadline["title"]}}</h4>
            @if($leftLinkHeadline["links"])
              <div class="news_items">
                @foreach($leftLinkHeadline["links"] as $link)
                  <div class="row">
                    <div class="col-lg-12">
                      <a target="_blank"  href="{{$link["link"]}}">{{$link["title"]}}</a>
                    </div>
                  </div>
                @endforeach
              </div>
            @endif
            <br />
          </div>
        @endforeach
      @endif
      
    </div>
    <div class="col-lg-6"> 
      @if($mainCategoryNews)
        <div>
          <h3><a href="{{ url('/news/main') }}">@lang('main.main_category')</a></h3>
          <div class="news_items">
            @foreach($mainCategoryNews as $new)
              <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-10">
                  <a target="_blank" href="{{$new["link"]}}">{{$new["title"]}}</a>@if($new["resource_title"]) ({{$new["resource_title"]}})@endif
                </div>
              </div>
            @endforeach
          </div>
          <div class="text-right"><a href="{{ url('/news/main') }}">@lang('main.more_news')</a></div>
        </div>
      @endif
      @php
        $startDay = date("Y-m-d 00:00:00");                              
      @endphp
      @if($newsHeadlines)
        @foreach($newsHeadlines as $newHeadline)
          <div>
            <h3><a href="{{ url('/news/' . $newHeadline["slug"]) }}">{{$newHeadline["title"]}}</a></h3>
            @if($newHeadline["news"])
              <div class="news_items">
                @foreach($newHeadline["news"] as $new)
                  <div class="row">
                    <div class="col-lg-2">
                      @if(strtotime($new["datetime"]) > strtotime($startDay))
                        {{date("H:i", strtotime($new["datetime"]))}}
                      @else
                        {{date("H:i", strtotime($new["datetime"]))}}<br /> {{date("j", strtotime($new["datetime"]))}} @lang('main.date_' . date("M", strtotime($new["datetime"])))
                      @endif
                    </div>
                    <div class="col-lg-10">
                      <a target="_blank"  href="{{$new["link"]}}">{{$new["title"]}}</a>@if($new["resource_title"]) ({{$new["resource_title"]}})@endif
                    </div>
                  </div>
                @endforeach
              </div>
            @endif
            <div class="text-right"><a href="{{ url('/news/' . $newHeadline["slug"]) }}">@if($newHeadline["more_button"]){{$newHeadline["more_button"]}}@else @lang('main.more_news')@endif</a></div>
          </div>
        @endforeach
      @endif
      
      <br />
      <br />
      <h2>@lang('main.regional_category')</h2>
      <br />
      <br />
      @if($regionalNews)
        @foreach($regionalNews as $newHeadline)
          <div>
            <h3><a href="{{ url('/news/' . $newHeadline["slug"]) }}">{{$newHeadline["title"]}}</a></h3>
            @if($newHeadline["news"])
              <div class="news_items">
                @foreach($newHeadline["news"] as $new)
                  <div class="row">
                    <div class="col-lg-2">
                      @if(strtotime($new["datetime"]) > strtotime($startDay))
                        {{date("H:i", strtotime($new["datetime"]))}}
                      @else
                        {{date("H:i", strtotime($new["datetime"]))}}<br /> {{date("j", strtotime($new["datetime"]))}} @lang('main.date_' . date("M", strtotime($new["datetime"])))
                      @endif
                    </div>
                    <div class="col-lg-10">
                      <a target="_blank"  href="{{$new["link"]}}">{{$new["title"]}}</a>@if($new["resource_title"]) ({{$new["resource_title"]}})@endif
                    </div>
                  </div>
                @endforeach
              </div>
            @endif
            <div class="text-right"><a href="{{ url('/news/' . $newHeadline["slug"]) }}">@if($newHeadline["more_button"]){{$newHeadline["more_button"]}}@else @lang('main.more_news')@endif</a></div>
          </div>
        @endforeach
      @endif
    </div>
    <div class="col-lg-3 right_side">
      Chat
      <br />
      Banners
      @if($rightBanners)
      	@foreach($rightBanners as $rightBanner)
      		@if($rightBanner["html"] || $rightBanner["image"])
					<div class="banner" style="max-width: 100%;">
						@if($rightBanner["link"])
							<a href="{{$rightBanner["link"]}}">
						@endif
						@if($rightBanner["html"])
							{!!$rightBanner["html"]!!}
						@elseif($rightBanner["image"])
							<img style="max-width: 100%;" src = "{{ url('files') . "/" . $rightBanner["image"]["hash"] . '/' . $rightBanner["image"]["name"] . ""}}" alt = "" class = "">
						@endif
						@if($rightBanner["link"])
								</a>
							@endif
					</div>
					@endif
      	@endforeach
      @endif
      <br />
      Links
      @if($rightLinks)
        @foreach($rightLinks as $rightLinkHeadline)
          <div>
            <h4>{{$rightLinkHeadline["title"]}}</h4>
            @if($rightLinkHeadline["links"])
              <div class="news_items">
                @foreach($rightLinkHeadline["links"] as $link)
                  <div class="row">
                    <div class="col-lg-12">
                      <a target="_blank"  href="{{$link["link"]}}">{{$link["title"]}}</a>
                    </div>
                  </div>
                @endforeach
              </div>
            @endif
            <br />
          </div>
        @endforeach
      @endif
    </div>
  </div>
</div>
@endsection

@push('styles')
  <style>
    body{
      background: #ecf0f5;
      color:
    }
    header{
      background: #fff;
      color: #2196f3;
    }
    footer{
      background: #f3f3f3;
      min-height: 50px;
    }
    .left_side{
      background: #222d32;
      color: #fff;
      min-height: 300px;
    }
    .right_side{
      background: #10cfbd;
      color: #fff;
      min-height: 200px;
    }
  </style>

@endpush
@push('scripts')
@endpush