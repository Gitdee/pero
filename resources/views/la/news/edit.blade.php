@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/news') }}">News</a> :
@endsection
@section("contentheader_description", $news->$view_col)
@section("section", "News")
@section("section_url", url(config('laraadmin.adminRoute') . '/news'))
@section("sub_section", "Edit")

@section("htmlheader_title", "News Edit : ".$news->$view_col)

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
				{!! Form::model($news, ['route' => [config('laraadmin.adminRoute') . '.news.update', $news->id ], 'method'=>'PUT', 'id' => 'news-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'title_ua')
					@la_input($module, 'title_ru')
					@la_input($module, 'title_en')
					@la_input($module, 'headline_id')
					@la_input($module, 'resource_id')
					@la_input($module, 'link')
					@la_input($module, 'datetime')
					@la_input($module, 'guid')
					@la_input($module, 'main_thing')
					@la_input($module, 'expire_main_thing')
					@la_input($module, 'running_line')
					@la_input($module, 'expire-running_line')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/news') }}">Cancel</a></button>
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
	$("#news-edit-form").validate({
		
	});
});
</script>
@endpush
