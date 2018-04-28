@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/tvs') }}">Tv</a> :
@endsection
@section("contentheader_description", $tv->$view_col)
@section("section", "Tvs")
@section("section_url", url(config('laraadmin.adminRoute') . '/tvs'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Tvs Edit : ".$tv->$view_col)

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
				{!! Form::model($tv, ['route' => [config('laraadmin.adminRoute') . '.tvs.update', $tv->id ], 'method'=>'PUT', 'id' => 'tv-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'title_ua')
					@la_input($module, 'title_ru')
					@la_input($module, 'title_en')
					@la_input($module, 'logo')
					@la_input($module, 'link')
					@la_input($module, 'status')
					@la_input($module, 'position')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/tvs') }}">Cancel</a></button>
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
	$("#tv-edit-form").validate({
		
	});
});
</script>
@endpush
