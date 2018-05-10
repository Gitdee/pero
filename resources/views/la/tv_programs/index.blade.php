@extends("la.layouts.app")

@section("contentheader_title", "Tv programs")
@section("contentheader_description", "Tv programs listing")
@section("section", "Tv programs")
@section("sub_section", "Listing")
@section("htmlheader_title", "Tv programs Listing")

@section("headerElems")
@la_access("Tv_programs", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Tv program</button>
@endla_access
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

<div class="box box-success">
	<!--<div class="box-header"></div>-->
	<div class="box-body">
		<table id="example1" class="table table-bordered">
		<thead>
		<tr class="success">
			@foreach( $listing_cols as $col )
			<th>{{ $module->fields[$col]['label'] or ucfirst($col) }}</th>
			@endforeach
			@if($show_actions)
			<th>Actions</th>
			@endif
		</tr>
		</thead>
		<tbody>
			
		</tbody>
		</table>
	</div>
</div>

@la_access("Tv_programs", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Tv program</h4>
			</div>
			{!! Form::open(['action' => 'LA\Tv_programsController@store', 'id' => 'tv_program-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
                    {{--@la_form($module)--}}
					
					
					@la_input($module, 'title_ua')
					@la_input($module, 'title_ru')
					@la_input($module, 'title_en')
					@la_input($module, 'datetime')
					@la_input($module, 'status')
					
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
@endla_access
<style>
    .wysihtml5-toolbar{
        list-style: none;
        display: block;
        padding: 0;
    }
    .wysihtml5-toolbar li{
        display: inline;
    }
    .wysihtml5-sandbox{
    		max-height: 60px;
    }
</style>
@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script>
$(function () {
	$("#example1").DataTable({
		processing: true,
        serverSide: true,
        ajax: "{{ url(config('laraadmin.adminRoute') . '/tv_program_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#tv_program-add-form").validate({
		
	});
    $('textarea[name="title_ua"], textarea[name="title_ru"], textarea[name="title_en"]').wysihtml5({
        toolbar:{
    	"font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
    	"emphasis": true, //Italics, bold, etc. Default true
    	"lists": false, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
    	"html": false, //Button which allows you to edit the generated HTML. Default false
    	"link": true, //Button to insert a link. Default true
    	"image": false, //Button to insert an image. Default true,
    	"color": false, //Button to change color of font
        "blockquote": false,
        }  
    });
});
</script>
@endpush
