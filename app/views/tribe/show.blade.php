@extends("layout")
@section("content")
	<div>
		<ol class="breadcrumb">
		  <li><a href="{{{URL::route('user.home')}}}">{{trans('messages.home')}}</a></li>
		  <li><a href="{{ URL::route('tribe.index') }}">{{ Lang::choice('Tribe',2) }}</a></li>
		  <li class="active">{{trans('Tribe')}}</li>
		</ol>
	</div>
	<div class="panel panel-primary tribe-create">
		<div class="panel-heading ">
			<span class="glyphicon glyphicon-user"></span>
			{{trans('Tribe-details')}}
			<div class="panel-btn">
				<a class="btn btn-sm btn-info" href="{{ URL::to("tribe/". $tribe->id ."/edit") }}">
					<span class="glyphicon glyphicon-edit"></span>
					{{trans('messages.edit')}}
				</a>
			</div>
		</div>
		<div class="panel-body">
			<div class="display-details">
				<h3 class="view"><strong>{{ Lang::choice('messages.name',1) }}</strong>{{ $tribe->name }} </h3>
				<p class="view"><strong>{{trans('messages.date-created')}}</strong>{{ $tribe->created_at }}</p>
			</div>
		</div>
	</div>
@stop