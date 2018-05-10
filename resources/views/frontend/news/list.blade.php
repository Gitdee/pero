@php
  $startDay = date("Y-m-d 00:00:00");                              
@endphp
@if($headlineWithNews["news"])
  <div class="news_items">
    @foreach($headlineWithNews["news"] as $new)
      <div class="row" style="padding: 5px 0;">
        <div class="col-lg-2">
          @if(strtotime($new["datetime"]) > strtotime($startDay))
            {{date("H:i", strtotime($new["datetime"]))}}
          @else
            {{date("H:i", strtotime($new["datetime"]))}} {{date("j", strtotime($new["datetime"]))}} @lang('main.date_' . date("M", strtotime($new["datetime"])))
          @endif
        </div>
        <div class="col-lg-10">
          <a target="_blank"  href="{{$new["link"]}}">{{$new["title"]}}</a>@if($new["resource_title"]) ({{$new["resource_title"]}})@endif
        </div>
      </div>
    @endforeach
  </div>
@endif