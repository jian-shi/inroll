angular.module('questionService', [])
    .factory('Question', function($http) {
        return {
            // get all the questions
            get : function() {
                return $http.get('/api/questions');
            },

            // save a question (pass in question data)
            save : function(questionData) {
                console.log(questionData);
                return $http({
                    method: 'POST',
                    url: '/api/questions',
                    headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                    data: $.param(questionData)
                });

            },

            // destroy a question
            destroy : function(id) {
                return $http.delete('/api/questions/' + id);
            }
        }

    });