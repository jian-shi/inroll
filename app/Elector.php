<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Elector extends Model {
	
	protected $fillable = ['gna','hostile'];
    protected $table = 'electors';


	public function address(){
		return $this->belongsTo('App\Address','address_id');
	}

    public function occupations(){
        return $this->hasOne('App\Occupation');
    }

    public function age(){
        return $this->belongsTo('App\Age', 'date_of_birth_range');
    }

    public function electorate(){
        return $this->belongsTo('App\Electorate');
    }

    public function relation(){
        return $this->hasOne('App\Relation');
    }

}

