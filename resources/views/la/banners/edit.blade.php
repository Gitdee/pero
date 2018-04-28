@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/banners') }}">Banner</a> :
@endsection
@section("contentheader_description", $banner->$view_col)
@section("section", "Banners")
@section("section_url", url(config('laraadmin.adminRoute') . '/banners'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Banners Edit : ".$banner->$view_col)

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
				{!! Form::model($banner, ['route' => [config('laraadmin.adminRoute') . '.banners.update', $banner->id ], 'method'=>'PUT', 'id' => 'banner-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'title')
					@la_input($module, 'image')
					@la_input($module, 'placing')
					@la_input($module, 'status')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/banners') }}">Cancel</a></button>
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
	$("#banner-edit-form").validate({
		
	});
});
</script>
@endpush
