@extends('default')

@section('content')

	<div class="col-lg-3">
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


    <div class="col-lg-9">
    @if (count($addresses) == 0)
    <div class="form-group">
            <ul class="nav nav-pills" role="tablist">
              <li role="presentation" class="active"><a href="#">Found <span class="badge">0 address</span></a></li>
              <li role="presentation"><a href="#"><span class="badge"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Please check your input. Choose 'Electorate Unknown' if not sure about the electorate.</span></a></li>
            </ul>
        </div>
    @else
    {{----}}

    {{----}}
    <div class="form-group">
                    <ul class="nav nav-pills" role="tablist">
                      <li role="presentation" class="active"><a href="#">Found <span class="badge">{!!$addresses->total() !!} addresses</span></a></li>
                       @foreach($electorate_group as $item)
                        <li role="presentation"><a href="#" ><span class="badge">{!! $item-> electorate->electorate!!}</span></a></li>
                       @endforeach
                    </ul>
                </div>

    <div class="form-group">
        <table class="table table-striped ">
        		<thead>
        		<th>House</th>
        	    <th>Name</th>
        	    <th>Age</th>
        	    <th>Title</th>
        	    <th>Occupation</th>
        	    <th>Electorate</th>
        	    <th>Feedback</th>
        	    <th>Party</th>
                <th>GNA</th>
        	    </thead>
        	    <tbody>
                @foreach ($addresses as $address)
                    @foreach ($address->electors as $elector)
                        {{--<tr class=--}}
                        {{--"@if(isset($elector->relation->relation))--}}
                            {{--@if ($elector->relation->relation=='friendly'||$elector->relation->relation=='persuadable')--}}
                                {{--success--}}
                            {{--@elseif($elector->relation->relation=='hostile')--}}
                                {{--danger--}}
                            {{--@elseif($elector->relation->is_gna==1)--}}
                                {{--warning--}}
                            {{--@endif--}}

                        {{--@endif"--}}
                        {{-->--}}
                        <tr>
                            @if($address->flat_no)
                            <td>{!! link_to_route('address_path', $address->flat_no."/".$address->house_no." ".$address->house_alpha, [$address->id]) !!}</td>
                            @else
                            <td>{!! link_to_route('address_path', $address->house_no.$address->house_alpha, [$address->id]) !!}
                            @endif

                            <td>{!! link_to_route('elector_path', $elector->forenames." ".strtoupper($elector->surname), [$elector->id]) !!}</td>
                            <td>{!! (date('Y') - $elector->age->age_to). "~" . (date('Y') - $elector->age->age_from)  !!}</td>
                            <td>{!! $elector->title !!}</td>
                            <td>{!! $elector->occupation !!}</td>
                            <td>{!! $elector->electorate->electorate !!}</td>

                            {!! Form::model($elector->relation,['action'=> ['RelationController@store', $elector->id],'class'=>'form-horizontal','id'=>'form']) !!}
                            <td>{!! Form::select($elector->id.'[relation]',[null=>'?','friendly'=>'Friendly', 'persuadable'=>'Persuadable', 'hostile'=>'Hostile', 'candidate_vote'=>'Candidate Vote','home_unclear'=>'Home/ Unclear','not_home'=>'Visited Not Home'], isset($elector->relation->relation)?$elector->relation->relation:null, ['class' =>'form-control','id'=>'input-relation']) !!}</td>
                            <td>{!! Form::select($elector->id.'[party_vote]',[null=>'N/A','act'=>'ACT', 'national'=>'National', 'Labour'=>'Labour', 'conservative'=>'Conservative','nzfirst'=>'NzFirst','green'=>'Green','other'=>'Other'], isset($elector->relation->party_vote)?$elector->relation->party_vote:null, ['class' =>'form-control','id'=>'input-party']) !!}</td>
                            <td>{!! Form::hidden($elector->id.'[is_gna]', 0) !!}<input type="checkbox" name={{$elector->id.'[is_gna]'}} value="1" {{isset($elector->relation->is_gna) && $elector->relation->is_gna==1?'checked=checked': 'false'}}></td>
                            </tr>
                    @endforeach
        	    @endforeach
        	    </tbody>
                </table>
    </div>

        {!! $addresses->appends(Request::except('page'))->render() !!}
        @endif
        </div>
        <nav class="navbar navbar-default navbar-fixed-bottom">
            <div class="container">
            {!! Form::label (count($addresses).'Addresses','Found '. count($addresses).' Addresses',['class'=>'navbar-brand'])!!}
            {!! Form::submit('Save Changes',  ['class'=> 'btn btn-primary navbar-btn pull-right','onclick'=>'javascript: submitform()']) !!}
            </div>
        </nav>

       {!! Form::close() !!}



@section('script')
       <script type="text/javascript">
           function submitform()
           {
              $(this).closest("form").submit();
           }

       </script>
       <script>
       $(document).ready(function(){
        $('.badge').on('click',function(){
            var electorate = $(this).text();
            $("tr:not(:has(th)):not(:contains('" + electorate + "'))").css("background", "red").hide();
            })
       })
       </script>
@endsection

@stop