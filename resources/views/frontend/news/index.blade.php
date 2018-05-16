@extends("frontend.layouts.app")

@section("htmlheader_title")
  {{$headlineWithNews["meta_title"] ? $headlineWithNews["meta_title"] : $headlineWithNews["title"]}}
@endsection

@section("main-content")
<div class="wrap other-blocks category-page">
  <div class="col-1">
  @if($newsHeadlines)
		<div class="siteslist" style="margin: 0;">
      @foreach($newsHeadlines as $newsHeadline)
        <a href="{{$newsHeadline["slug"]}}"><h3 class="sitelist-header">{{$newsHeadline["title"]}}</h3></a>
      @endforeach
    </div>
  @endif
  @if($regionalHeadlines)
  	<div class="siteslist">
		@foreach($regionalHeadlines as $regionalHeadline)
			<a href="{{$regionalHeadline["slug"]}}"><h3 class="sitelist-header">{{$regionalHeadline["title"]}}</h3></a>
			@endforeach
		</div>
	@endif
	</div>
	<div class="col-2">
		@php
      $startDay = date("Y-m-d 00:00:00");                              
    @endphp
    @if($headlineWithNews)
    	<a href="{{ url('/news/' . $headlineWithNews["slug"]) }}"><h2 class="center-block-header {{--lastFirstUpper--}}">{{$headlineWithNews["title"]}}</h2>
    	<div class="main-news">
				@if($headlineWithNews["news"])
					@php
			      $lastItem = end($headlineWithNews["news"]);                              
			    @endphp
					@foreach($headlineWithNews["news"] as $new)
						<p @if ($lastItem["id"] == $new["id"]) data-load-more-news="1"@endif>
							<span class="time">
								@if(strtotime($new["datetime"]) > strtotime($startDay))
	                {{date("H:i", strtotime($new["datetime"]))}}
	              @else
	                {{date("H:i", strtotime($new["datetime"]))}}<br /> {{date("j", strtotime($new["datetime"]))}} @lang('main.date_' . date("M", strtotime($new["datetime"])))
	              @endif
							</span>
							<a target="_blank"  href="{{$new["link"]}}">{{$new["title"]}}</a>@if($new["resource_title"]) ({{$new["resource_title"]}})@endif
						</p>
	        @endforeach
	     	@endif
     	</div>
    @endif
	</div>
	<div class="col-3">
		@if($categoryBanners)
		 	<div class="second-banners main-block-scroll">
      	@foreach($categoryBanners as $categoryBanner)
      		@if($categoryBanner["html"] || $categoryBanner["image"])
					<div class="banner">
						@if($categoryBanner["link"])
							<a href="{{$categoryBanner["link"]}}">
						@endif
						@if($categoryBanner["html"])
							{!!$categoryBanner["html"]!!}
						@elseif($categoryBanner["image"])
							<img style="max-width: 100%;" src = "{{ url('files') . "/" . $categoryBanner["image"]["hash"] . '/' . $categoryBanner["image"]["name"] . ""}}" alt = "" class = "">
						@endif
						@if($categoryBanner["link"])
								</a>
							@endif
					</div>
					@endif
      	@endforeach
    	</div>
    @endif
	</div>
</div>
@endsection

@push('styles')
@endpush
@push('scripts')

<script>
	var page = 1;
	function loadMore(){
	  $('[data-load-more-news]').each(function(){
			var element = $(this), container = $(this).parent(), win = $(window), busy = false, errors = 0, retry = 3; 
			function error(){
				errors++;
				if(errors >= retry) unbind();
			}
	
			function unbind(){
				var mousewheelevt=(/Firefox/i.test(navigator.userAgent))? "DOMMouseScroll" : "mousewheel";
				win.unbind('scroll resize orientationchange ' + mousewheelevt, check);
			}
			
			function check(){
				if(busy) return;
	      var delta = 0;
	      if($(window).width() > 2500){
	        delta = 1500;
	      }else if($(window).width() > 2000){
	        delta = 1300;
	      }else if($(window).width() > 1600){
	        delta = 1150;
	      }else if($(window).width() > 1300){
	        delta = 800;
	      }else if($(window).width() > 1000){
	        delta = 500;
	      }
	      console.log(delta);
	      console.log(element.offset().top, win.scrollTop() + element.height());
	      if((element.offset().top - delta) > win.scrollTop() + element.height()) return;
				//if(element.offset().top > container.scrollTop() + container.height()) return;
				/*
				var frm = $('#faq-form');
	      var urlPath = "?" + frm.serialize() + "&page=" + (page + 1);
	      if(window.history.replaceState)window.history.replaceState({"html":"","pageTitle":""},"", urlPath);
				*/
				busy = true;
	      $.ajax({
					url: window.location,
					//data: frm.serialize() + "&page=" + (page + 1) + "&act=pagin",
					data: "page=" + (page + 1) + "&act=pagin",
					dataType: 'json',
	        type: "get",
					success: function(response){
						if(response.html){
							container.append(response.html);
	            element = container.find("[data-load-more-news]").last();
							page++;
						}else error();
	
						if(response.has_more) check();
						else unbind();
					},
					error: error,
					complete: function(){
						busy = false;
					}
				});
			}
			var mousewheelevt=(/Firefox/i.test(navigator.userAgent))? "DOMMouseScroll" : "mousewheel";
			win.bind('scroll resize orientationchange ' + mousewheelevt, check);
			//check();
		});
	}
	//news
	$(function(){
	  loadMore();
	});
</script>

@endpush