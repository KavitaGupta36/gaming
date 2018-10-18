<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserManagement extends Model
{
    protected $fillable = ['level_name', 'voucher_number'];
}
