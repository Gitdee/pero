@if(isset($runningLineNews) && $runningLineNews)
<div class="wrap news-line">
    <marquee direction="left" onmouseover="this.stop()" onmouseout="this.start()">
      @foreach($runningLineNews as $new)
		    <span class="last-news">{{$new["title"]}}</span>
      @endforeach
    </marquee>    
</div>
@endif