<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameManagement extends Model
{
    protected $fillable = ['level_id', 'no_voucher', 'voucher_price', 'no_user_point', 'no_of_user', 'remaining_user'];
}
