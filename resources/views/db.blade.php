@extends('...default')
    @section('content')
        <div class="col-sm-12">
       {!! HTML::linkAction('DBManageController@update') !!}
        </div>

    @endsection
@stop