@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/tv_programs') }}">Tv program</a> :
@endsection
@section("contentheader_description", $tv_program->$view_col)
@section("section", "Tv programs")
@section("section_url", url(config('laraadmin.adminRoute') . '/tv_programs'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Tv programs Edit : ".$tv_program->$view_col)

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
				{!! Form::model($tv_program, ['route' => [config('laraadmin.adminRoute') . '.tv_programs.update', $tv_program->id ], 'method'=>'PUT', 'id' => 'tv_program-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'title_ua')
					@la_input($module, 'title_ru')
					@la_input($module, 'title_en')
					@la_input($module, 'datetime')
					@la_input($module, 'status')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/tv_programs') }}">Cancel</a></button>
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
	$("#tv_program-edit-form").validate({
		
	});
});
</script>
@endpush
