@extends('...default')
    @section('content')
        <div id="mapid"></div>
    @endsection
    @section('script')
        <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
        {!! HTML::script('scripts/epsom.js') !!}
        {!! HTML::script('scripts/akl.js') !!}
        {!! HTML::script('scripts/leaflet.js') !!}

        {!! HTML::script('scripts/chart/src/Chart.Core.js') !!}
        {!! HTML::script('scripts/chart/src/Chart.Doughnut.js') !!}
    @endsection
@stop
