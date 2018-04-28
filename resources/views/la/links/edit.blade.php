@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/links') }}">Link</a> :
@endsection
@section("contentheader_description", $link->$view_col)
@section("section", "Links")
@section("section_url", url(config('laraadmin.adminRoute') . '/links'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Links Edit : ".$link->$view_col)

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
				{!! Form::model($link, ['route' => [config('laraadmin.adminRoute') . '.links.update', $link->id ], 'method'=>'PUT', 'id' => 'link-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'title_ua')
					@la_input($module, 'title_ru')
					@la_input($module, 'title_en')
					@la_input($module, 'link')
					@la_input($module, 'headline_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/links') }}">Cancel</a></button>
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
	$("#link-edit-form").validate({
		
	});
});
</script>
@endpush
