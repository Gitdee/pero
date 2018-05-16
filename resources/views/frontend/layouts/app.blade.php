<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
@section('htmlheader')
	@include('frontend.layouts.partials.htmlheader')
@show
<body>
@include('frontend.layouts.partials.header')
<div class="container">
	@include('frontend.layouts.partials.navigations')
	@hasSection('news-line')@yield('news-line')@endif
	@yield('main-content')
</div><!-- ./wrapper -->
@section('footer')
	@include('frontend.layouts.partials.footer')
@show

@section('scripts')
	@include('frontend.layouts.partials.scripts')
@show
</body>

</html>

