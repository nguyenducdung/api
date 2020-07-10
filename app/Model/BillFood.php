<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BillFood extends Model
{

   protected $guarded = ['id'];
    const WAITING_STATUS = 0;
    const DONE_STATUS    = 1;

    const CANCEL_STATUS  = 2;

    public function food(){
       return $this->hasOne(Food::class,'id','food_id');
   }
    public function bill(){
        return $this->hasOne(Bill::class,'id','bill_id');
    }
}
