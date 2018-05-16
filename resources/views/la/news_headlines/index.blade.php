@extends("la.layouts.app")

@section("contentheader_title", "News Headlines")
@section("contentheader_description", "News Headlines listing")
@section("section", "News Headlines")
@section("sub_section", "Listing")
@section("htmlheader_title", "News Headlines Listing")

@section("headerElems")
@la_access("News_Headlines", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add News Headline</button>
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

@la_access("News_Headlines", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add News Headline</h4>
			</div>
			{!! Form::open(['action' => 'LA\News_HeadlinesController@store', 'id' => 'news_headline-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
                    @la_form($module)
					
					{{--
					@la_input($module, 'title_ua')
					@la_input($module, 'title_ru')
					@la_input($module, 'title_en')
					@la_input($module, 'slug')
					@la_input($module, 'more_button_ua')
					@la_input($module, 'more_button_ru')
					@la_input($module, 'more_button_en')
					@la_input($module, 'position')
					@la_input($module, 'region_headline')
					@la_input($module, 'status')
					@la_input($module, 'meta_title_ua')
					@la_input($module, 'meta_title_ru')
					@la_input($module, 'meta_title_en')
					@la_input($module, 'meta_keywords_ua')
					@la_input($module, 'meta_keywords_ru')
					@la_input($module, 'meta_keywords_en')
					@la_input($module, 'meta_description_ua')
					@la_input($module, 'meta_description_ru')
					@la_input($module, 'meta_description_en')
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
@endla_access

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script src="https://cdn.datatables.net/rowreorder/1.2.3/js/dataTables.rowReorder.min.js"></script>
<script>
var editor;
$(function () {
	var table = $("#example1").DataTable({
		dom: 'Bfrtip',
        rowReorder: {
             update: false,
             //selector: 'tr',
             dataSrc: 3//column position row
         },
        processing: true,
        serverSide: true,
        ajax: "{{ url(config('laraadmin.adminRoute') . '/news_headline_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
    table.on( 'row-reorder', function ( e, details, changes ) {
        $.ajax({
			url: "{{ url(config('laraadmin.adminRoute') . '/news_headline_position') }}",
			method: 'POST',
            data: {data: JSON.stringify(details)},
			headers: {
		    	'X-CSRF-Token': $('input[name="_token"]').val()
    		},
			success: function( data ) {
			     table.ajax.reload( null, false );
			}
		});
        
    } );    
	$("#news_headline-add-form").validate({
		
	});
});
</script>
@endpush
