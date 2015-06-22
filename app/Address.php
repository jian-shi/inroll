<?php namespace App;

use Illuminate\Database\Eloquent\Model;
//use Maatwebsite\Excel\Facades\Excel;

class Address extends Model 
{
	protected $fillable = [];
    protected $table = 'addresses';

    public function electors(){
        return $this->hasMany('App\Elector');
    }

    public function electorate(){
        return $this->belongsTo('App\Electorate');
    }

    public function feedbacks(){
        return $this->hasMany('App\Feedback');
    }

}
