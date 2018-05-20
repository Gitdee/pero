@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/taxes') }}">Tax</a> :
@endsection
@section("contentheader_description", $tax->$view_col)
@section("section", "Taxes")
@section("section_url", url(config('laraadmin.adminRoute') . '/taxes'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Taxes Edit : ".$tax->$view_col)

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
				{!! Form::model($tax, ['route' => [config('laraadmin.adminRoute') . '.taxes.update', $tax->id ], 'method'=>'PUT', 'id' => 'tax-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'title_ua')
					@la_input($module, 'title_ru')
					@la_input($module, 'title_en')
					@la_input($module, 'phone')
					@la_input($module, 'link')
					@la_input($module, 'region_id')
					@la_input($module, 'status')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/taxes') }}">Cancel</a></button>
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
	$("#tax-edit-form").validate({
		
	});
});
</script>
@endpush
