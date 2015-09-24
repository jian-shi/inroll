<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = 'phone';

    public function elector(){
        return $this->belongsTo('App\elector', 'elector_id');
    }

}
