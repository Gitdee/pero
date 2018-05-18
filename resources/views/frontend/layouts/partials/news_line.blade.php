@if(LAConfigs::getByKey('running_line_type') == "news")
	@if(isset($runningLineNews) && $runningLineNews)
	<div class="wrap news-line">
	    <marquee direction="left" onmouseover="this.stop()" onmouseout="this.start()">
	      @foreach($runningLineNews as $new)
			    <span class="last-news">{{$new["title"]}}</span>
	      @endforeach
	    </marquee>    
	</div>
	@endif
@else
	@if($line = LAConfigs::getByKey('running_line_text'))
		<div class="wrap news-line">
	    <marquee direction="left" onmouseover="this.stop()" onmouseout="this.start()">
	    	<span class="last-news">{{$line}}</span>
	    </marquee>
	  </div>
	@endif	
@endif