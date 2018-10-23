<?php

namespace App;

use App\Level;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserManagement extends Model
{
	use SoftDeletes;
    
    public $fillable = ['level_name', 'no_of_user','status'];

	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function levelName()
    {
    	return $this->belongsTo('App\Level','level_name','id');
    }
}
