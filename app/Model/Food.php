<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $guarded = ['id'];
    protected $table = 'foods';

    public function bill_food(){
        return $this->hasOne(BillFood::class,'food_id','id');
    }
    public function order_history(){
        return $this->hasMany(BillFood::class,'food_id','id');
    }
    public function type(){
        return $this->hasOne(Type::class,'id','type_id');
    }
    public function vote(){
        return $this->hasMany(FoodVote::class,'food_id','id');
    }
}
