@extends("frontend.layouts.app")

@section("htmlheader_title")
  {{$headlineWithNews["meta_title"] ? $headlineWithNews["meta_title"] : $headlineWithNews["title"]}}
@endsection

@section("main-content")
<div class="container">
  <div class="row">
    <div class="col-lg-3 left_side">
    	<div class="row">
    		<div class="col-lg-12">
					Categories
					<br />
    			@if($newsHeadlines)
    				@foreach($newsHeadlines as $newsHeadline)
    					<a href="{{$newsHeadline["slug"]}}">{{$newsHeadline["title"]}}</a>
							<br />
    				@endforeach
    			@endif
        </div>
    	</div>
    	<br />
      <br />
      <div class="row">
    		<div class="col-lg-12">
					@lang('main.regional_category')
					<br />
    			@if($regionalHeadlines)
    				@foreach($regionalHeadlines as $regionalHeadline)
    					<a href="{{$regionalHeadline["slug"]}}">{{$regionalHeadline["title"]}}</a>
							<br />
    				@endforeach
    			@endif
        </div>
    	</div>
      <br />
    </div>
    <div class="col-lg-8"> 
      @php
        $startDay = date("Y-m-d 00:00:00");                              
      @endphp
      @if($headlineWithNews)
        <div>
          <h3>{{$headlineWithNews["title"]}}</h3>
          <form class="text-right" action="" method="get">
          	@php
						  $keyword = app('request')->has('keyword') ? app('request')->input('keyword') : "";
						  $page = app('request')->has('page') ? app('request')->input('page') : 1;
						@endphp
						<input type="text" name="keyword" value="{{$keyword}}"/>
						<input type="submit" value=">" />
						<br />
						<br />
						@if($page > 1)
							<a href="{{url('news/' . $headlineWithNews["slug"] . '?keyword=' . $keyword . "&page=" . ($page-1))}}">Prev Page</a>
						@endif
						@if($headlineWithNews["news"])
							<a href="{{url('news/' . $headlineWithNews["slug"] . '?keyword=' . $keyword . "&page=" . ($page+1))}}">Next Page</a>
						@endif
						<br />
						<br />
					</form>
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
        </div>
      @endif
      <br />
    </div>
    {{--<div class="col-lg-1 right_side">
    </div>--}}
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