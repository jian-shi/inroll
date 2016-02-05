<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public $timestamps = false;
    protected $table = 'survey_question_answer';
    protected $fillable = ['electorId', 'surveyId','questionId','answer'];

}
