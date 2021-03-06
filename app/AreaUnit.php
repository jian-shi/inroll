<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaUnit extends Model
{

    protected $fillable = [];
    protected $table = 'census';

    public function electors(){
        return $this->hasMany('App\Elector');
    }

    public function addresses(){
        return $this->hasMany('App\Address');
    }
}