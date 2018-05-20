@extends("frontend.layouts.app")

@section("htmlheader_title")
  @lang('main.header_title')
@endsection

@section("news-line")
	@include('frontend.layouts.partials.news_line')
@endsection

@section("main-content")

<div class="wrap main-block">
    <div class="programm">
        <h2 id="programm-header" class="block-header">@lang("main.homepage_tv_program")</h2>
        <div id="programm-content" class="main-block-scroll programm-content">
          @if($tvProgram)
    				@foreach($tvProgram as $dayIfno)
	    					<p class="title"><strong>@lang("main.date_" . $dayIfno["title"])</strong> <span class="date">({{$dayIfno["date"]}})</span>:</p>
	    					@if($dayIfno["items"])
									@foreach($dayIfno["items"] as $item)			
										<div class="row">
											<span class="time-block">{{date("H:i", strtotime($item["datetime"]))}}</span>
			                {!!$item["title"]!!}
		                </div>
			            @endforeach
		            @endif
	    				@endforeach
	    		@else
	    			<p class="title" style="border: 0;">@lang('main.homepage_tv_program_no_records')</p>
    			@endif
        </div>
    </div>
    <div class="video-strimm">
        <iframe src="https://player.twitch.tv/?channel=tokismen" frameborder="0" allowfullscreen="true" allow="autoplay; encrypted-media"></iframe>
    </div>
		<div class="chat">
			<h2 id="chat-header" class="block-header">@lang('main.homepage_chat')</h2>
        <div id="chat-content" class="main-block-scroll chat-content"">
					<iframe src="https://www.twitch.tv/embed/tokismen/chat" frameborder="0" scrolling="no" height="288" width="225"></iframe>
				</div>
		</div>
		@if($rightBanners)
		 	<div class="second-banners main-block-scroll">
      	@foreach($rightBanners as $rightBanner)
      		@if($rightBanner["html"] || $rightBanner["image"])
					<div class="banner">
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
    	</div>
    @endif

</div>



