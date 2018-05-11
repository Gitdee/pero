@extends("la.layouts.app")

<?php
use Dwij\Laraadmin\Models\Module;
?>

@section("contentheader_title", "Top Menus")
@section("contentheader_description", "Editor")
@section("section", "Top Menus")
@section("sub_section", "Editor")
@section("htmlheader_title", "Top Menu Editor")

@section("headerElems")

@endsection

@section("main-content")

<div class="box box-success menus">
	<!--<div class="box-header"></div>-->
	<div class="box-body">
		<div class="row">
			<div class="col-md-4 col-lg-4">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li><a href="#tab-custom-link" data-toggle="tab">Custom Links</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab-custom-link">
							
							{!! Form::open(['action' => '\App\Http\Controllers\LA\Top_MenusController@store', 'id' => 'menu-custom-form']) !!}
								<input type="hidden" name="type" value="custom">
								<div class="form-group">
									<label for="url" style="font-weight:normal;">URL</label>
									<input class="form-control" placeholder="URL" name="url" type="text" value="http://" data-rule-minlength="1" required>
								</div>
								<div class="form-group">
									<label for="name" style="font-weight:normal;">Label(UA)</label>
									<input class="form-control" placeholder="Label(UA)" name="name_ua" type="text" value=""  data-rule-minlength="1" required>
								</div>
								<div class="form-group">
									<label for="name" style="font-weight:normal;">Label(RU)</label>
									<input class="form-control" placeholder="Label(RU)" name="name_ru" type="text" value=""  data-rule-minlength="1" required>
								</div>
								<div class="form-group">
									<label for="name" style="font-weight:normal;">Label(EN)</label>
									<input class="form-control" placeholder="Label(EN)" name="name_en" type="text" value=""  data-rule-minlength="1" required>
								</div>
                {{--
								<div class="form-group">
									<label for="icon" style="font-weight:normal;">Icon</label>
									<div class="input-group">
										<input class="form-control" placeholder="FontAwesome Icon" name="icon" type="text" value="fa-cube"  data-rule-minlength="1" required>
										<span class="input-group-addon"></span>
									</div>
								</div>--}}
								<input type="submit" class="btn btn-primary pull-right mr10" value="Add to menu">
							{!! Form::close() !!}
						</div>
					</div><!-- /.tab-content -->
				</div><!-- nav-tabs-custom -->
			</div>
			<div class="col-md-8 col-lg-8">
				<div class="dd" id="menu-nestable">
					<ol class="dd-list">
						@foreach ($menus as $menu)
							<?php echo LAHelper::print_menu_editor($menu, "App\Models\TopMenu", "top_menus"); ?>
						@endforeach
					</ol>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="EditModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Menu Item</h4>
			</div>
			{!! Form::open(['action' => ['\App\Http\Controllers\LA\Top_MenusController@update', 1], 'id' => 'menu-edit-form']) !!}
			<input name="_method" type="hidden" value="PUT">
			<div class="modal-body">
				<div class="box-body">
                    <input type="hidden" name="type" value="custom">
					<div class="form-group">
						<label for="url" style="font-weight:normal;">URL</label>
						<input class="form-control" placeholder="URL" name="url" type="text" value="http://" data-rule-minlength="1" required>
					</div>
					<div class="form-group">
						<label for="name" style="font-weight:normal;">Label(UA)</label>
						<input class="form-control" placeholder="Label(UA)" name="name_ua" type="text" value=""  data-rule-minlength="1" required>
					</div>
					<div class="form-group">
						<label for="name" style="font-weight:normal;">Label(RU)</label>
						<input class="form-control" placeholder="Label(RU)" name="name_ru" type="text" value=""  data-rule-minlength="1" required>
					</div>
					<div class="form-group">
						<label for="name" style="font-weight:normal;">Label(EN)</label>
						<input class="form-control" placeholder="Label(EN)" name="name_en" type="text" value=""  data-rule-minlength="1" required>
					</div>
          {{--
					<div class="form-group">
						<label for="icon" style="font-weight:normal;">Icon</label>
						<div class="input-group">
							<input class="form-control" placeholder="FontAwesome Icon" name="icon" type="text" value="fa-cube"  data-rule-minlength="1" required>
							<span class="input-group-addon"></span>
						</div>
					</div>
          --}}
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				{!! Form::submit( 'Submit', ['class'=>'btn btn-success']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('la-assets/plugins/nestable/jquery.nestable.js') }}"></script>
<script src="{{ asset('la-assets/plugins/iconpicker/fontawesome-iconpicker.js') }}"></script>
<script>
$(function () {
	$('input[name=icon]').iconpicker();

	$('#menu-nestable').nestable({
        group: 1
    });
	$('#menu-nestable').on('change', function() {
		var jsonData = $('#menu-nestable').nestable('serialize');
		// console.log(jsonData);
		$.ajax({
			url: "{{ url(config('laraadmin.adminRoute') . '/top_menus/update_hierarchy') }}",
			method: 'POST',
			data: {
				jsonData: jsonData,
				"_token": '{{ csrf_token() }}'
			},
			success: function( data ) {
				// console.log(data);
			}
		});
	});
	$("#menu-custom-form").validate({
		
	});

	$("#menu-nestable .editMenuBtn").on("click", function() {
		var info = JSON.parse($(this).attr("info"));
		
		var url = $("#menu-edit-form").attr("action");
		index = url.lastIndexOf("/");
		url2 = url.substring(0, index+1)+info.id;
		// console.log(url2);
		$("#menu-edit-form").attr("action", url2)
		$("#EditModal input[name=url]").val(info.url);
		$("#EditModal input[name=name_ua]").val(info.name_ua);
		$("#EditModal input[name=name_ru]").val(info.name_ru);
		$("#EditModal input[name=name_en]").val(info.name_en);
		$("#EditModal input[name=icon]").val(info.icon);
		$("#EditModal").modal("show");
	});

	$("#menu-edit-form").validate({
		
	});
	
	$("#tab-modules .addModuleMenu").on("click", function() {
		var module_id = $(this).attr("module_id");
		$.ajax({
			url: "{{ url(config('laraadmin.adminRoute') . '/top_menus') }}",
			method: 'POST',
			data: {
				type: 'module',
				module_id: module_id,
				"_token": '{{ csrf_token() }}'
			},
			success: function( data ) {
				// console.log(data);
				window.location.reload();
			}
		});
	});
});
</script>
@endpush