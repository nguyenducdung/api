<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $guarded = ['id'];
    const USED_STATUS = 0;
    const AVAILABLE_STATUS    = 1;
    public function customer_info(){
        return $this->hasOne(Customer::class,'id','user_id');
    }
}
