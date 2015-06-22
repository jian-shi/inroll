<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Age extends Model
{

    protected $fillable = [];
    protected $table = 'age';

    public function electors(){
        return $this->hasMany('App\Elector');
    }


}