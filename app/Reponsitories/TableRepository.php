<?php

namespace App\Repositories;

use App\Model\Table;
use App\Repositories\Base\BaseRepository;

class TableRepository extends BaseRepository {

    public function __construct(Table $model)
    {
        $this->model = $model;
    }
    public function getAll(){
        return $this->model->orderBy('id','desc')->get();
    }
}
