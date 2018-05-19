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
<form action="{{route(config('laraadmin.adminRoute').'.site_configs.store')}}" method="POST">
	<!-- general form elements disabled -->
	<div class="box box-warning">
		<div class="box-header with-border">
			<h3 class="box-title">Number of News Settings</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			{{ csrf_field() }}
			<!-- text input -->
      
  
			<div class="form-group">
				<label>Number of News on Homepage</label>
				<input type="text" class="form-control" placeholder="Number of News" name="number_news" value="{{$configs->number_news}}">
			</div>

			<div class="form-group">
				<label>Number of News on Homepage(Main Headline)</label>
				<input type="text" class="form-control" placeholder="Number of News on Homepage(Main Headline)" name="number_news_in_main_category" value="{{$configs->number_news_in_main_category}}">
			</div>
			
			<div class="form-group">
				<label>Position of Region News on Homepage</label>
				<input type="text" class="form-control" placeholder="Position of Region News on Homepage" name="region_position_on_homepage" value="{{$configs->region_position_on_homepage}}">
			</div>
			
			<div class="box-header with-border">
				<h3 class="box-title">Running Line Settings</h3>
			</div>
			<div class="form-group">
				<label>Type of Running Line</label>
				<select class="form-control" name="running_line_type">
					@foreach($running_line_type as $property=>$name)
						<option value="{{ $property }}" @if($configs->running_line_type == $property) selected @endif>{{ $name }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>Text of Running Line(UA)</label>
				<textarea class="form-control" placeholder="Text of Running Line(UA)" name="running_line_text_ua">{{$configs->running_line_text_ua}}</textarea>
			</div>
			<div class="form-group">
				<label>Text of Running Line(RU)</label>
				<textarea class="form-control" placeholder="Text of Running Line(RU)" name="running_line_text_ru">{{$configs->running_line_text_ru}}</textarea>
			</div>
			<div class="form-group">
				<label>Text of Running Line(EN)</label>
				<textarea class="form-control" placeholder="Text of Running Line(EN)" name="running_line_text_en">{{$configs->running_line_text_en}}</textarea>
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

@endpush
