var app = angular.module('myApp', ['mainCtrl','questionService'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});