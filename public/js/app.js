var app = angular.module('app',['ngRoute']);

app.config(function($routeProvider,  $locationProvider) {
    $routeProvider
        .when('/surveys', { templateUrl: '/partials/survey-list.html',controller: 'SurveysController'})
        .when('/survey/:surveyId', { templateUrl: '/partials/survey-detail.html', controller: 'SurveyController'})
        .when('/survey/:surveyId/survey-record', { templateUrl: '/partials/survey-record.html', controller: 'SurveyRecordController'})
        .otherwise({ redirect: '/' });
    $locationProvider.html5Mode(true);
});


