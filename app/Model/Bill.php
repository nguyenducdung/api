<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
   protected $guarded = ['id'];
    const WAITING_STATUS = 0;
    const DONE_STATUS    = 1;
    const CANCEL_STATUS  = 2;
    const PAID_STATUS    = 3;
   public function customer(){
       return $this->hasOne(Customer::class,'id','customer_id');
   }
    public function table(){
        return $this->hasOne(Table::class,'id','table_id');
    }
    public function voucher(){
        return $this->hasOne(Voucher::class,'id','voucher_id');
    }
    public function foods(){
        return $this->hasMany(BillFood::class,'bill_id','id');

    }
}
