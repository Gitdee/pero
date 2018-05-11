@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/pages') }}">Page</a> :
@endsection
@section("contentheader_description", $page->$view_col)
@section("section", "Pages")
@section("section_url", url(config('laraadmin.adminRoute') . '/pages'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Pages Edit : ".$page->$view_col)

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
				{!! Form::model($page, ['route' => [config('laraadmin.adminRoute') . '.pages.update', $page->id ], 'method'=>'PUT', 'id' => 'page-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'title_ua')
					@la_input($module, 'title_ru')
					@la_input($module, 'title_en')
					@la_input($module, 'slug')
					@la_input($module, 'status')
					@la_input($module, 'description_ua')
					@la_input($module, 'description_ru')
					@la_input($module, 'description_en')
					@la_input($module, 'meta_title_ua')
					@la_input($module, 'meta_title_ru')
					@la_input($module, 'meta_title_en')
					@la_input($module, 'meta_description_ua')
					@la_input($module, 'meta_description_ru')
					@la_input($module, 'meta_description_en')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/pages') }}">Cancel</a></button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script type="text/javascript" src="{{ asset('la-assets/plugins/ckeditor/ckeditor.js') }}"></script>
<script>
(function($){
	var index = 0;
  $.fn.ckeditor = function(){
		return this.each(function(){
			var This = $(this).addClass('ckeditor');
			if(!This.data('ckeditor')){
				if(!This.attr('id')) This.attr('id', 'ckeditor-'+index++);
				if(typeof CKEDITOR != 'undefined'){

					var config = $(this).data('ckeditor-config');
					var preset = config ? "custom" : $(this).data('ckeditor-preset');
					switch(preset){
						case 'custom':
							break;
						case 'minimal':
							config = {uiColor: '#FAFAFA',toolbar : [['Bold', 'Italic', 'Underline']]};
							break;
						case 'minimal+link':
							config = {uiColor: '#FAFAFA',toolbar : [['Bold', 'Italic', 'Underline']]};
							break;
						default:
							config = {uiColor: '#FAFAFA',toolbar : [['Bold', 'Italic', 'Underline']]};
              config = {
								uiColor: '#FAFAFA'
							}
					}
					config.readOnly = $(this).attr('readonly');

					This.data('ckeditor', CKEDITOR.replace(this, config));
				}
			}
		});
  };
  $.fn.ckeditorUpdateElement = function(){
		return this.each(function(){
			var ckeditor = $(this).data('ckeditor');
			if(ckeditor) ckeditor.updateElement();
		});
  };
  $.fn.ckeditorDestroy = function(){
		return this.each(function(){
			var This = $(this), ckeditor = This.data('ckeditor');
			if(ckeditor){
				ckeditor.destroy();
				This.data('ckeditor', null);
			}
		});
  };
  $.fn.ckeditorRefresh = function(){
		return this.ckeditorDestroy().ckeditor();
	};
})(jQuery);
$(function () {
	$("#page-edit-form").validate({
		
	});
	$("[name='description_ua']").ckeditor();
	$("[name='description_ru']").ckeditor();
	$("[name='description_en']").ckeditor();
});
</script>
@endpush
