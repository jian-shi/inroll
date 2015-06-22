<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Occupation extends Model {

    public function electors(){
        return $this->hasMany('App\Elector');
    }

}
