@extends('default')

@section('content')

	<div class="col-sm-12">
		{{--{!! Form::open(['method'=> 'GET', 'class'=>'form-horizontal']) !!}--}}
		{!! Form::open(['method'=> 'GET', 'class'=>'form-horizontal', 'action' => 'AddressController@phone']) !!}

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


    <div class="col-sm-12">
    <h3 class="bg-info">Results</h3>
	<table class="table table-striped ">
		<thead>
		<th>Address</th>
		<th>Residents</th>

	    <th>Phone Number</th>

	    </thead>
	    <tbody>
        @foreach ($addresses as $address)
            @if($address->flat_no)
            <td>{!! link_to_route('address_path', $address->flat_no." - ".$address->house_no." ".$address->house_alpha.", ".$address->street, [$address->id]) !!}</td>
            @else
            <td>{!! link_to_route('address_path', $address->house_no.$address->house_alpha." ".$address->street, [$address->id]) !!}
            @endif
            <td>
            @foreach($address->electors as $elector)
                {!! link_to_route('elector_path',$elector->surname ." ".$elector->forenames."//", [$elector->id])  !!}
            @endforeach
            </td>
            <td>{!! $elector->phone->landline or null !!}</td>
            </tr>
	    @endforeach

	    </tbody>
        </table>
        </div>


       {!! Form::close() !!}

    <script type="text/javascript">
    function submitform()
    {
        document.forms["form"].submit();
    }
    </script>


	@stop