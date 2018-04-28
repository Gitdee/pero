@extends("la.layouts.app")

@section("contentheader_title", "Configuration")
@section("contentheader_description", "")
@section("section", "Configuration")
@section("sub_section", "")
@section("htmlheader_title", "Configuration")

@section("headerElems")
@endsection

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
<form action="{{route(config('laraadmin.adminRoute').'.la_front_end_configs.store')}}" method="POST">
	<!-- general form elements disabled -->
	<div class="box box-warning">
		<div class="box-header with-border">
			<h3 class="box-title">Frontend Settings</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			{{ csrf_field() }}
			<!-- text input -->
      
      <div class="form-group">
				<label>Sitename</label>
				<input type="text" class="form-control" placeholder="Sitename" name="sitename" value="{{$configs->sitename}}">
			</div>
			<div class="form-group">
				<label>Sitename First Word</label>
				<input type="text" class="form-control" placeholder="Sitename First Word" name="sitename_part1" value="{{$configs->sitename_part1}}">
			</div>
			<div class="form-group">
				<label>Sitename Second Word</label>
				<input type="text" class="form-control" placeholder="Sitename Second Word" name="sitename_part2" value="{{$configs->sitename_part2}}">
			</div>
			<div class="form-group">
				<label>Sitename Short (2/3 Characters)</label>
				<input type="text" class="form-control" placeholder="Sitename Short (2/3 Characters)" name="sitename_short" value="{{$configs->sitename_short}}">
			</div>
			<div class="form-group">
				<label>Site Description</label>
				<input type="text" class="form-control" placeholder="Description in 140 Characters"  name="site_description" value="{{$configs->site_description}}">
      </div>
      <div class="form-group">
				<label>Site Keywords</label>
				<input type="text" class="form-control" placeholder="Site Keywords"  name="site_keywords" value="{{$configs->site_keywords}}">
      </div>
      
			<div class="form-group">
				<label>Phone</label>
				<input type="text" class="form-control" placeholder="Phone" name="phone1" value="{{$configs->phone1}}">
			</div>
			<div class="form-group">
				<label>Phone 2</label>
				<input type="text" class="form-control" placeholder="Phone 2" name="phone2" value="{{$configs->phone2}}">
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="text" class="form-control" placeholder="Email" name="email" value="{{$configs->email}}">
			</div>
      <div class="form-group">
				<label>Facebook</label>
				<input type="text" class="form-control" placeholder="Facebook" name="facebook" value="{{$configs->facebook}}">
			</div>
      <div class="form-group">
				<label>Google+</label>
				<input type="text" class="form-control" placeholder="Email" name="google_plus" value="{{$configs->google_plus}}">
			</div>
      <div class="form-group">
				<label>Twitter</label>
				<input type="text" class="form-control" placeholder="Email" name="twitter" value="{{$configs->twitter}}">
			</div>
      <div class="form-group">
				<label>Register Page(Pacient summary text)</label>
				{{--<input type="text" class="form-control" placeholder="Register Page(Pacient summary text)" name="register_summary_pacient" value="{{$configs->register_summary_pacient}}">
        --}}
        <textarea class="ckeditor form-control" placeholder="Register Page(Pacient summary text)" cols="30" rows="8" name="register_summary_pacient">{!!$configs->register_summary_pacient!!}</textarea>
        
			</div>
      <div class="form-group">
				<label>Register Page(Clinic summary text)</label>
				{{--<input type="text" class="form-control" placeholder="Register Page(Clinic summary text)" name="register_summary_clinic" value="{{$configs->register_summary_clinic}}">
        --}}
        <textarea class="ckeditor form-control" placeholder="Register Page(Clinic summary text)" cols="30" rows="8" name="register_summary_clinic">{!!$configs->register_summary_clinic!!}</textarea>
        
			</div>
      <div class="form-group">
				<label>403 Page(Title text)</label>
				<input type="text" class="form-control" placeholder="403 Page(Title text)" name="title_403" value="{{$configs->title_403}}">
			</div>
      <div class="form-group">
				<label>403 Page(Summary text)</label>
				<input type="text" class="form-control" placeholder="403 Page(Summary text)" name="summary_403" value="{{$configs->summary_403}}">
			</div>
      <div class="form-group">
				<label>404 Page(Title text)</label>
				<input type="text" class="form-control" placeholder="404 Page(Title text)" name="title_404" value="{{$configs->title_404}}">
			</div>
      <div class="form-group">
				<label>404 Page(Summary text)</label>
				<input type="text" class="form-control" placeholder="404 Page(Summary text)" name="summary_404" value="{{$configs->summary_404}}">
			</div>
      <div class="form-group">
				<label>503 Page(Title text)</label>
				<input type="text" class="form-control" placeholder="503 Page(Title text)" name="title_503" value="{{$configs->title_503}}">
			</div>
      <div class="form-group">
				<label>503 Page(Summary text)</label>
				<input type="text" class="form-control" placeholder="503 Page(Summary text)" name="summary_503" value="{{$configs->summary_503}}">
			</div>
      <div class="form-group">
				<label>Home page(meta title)</label>
				<input type="text" class="form-control" placeholder="Home page(meta title)"  name="homepage_meta_title" value="{{$configs->homepage_meta_title}}">
      </div>
      <div class="form-group">
				<label>Home Page(Promos section summary text)</label>
				<input type="text" class="form-control" placeholder="Home Page(Promos section summary text)" name="homepage_promos_summary" value="{{$configs->homepage_promos_summary}}">
			</div>
      <div class="form-group">
				<label>Home Page(News section summary text)</label>
				<input type="text" class="form-control" placeholder="Home Page(News section summary text)" name="homepage_news_summary" value="{{$configs->homepage_news_summary}}">
			</div>
      
      <div class="form-group">
				<label>Med tourism(title text)</label>
				<input type="text" class="form-control" placeholder="Med tourism(title text)"  name="med_tourism_title" value="{{$configs->med_tourism_title}}">
      </div>
      <div class="form-group">
				<label>Med tourism(summary text)</label>
				{{--<input type="text" class="form-control" placeholder="Med tourism(summary text)"  name="med_tourism_desc" value="{{$configs->med_tourism_desc}}">--}}
        <textarea class="ckeditor form-control" placeholder="Med tourism(summary text)" cols="30" rows="8" name="med_tourism_desc">{!!$configs->med_tourism_desc!!}</textarea>
      </div>
      
      <div class="form-group">
				<label>Med tourism(Items section summary text)</label>
				<input type="text" class="form-control" placeholder="Med tourism(Items section summary text)"  name="med_turism_items_title" value="{{$configs->med_turism_items_title}}">
      </div>
      
      <div class="form-group">
				<label>Med tourism(News section title text)</label>
				<input type="text" class="form-control" placeholder="Med tourism(News section title text)"  name="med_turism_news_title" value="{{$configs->med_turism_news_title}}">
      </div>
      
      <div class="form-group">
				<label>Med tourism(News section summary text)</label>
				{{--<input type="text" class="form-control" placeholder="Med tourism(News section summary text)"  name="med_turism_news_desc" value="{{$configs->med_turism_news_desc}}">--}}
        <textarea class="ckeditor form-control" placeholder="Med tourism(News section summary text)" cols="30" rows="8" name="med_turism_news_desc">{!!$configs->med_turism_news_desc!!}</textarea>
        
      </div>
      
			{{--
			<!-- checkbox -->
			<div class="form-group">
				<div class="checkbox">
					<label>
						<input type="checkbox" name="sidebar_search" @if($configs->sidebar_search) checked @endif>
						Show Search Bar
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="show_messages" @if($configs->show_messages) checked @endif>
						Show Messages Icon
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="show_notifications" @if($configs->show_notifications) checked @endif>
						Show Notifications Icon
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="show_tasks" @if($configs->show_tasks) checked @endif>
						Show Tasks Icon
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="show_rightsidebar" @if($configs->show_rightsidebar) checked @endif>
						Show Right SideBar Icon
					</label>
				</div>
			</div>
			<!-- select -->
			<div class="form-group">
				<label>Skin Color</label>
				<select class="form-control" name="skin">
					@foreach($skins as $name=>$property)
						<option value="{{ $property }}" @if($configs->skin == $property) selected @endif>{{ $name }}</option>
					@endforeach
				</select>
			</div>
			
			<div class="form-group">
				<label>Layout</label>
				<select class="form-control" name="layout">
					@foreach($layouts as $name=>$property)
						<option value="{{ $property }}" @if($configs->layout == $property) selected @endif>{{ $name }}</option>
					@endforeach
				</select>
			</div>
      
      --}}
		</div><!-- /.box-body -->
		<div class="box-footer">
			<button type="submit" class="btn btn-primary">Save</button>
		</div><!-- /.box-footer -->
	</div><!-- /.box -->
</form>

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
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
          console.log(config);
					var preset = config ? "custom" : $(this).data('ckeditor-preset');
          console.log(preset);
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
  $(".ckeditor").ckeditor();
});
</script>
@endpush
