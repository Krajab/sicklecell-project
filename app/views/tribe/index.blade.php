@extends("layout")
@section("content")
<div>
	<ol class="breadcrumb">
	  <li><a href="{{{URL::route('user.home')}}}">{{ trans('messages.home') }}</a></li>
	  <li class="active">{{ Lang::choice('settings',1) }}</li>
	</ol>
</div>
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="panel panel-primary">
	<div class="panel-heading ">
		<span class="ion-person-stalker"></span>
		{{ Lang::choice('Manage Tribes',1) }}
		<div class="panel-btn">
			<a class="btn btn-sm btn-info" href="{{ URL::to("tribe/create") }}" >
				<span class="glyphicon glyphicon-plus-sign"></span>
				{{ trans('Add Tribe') }}
			</a>
		</div>
	</div>
	<!-- <ul class="nav nav-tabs" role="tablist">
							<li class="active">
								<a href="tribe.index" role="tab" data-toggle="tab">
									{{trans('Tribes')}}</a></li>
							<li>
								<a href="" role="tab" data-toggle="tab">
									{{trans('Districts')}}</a></li>
						</ul> -->
	<div class="panel-body">
		<table class="table table-striped table-hover table-condensed search-table">
			<thead>
				<tr>
					<th>{{ Lang::choice('messages.name',1) }}</th>
					<!-- <th>{{ trans('messages.description') }}</th> -->
					<th></th>
				</tr>
			</thead>
			<tbody>
			@foreach($tribes as $key => $value)
				<tr @if(Session::has('activetribe'))
                            {{(Session::get('activetribe') == $value->id)?"class='info'":""}}
                        @endif
                        >

					<td>{{ $value->name }}</td>
					<!-- <td>{{ $value->description }}</td> -->
					
					<td>

					<!-- show the tribe (uses the show method found at GET /tribe/{id} -->
						<a class="btn btn-sm btn-success" href="{{ URL::to("tribe/" . $value->id) }}" >
							<span class="glyphicon glyphicon-eye-open"></span>
							{{ trans('messages.view') }}
						</a>

					<!-- edit this tribe (uses edit method found at GET /tribe/{id}/edit -->
						<a class="btn btn-sm btn-info" href="{{ URL::to("tribe/" . $value->id . "/edit") }}" >
							<span class="glyphicon glyphicon-edit"></span>
							{{ trans('messages.edit') }}
						</a>
						
					<!-- delete this tribe (uses delete method found at GET /tribe/{id}/delete -->
						<button class="btn btn-sm btn-danger delete-item-link"
							data-toggle="modal" data-target=".confirm-delete-modal"	
							data-id='{{ URL::to("tribe/" . $value->id . "/delete") }}'>
							<span class="glyphicon glyphicon-trash"></span>
							{{ trans('messages.delete') }}
						</button>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		{{ Session::put('SOURCE_URL', URL::full()) }}
	</div>
</div>
@stop