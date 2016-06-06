<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model 
{
	protected $fillable = [];
    protected $table = 'address';

    public function electors(){
        return $this->hasMany('App\Elector');
    }

    public function electorate(){
        return $this->belongsTo('App\Electorate');
    }

    public function feedbacks(){
        return $this->hasMany('App\Feedback');
    }

    public function phones(){
        return $this->hasManyThrough('App\Phone','App\Elector');
    }

}
