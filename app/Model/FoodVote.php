<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FoodVote extends Model
{
    protected $guarded = ['id'];
    public function customer(){
        return $this->hasOne(Customer::class,'id','customer_id');
    }
    public function food(){
        return $this->hasOne(Food::class,'id','food_id');
    }
}
