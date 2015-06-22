@extends('default')
@section('content')
	<div class="col-sm-12">
		{!! Form::open(['method'=> 'GET', 'class'=>'form-horizontal']) !!}
			<h3 class="bg-info">Search Address</h3>
			<div class="form-group">
				<div class="col-sm-3">{!! Form::select('electorate', $electorates,null, ['class' =>'form-control']) !!} {!! $errors->first('electorate', '<span class="help-block">:message</span>') !!}</div>
				<div class="col-sm-2">{!! Form::input('search', 'suburb', null, ['class' =>'form-control','placeholder' => 'Suburb']) !!} {!! $errors->first('electorate', '<span class="help-block">:message</span>') !!}</div>
	      		<div class="col-sm-2">{!! Form::input('search', 'house', null, ['class' =>'form-control','placeholder' => 'House No.']) !!}</div>
	      		<div class="col-sm-5">{!! Form::input('search', 'street', null, ['required','class' =>'form-control','placeholder' => 'Address']) !!}</div>
            </div>
				{!! Form::submit('Search', ['class'=> 'btn btn-primary pull-left']) !!}
		{!! Form::close() !!}
	</div>

	<div class="col-sm-12">
	<h3 class="bg-info"> Found {{count ($addresses)}} Addresses</h3>
	<table class="table table-striped table-bordered">
		<th>Address Name</th>
	    <th>Area Unit</th>
	    <th>Suburb</th>
	    <th>City</th>
	    <th>Electorate</th>
        @foreach ($addresses as $address)
	    <tr>
	        @if($address->flat_no)
	        <td>{!! link_to_route('address_path', $address->flat_no." - ".$address->house_no." ".$address->house_alpha.", ".$address->street, [$address->id]) !!}</td>
	        @else
	        <td>{!! link_to_route('address_path', $address->house_no.$address->house_alpha." ".$address->street, [$address->id]) !!}
	        @endif
	        <td> </td>
	        <td>{{$address->suburb_town }}</td>
	        <td>{{$address->city }}</td>
	        <td>{{$address->electorate->electorate}}</td>
	    </tr>
	@endforeach

	</table>
	</div>
	@stop