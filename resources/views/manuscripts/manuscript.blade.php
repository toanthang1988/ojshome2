<!-- manuscript_in_review.php -->
@extends('layout.master.master')
<!-- Header Title -->
@section('title-page-admin')
<!-- Tác giả -->
<!-- Journal Open Source -->
<!-- Bản thảo -->
{!! Lang::get('admin.manuscript.title_page_admin') !!}

@stop


<!-- Page Title -->
@section('title')
	 {!! Lang::get('admin.manuscript.title') !!}
	
@stop

<!-- Page Title Extra -->
@section('title-extra')

<!-- More extra - Page Title  -->

@stop

@section('content')
	
<script type="text/javascript">
	$(function() {
		$('#table_data').dataTable({
			"bPaginate": true,
			"bLengthChange": true,
			"bFilter": true,
			"bSort": true,
			"bInfo": true,
			"bAutoWidth": true
		});
	});
</script>

<div class="box">
<div class="box-header">
	 <h3 class="box-title">{!! Lang::get('admin.manuscript.header_title') !!}</h3>
</div><!-- /.box-header -->
<div class="box-body table-responsive">
	 <div id="table_data_wrapper" class="dataTables_wrapper form-inline" role="grid">

		<!-- Table -->
		<table id="table_data" class="table table-bordered table-striped dataTable" aria-describedby="table_data_info">
		<thead>
			<tr role="row">
				@foreach($result['col_header'] as $head)
					 <th class="sorting_asc center" role="columnheader" tabindex="0" aria-controls="table_data" rowspan="1" colspan="1">{{trans($head)}}</th>
				@endforeach
				<th rowspan="1" colspan="1" class="center">{!! trans('admin.manuscript.detail') !!}</th>
			</tr>
		</thead>

		<tfoot>
			<tr>
				@foreach($result['col_header'] as $head)
					 <th class="sorting_asc center" role="columnheader" tabindex="0" aria-controls="table_data" rowspan="1" colspan="1">{{trans($head)}}</th>
				@endforeach
				<th rowspan="1" colspan="1" class="center">{!! Lang::get('admin.manuscript.detail') !!}</th>
			</tr>
		</tfoot>
		<tbody role="alert" aria-live="polite" aria-relevant="all">
			<input type="hidden" value ='{!! $is_odd = true !!}'/>

			@foreach($result['data'] as $row)
				
				<tr class="{{ ($is_odd) ? 'odd' : 'even' }}">

					@foreach( $result['col_db'] as $col)					
						<td class="center" > {!! empty($row->$col) ? '-' : $row->$col !!} </td>
					@endforeach

					@if (!in_array(AUTHOR, $permissions))
						<!-- Editors -->
						<td class="center"><a href = "{{ url('admin/editor-manuscript/form/' . $row->id) }}"> {!! Lang::get('admin.manuscript.more_detail') !!} </a></td>
					@else

						<!-- Author -->
						@if (isset($stage) and $stage == EDITING and $row->is_print_out == PRINT_OUT)
							<!-- has print out from layout editor -->
							<td class="center"><a href = "{{ url('admin/editor-manuscript/form/' . $row->id) }}"> {!! Lang::get('admin.manuscript.more_detail') !!} </a></td>

						@else (isset($stage) and $stage != EDITING and $row->is_print_out == NOT_PRINT_OUT)
							<!-- else -->
							<td class="center"><a href = "{{ url('admin/manuscript/form/' . $row->id) }}"> {!! Lang::get('admin.manuscript.more_detail') !!} </a></td>
						
						@endif
						
					@endif
				</tr>

			@endforeach

		</tbody>
		</table>

	</div><!-- datatable_wrapper -->

</div><!-- /.box-body -->
</div>

@stop
