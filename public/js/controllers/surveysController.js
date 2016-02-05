app.controller('SurveysController', function SurveysController($scope, $http, Survey) {
    $scope.surveyData={};
    $scope.loading = true;

    Survey.getSurveys()
        .success(function(data){
            $scope.surveys = data;
            $scope.loading = false;
    });

    $scope.newSurvey = {description:'',start_date:'', is_open:''};
    $scope.addSurvey = function addSurvey() {
        Survey.addSurvey($scope.newSurvey).success(surveyAddSuccess).error(surveyAddError);
    };

    function surveyAddSuccess(data){
        $scope.error = null;
        $scope.surveys.push(data);
        $scope.newSurvey = {description:'',start_date:'', is_open:''};
    }

    function surveyAddError(data){
        $scope.error = data
    }

    $scope.removeSurvey = function removeSurvey(id){
        if (confirm('Do you really want to remove this survey?')) {
            Survey.removeSurvey(id).success(surveyRemoveSuccess);
        }
    };

    function surveyRemoveSuccess(data) {
        var i = $scope.surveys.length;
        while (i--) {
            if ($scope.surveys[i].id == data) {
                $scope.surveys.splice(i, 1);
            }
        }
    }
});

