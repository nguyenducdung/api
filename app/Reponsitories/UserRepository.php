<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\User;

class UserRepository extends BaseRepository {

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAllUser(){
        return $this->model->orderBy('id','desc')->get();
    }

    public function updateUser($userId,$params){
        return $this->model->where('id',$userId)->update($params);
    }
}
