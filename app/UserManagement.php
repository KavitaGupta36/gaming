<?php

namespace App;

use App\Level;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserManagement extends Model
{
	use SoftDeletes;
    
    public $fillable = ['level_name', 'voucher_number','status'];

	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function LevelName()
    {
    	return $this->belongsTo('App\Level');
    }
}
