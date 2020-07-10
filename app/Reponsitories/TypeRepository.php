<?php

namespace App\Repositories;

use App\Model\Bill;
use App\Model\Food;
use App\Model\Type;
use App\Repositories\Base\BaseRepository;

class TypeRepository extends BaseRepository {

    public function __construct(Type $model)
    {
        $this->model = $model;
    }
    public function getAll(){
        return $this->model->orderBy('id','desc')->get();
    }
    public function findById($typeId){
        return $this->model->find($typeId);
    }
}
