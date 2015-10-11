@extends('default')

@section('content')
	<section>

				<div class="row">
					<div class="col-lg-6">
						<h3>Create a Survey</h3>
						{!! Form::open(['url'=> 'survey','class'=>'form-horizontal'])!!}
                            <div class="form-group">
                            <div class="col-sm-12"><label>Description</label>{!! Form::textarea('description', null, ['class' => 'form-control']) !!}</div>
                            <div class="col-sm-3"><label>Start Date</label>{!! Form::text('start_date', null, ['class'=>'form-control','placeholder'=>'dd-mm-yyyy' ]) !!}</div>

                            <div class="col-sm-3"><label>End Date</label>{!! Form::text('end_date', null, ['class'=>'form-control','placeholder'=>'dd-mm-yyyy' ]) !!}</div>
                            <div class="col-sm-3"><label>Number of Questions</label>{!! Form::text('number_of_questions', null, ['class'=>'form-control']) !!}</div>
                            <div class="col-sm-3"><label>Active</label>{!! Form::select('is_open',[1=>'True', 0=>'False' ], true, ['id'=>'selectActive', 'class' =>'form-control']) !!}</div>
                            </div>


                            {{--<div class="form-group">--}}
                            {{--<div class="col-sm-12"><label>Question 1</label>{!! Form::text('question', null, ['class'=>'form-control']) !!}</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group">--}}
                            {{--<div class="col-sm-12"><label>Question 2</label>{!! Form::text('question', null, ['class'=>'form-control']) !!}</div>--}}
                            {{--</div>--}}

                            <div class="form-group">
                            <div class="col-sm-12">
                            {!! Form::submit('Submit',  ['class'=> 'btn btn-primary']) !!}
                            </div>
                            </div>



    					{!! Form::close() !!}


					</div>
				</div>

	</section>
@stop