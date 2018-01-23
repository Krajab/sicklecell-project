@extends("layout")
@section("content")
	<div>
		<ol class="breadcrumb">
		  <li><a href="{{{URL::route('user.home')}}}">{{trans('messages.home')}}</a></li>
		  <li><a href="{{ URL::route('unhls_patient.index') }}">{{ Lang::choice('messages.patient',2)}}</a></li>
		  <li class="active">{{trans('messages.edit-patient')}}</li>
		</ol>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading ">
			<span class="glyphicon glyphicon-edit"></span>
			{{trans('messages.edit-patient-details')}}
		</div>
		<div class="panel-body">
			@if($errors->all())
				<div class="alert alert-danger">
					{{ HTML::ul($errors->all()) }}
				</div>
			@endif
			{{ Form::model($patient, array('route' => array('unhls_patient.update', $patient->id), 'method' => 'PUT',
				'id' => 'form-edit-patient')) }}
				<div class="form-group">
					{{ Form::label('field_id', trans('')) }}
					{{ Form::text('field_id', Input::old('field_id'), array('class' => 'form-control')) }}
				</div>				
				<div class="form-group">
					{{ Form::label('name', trans('messages.names'), array('class' => 'required')) }}
					{{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
				</div>
				<div class="form-group">
					<label class= 'required' for="dob">Date Of Birth</label>
					<input type="text" name="dob" id="dob" class="form-control input-sm" size="11">
				</div>
				<div class="form-group">
					<label for="age">Age</label>
					<input type="text" name="age" id="age" class="form-control input-sm" size="11">
					<select name="age_units" id="id_age_units" class="form-control input-sm">
						<option value="Y">Years</option>
						<option value="M">Months</option>
					</select>
				</div>
				<div class="form-group">
					{{ Form::label('gender', trans('messages.sex'), array('class' => 'required')) }}
					<div>{{ Form::radio('gender', '0', true) }}
					<span class="input-tag">{{trans('messages.male')}}</span></div>
					<div>{{ Form::radio("gender", '1', false) }}
					<span class="input-tag">{{trans('messages.female')}}</span></div>
				</div>
				<div class="form-group">
					{{Form::label('tribe_id', 'Tribe')}}
					{{ Form::select('tribe_id', $tribe,
					Input::old('tribe_id'),
					['class' => 'form-control tribe']) }}
				</div>
				<div class="form-group">
					{{Form::label('district_id', 'District')}}
					{{ Form::select('district_id', $districts,
					Input::old('district_id'),
					['class' => 'form-control district']) }}
				</div>
				<!-- <div class="form-group">
					{{ Form::label('village_workplace', trans('messages.workplace-village')) }}
					{{ Form::text('village_workplace', Input::old('village_workplace'), array('class'=>'form-control')) }}
				</div> -->
				<!-- <div class="form-group">
					{{ Form::label('address', trans('messages.physical-address')) }}
					{{ Form::text('address', Input::old('address'), array('class' => 'form-control')) }}
				</div>
				<div class="form-group">
					{{ Form::label('occupation', trans('messages.occupation')) }}
					{{ Form::text('occupation', Input::old('occupation'), array('class' => 'form-control')) }}
				</div> -->
				<div class="form-group">
					{{ Form::label('phone_number', trans('messages.phone-number')) }}
					{{ Form::text('phone_number', Input::old('phone_number'), array('class' => 'form-control')) }}
				</div>

					<div class="form-group">
						{{Form::label('', 'ENTER RESULTS')}}
					</div>
					<div class="form-pane panel panel-default">
						<div class="col-md-6">
							<div class="form-group">
								{{Form::label('result', 'Result')}}
								{{ Form::select('result' , $measureRanges,
								Input::get('result'),
								['class' => 'form-control specimen-type']) }}
							</div>
					</div>
						
				<div class="form-group actions-row">
					{{ Form::button('<span class="glyphicon glyphicon-save"></span> '.trans('messages.save'),
						['class' => 'btn btn-primary', 'onclick' => 'submit()']) }}
				</div>
			</div>

			{{ Form::close() }}
		</div>
	</div>
@stop
