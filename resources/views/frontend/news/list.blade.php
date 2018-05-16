@php
  $startDay = date("Y-m-d 00:00:00");                              
@endphp
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