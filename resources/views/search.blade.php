@extends('...default')
    @section('content')
        <div class="col-sm-12">
            {!! Form::open(['method'=> 'GET', 'class'=>'form-horizontal']) !!}
                <h3 class="bg-info">Target Area</h3>
                    <div class="form-group">
                        <label for="input-electorate" class="col-sm-2 control-label">Electorate</label>
                        <div class="col-sm-10">
                            {!! Form::select('electorate[]', $electorates, null, ['required','id'=> 'selectElectorate' ,'class' =>'form-control', 'multiple' ]) !!} {!! $errors->first('electorate', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input-area_unit" class="col-sm-2 control-label">Area Unit</label>
                        <div class="col-sm-4">{!! Form::input('search', 'area_unit', null, ['class' =>'form-control','placeholder' => 'Area Unit']) !!}</div>
                        <label for="input-deprivation" class="col-sm-2 control-label">Deprivation</label>
                        <div class="col-sm-2">{!! Form::selectRange('dep_from',1,10, 1, ['class' =>'form-control', 'id'=>'input-deprivation']) !!}</div>
                        <div class="col-sm-2">{!! Form::selectRange('dep_to',1,10, 10, ['class' =>'form-control']) !!}</div>
                    </div>

                    <h3 class="bg-info">Target Electors</h3>
                    <div class="form-group">
                        <label for="input-age" class="col-sm-2 control-label">Age</label>
                        <div class="col-sm-2">{!! Form::select('age_from',$age_range, 'h', ['class' =>'form-control', 'id'=>'input-age']) !!}</div>
                        <div class="col-sm-2">{!! Form::select('age_to',$age_range, 'v', ['class' =>'form-control']) !!}</div>
                        <label for="input-ethnic" class="col-sm-2 control-label">Ethnic Group</label>
                        <div class="col-sm-2">{!! Form::select('ethnic',[null=>'any','chinese'=>'Chinese', 'korean'=>'Korean', 'indian'=>'Indian'], null, ['class' =>'form-control','id'=>'input-ethnic']) !!}</div>
                    </div>

                     <div class="form-group">
                         <label for="input-occupation" class="col-sm-2 control-label">Occupation</label>
                         <div class="col-sm-6">{!! Form::select('occupation[]',[null=> 'any'], null, ['id'=>'selectOccupation', 'class' =>'form-control','multiple']) !!}</div>
                     </div>

                <h3 class="bg-info"> Found {{$count_elector}} Electors, {{$count_address}} Households</h3>
                {{--{!! Form::submit('Search',  ['class'=> 'btn btn-info btn-lg pull-left'])!!}--}}
                <div class="col-sm-2"><button type="submit" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-search"></span> Search</button></div>

                @if ($count_elector>0) <div class="col-sm-2"><button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-cloud-download"></span> Download</button></div> @endif
            {!! Form::close() !!}
            {!! Form::open(['method' => 'GET','action'=> ['SearchController@export'],'class'=>'form-horizontal','id'=>'form']) !!}

            <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Export for</h4>
                  </div>
                  <div class="modal-body">
                  <div class="row">

                    <div class="col-sm-6">{!! Form::select('export',['mail'=>'Mailing', 'door'=>'Door Knocking'], null, ['class' =>'form-control','id'=>'export']) !!}</div>
                  </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Close</button>
                    {{--{!! link_to_route ('export','Export', null, array('class' => 'btn btn-primary pull-left')) !!}--}}
                    {!! Form::submit('Download List',  ['class'=> 'btn btn-primary btn-md pull-left']) !!}
                          </div>
                  </div>
                </div>

              </div>
              {!! Form::close() !!}

            </div>
        </div>

    @endsection
@stop