<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserToken extends Model
{
    protected $guarded = ['id'];
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

}