<div class="wrap other-blocks">
  <div class="col-1">
  		<div class="mediablock" style="margin-bottom:10px;">
  			<h2 id="but-rd" class="block-header media" style="width: 100%;margin-bottom:10px;">@lang('main.homepage_taxi')</h2>
  			@if($taxi)        
	         @foreach($taxi as $item)
	         <h4 style="width: 100%;text-align:center;">{{$item["title"]}}</h4>
	         	@if($item["items"])
	         		@foreach($item["items"] as $item2)
		         		@if($item2["link"])
		         			<a href="{{$radio["link"]}}">
		         		@endif
		         			<p style="text-align: center;">{{$item2["title"]}} &nbsp;&nbsp;&nbsp;{{$item2["phone"]}}</p>
		         		@if($item2["link"])
		         			</a>
		         		@endif
	         		@endforeach
         		@endif
	         @endforeach
	     	@endif
  		</div>
      <div class="mediablock">
          <h2 id="but-rd" class="block-header media" onclick="show('list-radio')">@lang('main.homepage_radio')</h2>
          <h2 id="but-tv" class="block-header media active" onclick="show('list-tv')">@lang('main.homepage_tv')</h2>
          <div id="list-radio" class="media-list-content">
            @if($radios)        
	            @foreach($radios as $radio)
	              <p>
									<a href="{{$radio["link"]}}">
		              @if($radio["logo"])
		                <img src = "{{ url('files') . "/" . $radio["logo"]["hash"] . '/' . $radio["logo"]["name"] . "?s=16"}}" alt = "{{$radio["title"]}}" class = "">
		              @endif
		              {{$radio["title"]}}
		              </a>
	              </p>
	            @endforeach
		       	@else
         			<p>@lang('main.homepage_no_records')</p>
		        @endif
          </div>
          <div id="list-tv" class="media-list-content">
        		@if($tvs)    
		            @foreach($tvs as $tv)
			            <p>
										<a href="{{$tv["link"]}}">
			              @if($tv["logo"])
			                <img src = "{{ url('files') . "/" . $tv["logo"]["hash"] . '/' . $tv["logo"]["name"] . "?s=16"}}" alt = "{{$tv["title"]}}" class = "">
			              @endif
			              {{$tv["title"]}}
			              </a>
			            </p>
		            @endforeach
         		@else
         			<p>@lang('main.homepage_no_records')</p>
		        @endif
          </div>
      </div>
		
			@if($leftLinks)
				<div class="siteslist">
	        @foreach($leftLinks as $leftLinkHeadline)
            <h3 class="sitelist-header">{{$leftLinkHeadline["title"]}}</h3>
            @if($leftLinkHeadline["links"])
            	@foreach($leftLinkHeadline["links"] as $link)
                <a target="_blank"  href="{{$link["link"]}}">{{$link["title"]}}</a>
              @endforeach
            @endif
	        @endforeach
        </div>
      @endif
  </div>
  <div class="col-2">
			@if($mainCategoryNews)
	      <div class="main-news">
	          <a href="{{ url('/news/main') }}"><h2 class="center-block-header {{--lastFirstUpper--}}">@lang('main.main_category')</h2></a>
	          @foreach($mainCategoryNews as $new)
	          	<p><a target="_blank" href="{{$new["link"]}}">{{$new["title"]}}</a><span class="resource_title">@if($new["resource_title"]) ({{$new["resource_title"]}})@endif</span></p>
	          @endforeach
	          <h3 class="center-block-more"><a href="{{ url('/news/main') }}">@lang('main.more_news')</a></h3>
	      </div>
      @endif
      
      @php
        $startDay = date("Y-m-d 00:00:00");    
				$regionalNewsPosition = LAConfigs::getByKey('region_position_on_homepage');                          
      @endphp
      @if($newsHeadlines)
      	@foreach($newsHeadlines as $key => $newHeadline)
      		@if($regionalNewsPosition == ($key + 1) && $regionalNews)
			      <div class="main-news politics regions_wrapper">
			          <h2 class="center-block-header region-header" onclick="show('region-more')">
		              @foreach($regionalNews as $newHeadlineRegion)
										@if($newHeadlineRegion["region_id"] == $regionalID)<span class="regions_title">{{$newHeadlineRegion["title"]}}</span>@endif
									@endforeach
		              <div id="region-more" class="show-more">
		                  @foreach($regionalNews as $newHeadlineRegion)
												<a data-region_title="{{$newHeadlineRegion["title"]}}" data-region_id="{{$newHeadlineRegion["region_id"]}}" href="javascript:;" @if($newHeadlineRegion["region_id"] == $regionalID)class="activecity"@endif>{{$newHeadlineRegion["region_title"]}}</a>
											@endforeach
		              </div>
			          </h2>
								@foreach($regionalNews as $newHeadlineRegion)
				          <div class="region_news_container @if($newHeadlineRegion["region_id"] == $regionalID) active @endif" id="region_news_container_region_{{$newHeadlineRegion["region_id"]}}">
					          @foreach($newHeadlineRegion["news"] as $new)
											<p>
												<span class="time">
													@if(strtotime($new["datetime"]) > strtotime($startDay))
			                      {{date("H:i", strtotime($new["datetime"]))}}
			                    @else
			                      {{date("H:i", strtotime($new["datetime"]))}}<br /> {{date("j", strtotime($new["datetime"]))}} @lang('main.date_' . date("M", strtotime($new["datetime"])))
			                    @endif
												</span>
												<a target="_blank"  href="{{$new["link"]}}">{{$new["title"]}}</a><span class="resource_title">@if($new["resource_title"]) ({{$new["resource_title"]}})@endif</span>
											</p>
					         	@endforeach
					          <h3 class="center-block-more"><a href="{{ url('/news/' . $newHeadlineRegion["slug"]) }}">@if($newHeadlineRegion["more_button"]){{$newHeadlineRegion["more_button"]}}@else @lang('main.more_news')@endif</a></h3>
				          </div>
				      	@endforeach
			      </div>
      		@endif
	      	<div class="main-news politics">
	          <a href="{{ url('/news/' . $newHeadline["slug"]) }}"><h2 class="center-block-header {{--lastFirstUpper--}}">{{$newHeadline["title"]}}</h2><a></a>
	          @if($newHeadline["news"])
							@foreach($newHeadline["news"] as $new)
								<p>
									<span class="time">
										@if(strtotime($new["datetime"]) > strtotime($startDay))
                      {{date("H:i", strtotime($new["datetime"]))}}
                    @else
                      {{date("H:i", strtotime($new["datetime"]))}}<br /> {{date("j", strtotime($new["datetime"]))}} @lang('main.date_' . date("M", strtotime($new["datetime"])))
                    @endif
									</span>
									<a target="_blank"  href="{{$new["link"]}}">{{$new["title"]}}</a><span class="resource_title">@if($new["resource_title"]) ({{$new["resource_title"]}})@endif</span>
								</p>
			        @endforeach
	         	@endif
	          <h3 class="center-block-more"><a href="{{ url('/news/' . $newHeadline["slug"]) }}">@if($newHeadline["more_button"]){{$newHeadline["more_button"]}}@else @lang('main.more_news')@endif</a></h3>
	      	</div>
	      @endforeach
			@endif
			
			@if($regionalNews && $regionalNewsPosition > count($newsHeadlines))
	      <div class="main-news politics regions_wrapper">
	          <h2 class="center-block-header region-header" onclick="show('region-more')">
              @foreach($regionalNews as $newHeadlineRegion)
								@if($newHeadlineRegion["region_id"] == $regionalID)<span class="regions_title">{{$newHeadlineRegion["title"]}}</span>@endif
							@endforeach
              <div id="region-more" class="show-more">
                  @foreach($regionalNews as $newHeadlineRegion)
										<a data-region_title="{{$newHeadlineRegion["title"]}}" data-region_id="{{$newHeadlineRegion["region_id"]}}" href="javascript:;" @if($newHeadlineRegion["region_id"] == $regionalID)class="activecity"@endif>{{$newHeadlineRegion["region_title"]}}</a>
									@endforeach
              </div>
	          </h2>
						@foreach($regionalNews as $newHeadlineRegion)
		          <div class="region_news_container @if($newHeadlineRegion["region_id"] == $regionalID) active @endif" id="region_news_container_region_{{$newHeadlineRegion["region_id"]}}">
			          @foreach($newHeadlineRegion["news"] as $new)
									<p>
										<span class="time">
											@if(strtotime($new["datetime"]) > strtotime($startDay))
	                      {{date("H:i", strtotime($new["datetime"]))}}
	                    @else
	                      {{date("H:i", strtotime($new["datetime"]))}}<br /> {{date("j", strtotime($new["datetime"]))}} @lang('main.date_' . date("M", strtotime($new["datetime"])))
	                    @endif
										</span>
										<a target="_blank"  href="{{$new["link"]}}">{{$new["title"]}}</a><span class="resource_title">@if($new["resource_title"]) ({{$new["resource_title"]}})@endif</span>
									</p>
			         	@endforeach
			          <h3 class="center-block-more"><a href="{{ url('/news/' . $newHeadlineRegion["slug"]) }}">@if($newHeadlineRegion["more_button"]){{$newHeadlineRegion["more_button"]}}@else @lang('main.more_news')@endif</a></h3>
		          </div>
		      	@endforeach
	      </div>
      @endif
  </div>
  <div class="col-3 siteslist">
  @if($rightLinks)
    @foreach($rightLinks as $rightLinkHeadline)
      <h3 class="sitelist-header">{{$rightLinkHeadline["title"]}}</h3>
      @if($rightLinkHeadline["links"])
        @foreach($rightLinkHeadline["links"] as $link)
          <a target="_blank"  href="{{$link["link"]}}">{{$link["title"]}}</a>
        @endforeach
      @endif
    @endforeach
  @endif
  </div>
</div>



{{--
<div class="container">
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
--}}
@endsection

@push('styles')
@endpush
@push('scripts')
@endpush