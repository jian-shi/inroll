@extends('default')

@section('content')
<div class="col-sm-12">
<h3 class="bg-info">Residents @ {{$address->flat_no}} {{$address->house_no}} {{$address->house_alpha}} {{$address->street}}</h3>
<table class="table table-striped table-bordered">

	<th>Title</th>
	<th>Surname, Given name</th>
	<th>GNA</th>
	<th>Hostile</th>
	{{--<th>Door knocking Status</th>--}}
	<th>Save</th>

@foreach ($address->electors as $elector)
	<tr>

	<td>{{{ $elector->title }}}</td>
	<td>{!! link_to_route('elector_path', $elector->surname.", ".$elector->forenames, [$elector->id]) !!}</td>
	{!! Form::model($elector, ['url'=>'elector/'.$elector->id, 'method'=> 'PATCH', 'class'=>'form-horizontal']) !!}
	<td>{!! Form::hidden('gna',0) !!}{!! Form::checkbox('gna', 1) !!}</td>
	<td>{!! Form::hidden('hostile',0) !!}{!! Form::checkbox('hostile', 1) !!}</td>
	<td>
  			{!! Form::submit('Submit', ['class'=> 'btn btn-primary']) !!}
	</td>
	{!! Form::close() !!}
	</tr>



@endforeach
	{{--</table>--}}
	{{--</div>--}}

    {{--<div class="col-sm-12">--}}
        {{--@foreach($address->feedbacks as $note)--}}
        {{--<hr>--}}
        {{--<blockquote>--}}
            {{--<p class="lead">{{$note->notes}}</p>--}}
            {{--<small class="text-right">@ {{$note->created_at}} By  {{$note->user->name}}</small>--}}
        {{--</blockquote>--}}
        {{--@endforeach--}}
    {{--</div>--}}
    {{--<div class="col-sm-12">--}}
    	{{--{!! Form::open(['method'=> 'POST', 'route'=> ['address.feedback.store', $address->id],'class'=>'form-horizontal']) !!}--}}
        {{--<h3 class="bg-info">Notes</h3>--}}
        {{--<div class="form-group">--}}
        {{--<div class="col-sm-12">{!! Form::textarea('notes',null, ['class' =>'form-control', 'id' => 'notes']) !!}</div>--}}
        {{--</div>--}}
        {{--{!! Form::submit('Save',  ['class'=> 'btn btn-primary pull-left']) !!}--}}
        {{--{!! Form::close() !!}--}}
    {{--</div>--}}
@stop