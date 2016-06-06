@extends('default')
@section('content')
    <div class="col-sm-3"></div>
	<div class="col-sm-6">
	    <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Search by Electorate & Address</h3>
                  </div>
                  <div class="panel-body">
                  {!! Form::open(['method'=> 'GET', 'class'=>'form-horizontal']) !!}
                      <div class="form-group">
                      <div class="col-sm-12">{!! Form::select('electorate', $electorates,null, ['class' =>'form-control']) !!} {!! $errors->first('electorate', '<span class="help-block">:message</span>') !!}</div>
                      </div>
                      <div class="form-group">
                      <div class="col-sm-12">{!! Form::input('search', 'house', null, ['class' =>'form-control','placeholder' => 'House No.']) !!}</div>
                      </div>
                      <div class="form-group">
                      <div class="col-sm-12">{!! Form::input('search', 'street', null, ['required','class' =>'form-control','placeholder' => 'Street']) !!}</div>
                      </div>
                      <div class="form-group">
                      <div class="col-sm-12">{!! Form::submit('Search', ['class'=> 'btn btn-primary pull-left']) !!}</div>
                      </div>
                  {!! Form::close() !!}
                  </div>
        </div>
	</div>


	@stop