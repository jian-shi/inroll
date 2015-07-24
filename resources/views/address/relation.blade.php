@extends('default')

@section('content')

	<div class="col-sm-12">
		{!! Form::open(['method'=> 'GET', 'class'=>'form-horizontal']) !!}
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
		<th>Address</th>
	    <th>Name</th>
	    <th>Age</th>
	    <th>Title</th>
	    <th>Occ</th>
	    <th>Feedback</th>
	    <th>Party</th>
        <th>GNA</th>
	    </thead>
	    <tbody>
        @foreach ($addresses as $address)
            @foreach ($address->electors as $elector)
                <tr class=
                "@if(isset($elector->relation->is_friendly))
                    @if ($elector->relation->is_friendly==1||$elector->relation->is_persuadable==1)
                        success
                    @elseif($elector->relation->is_hostile==1)
                        danger
                    @elseif($elector->relation->is_gna==1)
                        warning
                    @endif

                @endif"
                >
                    @if($address->flat_no)
                    <td>{!! link_to_route('address_path', $address->flat_no." - ".$address->house_no." ".$address->house_alpha.", ".$address->street, [$address->id]) !!}</td>
                    @else
                    <td>{!! link_to_route('address_path', $address->house_no.$address->house_alpha." ".$address->street, [$address->id]) !!}
                    @endif

                    <td>{!! link_to_route('elector_path', $elector->forenames.", ".$elector->surname, [$elector->id]) !!}</td>
                    <td>{!! (date('Y') - $elector->age->age_to). "~" . (date('Y') - $elector->age->age_from)  !!}</td>
                    <td>{!! $elector->title !!}</td>
                    <td>{!! $elector->occupation !!}</td>

                    {!! Form::model($elector->feedback,['action'=> ['RelationController@store', $elector->id],'class'=>'form-horizontal','id'=>'form']) !!}
                    <td>{!! Form::select($elector->id.'[relation]',[null=>'?','is_friendly'=>'Friendly', 'is_persuadable'=>'Persuadable', 'is_hostile'=>'Hostile', 'is_candidate_vote'=>'Candidate Vote','not_home'=>'Visited Not Home'], isset($elector->relation->relation)?$elector->relation->relation:null, ['class' =>'form-control','id'=>'input-party']) !!}</td>
                    {{--<td>{!! isset($elector->relation)?Form::hidden($elector->id.'[is_home]',0): null !!}<input type="checkbox" name={{$elector->id.'[is_home]'}} value="1" {{isset($elector->relation->is_home)&& $elector->relation->is_home==1?'checked=checked': 'false'}}></td>--}}
                    {{--<td>{!! isset($elector->relation)?Form::hidden($elector->id.'[is_friendly]',0): null !!}<input type="checkbox" name={{$elector->id.'[is_friendly]'}} value="1" {{isset($elector->relation->is_friendly)&& $elector->relation->is_friendly==1?'checked=checked': 'false'}}></td>--}}
                    {{--<td>{!! isset($elector->relation)?Form::hidden($elector->id.'[is_persuadable]',0): null !!}<input type="checkbox" name={{$elector->id.'[is_persuadable]'}} value="1" {{isset($elector->relation->is_persuadable)&& $elector->relation->is_persuadable==1?'checked=checked': 'false'}}></td>--}}
                    {{--<td>{!! isset($elector->relation)?Form::hidden($elector->id.'[is_hostile]',0): null !!}<input type="checkbox" name={{$elector->id.'[is_hostile]'}} value="1" {{isset($elector->relation->is_hostile)&& $elector->relation->is_hostile==1?'checked=checked': 'false'}}></td>--}}
                    {{--<td>{!! isset($elector->relation)?Form::hidden($elector->id.'[is_candidate_vote]',0): null !!}<input type="checkbox" name={{$elector->id.'[is_candidate_vote]'}} value="1" {{isset($elector->relation->is_candidate_vote)&& $elector->relation->is_candidate_vote==1?'checked=checked': 'false'}}></td>--}}
                    <td>{!! Form::select($elector->id.'[party_vote]',[null=>'N/A','act'=>'ACT', 'national'=>'National', 'Labour'=>'Labour', 'conservative'=>'Conservative','nzfirst'=>'NzFirst','green'=>'Green','other'=>'Other'], isset($elector->relation->party_vote)?$elector->relation->party_vote:null, ['class' =>'form-control','id'=>'input-party']) !!}</td>
                    <td>{!! isset($elector->relation)?Form::hidden($elector->id.'[is_gna]',0): null !!}<input type="checkbox" name={{$elector->id.'[is_gna]'}} value="1" {{isset($elector->relation->is_gna) && $elector->relation->is_gna==1?'checked=checked': 'false'}}></td>
                    </tr>

            @endforeach
	    @endforeach

	    </tbody>
        </table>
        </div>
        <nav class="navbar navbar-default navbar-fixed-bottom">
            <div class="container">
            {!! Form::label ('Found'. count($addresses).'Addresses','Found '. count($addresses).' Addresses',['class'=>'navbar-brand'])!!}

            {!! Form::submit('Save Changes',  ['class'=> 'btn btn-primary navbar-btn pull-right','onclick'=>'javascript: submitform()']) !!}

            </div>
        </nav>

       {!! Form::close() !!}

    <script type="text/javascript">
    function submitform()
    {
        document.forms["form"].submit();
    }
    </script>


	@stop