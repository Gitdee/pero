<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
@section('htmlheader')
	@include('frontend.layouts.partials.htmlheader')
@show
<body data-spy="scroll" data-offset="0" data-target="#navigation">
@include('frontend.layouts.partials.navigations')
<div class="">
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

