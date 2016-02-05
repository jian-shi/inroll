<!doctype html>
<html lang="en" ng-app="app">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/css/select2.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">

    <link rel="stylesheet" href="/css/style.css">

    <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js"></script>
    <script type='text/javascript' src="http://code.angularjs.org/1.4.7/angular-route.js"></script>


    <script type='text/javascript' src="/js/app.js"></script>
    <script type='text/javascript' src="/js/controllers/surveysController.js"></script>
    <script type='text/javascript' src="/js/services/surveyService.js"></script>
    <script type='text/javascript' src="/js/controllers/surveyController.js"></script>
    <script type='text/javascript' src="/js/controllers/surveyRecordController.js"></script>
    <meta charset="UTF-8">

    <base href="/surveys">
    <title>inRoll v1.2</title>
</head>
<body>

<div class="view-container">
    <div ng-view class="view-frame"></div>
</div>

</body>
</html>