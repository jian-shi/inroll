<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Occupation extends Model {

    protected $fillable = [];
    protected $table = 'occupation_category';
    public function electors(){
        return $this->hasMany('App\Elector');
    }

}
