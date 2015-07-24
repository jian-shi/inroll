<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
	protected $fillable = ['relation','party_vote','is_gna','user_id','elector_id'];
    protected $table = 'relation';

    public function elector(){
        return $this->belongsTo('App\Elector', 'elector_id');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
