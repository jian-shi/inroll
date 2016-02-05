app.controller('SurveyRecordController',function SurveyRecordController($scope, $routeParams, Survey) {
    $scope.recordData = {};

    Survey.getQuestions($routeParams.surveyId)
        .success(function(data){
            $scope.questions = data;
        });

    $scope.newRecord= {};


    $scope.saveSurveyAnswer = function saveSurveyAnswer(){
        $scope.newRecord.surveyId = $routeParams.surveyId;
        $scope.newRecord.electorId = $scope.electorId;
        Survey.addSurveyAnswer($scope.newRecord)
            .success(answerAddSuccess).error(answerAddError);
    }

    function answerAddSuccess(data){
        console.log(data);
        //$scope.error = null;
        //$scope.questions.push(data);
        //
        //$scope.newQuestion = {text:''};
    }

    function answerAddError(data){
        $scope.error = data;
    }

    $scope.removeQuestion = function removeQuestion(id){
        if (confirm('Do you really want to remove this question?')) {
            Survey.removeQuestion(id).success(questionRemoveSuccess);
        }
    }

    function questionRemoveSuccess(data) {
        var i = $scope.questions.length;
        while(i--){
            if($scope.questions[i].id == data){
                $scope.questions.splice(i, 1);
            }
        }
    }


});

