<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'question';
    protected $fillable = ['text', 'survey_id'];

    public function survey(){
        return $this->belongsTo('App\Survey');
    }

}
