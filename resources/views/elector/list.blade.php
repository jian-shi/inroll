@extends('default')

@section('content')
<div class="row">
    <div class="col-lg-3">
        <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Search by Electorate & Name</h3>
              </div>

              <div class="panel-body">
              {!! Form::open(['method'=> 'GET', 'class'=>'form-horizontal']) !!}
                  <div class="form-group">
                    <div class="col-sm-12">{!! Form::select('electorate', $electorates,null, ['class' =>'form-control']) !!} </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">{!! Form::input('search', 'surname', null, ['required','class' =>'form-control','placeholder' => 'Surname']) !!}</div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">{!! Form::input('search', 'given_name', null, ['class' =>'form-control','placeholder' => 'Given Name(s)']) !!}</div>

                  </div>
                  <div class="form-group">
                  <div class="col-sm-12">{!! Form::submit('Search',  ['class'=> 'btn btn-primary pull-left']) !!}</div>
                  </div>
              {!! Form::close() !!}
              </div>
        </div>
    </div>


@if(count($electors) > 0)
<div class="col-lg-9">
        <div class="form-group">
        <ul class="nav nav-pills" role="tablist">
          <li role="presentation" class="active"><a href="#">Found <span class="badge">{!!$electors->total() !!} people</span></a></li>
          <li role="presentation"><a href="#"><span class="badge">{!!$electors->count() !!} per page</span></a></li>
        </ul>
        </div>

        <div class="form-group">

        <table class="table table-striped table-bordered sticky-header">
        <thead>
            <th>Title</th>
            <th>Name</th>
            <th>Address</th>
            <th>Electorate</th>
            <th>Feedback</th>
            <th>Party Vote</th>
            <th>GNA</th>
            <th>Save</th>
        </thead>
        <tbody>
            @foreach ($electors as $elector)
            <tr>
            <td>{{{ $elector->title }}}</td>
            <td>{!! link_to_route('elector_path', $elector->forenames.' '.strtoupper($elector->surname), [$elector->id]) !!}</td>
            @if($elector->flat_no)
            <td>{!! link_to_route('address_path', $elector->flat_no."/". $elector->house_no. $elector->house_alpha.' '. $elector->street, [$elector->address_id])!!}</td>
            @else
            <td>{!! link_to_route('address_path', $elector->house_no. $elector->house_alpha.' '. $elector->street, [$elector->address_id])!!}</td>
            @endif
            <td>{!! $elector->electorate->electorate!!}</td>
            {{--{!! Form::model($elector, ['url'=>'elector/'.$elector->id, 'method'=> 'PATCH', 'class'=>'form-horizontal']) !!}--}}
            {!! Form::model($elector->relation,['action'=> ['RelationController@store', $elector->id],'class'=>'form-horizontal']) !!}
            <td>{!! Form::select($elector->id.'[relation]',[null=>'?','friendly'=>'Friendly', 'persuadable'=>'Persuadable', 'hostile'=>'Hostile', 'candidate_vote'=>'Candidate Vote','home_unclear'=>'Home/ Unclear','not_home'=>'Visited Not Home'], isset($elector->relation->relation)?$elector->relation->relation:null, ['class' =>'form-control','id'=>'input-relation']) !!}</td>
            <td>{!! Form::select($elector->id.'[party_vote]',[null=>'N/A','act'=>'ACT', 'national'=>'National', 'Labour'=>'Labour', 'conservative'=>'Conservative','nzfirst'=>'NzFirst','green'=>'Green','other'=>'Other'], isset($elector->relation->party_vote)?$elector->relation->party_vote:null, ['class' =>'form-control','id'=>'input-party']) !!}</td>
            <td>{!! Form::hidden($elector->id.'[is_gna]', 0) !!}<input type="checkbox" name={{$elector->id.'[is_gna]'}} value="1" {{isset($elector->relation->is_gna) && $elector->relation->is_gna==1?'checked=checked': 'false'}}></td>

            <td>{!! Form::submit('Submit', ['class'=> 'btn btn-primary']) !!}</td>

            {!! Form::close() !!}

            </tr>
            @endforeach
        </tbody>
        </table>
        {!! $electors->appends(Request::except('page'))->render() !!}
        </div>

</div>

@else
<div class="col-sm-8">
         <div class="form-group">
                <ul class="nav nav-pills" role="tablist">
                  <li role="presentation" class="active"><a href="#">Found <span class="badge"> No Result </span></a></li>
                  <li role="presentation"><a href="#"><span class="badge"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Please check your input.</span></a></li>
                </ul>
         </div>
</div>
</div>
@endif
@stop