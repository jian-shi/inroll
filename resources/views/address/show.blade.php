@extends('default')

@section('content')
<div class="col-sm-12">

@if($address->flat_no)<h3 class="bg-info">{{$address->flat_no}}/{{$address->house_no}} {{$address->house_alpha}} {{$address->street}}, {{$address->electorate->electorate}}</h3>
@else<h3 class="bg-info">{{$address->house_no}} {{$address->house_alpha}} {{$address->street}}, {{$address->electorate->electorate}}</h3>
@endif
</div>
<table class="table table-striped table-bordered">

	<th>Title</th>
	<th>Name</th>
	<th>Relationship</th>
	<th>Party</th>
	<th>GNA</th>
	<th>Save</th>

@foreach ($address->electors as $elector)
	<tr>
	<td>{{{ $elector->title }}}</td>
	<td>{!! link_to_route('elector_path', $elector->forenames.' '. strtoupper($elector->surname), [$elector->id]) !!}</td>
	{!! Form::model($elector->relation,['action'=> ['RelationController@store', $elector->id],'class'=>'form-horizontal','id'=>'form']) !!}
	 <td>{!! Form::select($elector->id.'[relation]',[null=>'?','friendly'=>'Friendly', 'persuadable'=>'Persuadable', 'hostile'=>'Hostile', 'candidate_vote'=>'Candidate Vote','home_unclear'=>'Home/ Unclear','not_home'=>'Visited Not Home'], isset($elector->relation->relation)?$elector->relation->relation:null, ['class' =>'form-control','id'=>'input-relation']) !!}</td>
    <td>{!! Form::select($elector->id.'[party_vote]',[null=>'N/A','act'=>'ACT', 'national'=>'National', 'Labour'=>'Labour', 'conservative'=>'Conservative','nzfirst'=>'NzFirst','green'=>'Green','other'=>'Other'], isset($elector->relation->party_vote)?$elector->relation->party_vote:null, ['class' =>'form-control','id'=>'input-party']) !!}</td>
    <td>{!! Form::hidden($elector->id.'[is_gna]', 0) !!}<input type="checkbox" name={{$elector->id.'[is_gna]'}} value="1" {{isset($elector->relation->is_gna) && $elector->relation->is_gna==1?'checked=checked': 'false'}}></td>
    <td>
    {!! Form::submit('Submit', ['class'=> 'btn btn-primary']) !!}
	</td>
	{!! Form::close() !!}
	</tr>
@endforeach
	</table>
@stop