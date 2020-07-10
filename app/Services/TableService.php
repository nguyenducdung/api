<?php

namespace App\Services;


use App\Repositories\TableRepository;

class TableService {


    protected $tableRepository;
    public function __construct(TableRepository $tableRepository)
    {
        $this->tableRepository = $tableRepository;
    }

    public function getAllTable(){
        return $this->tableRepository->getAll();
    }
    public function create($params){
        return $this->tableRepository->create($params);
    }
    public function find($id){
        return $this->tableRepository->find($id);
    }
    public function update($id,$params){
        $this->tableRepository->updateById($id,$params);
        return $this->tableRepository->find($id);
    }
    public function delete($id){
        return $this->tableRepository->delete($id);
    }

}
