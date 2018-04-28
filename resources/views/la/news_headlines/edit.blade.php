@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/news_headlines') }}">News Headline</a> :
@endsection
@section("contentheader_description", $news_headline->$view_col)
@section("section", "News Headlines")
@section("section_url", url(config('laraadmin.adminRoute') . '/news_headlines'))
@section("sub_section", "Edit")

@section("htmlheader_title", "News Headlines Edit : ".$news_headline->$view_col)

@section("main-content")

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box">
	<div class="box-header">
		
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!! Form::model($news_headline, ['route' => [config('laraadmin.adminRoute') . '.news_headlines.update', $news_headline->id ], 'method'=>'PUT', 'id' => 'news_headline-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'title_ua')
					@la_input($module, 'title_ru')
					@la_input($module, 'title_en')
					@la_input($module, 'slug')
					@la_input($module, 'more_button_ua')
					@la_input($module, 'more_button_ru')
					@la_input($module, 'more_button_en')
					@la_input($module, 'position')
					@la_input($module, 'region_headline')
					@la_input($module, 'status')
					@la_input($module, 'meta_title_ua')
					@la_input($module, 'meta_title_ru')
					@la_input($module, 'meta_title_en')
					@la_input($module, 'meta_keywords_ua')
					@la_input($module, 'meta_keywords_ru')
					@la_input($module, 'meta_keywords_en')
					@la_input($module, 'meta_description_ua')
					@la_input($module, 'meta_description_ru')
					@la_input($module, 'meta_description_en')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/news_headlines') }}">Cancel</a></button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
	$("#news_headline-edit-form").validate({
		
	});
});
</script>
@endpush
