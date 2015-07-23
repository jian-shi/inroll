@extends('default')

@section('content')
<div class="col-sm-12">
<h3 class="bg-info">Residents @ {{$address->flat_no}} {{$address->house_no}} {{$address->house_alpha}} {{$address->street}}</h3>
</div>
<table class="table table-striped table-bordered">

	<th>Title</th>
	<th>Surname, Given name</th>
	<th>GNA</th>
	<th>Hostile</th>

	<th>Save</th>

@foreach ($address->electors as $elector)
	<tr>

	<td>{{{ $elector->title }}}</td>
	<td>{!! link_to_route('elector_path', $elector->surname.", ".$elector->forenames, [$elector->id]) !!}</td>
	{!! Form::model($elector->relation,['action'=> ['RelationController@store', $elector->id],'class'=>'form-horizontal','id'=>'form']) !!}
	<td>{!! isset($elector->relation)?Form::hidden($elector->id.'[is_gna]',0): null !!}<input type="checkbox" name={{$elector->id.'[is_gna]'}} value="1" {{isset($elector->relation->is_gna)&& $elector->relation->is_gna==1?'checked=checked': 'false'}}></td>
    <td>{!! isset($elector->relation)?Form::hidden($elector->id.'[is_hostile]',0): null !!}<input type="checkbox" name={{$elector->id.'[is_hostile]'}} value="1" {{isset($elector->relation->is_hostile)&& $elector->relation->is_hostile==1?'checked=checked': 'false'}}></td>
    <td>
    {!! Form::submit('Submit', ['class'=> 'btn btn-primary']) !!}
	</td>
	{!! Form::close() !!}
	</tr>



@endforeach
	</table>
@stop