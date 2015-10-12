@extends('default')

@section('content')
	<section>

        <div class="row">
            <h3 class="bg-info">Survey Details</h3>
            <div class="form-group">
                <div class="col-sm-12"><label>Description</label><input type="textarea" class="form-control" value="{{$survey->description}}"></div>
                <div class="col-sm-3"><label>Start Date</label><input type="text" class="form-control" value="{{$survey->start_date}}"></div>
                <div class="col-sm-3"><label>End Date</label><input type="text" class="form-control" value="{{$survey->end_date}}"></div>
                <div class="col-sm-3"><label>Number of Questions</label><input type="text" class="form-control" value="{{ $survey->number_of_questions }}"></div>
                <div class="col-sm-3"><label>Is Active</label><input type="text" class="form-control" value="{{$survey->is_open}}"></div>
            </div>
        </div>

        <div class="row" ng-controller="MyCtrl">
            <div class="form-group">
            <h3>Questions</h3>
                <div class="col-sm-12">
                    <form class="form-inline" ng-app="myApp" ng-controller="MyCtrl">

                        [<span ng-repeat="input in inputs">"<%input.value%>"</span>]
                        <div ng-repeat="input in inputs">
                            <input type="text" ng-model="input.value" class="form-control voffset2"/>
                            <button class = 'btn btn-primary form-control voffset2' ng-click="removeInput($index)">-</button>
                        </div>
                        <button class = 'btn btn-primary form-control voffset2' ng-click="addInput()">ADD</button>
                    </form>
                </div>
            </div>
        </div>
	</section>
@stop