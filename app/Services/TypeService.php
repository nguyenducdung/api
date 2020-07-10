<?php

namespace App\Services;


use App\Repositories\TypeRepository;

class TypeService {


    protected $typeRepository;
    public function __construct(TypeRepository $typeRepository)
    {
        $this->typeRepository = $typeRepository;
    }

    public function getAll(){
        return $this->typeRepository->getAll();
    }
    public function findById($id){
        return $this->typeRepository->findById($id);
    }

}
