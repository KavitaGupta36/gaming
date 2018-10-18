<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoucherManagement extends Model
{
    protected $fillable = ['name', 'desc', 'amount', 'link_code', 'status'];
}
