<?php

namespace App;

use App\UserManagement;
use App\GameManagement;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = ['level_name'];

    /*protected $hidden = [
        'created_at', 'updated_at',
    ];*/

    public function UserManage()
    {
    	return $this->hasOne('App\UserManagement');
    }

    public function GameManage()
    {
    	return $this->hasOne('App\GameManagement');
    }
}
