<!DOCTYPE html>
<html lang="en" ng-app = "app">
<head>
	<!-- Latest compiled and minified CSS -->
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    {!! HTML::style('css/style.css') !!}
    <!-- Select2 -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/css/select2.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
    <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular.min.js"></script>
    <script type='text/javascript' src="http://code.angularjs.org/1.5.0/angular-route.js"></script>
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />

    {!! HTML::script('js/app.js')!!}
    {!! HTML::script('js/controllers/surveysController.js')!!}
    {!! HTML::script('js/services/surveyService.js')!!}
    {!! HTML::script('js/controllers/surveyController.js')!!}
    {!! HTML::script('js/controllers/surveyRecordController.js')!!}
    <meta charset="UTF-8">

	<title>inRoll v1.2</title>


</head>
<body >
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">inRoll</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="/">Search</a></li>
            <li><a href="/address/">Address</a></li>
            <li><a href="/elector/">Elector</a></li>
            <li><a href="/phone/">Phone</a></li>
            <li><a href="/surveys/">Survey</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hi, {{ Auth::user()->name ?: '' }}  <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="/auth/logout">Logout</a></li>
                <li class="divider"></li>
                <li><a href="#">Report Bugs</a></li>
                <li class="divider"></li>
                <li><a href="/db">Database Management</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

	<div class="container">
	    @if(Session::has('flash_message'))
	        <div class="alert alert-success">{{Session::get('flash_message')}}</div>
	    @endif
	    @if($errors->any())
        	        <div class="alert alert-danger">
        	            @foreach ($errors->all() as $error)
        	                <li>{{$error}}</li>
        	            @endforeach
        	        </div>
        @endif

		@yield('content')
		<div ng-view></div>
	</div>



	<script src="http://code.jquery.com/jquery.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/js/select2.min.js"></script>

    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>--}}


    {!! HTML::script('scripts/functions.js') !!}
    @yield('script')


    @yield('footer')
</body>
</html>