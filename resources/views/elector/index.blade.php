@extends('default')

@section('content')

<div class="col-sm-12">
	{!! Form::open(['method'=> 'GET', 'class'=>'form-horizontal']) !!}
		<h3 class="bg-info">Search Electors</h3>
		<div class="form-group">
			{{--<div class="col-sm-2">{!! Form::input('id','id',null, ['class' =>'form-control','placeholder' => 'Elector ID']) !!} </div>--}}
      		<div class="col-sm-3">{!! Form::select('electorate', $electorates,null, ['class' =>'form-control']) !!} </div>
      		<div class="col-sm-3">{!! Form::input('search', 'surname', null, ['required','class' =>'form-control','placeholder' => 'Surname']) !!}</div>
      		<div class="col-sm-3">{!! Form::input('search', 'given_name', null, ['class' =>'form-control','placeholder' => 'Given Name']) !!}</div>
   	 	    <div class="col-sm-3">{!! Form::submit('Search',  ['class'=> 'btn btn-primary pull-left']) !!}</div>
   	 	</div>

	{!! Form::close() !!}

</div>
@if (count($electors) > 0)
<div class="col-sm-12">
        <div class="form-group">
        <h3 class="bg-info">Found {{count($electors)}} Electors</h3>
        </div>

        <div class="form-group">
        <table class="table table-striped table-bordered sticky-header">
        <thead>
            <th>ID</th>
            <th>Title</th>
            <th>Surname, Given name</th>
            <th>Address</th>
            <th>GNA</th>

            <th>Hostile</th>
            <th>Edit</th>
        </thead>
        <tbody>
            @foreach ($electors as $elector)
            <tr>
            <td>{{{ $elector->id }}}</td>
            <td>{{{ $elector->title }}}</td>
            <td>{!! link_to_route('elector_path', $elector->forenames.", ".$elector->surname, [$elector->id]) !!}</td>
            <td>{!! $elector->address->street.', '.$elector->address->suburb_town !!}</td>
            {{--{!! Form::model($elector, ['url'=>'elector/'.$elector->id, 'method'=> 'PATCH', 'class'=>'form-horizontal']) !!}--}}
            {!! Form::model($elector->relation,['action'=> ['RelationController@store', $elector->id],'class'=>'form-horizontal']) !!}
            <td>{!! isset($elector->relation)?Form::hidden($elector->id.'[is_gna]',0): null !!}<input type="checkbox" name={{$elector->id.'[is_gna]'}} value="1" {{isset($elector->relation->is_gna) && $elector->relation->is_gna==1?'checked=checked': 'false'}}></td>
            <td>{!! isset($elector->relation)?Form::hidden($elector->id.'[is_hostile]',0): null !!}<input type="checkbox" name={{$elector->id.'[is_hostile]'}} value="1" {{isset($elector->relation->is_hostile)&& $elector->relation->is_hostile==1?'checked=checked': 'false'}}></td>



            <td>{!! Form::submit('Submit', ['class'=> 'btn btn-primary']) !!}</td>

            {!! Form::close() !!}

            </tr>
            @endforeach
        </tbody>
        </table>
        </div>

</div>
@endif
@stop