@extends("la.layouts.app")

@section("contentheader_title", "Links Headlines")
@section("contentheader_description", "Links Headlines listing")
@section("section", "Links Headlines")
@section("sub_section", "Listing")
@section("htmlheader_title", "Links Headlines Listing")

@section("headerElems")
@la_access("Links_Headlines", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Links Headline</button>
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

@la_access("Links_Headlines", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Links Headline</h4>
			</div>
			{!! Form::open(['action' => 'LA\Links_HeadlinesController@store', 'id' => 'links_headline-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
                    @la_form($module)
					
					{{--
					@la_input($module, 'title_ua')
					@la_input($module, 'title_ru')
					@la_input($module, 'title_en')
					@la_input($module, 'status')
					@la_input($module, 'placing')
					@la_input($module, 'position')
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
<script>
$(function () {
	var table = $("#example1").DataTable({
	    dom: 'Bfrtip',
        rowReorder: {
             update: false,
             //selector: 'tr',
             dataSrc: 4//column position row
         },
		processing: true,
        serverSide: true,
        ajax: "{{ url(config('laraadmin.adminRoute') . '/links_headline_dt_ajax') }}",
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
    		url: "{{ url(config('laraadmin.adminRoute') . '/links_headline_position') }}",
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
	$("#links_headline-add-form").validate({
		
	});
});
</script>
@endpush
