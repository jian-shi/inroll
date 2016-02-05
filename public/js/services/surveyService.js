app.factory('Survey', function($http) {
        return {
            // get all the surveys
            getSurveys : function getSurveys() {
                return $http.get('/api/surveys');
            },

            getSurvey : function getSurvey(id) {
                return $http.get('/api/surveys/'+id);
            },

            addSurvey : function addSurvey(data) {
                return $http.post('/api/surveys/',data);
            },

            removeSurvey : function removeSurvey(id) {
                return $http.delete('/api/surveys/' + id);
            },

            getQuestions : function getQuestions(id) {
                return $http.get('/api/survey/'+id+'/questions');
            },

            addQuestion: function addQuestion(data) {
                return $http.post('/api/questions', data);
            },

            removeQuestion: function removeQuestion(id) {
                return $http.delete('/api/questions/'+ id);
            },

            addSurveyAnswer: function addAnswer(data) {
                console.log(data);
                return $http.post('/api/answers', data);
            }
        }

    });