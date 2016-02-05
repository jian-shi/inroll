<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = ['description','start_date','end_date', 'is_open','number_of_questions'];

    public function questions(){
        return $this->hasMany('App\Question');
    }
}
