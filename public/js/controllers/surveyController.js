app.controller('SurveyController',function SurveyController($scope, $routeParams, Survey) {
    $scope.questionData = {};
    $scope.loading = true;

    Survey.getSurvey($routeParams.surveyId)
    .success(function(data){
        $scope.survey = data;

    });

    Survey.getQuestions($routeParams.surveyId)
        .success(function(data){
            $scope.questions = data;

        });

    $scope.newQuestion = {text:''};
    $scope.addQuestion = function addQuestion(){
        $scope.newQuestion.surveyId = $scope.survey.id;
        Survey.addQuestion($scope.newQuestion)
            .success(questionAddSuccess).error(questionAddError);
    }

    function questionAddSuccess(data){
        $scope.error = null;
        $scope.questions.push(data);

        $scope.newQuestion = {text:''};
    }

    function questionAddError(data){
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

