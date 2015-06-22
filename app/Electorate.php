<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Electorate extends Model
{

    protected $fillable = [];
    protected $table = 'electorate';

    public function electors(){
        return $this->hasMany('App\Elector');
    }

    public function addresses(){
        return $this->hasMany('App\Address');
    }
}