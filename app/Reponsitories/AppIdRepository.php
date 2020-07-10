<?php

namespace App\Repositories;

use App\Model\AppId;
use App\Repositories\Base\BaseRepository;

class AppIdRepository extends BaseRepository {

    public function __construct(AppId $model)
    {
        $this->model = $model;
    }
    public function getAll(){
        return $this->model->orderBy('id','desc')->get();
    }
    public function getByUser($userId){
        return $this->model->where('user_id',$userId)->get();
    }
    public function findById($typeId){
        return $this->model->find($typeId);
    }
    public function findByToken($token){
        return $this->model->where('token',$token)->first();
    }
}
