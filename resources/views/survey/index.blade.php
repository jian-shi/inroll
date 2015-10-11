@extends('default')

@section('content')

@if (count($surveys) > 0)
<div class="col-lg-12">
        {!! Form::open(['method'=> 'GET', 'class'=>'form-horizontal']) !!}
        <div class="form-group">
        <h3 class="bg-info">Found {{count($surveys)}} Survey(s)</h3>
        </div>

        <div class="form-group">
        <table class="table table-striped table-bordered">
        <thead>
            <th>ID</th>
            <th>Description</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Open</th>
            <th>Edit</th>


        </thead>
        <tbody>
            @foreach ($surveys as $survey)
            <tr>
            <td>{{{ $survey->id }}}</td>
            <td>{{{ $survey->description }}}</td>
            <td>{{{ $survey->start_date }}}</td>
            <td>{{{ $survey->end_date }}}</td>
            <td>{{{ $survey->is_open }}}</td>


            <td>{!! link_to_route('survey_path', 'Edit', [$survey->id]) !!}</td>


            {!! Form::close() !!}

            </tr>
            @endforeach
        </tbody>
        </table>
        </div>

</div>
@endif
@stop