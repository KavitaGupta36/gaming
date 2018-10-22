<?php

namespace App;

use App\Level;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GameManagement extends Model
{
	use SoftDeletes;

    public $fillable = ['level_id', 'no_voucher', 'voucher_price', 'no_user_point', 'no_of_user', 'remaining_user','status'];

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
