@extends("la.layouts.app")

@section("contentheader_title", "News Resources RSSes")
@section("contentheader_description", "News Resources RSSes listing")
@section("section", "News Resources RSSes")
@section("sub_section", "Listing")
@section("htmlheader_title", "News Resources RSSes Listing")

@section("headerElems")
@la_access("News_Resources_RSSes", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add News Resources RSS</button>
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

@la_access("News_Resources_RSSes", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add News Resources RSS</h4>
			</div>
			{!! Form::open(['action' => 'LA\News_Resources_RSSesController@store', 'id' => 'news_resources_rss-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
                    {{--@la_form($module)--}}
					
					
					@la_input($module, 'title')
					@la_input($module, 'rss')
					@la_input($module, 'headline_ids')
					@la_input($module, 'status')
					@la_input($module, 'socia_network')
					{{--@la_input($module, 'last_sync')--}}
					@la_input($module, 'sync_start')
					@la_input($module, 'sync_end')
					
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
	$("#example1").DataTable({
		processing: true,
        serverSide: true,
        ajax: "{{ url(config('laraadmin.adminRoute') . '/news_resources_rss_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#news_resources_rss-add-form").validate({
		
	});
});
</script>
@endpush
