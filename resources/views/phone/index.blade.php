@extends('...default')

@section('content')

	<div class="col-sm-12">
		{{--{!! Form::open(['method'=> 'GET', 'class'=>'form-horizontal']) !!}--}}
		{!! Form::open(['method'=> 'GET', 'class'=>'form-horizontal', 'action'=>'PhoneController@show']) !!}

			<h3 class="bg-info">Search Address</h3>
			<div class="form-group">
				<div class="col-sm-2">{!! Form::select('electorate', $electorates,null, ['class' =>'form-control']) !!} {!! $errors->first('electorate', '<span class="help-block">:message</span>') !!}</div>
				<div class="col-sm-2">{!! Form::input('search', 'suburb', null, ['class' =>'form-control','placeholder' => 'Suburb']) !!} {!! $errors->first('electorate', '<span class="help-block">:message</span>') !!}</div>
	      		<div class="col-sm-2">{!! Form::input('search', 'house', null, ['class' =>'form-control','placeholder' => 'House No.']) !!}</div>
	      		<div class="col-sm-4">{!! Form::input('search', 'street', null, ['required','class' =>'form-control','placeholder' => 'Address']) !!}</div>
				<div class="col-sm-2">{!! Form::submit('Search', ['class'=> 'btn btn-primary pull-right']) !!}</div>
			</div>
		{!! Form::close() !!}
	</div>



@stop