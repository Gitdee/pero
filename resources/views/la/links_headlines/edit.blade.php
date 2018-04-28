@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/links_headlines') }}">Links Headline</a> :
@endsection
@section("contentheader_description", $links_headline->$view_col)
@section("section", "Links Headlines")
@section("section_url", url(config('laraadmin.adminRoute') . '/links_headlines'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Links Headlines Edit : ".$links_headline->$view_col)

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
				{!! Form::model($links_headline, ['route' => [config('laraadmin.adminRoute') . '.links_headlines.update', $links_headline->id ], 'method'=>'PUT', 'id' => 'links_headline-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'title_ua')
					@la_input($module, 'title_ru')
					@la_input($module, 'title_en')
					@la_input($module, 'status')
					@la_input($module, 'placing')
					@la_input($module, 'position')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/links_headlines') }}">Cancel</a></button>
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
	$("#links_headline-edit-form").validate({
		
	});
});
</script>
@endpush
