@extends('default')

@section('content')

	<div class="col-sm-12">
		{!! Form::open(['method'=> 'GET', 'class'=>'form-horizontal','action'=>'PhoneController@show']) !!}
			<h3 class="bg-info">Search Address</h3>
			<div class="form-group">
				<div class="col-sm-2">{!! Form::select('electorate', $electorates,null, ['class' =>'form-control']) !!} {!! $errors->first('electorate', '<span class="help-block">:message</span>') !!}</div>
				<div class="col-sm-2">{!! Form::input('search', 'suburb', null, ['class' =>'form-control','placeholder' => 'Suburb']) !!} {!! $errors->first('electorate', '<span class="help-block">:message</span>') !!}</div>
	      		<div class="col-sm-2">{!! Form::input('search', 'house', null, ['class' =>'form-control','placeholder' => 'House No.']) !!}</div>
	      		<div class="col-sm-4">{!! Form::input('search', 'street', null, ['required','class' =>'form-control','placeholder' => 'Address']) !!}</div>
                {{--<div class="col-sm-2"><label>{!! Form::checkbox('door_knock', 1) !!} Door Knocking List</label></div>--}}

				<div class="col-sm-2">{!! Form::submit('Search', ['class'=> 'btn btn-primary pull-right']) !!}</div>
			</div>
		{!! Form::close() !!}
	</div>


    <div class="col-sm-12">
    <h3 class="bg-info">Results</h3>
	<table class="table table-striped ">
		<thead>
		<th>Phone</th>
		<th>Address</th>
		<th>Residents</th>

	    </thead>
	    <tbody>
        @foreach ($phones as $phone)


            @if($phone->landline)
            <tr>
            <td><a href='skype:{{$phone->landline}}?call'>{{$phone->landline}}</a> </td>
            <td>@if ($phone->elector->address->flat_no)
                    {{$phone->elector->address->flat_no }}/
                @endif
                {{$phone->elector->address->house_no }}
                 @if ($phone->elector->address->house_alpha)
                    / {{$phone->elector->address->house_alpha}}
                 @endif
                 {{$phone->elector->address->street }} </td>


                <td>
                @foreach ($phone->elector->address->electors as $elector)
                   {{\Illuminate\Support\Str::limit($elector->forenames,1,$end = '')}} <b>{{$elector->surname}}</b>,
                @endforeach
                </td>
            </tr>
            @endif


	    @endforeach

	    </tbody>
        </table>
        </div>


       {!! Form::close() !!}




	@stop