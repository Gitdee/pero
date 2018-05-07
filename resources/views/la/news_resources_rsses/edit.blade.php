@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/news_resources_rsses') }}">News Resources RSS</a> :
@endsection
@section("contentheader_description", $news_resources_rss->$view_col)
@section("section", "News Resources RSSes")
@section("section_url", url(config('laraadmin.adminRoute') . '/news_resources_rsses'))
@section("sub_section", "Edit")

@section("htmlheader_title", "News Resources RSSes Edit : ".$news_resources_rss->$view_col)

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
				{!! Form::model($news_resources_rss, ['route' => [config('laraadmin.adminRoute') . '.news_resources_rsses.update', $news_resources_rss->id ], 'method'=>'PUT', 'id' => 'news_resources_rss-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'title')
					@la_input($module, 'rss')
					@la_input($module, 'headline_ids')
					@la_input($module, 'status')
					@la_input($module, 'socia_network')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/news_resources_rsses') }}">Cancel</a></button>
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
	$("#news_resources_rss-edit-form").validate({
		
	});
});
</script>
@endpush
