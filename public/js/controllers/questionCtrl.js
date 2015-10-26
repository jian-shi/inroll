angular.module('questionCtrl', [])
.controller('QuestionController', function($scope, $http, Question) {
    $scope.questionData={};
    $scope.loading = true;

    Question.get()
        .success(function(data){
            $scope.questions = data;
            $scope.loading = false;
    });

    $scope.submitQuestion = function() {
        $scope.loading = true;
        Question.save($scope.questionData).success(function(data){
            Question.get().then(function(getData){
                $scope.questions = getData;
                $scope.loading = false;
            });
        })

    };

    $scope.deleteQuestion = function(id){
        $scope.loading = true;
        Question.destroy(id).then(function(data){
            Question.get().success(function(getData){
                $scope.comments = getData;
                $scope.loading = false;
            });
        });
    };
});

