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

        {{--<div class="row">--}}
            {{--<div class="form-group">--}}
            {{--<h3>Questions</h3>--}}
                {{--<div class="col-sm-12">--}}
                    {{--<form class="form-inline" ng-controller="mainCtrl">--}}
                        {{--[<span ng-repeat="input in inputs">"<%input.value%>"</span>]--}}
                        {{--<div ng-repeat="input in inputs">--}}
                            {{--<input type="text" ng-model="input.value" class="form-control voffset2"/>--}}
                            {{--<button class = 'btn btn-primary form-control voffset2' ng-click="removeInput($index)">-</button>--}}
                        {{--</div>--}}
                        {{--<button class = 'btn btn-primary form-control voffset2' ng-click="addInput()">ADD</button>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="row">
        <h3 class="bg-info">Submit Questions</h3>
            <div class="col-md-12" ng-controller="MainController">
                <form ng-submit="submitQuestion()"> <!-- ng-submit will disable the default form action and use our function -->
                    <!-- AUTHOR -->


                    <!-- COMMENT TEXT -->
                    <div class="form-group">
                        <input Type="hidden" ng-init='questionData.survey_id={{$survey->id}}' ng-model="questionData.survey_id"/>
                        <input type="text" class="form-control input-lg" name="question" ng-model="questionData.text" placeholder="Add a survey question">
                    </div>

                    <!-- SUBMIT BUTTON -->
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                    </div>
                </form>

                <!-- LOADING ICON =============================================== -->
                <!-- show loading icon if the loading variable is set to true -->
                <p class="text-center" ng-show="loading"><span class="fa fa-meh-o fa-5x fa-spin"></span></p>

                <!-- THE COMMENTS =============================================== -->
                <!-- hide these comments if the loading variable is true -->
                <div class="question" ng-hide="loading" ng-repeat="question in questions">
                    <h3>Question #<% question.id %></h3>
                    <p><% question.text %></p>
                    <p><a href="#" ng-click="deleteQuestion(question.id)" class="text-muted">Delete</a></p>
                </div>
            </div>
        </div>
	</section>
@stop