@extends("frontend.layouts.app")

@section("htmlheader_title")
  @lang('news.news_meta_title')
@endsection
{{--
@section("meta_description")@endsection
@section("meta_keywords")@endsection
--}}


@section("main-content")
@php
  $keyword = app('request')->input('keyword');
@endphp
<section class="container-fluid main-search all-news">
   <div class="container">
      @include('frontend.layouts.partials.header_filters')
      <div class="row">
  			 <div class="col-md-4 hidden-xs"></div>
         <div class="col-md-8 text-center news-search-form">
            <form id="orders-edit-form" role="form" action="{{ url('/news')}}" method="get" enctype="plain">
              <div class="input-group">
      				  <input type="text" name="keyword" value="{{$keyword}}" class="form-control" placeholder="">
      				  <span class="input-group-btn">
      					<button class="btn btn-primary" type="submit"><i class="fa  fa-search"></i></button>
      				  </span>
      				</div>
            </form>
          </div>
      </div>
   </div>
</section>

<section class="container-fluid papers-slider news-list">
  <div class="container">
    @if($clinicsNews)
      @foreach($clinicsNews as $new)
        <div class="row">
           <div class="col-md-4">
              <div class = "paper">
                 @if($new->image)
                  <img src="{{ url('files') . "/" . $new->image->hash . '/' . $new->image->name . "?s=360-240"}}" alt="" style="">
                 @else
                  <img src="{{ url('files') . "/default/default?s=360-240"}}" alt="" style="">
                 @endif
                 @if($new->datetime && $new->datetime != "0000-00-00 00:00:00")<span class="paper-date">{{date("d.m.y", strtotime($new->datetime))}}</span>@endif
              </div>
           </div>
      	   <div class = "col-md-8">
      			<p class = "paper-name">
                <a href = "{{url('/news/' . $new->slug)}}">
                  <span>{{$new->name}}</span>
                </a>
                <a href = "{{url('/news/' . $new->slug)}}" class = "paper-more"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
             </p>
             @if($new->clinic)
              <p class = "paper-name">
                <a href = "{{url('/clinic/' . $new->clinic->slug)}}">
                  <span>{{$new->clinic->name}}</span>
                </a>
              </p>
              @endif
      			 <p class = "paper-content">
        			 @php echo (mb_strimwidth($new->description, 0, 310, '...'))@endphp
      			</p>
            @if($new->tags_data)
        			<p class = "papre-tags">
        				@lang('news.news_tags'): 
                @php
                 $k = 0;
                @endphp
                @foreach($new->tags_data as $tKey => $tag)
                  @if($k != 0), @endif<a href="{{url('/news')}}?keyword={{$tag}}">{{$tag}}</a>
                  @php
                   $k++;
                  @endphp  
                @endforeach
        			</p>
            @endif
      	   </div>
        </div>
      @endforeach
    @else
      <div class="col-xs-12 text-justify">
         @if($keyword)
          <h2>@lang('news.no_records')</h2>
         @else
          <h2>@lang('homepage.no_records_news_title')</h2>
         @endif
      </div>
    @endif
  </div>
</section>
@if($clinicsNews)
<div class="container">
	<div class = "row"> 
		<div class = "col-xs-12 text-center pagginator">
		@if($keyword)
      {{ $clinicsNews->appends(['keyword' => $keyword])->links() }}
    @else
      {{ $clinicsNews->links() }}
    @endif
		</div>
	</div>
</div>
@endif

@include('frontend.layouts.partials.call_action_footer')
@endsection
@push('styles')
<link rel="stylesheet" href="{{ asset('/la-assets/css/kab-main.css') }}">
@endpush
@push('scripts')
@endpush