@extends("layout")
@section("content")
<div>
	<ol class="breadcrumb">
	  <li><a href="{{{URL::route('user.home')}}}">{{trans('messages.home')}}</a></li>
	  <li class="active">{{ Lang::choice('messages.patient',2) }}</li>
	</ol>
</div>

<!-- <div class='container-fluid'>
	<div class='row'>
		<div class='col-md-12'>
			{{ Form::open(array('route' => array('unhls_patient.index'), 'class'=>'form-inline',
				'role'=>'form', 'method'=>'GET')) }}
				<div class="form-group">
					{{ Form::label('search', "search", array('class' => 'sr-only')) }}
					{{ Form::text('search', Input::get('search'), array('class' => 'form-control test-search')) }}
				</div>
				<div class="form-group">
					{{ Form::button("<span class='glyphicon glyphicon-search'></span> ".trans('messages.search'), 
				        array('class' => 'btn btn-primary', 'type' => 'submit')) }}
				</div>
			{{ Form::close() }}
		</div>
	</div>
</div> -->

<!-- <br> -->

@if (Session::has('message'))
	<div class="alert alert-info">{{ trans(Session::get('message')) }}</div>
@endif

<div class="panel panel-primary">
	<div class="panel-heading ">
		<span class="glyphicon glyphicon-user"></span>
		{{trans('messages.list-patients')}}
		<div class="panel-btn">
			<a class="btn btn-sm btn-info" href="{{ URL::route('unhls_patient.create') }}">
				<span class="glyphicon glyphicon-plus-sign"></span>
				{{trans('messages.new-patient')}}
			</a>
			<!-- <a class="btn btn-sm btn-success" href="downloadExcel">
				<span class="glyphicon glyphicon-plus-sign"></span>
				Export to Excel
			</a> -->
		</div>
	</div>
	<div class="panel-body">
		<table class="custom-data-table table table-striped dataTable no-footer display nowrap" id="personnel" data-form="deleteForm">
			<thead>
				<tr>
					<th>{{trans('Sickle ID')}}</th>
					<th>Field ID</th>
					<th>{{Lang::choice('messages.name',1)}}</th>
					<th>{{trans('messages.gender')}}</th>
					<th>{{trans('messages.age')}}</th>
					<th>Tribe</th>
					<th>District</th>
					<th>Phone Number</th>
					<th>Results</th>
					<th>{{trans('messages.actions')}}</th>
				</tr>
			</thead>
			<tbody>
			@foreach($patients as $key => $patient)
				<tr  @if(Session::has('activepatient'))
						{{(Session::get('activepatient') == $patient->id)?"class='info'":""}}
					@endif
					<td>{{ $patient->patient_number }}</td>
					<td>{{ $patient->ulin}}</td>
					<td>{{ $patient->field_id }}</td>
					<td>{{ $patient->name }}</td>
					<td>{{ ($patient->gender==0?trans('messages.male'):trans('messages.female')) }}</td>
					<td>{{ $patient->getAge() }}</td>
					<td>{{ $patient->tribe->name}}</td>
					<td>{{ $patient->district->name }}</td>
					<td>{{ $patient->phone_number }}</td>
					<td>
						@if(!is_null($patient->visits->first()))
							@if(!is_null($patient->visits->first()->tests))
								{{ $patient->visits->first()->tests->first()->testResults->first()->result }}
							@endif
						@endif
					</td>
					<td>
						<!-- show the patient (uses the show method found at GET /patient/{id} -->
						<a class="btn btn-sm btn-success" href="{{ URL::route('unhls_patient.show', array($patient->id)) }}" >
							<span class="glyphicon glyphicon-eye-open"></span>
							{{trans('messages.view')}}
						</a>

						<!-- edit this patient (uses the edit method found at GET /patient/{id}/edit -->
						<a class="btn btn-sm btn-info" href="{{ URL::route('unhls_patient.edit', array($patient->id)) }}" >
							<span class="glyphicon glyphicon-edit"></span>
							{{trans('messages.edit')}}
						</a>
						@if(Auth::user()->can('can_delete_patient'))
						<!-- can delete patient -->
						<button class="btn btn-sm btn-danger delete-item-link"
							data-toggle="modal" data-target=".confirm-delete-modal"
							data-id="{{ URL::route('unhls_patient.delete', array($patient->id)) }}">
							<span class="glyphicon glyphicon-trash"></span>
							{{ trans('messages.delete') }}
						</button>
						@endif
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		<?php echo $patients->links(); 
		Session::put('SOURCE_URL', URL::full());?>
	</div>
</div>
@stop