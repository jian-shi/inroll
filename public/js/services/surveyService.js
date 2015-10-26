angular.module('surveyService', [])
    .factory('Survey', function($http) {
        return {
            // get all the surveys
            get : function() {
                return $http.get('/api/surveys');
            },

            // save a survey (pass in survey data)
            save : function(surveyData) {
                console.log(surveyData);
                return $http({
                    method: 'POST',
                    url: '/api/surveys',
                    headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                    data: $.param(surveyData)
                });

            },

            // destroy a survey
            destroy : function(id) {
                return $http.delete('/api/surveys/' + id);
            }
        }

    });